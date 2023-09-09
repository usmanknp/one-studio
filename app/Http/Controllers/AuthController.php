<?php

namespace App\Http\Controllers;

use Validator;
use Exception;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Str;
use Mail;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login_view()
    {
        return view('login');
    }

    public function user_handshake(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'message' => 'Please fill all the missing fields'
                ], 422);
            }

            if(User::where(['email' => $request->email, 'status' => 0])->first())
            {

                $message = "Your account is in active!";
                 return redirect()->to('/')->with('message', $message);
            }

            try
            {
                if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
                {
                    $message = "Login Successfuly!";
                    // return redirect()->to('/')->with('success', $message);
                    return redirect()->intended('/dashboard');
                }
                else
                {
                    // event(new LoginActivity($request));
                    $message = "Credential invalid!";
                    return redirect()->to('/')->with('message', $message);
                }
            }
            catch(Exception $e)
            {
                return response()->json([
                    'message' => $e->getMessage()
                ], 422);
            }


        } catch(Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function user_logout()
    {
        Auth::logout();
        return redirect('/');
    }


    public function user_create()
    {
        return view('users.create');
    }


    public function user_save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required'
        ]);

        if($validator->fails())
        {
            return redirect()->to('/user-create')->with('error','All Fields are required!');
        }

        if(User::where(['email' => $request->email])->count() > 0)
        {
            return redirect()->to('/user-create')->with('error','Email already exists!');
        }

        $user = new User();
        $user->uuid = Str::uuid();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = 1;
        $user->save();

        if($request->type === 'editor')
        {
            $this->set_editor_permissions($user);
            //Assign Role
            $user->assign('editor');
            return redirect()->to('/user-create')->with('message','Editor Account create successfully!');
        }

        $this->set_user_permissions($user);
            //Assign Role
            $user->assign('user');
            return redirect()->to('/user-create')->with('message','User Account create successfully!');
    }

    public function user_list()
    {
        $records = User::all();
        // dd($users->roles);
        // $roles = [];
        // foreach($users  as $key => $user)
        // {
        //     foreach($user as $keey => $role)
        //     {
        //         $roles[$role] = $user;
        //     }
            
        // }
        // dd($roles);
        return view('users.list', compact('records'));
    }


    public function user_edit($uuid)
    {
        $user = User::where('uuid',$uuid)->first();

        if($user)
        {
            return view('users.edit', compact(['user']));
        }
        return redirect()->to('/user-list')->with('error', 'Record Not Found!');
    }

    public function user_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required',
            'status' => 'required'
        ]);


        if($validator->fails())
        {
            return redirect()->to('/user-edit/'  . $request->id)->with('error', 'All Fields are required!');
        }

        // if(User::where(['email' => $request->email])->count() > 0)
        // {
        //     return redirect()->to('/user-edit/' . $request->id)->with('error','Email already exists!');
        // }

        $user = User::where('uuid',$request->id)->first();

        if($user)
        {

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->status = $request->status;
            $user->save();

            return redirect()->to('/user-list')->with('message', 'Record Updated Successfully!');
        }

        return redirect()->to('/user-list')->with('error', 'Something went wrong!');

    }

    private function set_user_permissions($user)
    {
        $permissions = array(
            0 => 'view_class'
        );

        foreach($permissions as $permission)
        {
            $user->allow($permission);
        }

        return true;
    }

    private function set_editor_permissions($user)
    {
        $permissions = array(
            0 => 'view_class',
            1 => 'create_class',
            2 => 'edit_class',
            3 => 'view_offer',
            4 => 'create_offer',
            5 => 'edit_offer',
            6 => 'view_instructor',
            7 => 'create_instructor',
            8 => 'edit_instructor',
        );

        foreach($permissions as $permission)
        {
            $user->allow($permission);
        }

        return true;
    }


    public function api_handshake(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'Please fill all the missing fields'
            ], 422);
        }

        if(User::where(['email' => $request->email, 'status' => 0])->first())
        {

            return response([
                'message' => 'Your account inactive'
            ],422);
        }

        try
        {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            {
                $token = $request->user()->createToken('my-app-token')->plainTextToken;

                return response([
                    'token' => $token,
                    'user' => $request->user()
                ]);
            }
            else
            {
                return response([
                    'message' => 'Credential invalid!'
                ],422);
            }
        }
        catch(Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function create_account(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'Please fill all the missing fields'
            ], 422);
        }

        if(User::where(['email' => $request->email])->count() > 0)
        {
            return response()->json([
                'message' => 'Email already exist'
            ], 422);
        }

        try
        {
            $user = new User();
            $user->uuid = Str::uuid();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->status = 1;
            $user->save();

            $this->set_user_permissions($user);
            //Assign Role
            $user->assign('user');

            $sender = $user->email;
            $subject = 'Your OnePilatesStudio account is now created';
            $template_name = 'mail/templates/welcome_mail';
    
            $mail_data = array(
                'name' => $user->name,
            );
            Mail::send($template_name, ['data' => $mail_data], function($message) use ($sender, $subject) {
                $message->to($sender)->subject($subject);
            });

            return response()->json([
                'message' => 'Your Account Create Successfully!'
            ], 200);
        }
        catch(Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function api_user_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'country' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'Please fill all the missing fields'
            ], 422);
        }
  
       $address= Address::updateOrCreate(
            ['user_id' => $request->user()->id],
            [
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
            ]
        );
        if($address)
        {
            return response()->json([
                'message' => 'Profile Updated Successfully!'
            ], 200);
        }
    }
    public function api_user_info(Request $request)
    {
        $user = User::where('id',$request->user()->id)->with('address')->get();
        return response()->json([
            'data' => $user
        ], 200);
    }

    public function api_user_logout(Request $request)
    {
        $logout = $request->user()->currentAccessToken()->delete();

        if($logout)
        {
            return response([
                'message' => 'User is logged out successfully. Please login now.'
            ], 200);
        }

        return response([
            'message' => 'Something went wrong'
        ], 422);
    }

}
