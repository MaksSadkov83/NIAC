<?php

namespace App\Http\Controllers;

use App\Models\Editors;
use App\Models\Exam;
use App\Models\RoleUsers;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPanelExaminerController extends Controller
{
//    Переход на приветсвенную страницу админ панели экзаменатора
    public function index(){
        return view('admin_panel_examiner');
    }

//    страница показа экзаменующихся в системе
    public function show_user(){
        $examinee = DB::table('users')
            ->join('role_users', 'users.id', 'role_users.user_id')
            ->select('users.id', 'users.name', 'users.telephon_number', 'role_users.text_')
            ->where('role_users.text_', '=', 'Экзаменующийся')
            ->get();

        return view('admin_panel_examiner.users', ['data' => $examinee]);
    }

//    страница показа созданных экзаменов
    public function show_exam(){
        $exam = DB::table('editors')
            ->join('users', 'users.id', 'editors.editor_id')
            ->join('exams', 'exams.id', 'editors.exam_id')
            ->select('editors.id', 'users.name', 'exams.text_', 'editors.exam_id')
            ->get();

        return view('admin_panel_examiner.show_exam', ['data' => $exam]);
    }

//    Страница обновления экзаменующигося
    public function update_users_page($id){
        $examinee_update = Users::find($id);

        return view('admin_panel_examiner.update_users', ['data' => $examinee_update, 'id' => $id]);
    }

//    Страница обновления теста (название)
    public function update_exam_page($id){
        $exam = Exam::find($id);

        return view('admin_panel_examiner.update_exam', ['data' => $exam, 'id' => $id]);
    }

//    добавление экзаминующигося
    public function add_examinee(Request $request){
        try {
            $examinee = Users::create([
                'name' => $request->input('user_name'),
                'telephon_number' => $request->input('telephon_number'),
                'password' => bcrypt($request->input('password')),
            ]);

            RoleUsers::create([
                'user_id' => $examinee->id,
                'text_' => $request->input('role_user'),
            ]);

            return redirect()->route('admin_panel_examiner_show_users')->with('success', 'Запись успешно добавлена');
        } catch (\Illuminate\Database\QueryException $exception){
            return back()->withError('Пользователь с таким номером телефона уже существует!!!');
        }
    }

//    логика обновления экзаменующигося
    public function update_examinee($id, Request $request){
        $examinee = Users::find($id);

        if (!$request->input('password') == null){
            $examinee->password = bcrypt($request->input('password'));
            $examinee->name = $request->input('user_name');
            $examinee->telephon_number = $request->input('telephon_number');
            $examinee->save();
        }

        $examinee->name = $request->input('user_name');
        $examinee->telephon_number = $request->input('telephon_number');
        $examinee->save();

        return redirect()->route('admin_panel_examiner_show_users');
    }

//    Логика добавления экзамена
    public function add_exam(Request $request){
        $exam = Exam::create([
           'text_' => $request->input('exam_text'),
        ]);

        Editors::create([
           'editor_id' => $request->input('editor_id'),
           'exam_id' => $exam->id,
        ]);

        return redirect()->route('show_exam');
    }

    public function update_exam($id, Request $request){
        $exam = Exam::find($id);

        $exam->text_ = $request->input('exam_text');
        $exam->save();

        return redirect()->route('show_exam');
    }
}
