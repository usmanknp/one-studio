@extends('mail.layout')
@section('content')
You have requested to reset your password Click on the button below to reset your password
<a style="display: block;  text-decoration: none; text-align: center; color: #ffde00; font-weight: 700; padding: 2px; overflow: hidden; border-radius: 8px;"
                                    href="{{ env('SHOP_URL') }}/auth/reset-password/alskdfjlkasdjflksadjf"
                                    target="_blank">Click here to reset password</a>
@endsection