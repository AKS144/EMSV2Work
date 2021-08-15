<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\User;
use App\Team;
use App\ProjectManager;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(10);
        
        $employees = User::where('role', 'employee')->get();
        $projectManager = ProjectManager::join('users','users.id','=', 'project_managers.user_id')
                                         ->select('users.first_name','users.last_name','project_managers.project_id')->get();

        $userproject = ProjectManager::join('users','users.id','=', 'project_managers.user_id')
        ->join('team_members', 'team_members.employee_id', 'users.id')
        ->join('projects', 'projects.id', 'project_managers.project_id')
        ->join('teams', 'teams.id', 'team_members.team_id')
        ->where('project_managers.user_id', auth()->user()->id)
        ->select('users.first_name','users.last_name','project_managers.project_id', 'teams.team_name', 'projects.project_name')->get();




        // dd( $check_on_going_project);

       return view('admin.projects.index', compact('employees','projectManager'))->with('projects', $projects);
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
        // dd($request->all());
       $save_project = Project::updateOrCreate(['id'=>$request->project_id],['project_name' => $request->project_name,'project_description' => $request->project_description,
       'planned_start_date' => $request->planned_start_date,'planned_end_date' => $request->planned_end_date,'actual_start_date' => $request->actual_start_date,
       'actual_end_date'=> $request->actual_end_date]);
       
       if ($save_project) {

            }else {
                Toastr::success('Project Fail to Create!','Error');
                return redirect()->route('user');
                // ->with('error','Employee Fail to add!');
            }

                Toastr::success('Project successfully Created!','Success');
                return redirect()->route('project.index');
                // ->with('success','Employee successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::count();
        // $project = Project::where();

        $check_exist_team = ProjectManager::join('users','users.id','=', 'project_managers.user_id')
        // ->join('team_members', 'team_members.employee_id', 'users.id')
        ->join('projects', 'projects.id', 'project_managers.project_id')
        ->join('teams', 'teams.user_id', 'users.id')
        ->where('project_managers.project_id', $id)
        ->select('teams.id as team_id')->first();

        $check_on_going_project = ProjectManager::join('users','users.id','=', 'project_managers.user_id')
        // ->join('team_members', 'team_members.employee_id', 'users.id')
        ->join('projects', 'projects.id', 'project_managers.project_id')
        ->join('teams', 'teams.user_id', 'users.id')
        ->where('project_managers.project_id', $id)->count();



        // dd($check_exist_team->team_id);

        if ( $check_on_going_project > 0) {
            $removeProject = Project::where('id',$id)->delete();
            $removeTeam = Team::where('id',$check_exist_team->team_id)->delete();
            // Toastr::success('Project Removal successful!','Success');
            // return redirect()->back();
        }else {

            $removeProject = Project::where('id',$id)->delete();
        }
        
        // $removeProject = Project::where('id',$id)->delete();

        

        // if ($project == 0) {
           
        //     Toastr::info('There is no Project! Please add Project.','Info');
        //     return redirect()->route('project.index');
    
        //     }else
            //  if (!$removeProject){
            //     Toastr::error('Attempt to Remove Project Fail try again!','Error');
            //     return redirect()->back();
            //      }

            //      else 
            //      {
                    // Toastr::success('Attempt to Remove Project Fail try again!','Error');
                    // return redirect()->back();
                    // }
    
                    Toastr::success('Project Removal successful!','Success');
                    return redirect()->back();
                
                // }
    }


    public function UserProjectIndex()
    {
        $userProject = auth()->user()->id;
        

        return view('admin.projects.users.project.index')->with('users_project');
    }
}
