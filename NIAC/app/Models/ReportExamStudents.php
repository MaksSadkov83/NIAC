<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportExamStudents extends Model
{
    use HasFactory;

    protected $fillable = ['exam_result', 'exam_date', 'student_id', 'exam_id'];
}
