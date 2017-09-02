<?php
/**
 * Created by PhpStorm.
 * User: Leafqun
 * Date: 2017/8/27
 * Time: 18:01
 */

namespace App\Http\Controllers;


use App\Students;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function login(Request $request){
        $userName = $request -> input('userName');
        $userPwd = $request -> input('userPwd');
        $student = Students::where('userName', $userName) -> first();
        if(isset($student)){
            if($userPwd === $student -> userPwd) $msg = array("msg"=>"success");
            else $msg = array("msg"=>"密码错误");
        }else{
            $msg = array("msg"=>"用户名不存在");
        }
        return $msg;
    }
}