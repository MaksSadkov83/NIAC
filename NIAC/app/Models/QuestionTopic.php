<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTopic extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['text_', 'exam_id'];

    public function question(){
        return $this->hasMany(Question::class);
    }
}
