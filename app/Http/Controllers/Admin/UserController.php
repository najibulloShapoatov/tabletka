<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{

    public function index(){
        $users = (new User())->getList();
        $roles = (new Role())->getList();
        return view('admin.user.index', compact(['users', 'roles']));
    }


    public function signIn(Request $request)
    {


        $res =  $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);

        if($res){
            $in = $request->all();
            $phone = trim(htmlspecialchars($in['phone']));
            $pass = trim(htmlspecialchars($in['password']));
            $r = trim(htmlspecialchars($in['r']));
            $rs = (new User)->loginAdmin($phone, $pass, $r);
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

    public function logout(){
        Auth::logout();
        return redirect('/admin');
    }



    public function change($id){
        $rs = (new User())->changeActive($id);
        return Response::json($rs, 200);
    }

    public function create(Request $request){
        $v =  $request->validate([
            'role' => 'required',
            'name' => 'required',
            'phone' => 'required',
           // 'phone' => 'required|unique:users,phone,' .$data->id,
            //'phone' => 'required|unique:users,phone',
            'password' => 'required',
        ]);

        if($v){

            $validPhone = (new User())->validatePhone($request->input('phone'));
            if($validPhone['err'] != 0){
                return Response::json($validPhone, 200);
            }
            $rs = (new User())->checkPhone($request->input('phone'));
            if($rs['err'] == 1){
                return Response::json($rs, 200);
            }

            $data = (new User())->create($request);;
            $html = View::make('admin.user._create', compact(['data']))->render();
            return Response::json([
                'err'=>0,
                'res'=>$html
            ], 200);
        }
    }

    public function delete($id){
        $rs = (new User())->deleteUser($id);
        return Response::json($rs, 200);
    }


    public function edit($id){
        $data = (new User())->getByID($id);
        $roles = (new Role())->getList();
        $html = View::make('admin.user._edit', compact(['data', 'roles']))->render();
        return Response::json($html, 200);
    }












    public function update(Request $request){
        $v =  $request->validate([
            'role' => 'required',
            'name' => 'required',
            'phone' => 'required',
        ]);

        if($v){
            $validPhone = (new User())->validatePhone($request->input('phone'));
            if($validPhone['err'] != 0){
                return Response::json($validPhone, 200);
            }
            $data = (new User())->updateUser($request);
            $html = View::make('admin.user._update', compact(['data']))->render();
            return Response::json([
                'err'=>0,
                'res'=>$html
            ], 200);
        }
    }

}
