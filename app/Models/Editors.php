<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editors extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['exam_id', 'editor_id'];
}
