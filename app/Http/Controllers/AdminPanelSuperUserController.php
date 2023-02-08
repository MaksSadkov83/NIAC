<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\RoleUsers;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPanelSuperUserController extends Controller
{
//    загрузка страницы админ панели супер пользователя
    public function index(){
        return view('admin_panel_super_user');
    }

//    загрузка страницы показа пользователей (экзаменаторов) системы
    public function show_users(){
        $eximiners = DB::table('users')
            ->join('role_users', 'users.id', 'role_users.user_id')
            ->select('users.id', 'users.name', 'users.telephon_number', "role_users.text_")
            ->where('role_users.text_', '=', 'Экзаменатор')
            ->get();

        return view('admin_panel_super_user.users', ['data' => $eximiners]);
    }

//    страница обновления пользователей (экзаменаторов) системы
    public function update_users_page($id){
        $users = DB::table('users')
            ->join('role_users', 'users.id', 'role_users.user_id')
            ->select('users.name', 'users.telephon_number', 'role_users.text_')
            ->where('users.id', '=', $id)
            ->first();

        return view('admin_panel_super_user.update_users', ['data' => $users, 'id' => $id]);
    }

//    логика добавления пользователя (экзаменатора)
    public function add_examiners(Request $request){
        try {
            $examiners = Users::create([
                'name' => $request->input('user_name'),
                'password' => bcrypt($request->input('password')),
                'telephon_number' => $request->input('telephon_number'),
            ]);

            RoleUsers::create([
                'user_id' => $examiners->id,
                'text_' => $request->input('role_user'),
            ]);

            return redirect()->route('admin_panel_super_user_show_users');
        } catch (\Illuminate\Database\QueryException $exception){
            return back()->withError('Пользователь с таким номером телефона уже существует!!!');
        }
    }

//    логика обновления пользователя (экзаменатора)
    public function update_examiners($id, Request $request){
        $examiners = Users::findOrFail($id);

        if (!$request->input('password' == null)){
            $examiners->password = bcrypt($request->input('password'));
            $examiners->name = $request->input('user_name');
            $examiners->telephon_number = $request->input('telephon_number');
            $examiners->save();
        }

        $examiners->name = $request->input('user_name');
        $examiners->telephon_number = $request->input('telephon_number');
        $examiners->save();

        $role_user = RoleUsers::where('user_id', $id)->update(['text_' => $request->input('role_user')]);

        return redirect()->route('admin_panel_super_user_show_users')->with('success', 'Пользователь успешно обновлен');
    }

    public function logout(){
        Auth::logoutCurrentDevice();

        return redirect()->route('home');
    }
}

