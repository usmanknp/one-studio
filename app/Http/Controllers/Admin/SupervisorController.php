<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Validator;
use Exception;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Str;
use Mail;
use App\Jobs\sendMail;
use App\Models\Media;
use App\Models\TechnicianSetting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;

class SupervisorController extends Controller
{
 

    public function user_create()
    {
        return view('admin.supervisor.create');
    }


    public function user_save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required',
            'company_id' => 'required',
            'mobile_no' => 'required',
            'location' => 'required'

        ]);

        if($validator->fails())
        {
            return redirect()->to('/user-create')->with('error','All Fields are required!');
        }

        if(User::where(['email' => $request->email])->count() > 0)
        {
            return redirect()->to('/user-create')->with('error','Email already exists!');
        }
        DB::beginTransaction();
        $user = new User();
        $user->uuid = Str::uuid();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->locale = 'en';
        $user->password = bcrypt($request->password);
        $user->status = 1;

        if (!file_exists(public_path('/uploads/media')))
        {
            mkdir(public_path('/uploads/media'), 0777, true);
        }

        $filename = time().'.'.$request->file->getClientOriginalExtension();
        $request->file->move(public_path('uploads/avatars'), $filename);
        $user->avatar = $filename;
        $user->save();

        $setting = new TechnicianSetting();
        $setting->user_id = $user->id;
        $setting->company_id = $request->company_id;
        $setting->mobile_no = $request->mobile_no;
        $setting->location = $request->location;
        $setting->save();

       

        // $this->update_media($request->all(), $user->id, 'User');
       
        // $sender = $user->email;
        //     $subject = 'Your OnePilatesStudio account is now created';
        //     $template_name = 'mail/templates/welcome_mail';
    
        //     $mail_data = array(
        //         'name' => $user->name,
        //     );
           
        //   dispatch(new sendMail($template_name, $mail_data, $sender, $subject));

        // $this->set_editor_permissions($user);
        $user->assign('supervisor');
        DB::commit();
        return redirect()->to('/backend/supervisor/user-create')->with('message','Account create successfully!');

    }

    public function user_list()
    {
        $records =  User::whereHas('roles', function($sub_query) {
            $sub_query->where('roles.name', '=', 'supervisor');
        })->get();
        return view('admin.supervisor.list', compact('records'));
    }


    public function user_edit($uuid)
    {
        $user = User::where('uuid',$uuid)->first();

        if($user)
        {
            return view('admin.supervisor.edit', compact(['user']));
        }
        return redirect()->to('/backend/supervisor/user-list')->with('error', 'Record Not Found!');
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
            return redirect()->to('/backend/supervisor/user-edit/'  . $request->id)->with('error', 'All Fields are required!');
        }

        // if(User::where(['email' => $request->email])->count() > 0)
        // {
        //     return redirect()->to('/user-edit/' . $request->id)->with('error','Email already exists!');
        // }

        $user = User::where('uuid',$request->id)->first();

        if($user)
        {

            $user->name = $request->name;
            // $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->status = $request->status;
            $user->save();

            return redirect()->to('/backend/supervisor/user-list')->with('message', 'Record Updated Successfully!');
        }

        return redirect()->to('/backend/supervisor/user-list')->with('error', 'Something went wrong!');

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
}
