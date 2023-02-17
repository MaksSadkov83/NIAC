<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use App\Http\Resources\QuestionTopicResource;
use App\Models\Exam;
use App\Models\Option;
use App\Models\Question;
use App\Models\QuestionTopic;
use Illuminate\Http\Request;

class CreateQuestionTopicsWithQuestionController extends Controller
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
        $array = $request->all();

        for ($i = 0; $i < count($array); ++$i){
            for ($j = 2; $j < count($array[$i]); ++$j){
                $question = Question::create([
                   'question_topic_id' => $array[$i]['id_topic'],
                   'text_' => $array[$i]['name_question']
                ]);

              for ($l = 0; $l < count($array[$i]['options']); ++$l){
                  Option::create([
                     'question_id' => $question->id,
                      'text_' => $array[$i]['options'][$l]['name_option'],
                      'score' => $array[$i]['options'][$l]['score'],
                  ]);
              }

            }
        }

        return response()->json('Вопросы успешно сохранены', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new QuestionTopicResource(QuestionTopic::with('question')->find($id));
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
