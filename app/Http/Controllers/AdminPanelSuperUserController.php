<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPanelSuperUserController extends Controller
{
    public function index(){
        return view('admin_panel_super_user');
    }

    public function show_users(){
        $users = DB::table('users')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')
            ->select('users.id', 'users.name', 'role_users.text_', 'users.telephon_number', 'users.active')
            ->where('users.id', '!=', Auth::id())
            ->get();

        return view('admin_panel_super_user.users', ['data' => $users]);
    }

    public function show_exam(){
        $exam = DB::table('editors')
            ->join('users', 'users.id', '=', 'editors.editor_id')
            ->join('exams', 'exams.id', '=', 'editors.exam_id')
            ->select('editors.id', 'users.name', 'exams.text_')
            ->get();

        return view('admin_panel_super_user.exams', ['data' => $exam]);
    }

    public function show_link_exam(){
        $student_answers = DB::table('student_exams')
            ->join('users', 'users.id', '=', 'student_exams.student_id')
            ->join('exams','exams.id', '=', 'student_exams.exam_id')
            ->select('student_exams.id', 'users.name', 'exams.text_', 'student_exams.min_score')
            ->get();

        $exams = Exam::all();
        $students = DB::table('users')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')
            ->select('users.name', 'users.id')
            ->where([
                ['role_users.text_', '=', 'Экзаменующийся'],
                ['users.active', '=', '1']
            ])
            ->get();

        return view('admin_panel_super_user.link_exam', ['data' => $student_answers, 'exam_list' => $exams, 'students' => $students]);
    }


}
