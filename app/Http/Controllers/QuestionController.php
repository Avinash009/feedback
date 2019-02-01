<?php

namespace App\Http\Controllers;
use App\Http\Controllers\View;
use Illuminate\Http\Request;
use App\Question;
use App\Project;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('question');
    }
    
    public function getList($id = NULL)
    {
        if(count(Question::all()->where("project_id", $id)) > 0)
        {
            $questons = Question::all()->where("project_id", $id);
            return Response()->json(array('questions' => $questons));
        }
        return Response()->json(array('questions' =>0));
    }
    
    function view($id)
    {
        return view('project/question/view',['project_id' => $id]);
    }
    function showQustions($questions)
    {
        return view('Question/listQuestions', ["allQuestions" => $questions]);
        
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project/Question/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
