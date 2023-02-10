<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['text_'];

    public function question_topics(){
        return $this->hasMany(QuestionTopic::class);
    }
}
