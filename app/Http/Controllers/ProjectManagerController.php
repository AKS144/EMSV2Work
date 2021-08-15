<?php

namespace App\Http\Controllers;

use App\ProjectManager;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use App\User;
use App\Project;

class ProjectManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = User::where('role', 'employee')->get();
        $projectManager = ProjectManager::join('projects', 'projects.id', '=', 'project_managers.project_id')
            ->join('users', 'users.id', '=', 'project_managers.employee_id')
            ->get();

        return view('admin.project_managers.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projectManager = ProjectManager::join('projects', 'projects.id', '=', 'project_managers.project_id')
            ->join('users', 'users.id', '=', 'project_managers.employee_id')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $projectManager = ProjectManager::create($request->all());

        if ($projectManager) {
        } else {
            Toastr::success('Project Assigment Fail!', 'Error');
            return redirect()->route('project.index');
            // ->with('error','Employee Fail to add!');
        }

        Toastr::success('Project Assigment Assigned!', 'Success');
        return redirect()->route('project_manager.show', $projectManager->project_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectManager  $projectManager
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projectManager = ProjectManager::join('projects', 'projects.id', '=', 'project_managers.project_id')
            ->join('users', 'users.id', '=', 'project_managers.user_id')
            ->where('projects.id', $id)
            ->get();

        $project_id = Project::first();

        $projectM = ProjectManager::join('projects', 'projects.id', '=', 'project_managers.project_id')
            ->where('projects.id', $project_id->id)->first();

        // dd($projectM);
        return view('admin.project_managers.assigned_managers', compact('projectManager'))->with('projectM', $projectM);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectManager  $projectManager
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectManager $projectManager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectManager  $projectManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectManager $projectManager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectManager  $projectManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectManager $projectManager)
    {
        //
    }
}
