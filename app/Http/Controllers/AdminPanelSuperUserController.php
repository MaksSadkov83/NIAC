<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\RoleUsers;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPanelSuperUserController extends Controller
{
    public function index(){
        return view('admin_panel_super_user');
    }

    public function show_users(){
        $eximiners = DB::table('users')
            ->join('role_users', 'users.id', 'role_users.user_id')
            ->select('users.id', 'users.name', 'users.telephon_number', "role_users.text_")
            ->where('role_users.text_', '=', 'Экзаменатор')
            ->get();

        return view('admin_panel_super_user.users', ['data' => $eximiners]);
    }

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
}

