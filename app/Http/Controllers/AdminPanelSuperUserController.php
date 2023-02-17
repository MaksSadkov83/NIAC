<?php

namespace App\Http\Controllers;

use App\Models\Editors;
use App\Models\Exam;
use App\Models\QuestionTopic;
use App\Models\RoleUsers;
use App\Models\StudentExam;
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
            ->select('editors.id', 'users.name', 'exams.text_', 'editors.exam_id')
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

//    Страница обновления пользователя
    public function update_users_page($id){
        $users = DB::table('users')
            ->join('role_users', 'users.id', 'role_users.user_id')
            ->select('users.id', 'users.name', 'users.telephon_number', 'users.active', 'role_users.text_')
            ->where('users.id', '=', $id)
            ->first();

        return view('admin_panel_super_user.update_users', ['data' => $users]);
    }

//    Страница добавления тем к тесту
    public function topic_show($id){
        $topic = QuestionTopic::where('exam_id', $id)->get();
        return view('admin_panel_super_user.question_topics', ['data' => $topic, 'id_exam' => $id]);
    }

//    Страница добавления вопросов и ответов к вопросам
    public function question_and_option($id){
        $topic = QuestionTopic::find($id);
        return view('admin_panel_super_user.question_and_option', ['name_topic' => $topic->text_, 'id' => $id]);
    }

//    Страница обновления привязки теста к студенту
    public function update_link_exam_page($id){
        $exams = Exam::all();
        $students = DB::table('users')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')
            ->select('users.name', 'users.id')
            ->where([
                ['role_users.text_', '=', 'Экзаменующийся'],
                ['users.active', '=', '1']
            ])
            ->get();

        $student_answers = StudentExam::find($id);

        $current_users = DB::table('users')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')
            ->select('users.name')
            ->where('users.id' ,'=', $student_answers->student_id)
            ->first();

        $current_exam = Exam::find($student_answers->exam_id);

        return view('admin_panel_super_user.update_link_exam',
            [
                'exam_list' => $exams,
                'students' => $students,
                'current_users' => $current_users,
                'current_exam' => $current_exam,
                'student_answers' => $student_answers,
            ]);
    }

//    Страница обновление названия теста
    public function update_exam_page($id){
        $editor_exam = DB::table('editors')
            ->join('users', 'users.id', '=', 'editors.editor_id')
            ->join('exams', 'exams.id', '=', 'editors.exam_id')
            ->select('editors.id', 'editors.editor_id', 'exams.text_', 'editors.exam_id')
            ->where('editors.id', '=', $id)
            ->first();

        $examiners = DB::table('users')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')
            ->select('users.id', 'users.name')
            ->where([
                ['role_users.text_', '=', 'Экзаменатор'],
                ['users.active', '=', '1']
            ])
            ->get();

        return view('admin_panel_super_user.update_exam', ['editor_exam' => $editor_exam, 'examiners' => $examiners]);
    }

//    Логика добавления пользователей в систему
    public function add_users(Request $request){
        try {
            $users = Users::create([
                'name' => $request->input('user_name'),
                'password' => bcrypt($request->input('password')),
                'telephon_number' => $request->input('telephone_number'),
                'active' => $request->input('active_user'),
            ]);

            RoleUsers::create([
                'user_id' => $users->id,
                'text_' => $request->input('role_user_choose'),
            ]);

            return redirect()->route('admin_panel_su_show_users')->with('success', 'Пользователь успешно создан!');
        } catch (\Illuminate\Database\QueryException){
            return back()->withError('Пользователь с таким номером телефона уже существует!!!');
        }
    }

//    Логика обновления пользователей
    public function update_users($id, Request $request){
        $users = Users::find($id);

        if (!$request->input('password') == null){
            $users->password = bcrypt($request->input('password'));
            $users->telephon_number = $request->input('telephone_number');
            $users->name = $request->input('user_name');
            $users->active = $request->input('active_user');

            $users->save();

//            RoleUsers::where('user_id', $id)->update(['text_' => $request->input('role_user_choose')]);

            return redirect()->route('admin_panel_su_show_users')->with('success', 'Запись успешно обновлена');
        } else {
            $users->active = $request->input('active_user');
            $users->telephon_number = $request->input('telephone_number');
            $users->name = $request->input('user_name');

            $users->save();

//            RoleUsers::where('user_id', $id)->update(['text_' => $request->input('role_user_choose')]);

            return redirect()->route('admin_panel_su_show_users')->with('success', 'Запись успешно обновлена');
        }
    }

//    логика добавления теста
    public function add_exam(Request $request){
        $exam = Exam::create([
            'text_' => $request->input('exam_text'),
        ]);

        Editors::create([
           'editor_id' => $request->input('examiner_id'),
           'exam_id' => $exam->id,
        ]);

        return redirect()->route('admin_panel_su_show_exam')->with('success', 'Тест успешно создан!!');
    }

//    Логика привязки теста к студенту
    public function link_exam(Request $request){
        StudentExam::create([
            'student_id' => $request->input('student'),
            'exam_id' => $request->input('exam_choose'),
            'min_score' => $request->input('min_score'),
        ]);

        return redirect()->route('admin_panel_su_link_exam')->with('success', 'Запись успешно создана!!');
    }

//    Логика обновления привязки теста к студенту
    public function update_link_exam($id, Request $request){
        $student_answer = StudentExam::find($id);

        $student_answer->student_id = $request->input('student');
        $student_answer->exam_id = $request->input('exam_choose');
        $student_answer->min_score = $request->input('min_score');

        $student_answer->save();

        return redirect()->route('admin_panel_su_link_exam')->with('success', 'Запись успешно обновлена!!!');
    }

//    Логика удаления привязки теста к студенту
    public function delete_link_exam($id){
        StudentExam::destroy($id);

        return redirect()->route('admin_panel_su_link_exam')->with('success', 'Запись успешно удалена!!');
    }

//    Логика обновления названия теста
    public function update_exam($id, Request $request){
        $editor = Editors::find($id);

        $editor->editor_id = $request->input('examiner_id');
        $editor->save();

        $exam = Exam::find($request->input('exam_id'));

        $exam->text_ = $request->input('exam_text');
        $exam->save();

        return redirect()->route('admin_panel_su_show_exam')->with('success', 'Запись успешно обновлена!');
    }

//    Логика добавления тем к тесту
    public function add_topic($id, Request $request){
        QuestionTopic::create([
           'text_' => $request->input('topic_text'),
           'exam_id' => $request->input('exam_id')
        ]);

        return redirect()->route('admin_panel_su_show_topic', ['id' => $id])->with('success', 'Запись успешно создана!!');
    }
}
