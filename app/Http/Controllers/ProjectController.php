<?php

namespace App\Http\Controllers;

use App\Http\Controllers\View;
use Validator;
use Illuminate\Http\Request;
use App\Project;
use Auth;

class ProjectController extends Controller {

    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index() {
        //
    }

    public function view() {
       return view('project.view');
    }
    
    public function getList()
    {
         if (count($this->getAllProjects()) > 0) {
            return Response()->json(array(
                        'projects' => $this->getAllProjects()
            ));
        }
        
        return Response()->json(array(
                        'projects' => array()
            ));
    }
    
    public function viewProjects() {
        if (count($this->getAllProjects()) < 1) {
            return redirect()->route('project.view', array());
        }
        return view('Project/showProjects', ["allProjects" => $this->getAllProjects()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $project_id) {
        $validator = Validator::make($request->all(), [
                    'projectName' => 'required',
        ]);

        if ($validator->fails()) {
            return Response()->json(array(
                        'errors' => $validator->getMessageBag()->toArray()
            ));
        }
        
        $newProject = Project::updateOrCreate(['id' => $project_id],[
            'name' => $request->projectName,
            'user_id' => Auth::user()->id,
        ]);
        if (!$newProject) {
            return Response()->json(array('fail' => 'Something went wrong'));
        }

        return Response()->json(array('success' => 'Project created successfully'));
    }

    public function getAllProjects() {
        return Project::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return Project::all($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
       return Project::find($id);
        die();
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
        if (Project::destroy($id)) {
            return Response()->json(array('success' => 'Project deleted successfully'));
        }
        else{
            return Response()->json(array('error' => 'Something went wrong'));
        }
        
        die();
    }

}
