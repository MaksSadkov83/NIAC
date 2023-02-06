<?php

namespace App\Http\Controllers;

use App\Models\RoleUsers;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function login(Request $request){
        if (!Auth::attempt($request->only('id', 'password'))){
            echo 'Error';
        } else {
            $user = DB::table('role_users')->where('user_id', $request->input('id'))->value('text_');

            if ($user == 'Экзаменатор'){
                return redirect()->route('admin_home');
            } else if ($user == 'Экзаменующийся'){
                return redirect()->route('exam_start');
            }
        }
    }

    public function registration(Request $request){
        Users::create([
            'id' => $request->input('id'),
            'password' => bcrypt($request->input('password')),
        ]);

        RoleUsers::create([
            'user_id' => $request->input('id'),
            'text_' => $request->input('role_user')
        ]);

        return redirect()
            ->route('users')
            ->with('success', 'Пользователь успешно сосздан');
    }

    public function delete_user($id){
        DB::table('role_users')->where('user_id','=', $id)->delete();
        if (DB::table('editors')->count()){
            DB::table('editors')->where('editors.editor_id', '=', $id)->delete();
            DB::table('users')->where('id', '=', $id)->delete();
        } else DB::table('users')->where('id', '=', $id)->delete();

        return redirect()->route('users');
    }

    public function update_users_page($id){
        $users = DB::table('users')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')
            ->select('users.id', 'users.password', 'role_users.text_')
            ->where('users.id', '=', $id)
            ->first();

        return view('update_users', ['data' => $users]);
    }

    public function update_users(Request $request){
        if (!$request->input('password') == null){
            $user = Users::find($request->input('id'));
            $user->password = bcrypt($request->input('password'));
            $user->save();
        }

        $role_user = RoleUsers::where('user_id', $request->input('id'))->update(['text_' => $request->input('role_user')]);

        return redirect()->route('users');
    }
}
