<?php
/**
 * Created by IntelliJ IDEA.
 * User: 王得屹
 * Date: 2016/4/15
 * Time: 12:04
 */
namespace App\Http\Controllers;

use App\Models\ProductPicture;
use Validator;
use Illuminate\Support\Facades\Input;
use App\Models\Stall;
use Illuminate\Contracts\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use EasyWeChat\Foundation\Application;

class StallController extends Controller{
    public function index(){
        $options = config('wechat');
        $app = new Application($options);
        $js = $app->js;

        $user = session('wechat.oauth_user');
        $stall = Stall::where('open_id',$user->openid)->first();
        
        if($stall){
            return view('stall_info',['js'=>$js ,'stall'=>$stall]);
        }else{
            return view('stall',['js'=>$js]);
        }
    }
    
    public function createStall(){
        $options = config('wechat');
        $app = new Application($options);
        $js = $app->js;
        
        $validator = Validator::make(Input::all(), Stall::$rules);

        if ($validator->passes()) {
            // 验证通过就存储用户数据
            $stall = new Stall();
            $user = session('wechat.oauth_user');

            $stall->username = Input::get('username');
            $stall->mobile = Input::get('mobile');
            $stall->weixinNo = Input::get('weixinNo');
            $stall->title = Input::get('title');
            $stall->stallName = Input::get('stallName');
            $stall->stallNum = Input::get('stallNum');
            $stall->city = Input::get('city');
            $stall->stall = Input::get('stall');
            $stall->country = Input::get('country');
            $stall->province = Input::get('province');
            $stall->stallCity = Input::get('stallCity');
            $stall->region = Input::get('region');
            $stall->address = Input::get('address');
            $stall->style = Input::get('style');
            $stall->category = Input::get('category');
            $stall->shipmentOK = Input::get('shipmentOK');
            if (Input::get('contact') == ''){
                echo "<script>history.back(); alert('请选择红了吗对接人!');</script>";
                return;
            }
            $stall->contact = Input::get('contact');
            $stall->open_id = $user->openid;

            $pictures = [];
            if(Input::has('itemImage')){
                foreach (Input::get('itemImage') as $img) {
                    $picture = new ProductPicture();
                    $picture->type = 3;//档口类型为3
                    $picture->url = $img;
                    $picture->file_id = pathinfo($img)['filename'];
                    $picture->upload_time = time();
                    $pictures[] = $picture;
                }
            }

            $stall->save();
            $stall->pictures()->saveMany($pictures);

            echo "<script> alert('注册成功!'); </script>";

            return Redirect::to('stall_index');
        } else {
            // 验证没通过就显示错误提示信息
            echo "<script>history.back(); alert('请按要求填写真实信息!');</script>";
        }
    }
}