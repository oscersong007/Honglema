<?php
/**
 * Created by IntelliJ IDEA.
 * User: 王得屹
 * Date: 2016/4/12
 * Time: 16:29
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Models\User;
use Auth;

class CMSController extends Controller{
    public function index(){
        if(Auth::check()){
            return view('/cms/index');
        }
        else{
            return view('/cms/login');
        }
    }

    public function login(){
        echo Input::get('name');
        echo Input::get('password');
        if (Auth::attempt(array('name'=>Input::get('name'), 'password'=>Input::get('password')))){
            return view('/cms/index');
        }
        else{
            echo "<script>history.go(-1); alert('用户名密码错误!');</script>";
        }
    }
}