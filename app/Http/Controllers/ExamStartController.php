<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\StudentExam;
use App\Models\Users;
use Illuminate\Http\Request;

class ExamStartController extends Controller
{
    public function index($student_id){
        if (!StudentExam::where('student_id', $student_id)->get()->count() == 0){
            $exam_id = StudentExam::where('student_id', $student_id)->select('exam_id')->first();
            $exam = Exam::find($exam_id->exam_id);
            return view('exam_start', ['exam_id' => $exam_id->exam_id, 'exam_text' => $exam->text_]);
        }else return back()->withError('У студента "'.Users::find($student_id)->name.'" нет тестов для прохождения');
    }
}
