<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\TeamMember;
use DB;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects =   User::join('project_managers', 'project_managers.user_id', '=', 'users.id')
                            ->join('projects','projects.id', '=', 'project_managers.project_id')
                            ->where('project_managers.user_id',  auth()->user()->id)->get();


        $tasks =  User::join('project_managers', 'project_managers.user_id', '=', 'users.id')
                                ->join('projects','projects.id', '=', 'project_managers.project_id')
                                ->join('tasks','tasks.project_id', '=', 'projects.id')
                                ->where('users.id', auth()->user()->id)->get();

        
                $team_member_users = TeamMember::join('teams', 'teams.id', '=', 'team_members.team_id')
                                                
                ->select('teams.team_name' ,'teams.id', DB::raw('count(*) as total'))
                ->groupBy('teams.id','teams.team_name')
                ->paginate(5);

               
                $team_members = TeamMember::join('teams', 'teams.id', '=', 'team_members.team_id')
                ->join('project_roles', 'project_roles.id', '=', 'team_members.role_id')
                ->join('users', 'users.id', '=', 'team_members.employee_id')
                ->select('team_members.id as member_id','teams.team_name' ,'teams.id','project_roles.name',
                'users.first_name','users.last_name', 'users.phone','users.image','users.id as user_id')
                ->where('team_members.employee_id',  '!=', auth()->user()->id)
                ->paginate(5);

                $employees = User::join('project_managers','project_managers.user_id','=', 'users.id')
                ->where('users.role', 'employee')
                ->where('project_managers.user_id', '!=', auth()->user()->id)
                ->get();


        return view('admin.tasks.index', compact('projects','team_member_users','team_members'))
        ->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
       $task_save = Task::create($request->all());

       return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
