<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPanelSuperUserController extends Controller
{
//    Стартовая страница админ панели
    public function index(){
        return view('admin_panel_super_user');
    }

//    страница пользователей системы
    public function show_users(){
        $users = DB::table('users')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')
            ->select('users.id', 'users.name', 'role_users.text_', 'users.telephon_number', 'users.active')
            ->where('users.id', '!=', Auth::id())
            ->get();

        return view('admin_panel_super_user.users', ['data' => $users]);
    }

//    страница созданных экзаменов
    public function show_exam(){
        $exam = DB::table('editors')
            ->join('users', 'users.id', '=', 'editors.editor_id')
            ->join('exams', 'exams.id', '=', 'editors.exam_id')
            ->select('editors.id', 'users.name', 'exams.text_')
            ->get();

        $users = DB::table('users')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')
            ->select('users.id', 'users.name')
            ->where([
                ['role_users.text_', '=', 'Экзаменатор'],
                ['users.active', '=', '1']
            ])
            ->get();

        return view('admin_panel_super_user.exams', ['data' => $exam, 'examiners' => $users]);
    }

//    страница привязки экзаменов
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

//    страница резултатов экзамена
    public function show_result_exam(){
       $report_exam_students = DB::table('report_exam_students');

       if ($report_exam_students->count()){
           $report_exam_students
               ->join('exams', 'exams.id', '=', 'report_exam_students.exam_id')
               ->join('users', 'users.id', '=', 'report_exam_students.student_id')
               ->select('report_exam_students.id', 'exams.text_', 'users.name', 'report_exam_students.exam_result', 'report_exam_students.exam_date')
               ->get();

           return view('admin_panel_super_user.result_exam', ['data' => $report_exam_students]);
       } else return view('admin_panel_super_user.result_exam', ['data' => null]);
    }
}
