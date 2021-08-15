<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use App\ProjectRole;
use App\TeamMember;
use App\ProjectManager;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;
class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team_id =  TeamMember::where('employee_id',  auth()->user()->id)->first();
        $project_manager =  ProjectManager::where('user_id',  auth()->user()->id)
        // ->join('project_managers', 'project_managers.user_id', '=', 'team_members.employee_id')
        ->first();

        // dd($project_manager);
        $teams = Team::paginate(10);

        $employees = User::join('project_managers','project_managers.user_id','=', 'users.id')
        ->where('users.role', 'employee')
        ->where('project_managers.user_id', '!=', auth()->user()->id)
        ->get();

        $employees_assign = User::where('role', 'employee')
        ->where('id', '!=', auth()->user()->id)
        ->get();

        $roles = ProjectRole::all();
        $team_members = TeamMember::paginate(10);

        $team_members = TeamMember::join('teams', 'teams.id', '=', 'team_members.team_id')
        ->select('teams.team_name' ,'teams.id', DB::raw('count(*) as total'))
        ->groupBy('teams.id','teams.team_name')
        ->get();

        if (!$project_manager) {

                $team_member_users = TeamMember::join('teams', 'teams.id', '=', 'team_members.team_id')
                                                
                ->select('teams.team_name' ,'teams.id', DB::raw('count(*) as total'))
                ->groupBy('teams.id','teams.team_name')
                // ->where('team_members.team_id', $team_id->team_id)
                ->get();
                
                $user_teams = Team::all();
       
        // }
        // elseif(!$team_id) {
        //         $team_member_users = TeamMember::join('teams', 'teams.id', '=', 'team_members.team_id')
        //         ->select('teams.team_name' ,'teams.id', DB::raw('count(*) as total'))
        //         ->groupBy('teams.id','teams.team_name')
        //         ->where('team_members.team_id', $team_id->team_id)
        //         ->get();

        //         $user_teams = Team::where('user_id', $team_id->employee_id)->get();
        }else if($project_manager){

            $team_member_users = TeamMember::join('teams', 'teams.id', '=', 'team_members.team_id')
                                                
            ->select('teams.team_name' ,'teams.id', DB::raw('count(*) as total'))
            ->groupBy('teams.id','teams.team_name')
            // ->where('team_members.team_id', $team_id->team_id)
            ->get();
            
            $user_teams = Team::all();

        }else {
            $team_member_users = TeamMember::join('teams', 'teams.id', '=', 'team_members.team_id')
            ->select('teams.team_name' ,'teams.id', DB::raw('count(*) as total'))
            ->groupBy('teams.id','teams.team_name')
            ->where('team_members.team_id', $team_id->team_id)
            ->get();
            $user_teams = Team::where('user_id', $team_id->employee_id)->get();
        }

      
        
 

        return view('admin.teams.index', compact('employees_assign','team_members','team_member_users','user_teams', 'project_manager', 'team_id'))->with('teams', $teams)->with('employees', $employees)->with('roles', $roles);
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
        $save_team = New Team;
       
            $save_team->team_name = $request->team_name;
        if (auth()->user()) {
            $save_team->user_id = auth()->user()->id;
        }else {
            $save_team->user_id = '';
        }
        
        $save_team->save();

       if ($save_team) {

            }else {
                Toastr::success('Team Fail to Create!','Error');
                return redirect()->route('user');
                // ->with('error','Employee Fail to add!');
            }

                Toastr::success('Team successfully Created!','Success');
                return redirect()->route('team.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function UpdateTeam(Request $request, $id)
    {
        // $team_update = Team::find($id);

        $team_update = DB::table('teams')
              ->where('id', $id)
              ->update(['team_name' => $request->team_name]);

        
        if ($team_update) {

        }else {
            Toastr::success('Team Fail to Update!','Error');
            return redirect()->route('user');
            // ->with('error','Employee Fail to add!');
        }

            Toastr::success('Team successfully Updated!','Success');
            return redirect()->route('team.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        // dd($request->all());
        $team_delete = DB::table('teams')
              ->where('id', $id)
              ->delete();

        
        if ($team_delete) {

        }else {
            Toastr::error('Team Fail to Delete!','Error');
            return redirect()->route('user');
            // ->with('error','Employee Fail to add!');
        }

            Toastr::success('Team successfully Delete!','Success');
            return redirect()->route('team.index');
    }
}
