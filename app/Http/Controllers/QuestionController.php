<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\View;
use Validator;
use Illuminate\Http\Request;
use App\Question;
use App\QuestionOption;
use App\Perseption;
use Auth;
use View;

class QuestionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('question');
    }

    public function getList($id = NULL) {
        if (count(Question::all()->where("project_id", $id)) > 0) {
            $questons = Question::all()->where("project_id", $id);
            return Response()->json(array('questions' => $questons));
        }
        return Response()->json(array('questions' => 0));
    }

    function view($id) {
        return view('project/question/view', ['project_id' => $id]);
    }

    function showQustions($questions) {
        return view('Question/listQuestions', ["allQuestions" => $questions]);
    }
    public function openModal($id, $question_id)
    {
        $question = '';
        $question_options = '';
        $perseptions = '';
        if($question_id == '-1')
        {
           $question = new Question(); 
        }
        else
        {
           $question = Question::find($question_id);
           $question_options = Question::find($question_id)->questionOptions;
           $perseptions = Question::find($question_id)->perseptions;
        }
       
        $view = View::make('includes/question-modal', [
            'question' => $question,
            'project_id' => $id,
            'question_options' => $question_options,
            'perseptions' => $perseptions
        ]);
        
        $Question_modal_html = $view->render();
        
        return $Question_modal_html;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id, $question_id) {
        $validator = Validator::make($request->all(), [
                    'question' => 'required'
        ]);
        
        if ($validator->fails()) {
            return Response()->json(array(
                        'errors' => $validator->getMessageBag()->toArray()
            ));
        }

        $options = $request->options;
        $perseptions = $request->perseptions;

        if (!empty($options)) {
            foreach ($options as $option) {
                if (empty($option)) {
                    return Response()->json(array("options" => "options can't be empty"));
                }
            }
        }
        if (!empty($perseptions)) {
            foreach ($perseptions as $perseption) {
                if (empty($perseption)) {
                    return Response()->json(array("perseptions" => "perseptions can't be empty"));
                }
            }
        }
        $question = Question::updateOrCreate(['id' => $question_id], [
                    'user_id' => Auth::user()->id,
                    'question' => $request->question,
                    'type' => 'multiple-choice',
                    'project_id' => $id,
        ]);

        $question_options = '';
        if (!empty($question->id)) {
            
            $question_options = QuestionOption::where('question_id', '=', $question->id)->get();
            $database_options = [];
            if (!$question_options->isEmpty()) {
                foreach ($question_options as $option) {
                    $value = $option->id;
                    $database_options[] = $value;
                }
            }
            
            foreach ($options as $index => $option) {
                $option_id;
                if(array_key_exists($index, $database_options))
                {
                    $option_id = $database_options[$index];
                }
                else
                {
                    $option_id = -1;
                }
                QuestionOption::updateOrCreate(['id' => $option_id], [
                    'option' => $option,
                    'question_id' => $question->id,
                    'project_id' => $id,
                ]);
            }
            
            $question_perseptions = Perseption::where('question_id', '=', $question->id)->get();
            $database_perseptions = [];
            if (!$question_perseptions->isEmpty()) {
                foreach ($question_perseptions as $perseption) {
                    $database_perseptions[] = $perseption->id;
                }
            }

            foreach ($perseptions as $index => $perseption) {
                $perseption_id;
                if(array_key_exists($index, $database_perseptions))
                {
                    $perseption_id = $database_perseptions[$index];
                }
                else
                {
                    $perseption_id = -1;
                }
                Perseption::updateOrCreate(['id' => $perseption_id], [
                    'perseption' => $perseption,
                    'question_id' => $question->id,
                    'project_id' => $id,
                ]);
            }
        } else {
            return Response()->json(array("500" => "some thing went wrong"));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
