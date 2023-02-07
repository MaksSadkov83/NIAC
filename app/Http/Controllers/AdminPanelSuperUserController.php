<?php

namespace App\Http\Controllers;

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
}
