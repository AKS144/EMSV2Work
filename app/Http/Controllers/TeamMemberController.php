<?php

namespace App\Http\Controllers;

use App\TeamMember;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team_members = TeamMember::select('team_id', DB::raw('count(*) as total'))
        ->groupBy('team_id')
        ->get()->dd();

        return view('admin.team_members.index')->with('team_members', $team_members);
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
        $check_project_manager = TeamMember::where('employee_id', auth()->user()->id)->where('team_id', $request->team_id)->count();

        if($check_project_manager > 0){
            $save_team = TeamMember::create($request->all());
        }else {
            $save_team = New TeamMember;
            $save_team->employee_id = auth()->user()->id;
            $save_team->team_id = $request->team_id;
            $save_team->role_id = 1;
            $save_team->save();

            $save_team = TeamMember::create($request->all());
        }
       
       
       if ($save_team) {

            }else {
                Toastr::success('Team Member Fail to Assign!','Error');
                return redirect()->route('team.index');
                // ->with('error','Employee Fail to add!');
            }

                Toastr::success('Team Member successfully Assigned!','Success');
                return redirect()->route('team.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $team_members = TeamMember::join('teams', 'teams.id', '=', 'team_members.team_id')
        ->join('project_roles', 'project_roles.id', '=', 'team_members.role_id')
        ->join('users', 'users.id', '=', 'team_members.employee_id')
        ->select('team_members.id as member_id','teams.team_name' ,'teams.id','project_roles.name',
        'users.first_name','users.last_name', 'users.phone','users.image')
        ->where('team_members.team_id',  $id)
        ->get();

        $project_manager =  TeamMember::where('employee_id',  auth()->user()->id)
        ->join('project_managers', 'project_managers.user_id', '=', 'team_members.employee_id')->first();

       return view('admin.team_members.show', compact('team_members', 'project_manager'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamMember $teamMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeamMember $teamMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = TeamMember::where('id', $id)->count();
       $removeMember = TeamMember::where('id',$id)->delete();
        // dd( $member);
    //    $removeMember->delete();

       if ($member > 0) {
           
        Toastr::info('This team have no member! Please add Members.','Info');
        return redirect()->route('team.index');

        }else{

            if ($removeMember) {

                }else {
                Toastr::error('Attempt to Remove Team Member Fail try again!','Error');
                return redirect()->back();
                }

                Toastr::success('Team Member Removal successful!','Success');
                return redirect()->back();
            
            }
    
    }


}
