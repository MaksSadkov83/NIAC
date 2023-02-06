<?php

namespace App\Http\Controllers;

use App\Models\Editors;
use App\Models\Exam;
use App\Models\Option;
use App\Models\Question;
use App\Models\QuestionTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
//    Вход на стартовую страницу Админ панели
    public function index(){
        return view('admin_home');
    }

//    Страница создания экзамена
    public function create_exam_page(){
        return view('create_exam', ['user_id' => Auth::id()]);
    }

//    Сраница показа созданных экзаменов
    public function show_exam_page(){
        $exam = DB::table('editors')
            ->join('exams', 'exams.id', '=', 'editors.exam_id')
            ->select('editors.id', 'editors.exam_id', 'exams.text_', 'editors.editor_id')
            ->get();

        return view('show_exam', ['data' => $exam]);
    }

//    Страница показа пользователей системы
    public function show_users_page(){
        $users = DB::table('users')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')
            ->select('users.id', 'role_users.text_')
            ->get();
        return view('users', ['data' => $users]);
    }

//    Страница обновления экззамена (названия)
    public function update_exam_page($id){
        $data = DB::table('exams')
            ->select('id', 'text_')
            ->where('id', '=', $id)
            ->first();

        return view('update_exam', ['data' => $data]);
    }

//    Логика создания экзамена
    public function create_exam(Request $request){
        Exam::create([
            'text_' => $request->input('exam_text')
        ]);

        $exam_id = Exam::orderBy('id', 'desc')->first();

        Editors::create([
            'editor_id' => $request->input('editor_id'),
            'exam_id' => $exam_id->id,
        ]);

        return redirect()->route('show_exam');
    }

    public function update_exam(Request $request){
        $update_exam = Exam::find($request->input('exam_id'));

        $update_exam->text_ = $request->input('exam_text');
        $update_exam->save();

        return redirect()->route('show_exam');
    }

//    Логика удаления теста
    public function delete_exam($id){

    }

//    Функция выхода из Админ панели
    public function logout(Request $request){
        return redirect()->route('home');
    }
}
