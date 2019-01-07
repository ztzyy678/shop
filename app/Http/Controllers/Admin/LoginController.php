<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Admin\User\Admin_User;
use Illuminate\Support\Facades\Input;
use Hash;

class LoginController extends Controller
{
    //跳转登录页面
    public function login(Request $request)
    {
    	
		return view ('admin.login');

    	$this->validate($request, [
            'uname' => 'required',
            'pwd' => 'required',
                ],
            [
                'uname.required'=>'用户名必填',
                'pwd.required'=>'密码必填',
            ]);
    }

   //登录验证
    public function dologin()
    {
        $res = Input::except('_token');

        $user = Admin_User::where('uname',$res['uname'])->first();

        //如果数据库中没有此用户，返回登录页面
        if(!$user)
        {
         
            return back()->withErrors('没有这个用户') -> withInput();
        
        }
        
        //验证密码
        if (!Hash::check($res['pwd'],$user['pwd'] )) 
        {
            return back()->withErrors('密码错误') -> withInput();
        }
       
        session(['user'=>$user]);
        
        return redirect('/admin/index');

    }

}
