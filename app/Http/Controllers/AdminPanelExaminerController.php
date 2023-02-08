<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPanelExaminerController extends Controller
{
    public function index(){
        return view('admin_panel_examiner');
    }

    public function show_user(){
        $examinee = DB::table('users')
            ->join('role_users', 'users.id', 'role_users.user_id')
            ->select('users.id', 'users.name', 'users.telephon_number', 'role_users.text_')
            ->where('role_users.text_', '=', 'Экзаменующийся')
            ->get();

        return view('admin_panel_examiner.users', ['data' => $examinee]);
    }
}
