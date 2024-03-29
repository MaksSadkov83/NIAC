<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionTopicResource;
use App\Models\Exam;
use App\Models\Question;
use App\Models\QuestionTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamStartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question_topics = QuestionTopic::where('exam_id', $id)->get('id');

        $array = array();

        for ($i = 0; $i < count($question_topics); ++$i){
            $id_question = Question::where('question_topic_id', $question_topics[$i]['id'])->get('id');
            $question_and_option = QuestionResource::collection(Question::with('options')->find($id_question));

            array_unshift($array, $question_and_option);
        }

        return response()->json($array);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
