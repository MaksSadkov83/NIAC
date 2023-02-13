<?php

namespace App\Http\Controllers;

use App\Models\RoleUsers;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
//    авторизация
    public function login(Request $request){
        if (!Auth::attempt($request->only('id', 'password'))){
            echo "Error";
        } else {
            $user_role = DB::table('role_users')->where('user_id', '=', $request->input('id'))->first();
            $user = Users::find($request->input('id'));

            if ($user_role->text_ == 'SuperAdmin'){
                if ($user->active == 1){
                    return redirect()->route('admin_panel_su');
                }
            } else if ($user_role->text_ == 'Экзаменатор'){
                if ($user->active == 1){
                    echo 'Экзаменатор';
                }
            } else if ($user_role->text_ == 'Экзаменующийся'){
                if ($user->active == 1){
                    return redirect()->route('exam_start', ['id' => $request->input('id')]);
                }
            }
        }
//        Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
    }

//    регистрация пользователей ()
    public function registration(Request $request){
        $user_id = Users::create([
            'name' => $request->input('user_name'),
            'telephon_number' => $request->input('telephon_number'),
            'password' => bcrypt($request->input('password')),
            'active' => $request->input('active_user'),
        ]);

        RoleUsers::create([
           'user_id' => $user_id->id,
            'text_' => $request->input('role_user')
        ]);

        return redirect()->route('home');
    }

//    Выход из админ панели
    public function logout(){
        Auth::logoutCurrentDevice();

        return redirect()->route('home');
    }
}
