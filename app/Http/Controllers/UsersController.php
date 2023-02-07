<?php

namespace App\Http\Controllers;

use App\Models\RoleUsers;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function login(Request $request){
        if (!Auth::attempt($request->only('id', 'password'))){
            echo "Error";
        } else {
            $user_role = DB::table('role_users')->where('user_id', '=', $request->input('id'))->first();

            if ($user_role->text_ == 'SuperAdmin'){
                return redirect()->route('admin_panel_super_user');
            } else if ($user_role->text_ == 'Экзаменатор'){
                echo "Экзаментатор";
            } else if ($user_role->text_ == 'Экзаменующийся'){
                echo "Экзаменующийся";
            }
        }
    }

    public function registration(Request $request){
        $user_id = Users::create([
            'name' => $request->input('user_name'),
            'telephon_number' => $request->input('telephon_number'),
            'password' => bcrypt($request->input('password')),
        ]);

        RoleUsers::create([
           'user_id' => $user_id->id,
            'text_' => $request->input('role_user')
        ]);

        return redirect()->route('home');
    }
}
