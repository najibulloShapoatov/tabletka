<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



public function roles(){
    return $this->belongsTo('App\Model\Role', 'role');
}


    public function loginAdmin( $phone, $pass, $remember)
    {
        $user = $this->where(['phone' => $phone])->get()->first();
        if(!empty($user)){
            if(Hash::check($pass, $user->password))
            {
                if($remember == 1){
                    Auth::loginUsingId($user->id, true);
                }
                else{
                    Auth::loginUsingId($user->id);
                }
                return true;
            }
            return false;
        }
         return false;
    }

    public function login( $phone, $pass, $remember)
    {
        $user = $this->where(['phone' => $phone])->get()->first();
        if(!empty($user)  && $user->is_active == 1){
            if(Hash::check($pass, $user->password))
            {
                if($remember == 1){
                    Auth::loginUsingId($user->id, true);
                }
                else{
                    Auth::loginUsingId($user->id);
                }
                return true;
            }
            return false;
        }
         return false;
    }

    public function makeAuth($id){
        Auth::loginUsingId($id);
        return true;
    }

    public function getByID($id)
    {
        return $this->where('id', $id)->get()->first();
    }

    public function getList()
    {
        return $this->orderBy('id', 'asc')->get();
    }

    public function changeActive($id)
    {
        $u = $this->getByID($id);
        $u->is_active = ($u->is_active == 1)? 0 : 1;
        $u->save();
        return $u->is_active;
    }

    public function checkPhone($phone){
        $rs = $this->where(['phone' => $phone])->exists();
        if ($rs){ return [ 'err'=>1, 'msg'=>'Пользовател с таким телефоном уже существует !!!'];}
        return ['err'=>0];
    }


    public function create(Request $request)
    {
        $in = $request->all();
        $usr = new User();
        $usr->name = trim(htmlspecialchars($in['name']));
        $usr->role = trim(htmlspecialchars($in['role']));
        if(!empty(trim(htmlspecialchars($in['surname'])))) {
            $usr->surname = trim(htmlspecialchars($in['surname']));
        }
        $usr->phone = trim(htmlspecialchars($in['phone']));
        $usr->email = trim(htmlspecialchars($in['email']));
        $usr->password = Hash::make(trim(htmlspecialchars($in['password'])));
        if(!empty(trim(htmlspecialchars($in['city'])))) {
            $usr->city = trim(htmlspecialchars($in['city']));
        }
        if(!empty(trim(htmlspecialchars($in['address'])))) {
            $usr->address = trim(htmlspecialchars($in['address']));
        }
        $usr->save();

        $path = public_path('uploads/users/' . $usr->id);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        if ($file = $request->file('image')) {
            $image = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $imageName = time() . '_' . uniqid() . '.' . $extension;
            $img = Image::make($image);
            $img->save($path . '/' . $imageName);
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $usr->image = $imageName;
            $usr->save();
        }
       return $this->getByID($usr->id);
    }





    public function validatePhone($phone){
        $patternPhoneCode = ['50','55','77','88','90','91','92','93','98','11','00'];
        $mobileregex = "/[0-9]{9}$/";
        $fl_array = preg_grep('/^'.substr($phone, 0, 2).'/', $patternPhoneCode);
        if(empty($phone) || strlen($phone) != 9 || preg_match($mobileregex,$phone) === 0){
            $error = ['err' => 1, 'msg' => 'Введите номер телефона, пример: 900112233'];
            return $error;
        }
        return ['err' => 0];
    }

    public function deleteUser($id)
    {
        $usr = $this->getByID($id);
        $path = public_path('/uploads/users/').$usr->id;
        if(File::isDirectory($path)){
            File::deleteDirectory($path);
        }
        return $usr->delete();
    }



    public function updateUser(Request $request)
    {
        $in = $request->all();
        $id = $request->input('id');
        $usr = $this->getByID($id);
        $usr->name = trim(htmlspecialchars($in['name']));
        $usr->role = trim(htmlspecialchars($in['role']));
        if(!empty(trim(htmlspecialchars($in['surname'])))) {
            $usr->surname = trim(htmlspecialchars($in['surname']));
        }

        $usr->phone = trim(htmlspecialchars($in['phone']));
        $usr->email = trim(htmlspecialchars($in['email']));
        if(!empty(trim(htmlspecialchars($in['password'])))) {
            $usr->password = Hash::make(trim(htmlspecialchars($in['password'])));
        }
        if(!empty(trim(htmlspecialchars($in['city'])))) {
            $usr->city = trim(htmlspecialchars($in['city']));
        }
        if(!empty(trim(htmlspecialchars($in['address'])))) {
            $usr->address = trim(htmlspecialchars($in['address']));
        }
        $usr->save();

        $path = public_path('uploads/users/' . $usr->id);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        if ($file = $request->file('image')) {
            if(File::isFile($path .'/' . $usr->image)){File::delete($path .'/' . $usr->image);}
            $image = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $imageName = time() . '_' . uniqid() . '.' . $extension;
            $img = Image::make($image);
            $img->save($path . '/' . $imageName);
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $usr->image = $imageName;
            $usr->save();
        }
        return $this->getByID($usr->id);
    }




    public function updateUserFrontend(Request $request, $userID )
    {
        $in = $request->all();
        $usr = $this->getByID($userID);
        $usr->name = trim(htmlspecialchars($in['name']));

        if(!empty(trim(htmlspecialchars($in['surname'])))) {
            $usr->surname = trim(htmlspecialchars($in['surname']));
        }
        if(!empty(trim(htmlspecialchars($in['email'])))) {
            $usr->email = trim(htmlspecialchars($in['email']));
        }
        if(!empty(trim(htmlspecialchars($in['city'])))) {
            $usr->city = trim(htmlspecialchars($in['city']));
        }
        if(!empty(trim(htmlspecialchars($in['address'])))) {
            $usr->address = trim(htmlspecialchars($in['address']));
        }
        $usr->save();

        $path = public_path('uploads/users/' . $usr->id);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        if ($file = $request->file('image')) {
            if(File::isFile($path .'/' . $usr->image)){File::delete($path .'/' . $usr->image);}
            $image = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $imageName = time() . '_' . uniqid() . '.' . $extension;
            $img = Image::make($image);
            $img->save($path . '/' . $imageName);
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($path . '/thumb_' . $imageName);
            $usr->image = $imageName;
            $usr->save();
        }
        return $this->getByID($usr->id);
    }

















    // automaticaly authorize user
    public function authAuto($userID)
    {
        return Auth::loginUsingId($userID);
    }




    // update user data
    public function updateUserData($input)
    {
        $name = htmlspecialchars(trim($input['name']));
        $lastname = htmlspecialchars(trim($input['lastname']));
        $address = htmlspecialchars(trim($input['address']));
        $city = htmlspecialchars(trim($input['city']));
        $email = htmlspecialchars(trim($input['email']));

        $user = $this->getByID(Auth::user()->id);
        $user->name = $name;
        $user->surname = $lastname;
        $user->email = $email;
        $user->city = $city;
        $user->address = $address;
        return $user->save();
    }

    // create unregistered user
    public function createUnregisteredUser($input)
    {
        $name = htmlspecialchars(trim($input['name']));
        $lastname = htmlspecialchars(trim($input['lastname']));
        $address = htmlspecialchars(trim($input['address']));
        $city = htmlspecialchars(trim($input['city']));
        $phone = htmlspecialchars(trim($input['phone']));
        $email = htmlspecialchars(trim($input['email']));
        //$createAccount = htmlspecialchars(trim($input['createAccount']));

        $password = Str::random(4);

        $user = new User();
        $user->name = $name;
        $user->surname = $lastname;
        $user->email = $email;
        $user->city = $city;
        $user->address = $address;
        $user->phone = $phone;
        $user->password = Hash::make($password);
        $result = $user->save();

        if($result){
            return [
                'id' => $user->id,
                'password' => $password,
                //'create_account' => $createAccount
            ];
        }

    }

    // validate checkout fields
    public function validateCheckoutFields($input)
    {
        $name = htmlspecialchars(trim($input['name']));
        $address = htmlspecialchars(trim($input['address']));
        $phone = htmlspecialchars(trim($input['phone']));
        $email = htmlspecialchars(trim($input['email']));

        if(empty($name) || strlen($name) < 4){
            $error = ['error_code' => 1, 'msg' => 'Введите имя, содержащее больше 3 символов'];
            return $error;
        }

        if(empty($address)){
            $error = ['error_code' => 1, 'msg' => 'Введите адрес'];
            return $error;
        }

        if(!Auth::check())
        {
            $patternPhoneCode = ['50','55','77','88','90','91','92','93','98','99','11','00'];
            $mobileregex = "/[0-9]{9}$/";
            $fl_array = preg_grep('/^'.substr($phone, 0, 2).'/', $patternPhoneCode);

            if(empty($phone) || strlen($phone) != 9 || preg_match($mobileregex,$phone) === 0){
                $error = ['error_code' => 1, 'msg' => 'Введите номер телефона, пример: 900112233'];
                return $error;
            }

            if(count($fl_array) == 0){
                $error = ['error_code' => 1, 'msg' => 'Неправильный код мобильного оператора'];
                return $error;
            }

            if($this->where('phone', $phone)->exists()){
                $error = ['error_code' => 1, 'msg' => 'Ваш номер телефона имеется в нашей базе. Выберите другой или <a href="/sign-in">авторизуйтесь</a>'];
                return $error;
            }

        }

        if(!empty($email)){
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error = ['error_code' => 1, 'msg' => 'Введите правильны формат эл. почты'];
                return $error;
            }

        }

        return ['error_code' => 0, 'msg' => ''];
    }







    public function checkConfirmPassword($pass, $cpass){
        if ($pass != $cpass ){ return [ 'err'=>1, 'msg'=>'Пароли не совпадают !!!'];}
        return ['err'=>0];
    }
    public function checkPassword($pass, $userID){
        $user = $this->getByID($userID);
        if (Hash::check($pass, $user->password))
        {
            return ['err'=>0];
        }
        return [ 'err' => 1, 'msg' => 'Неверно введен старый пароль !!!'];

    }

    public function createFromFrontend(Request $request)
    {
        $in = $request->all();
        $usr = new User();
        $usr->name = trim(htmlspecialchars($in['name']));
        $usr->phone = trim(htmlspecialchars($in['phone']));
        $usr->password = Hash::make(trim(htmlspecialchars($in['password'])));
        $usr->is_active = 0;
        $usr->sms_code = 2211;
        $usr->save();

        $path = public_path('uploads/users/' . $usr->id);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        if ($file = $request->file('image')) {
            $image = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $imageName = time() . '_' . uniqid() . '.' . $extension;
            $img = Image::make($image);
            $img->save($path . '/' . $imageName);
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($path . '/thumb_' . $imageName);
            $usr->image = $imageName;
            $usr->save();
        }
        return $this->getByID($usr->id);
    }

    public function checkSmsCode( $id, $smsCode)
    {
        $usr = $this->where(['id'=>$id, 'sms_code'=>$smsCode])->exists();
        if ($usr){
            return true;
        }
        return false;
    }

    public function changePassword($id, $pass)
    {
        $usr = $this->getByID($id);
        $usr->password = Hash::make($pass);
        $usr->save();
    }
}
