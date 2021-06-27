<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function profile(){
        $usr = (new User())->getByID(Auth::id());

        $cart = new Cart();
        $wishlist = $cart->getWishlist();
        // get cart info
        $ordrs = (new Order())->getlistByUser($usr->id);

        return view('frontend.user.index', compact([
            'usr',
            'wishlist',
            'ordrs',
        ]));
    }

    public function orderDetail($id){

        $or = (new Order())->getByID($id);
        $html = View::make('frontend.user._order-detail', compact('or'))->render();
        return response()->json($html, 200);
    }
    public function orderList(){

        $ordrs = (new Order())->getlistByUser(Auth::id());

        $html = View::make('frontend.user._orders', compact('ordrs'))->render();

        return response()->json($html, 200);
    }

    public function updateInfo(Request $request){
        if(empty($request->input('name'))){ return response()->json(['err' =>1, 'msg'=>'Введите имя' ], 200);}
        $rs = (new User())->updateUserFrontend($request, Auth::id());
        if ($rs) {
            return response()->json(['err' => 0, 'msg' => 'Успешно !!!'], 200);
        }
    }
    public function updatePass(Request $request){
        $res =  $request->validate([
            'oldpass' => 'required',
            'newpass' => 'required',
            'confirmpass' => 'required',
        ]);

        if($res) {

            $checkPass = (new User())->checkPassword($request->input('oldpass'), Auth::id());
            if ($checkPass['err'] == 1) {
                return response()->json($checkPass, 200);
            }
            $checkConfirm = (new User())->checkConfirmPassword($request->input('newpass'), $request->input('confirmpass'));
            if ($checkConfirm['err'] ==1) {
                return response()->json($checkConfirm, 200);
            }
            (new User())->changePassword(Auth::id(), $request->input('newpass'));
            return response()->json([
                'err'=>0,
                'msg'=> "Успешно !!!"
            ], 200);
        }
    }





    public function login(Request $request)
    {


        $res =  $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);

        if($res){
            $in = $request->all();
            $phone = trim(htmlspecialchars($in['phone']));
            $pass = trim(htmlspecialchars($in['password']));
            $r = trim(htmlspecialchars($in['remember']));
            $rs = (new User)->login($phone, $pass, $r);
            if($rs) {
                return Response::json([
                    'err' => 0,
                    'sts' => $rs
                ], 200);
            }
            return Response::json([
                'err'=>1,
                'msg' => 'Неправильно введен телефон или пароль !!!'
            ], 200);

        }
        else{
            return Response::json([
                'err'=>1,
                'msg' => 'Неправильно введен телефон или пароль !!!'
            ], 200);
        }

    }


    public function create(Request $request){
        $v =  $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'password' => 'required',
        ]);

        if($v){

            $validPhone = (new User())->validatePhone($request->input('phone'));
            if($validPhone['err'] != 0){
                return Response::json($validPhone, 200);
            }
            $checkPhone = (new User())->checkPhone($request->input('phone'));
            if($checkPhone['err'] == 1){
                return Response::json($checkPhone, 200);
            }
            $checkPassConfirm = (new User())->checkConfirmPassword($request->input('password'), $request->input('confirmPassword'));
            if($checkPassConfirm['err'] == 1){
                return Response::json($checkPassConfirm, 200);
            }

            $data = (new User())->createFromFrontend($request);;
            return Response::json([
                'err'=>0,
                'res'=>$data->id
            ], 200);
        }
    }

    public function smsCode(Request $request){

        $in = $request->all();
        $id = trim(htmlspecialchars($in['id']));
        $smsCode = trim(htmlspecialchars($in['smsCode']));
        $res = (new User())->checkSmsCode($id, $smsCode);
        if($res){
            (new User())->makeAuth($id);
            return response()->json([
                'sts' =>0,
            ], 200);
        }
        return response()->json([
            'sts' =>1,
            'msg'=>'Неправильно введен код !!!'
        ], 200);
    }

}
