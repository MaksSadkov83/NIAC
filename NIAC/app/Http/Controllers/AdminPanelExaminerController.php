<?php

namespace App\Http\Controllers;

use App\Models\Editors;
use App\Models\Exam;
use App\Models\RoleUsers;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPanelExaminerController extends Controller
{
//    Стартовая страница админ панели экзаменатора
    public function index()
    {
        return view('admin_panel_examiner');
    }

//    Страница добавления и просмотра Экзаменующихся
    public function users_show()
    {
        $users = DB::table('users')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')
            ->select('users.id', 'users.name', 'role_users.text_', 'users.telephon_number', 'users.active')
            ->where([
                ['users.id', '!=', Auth::id()],
                ['role_users.text_', '=', 'Экзаменующийся']
            ])
            ->get();

        return view('admin_panel_examiner.users', ['data' => $users]);
    }

//    Страница создания теста
    public function show_exam()
    {
        $exam = DB::table('editors')
            ->join('users', 'users.id', '=', 'editors.editor_id')
            ->join('exams', 'exams.id', '=', 'editors.exam_id')
            ->select('editors.id', 'users.name', 'exams.text_', 'editors.exam_id', 'editors.editor_id')
            ->get();

        return view('admin_panel_examiner.exams', ['data' => $exam]);
    }

//    Страница привязки экзамена
    public function link_exam_page()
    {
        $student_answers = DB::table('student_exams')
            ->join('users', 'users.id', '=', 'student_exams.student_id')
            ->join('exams', 'exams.id', '=', 'student_exams.exam_id')
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

        return view('admin_panel_examiner.link_exam', ['data' => $student_answers, 'exam_list' => $exams, 'students' => $students]);
    }

//    Страница результатов экзамена
    public function show_result_exam()
    {
        $report_exam_students = DB::table('report_exam_students');

        if ($report_exam_students->count()) {
            $report_exam_students
                ->join('exams', 'exams.id', '=', 'report_exam_students.exam_id')
                ->join('users', 'users.id', '=', 'report_exam_students.student_id')
                ->select('report_exam_students.id', 'exams.text_', 'users.name', 'report_exam_students.exam_result', 'report_exam_students.exam_date')
                ->get();

            return view('admin_panel_examiner.result_exam', ['data' => $report_exam_students]);
        } else return view('admin_panel_examiner.result_exam', ['data' => null]);
    }

//    Страница обновления пользователя
    public function show_update_users($id)
    {
        $users = DB::table('users')
            ->join('role_users', 'users.id', 'role_users.user_id')
            ->select('users.id', 'users.name', 'users.telephon_number', 'users.active', 'role_users.text_')
            ->where('users.id', '=', $id)
            ->first();

        return view('admin_panel_examiner.update_users', ['data' => $users]);
    }

//    Страница создания тем, вопросов и ответов
    public function question_topic_and_question_page($id)
    {
        $exam = Exam::find($id);
        $editors = $exam = DB::table('editors')
            ->join('users', 'users.id', '=', 'editors.editor_id')
            ->join('exams', 'exams.id', '=', 'editors.exam_id')
            ->select('editors.editor_id')
            ->where('editors.exam_id', '=', $id)
            ->first();
        return view('admin_panel_examiner.question_topic_and_question', ['name_exam' => $exam->text_, 'id' => $id, 'editors' => $editors]);
    }

//    Страница обновления названия теста
    public function update_exam_page($id)
    {
        $exam = Exam::find($id);

        return view('admin_panel_examiner.update_exam', ['exam' => $exam]);
    }

//    Логика добавления Экзаменующигося
    public function add_users(Request $request)
    {
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

            return redirect()->route('admin_panel_examiner_users_show')->with('success', 'Экзаменующийся успешно создан!');
        } catch (\Illuminate\Database\QueryException) {
            return back()->withError('Пользователь с таким номером телефона уже существует!!!');
        }
    }

//    Логика обновления Экзаменующигося
    public function update_users($id, Request $request){
        $users = Users::find($id);

        if (!$request->input('password') == null) {
            $users->password = bcrypt($request->input('password'));
            $users->telephon_number = $request->input('telephone_number');
            $users->name = $request->input('user_name');
            $users->active = $request->input('active_user');

            $users->save();

//            RoleUsers::where('user_id', $id)->update(['text_' => $request->input('role_user_choose')]);

            return redirect()->route('admin_panel_examiner_users_show')->with('success', 'Запись успешно обновлена');
        } else {
            $users->active = $request->input('active_user');
            $users->telephon_number = $request->input('telephone_number');
            $users->name = $request->input('user_name');

            $users->save();

//            RoleUsers::where('user_id', $id)->update(['text_' => $request->input('role_user_choose')]);

            return redirect()->route('admin_panel_examiner_users_show')->with('success', 'Запись успешно обновлена');
        }
    }

//    Логика добавления теста
    public function add_exam(Request $request){
        $exam = Exam::create([
            'text_' => $request->input('exam_text'),
        ]);

        Editors::create([
            'editor_id' => $request->input('examiner_id'),
            'exam_id' => $exam->id,
        ]);

        return redirect()->route('admin_panel_examiner_show_exam')->with('success', 'Тест успешно создан!!');
    }
}
