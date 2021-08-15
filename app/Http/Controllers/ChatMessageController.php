<?php

namespace App\Http\Controllers;

use App\ChatMessage;
use Illuminate\Http\Request;
use App\User;
use App\TeamMember;
use App\Team;
use App\ProjectManager;
use DB;
use App\EmployeeDetail;
class ChatMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $current_user_id = auth()->user()->id;

        // $countUnRead_messages = '';
        // dd($request->all());

        $team_id = TeamMember::where('employee_id',  $current_user_id)->first();
        $team = TeamMember::where('employee_id',  $current_user_id)->first();
        $teams = team::where('user_id',  $current_user_id)->get();
        $projectManager = ProjectManager::where('user_id', $current_user_id)->first();
        

        if ($request->ajax()) {
            // $team_id = Team::where('user_id',  $current_user_id)->first();
            // dd($team_id);
            if ($projectManager) {
                # code...
            
            $employees = User::join('team_members', 'team_members.employee_id', '=', 'users.id')
                                ->join('teams', 'teams.id', '=', 'team_members.team_id')
                                ->where('users.id', '!=', auth()->user()->id)
                                // ->where('team_members.team_id',  $request->id)
                                ->select('users.id as id', 'users.image', 'users.username', 'users.first_name', 'users.last_name',
                                'teams.id as team_id', 'teams.team_name')
                                 ->groupBy('id', 'users.image', 'users.username', 'users.first_name', 'users.last_name',
                                 'teams.id', 'teams.team_name')->get();


            $employees = json_decode(json_encode($employees));
           

            $user_detail = auth()->user()->first_name . ' '. auth()->user()->last_name;
           

            $output = '
                    <div class="people-list" id="people-list">
                    <div class="search">
                    <div class="col-md-12">
                    <div class="col-md-8 pull-left" style="text-transform:uppercase">
                    <span>'.$user_detail.'</span>
                    </div>
                    </div>
                    
                    <br><br>
                    </div>
                    <ul class="list">
                ';

                    foreach($employees as $row)
                    {
                        
                    $status = '';
                    $image = '';
                    $is_onlineUser = '';

                    $employee_last_act = EmployeeDetail::
                        where('employee_id',  $row->id)->
                        where('is_online',  1)
                        ->get();
        
                        foreach($employee_last_act as $last_act)
                        {
                          $is_onlineUser = $last_act->is_online;
                        }
        
                    if($is_onlineUser == 1 )
                    {
                    $status = '<i class="fa fa-circle online"></i> online';
                    }
                    else
                    {
                    $status = '<i class="fa fa-circle offline"></i> offline';
                    }

                    if($row->image != '' )
                    {
                        $image = ' '.asset("uploads/gallery/" .$row->image).'';
                    }
                    else
                    {
                        $image = ' '.asset("uploads/gallery/no-image.jpg").'';
                    }
                      

                    $output .= '
                    
                    <li class="clearfix start_chat name_chat" data-touserid="'.$row->id.'"
                        data-tousername="'.$row->username.' "  data-toteamid="'.$row->team_id.' " data-toteamname="'.$row->team_name.' ">
                       
                         <img src="'.$image.' " alt="avatar" class="rounded-circle"/ style=" width:60px;height: 60px;border-radius:50%; " >
                        <input type="hidden" id="group_team_id" value="'.$row->team_id.'" name="group_team_id">
                        <div class="about">
                        '. $this->count_unRead_message($row->id, $current_user_id) .'  '.$this->Fetch_IsTyping($row->id).'
                            <div class="">'.ucfirst($row->username).' &nbsp &nbsp &nbsp &nbsp  <span class="badge badge-success pull-right">'.$row->team_name.' </span></div>
                            <div class="status">
                                '.$status.'
                            </div>
                        </div>
                    </li> 
                    <hr>
                    ';
                   
                    }
                }else {
                    $employees = User::join('team_members', 'team_members.employee_id', '=', 'users.id')
                                ->join('teams', 'teams.id', '=', 'team_members.team_id')
                                ->where('users.id', '!=', auth()->user()->id)
                                ->where('team_members.team_id',  $request->id)
                                ->select('users.id as id', 'users.image', 'users.username', 'users.first_name', 'users.last_name',
                                'teams.id as team_id', 'teams.team_name')->get();

            $employees = json_decode(json_encode($employees));
           

            $categories_menu = '';
            foreach($employees as $value){
                $categories_menu .= "
                   ".$this->count_unRead_message($value->id, $current_user_id)."
              ";
               
            }
           
            $user_detail = auth()->user()->first_name . ' '. auth()->user()->last_name;

            $output = '
                    <div class="people-list" id="people-list">
                    <div class="search">
                    <div class="col-md-12">
                    <div class="col-md-8 pull-left" style="text-transform:uppercase">
                    <span>'.$user_detail.'</span>
                    </div>
                    </div>
                    
                    <br><br>
                    </div>
                    <ul class="list">
                ';


                    foreach($employees as $row)
                    {
                        
                    $status = '';
                    $image = '';
                    $is_onlineUser = '';

                    $employee_last_act = EmployeeDetail::
                        where('employee_id',  $row->id)->
                        where('is_online',  1)
                        ->get();
        
                        foreach($employee_last_act as $last_act)
                        {
                          $is_onlineUser = $last_act->is_online;
                        }
        
                    if($is_onlineUser == 1 )
                    {
                    $status = '<i class="fa fa-circle online"></i> online';
                    }
                    else
                    {
                    $status = '<i class="fa fa-circle offline"></i> offline';
                    }

                    if($row->image != '' )
                    {
                        $image = ' '.asset("uploads/gallery/" .$row->image).'';
                    }
                    else
                    {
                        $image = ' '.asset("uploads/gallery/no-image.jpg").'';
                    }
                      

                    $output .= '

                    <li class="clearfix start_chat name_chat" data-touserid="'.$row->id.'"
                        data-tousername="'.$row->username.' "  data-toteamid="'.$row->team_id.' " data-toteamname="'.$row->team_name.' ">
                       
                         <img src="'.$image.' " alt="avatar" class="rounded-circle"/ style=" width:60px;height: 60px;border-radius:50%" >
                        <input type="hidden" id="group_team_id" value="'.$row->team_id.'" name="group_team_id">
                        <div class="about">
                        '. $this->count_unRead_message($row->id, $current_user_id) .'  '.$this->Fetch_IsTyping($row->id).'
                            <div class="">'.ucfirst($row->username).' </div>
                            <div class="status">
                                '.$status.'
                            </div>
                        </div>
                    </li> ';
                   
                    }
                }
                  

                $output .= ' </ul></div>';

           

                // $view = view('admin.chat_app.chat_template',compact('categories_menu'))
                // ->with('employees', $employees)
                // // ->with('employee_last_act', $employee_last_act)
                // ->render();

                // return response($view);

                return response()->json($output);
        }

        $employee_last_act = EmployeeDetail::
        where('employee_id', auth()->user()->id)->
        where('is_online',  1)
        ->get();

       

        $is_onlineUser = '';

        foreach($employee_last_act as $last_act)
        {
          $is_onlineUser = $last_act->is_online;
        }

        $group_team_id = '';
        foreach($teams as $team)
        {
          $group_team_id = $team->id;
        }


        $group_countMessage =   $this->count_unRead_group_chat_message($group_team_id, $current_user_id);

    //  dd($group_countMessage)  ;
       return view('admin.chat_app.index', compact('team', 'is_onlineUser', 'teams', 'projectManager'));
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
       if ($request->ajax()) {
            $data = ChatMessage::create([

                'to_employee_id'  => $request->to_user_id,
                'team_id'  => $request->to_team_id,
                'from_employee_id'  => auth()->user()->id,
                'message'  => $request->chat_message,
                'status'   => '0'
                ]
               
            );

            return response($data);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChatMessage  $chatMessage
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $team_id)
    {
        
        $current_user_id = auth()->user()->id;

        // $countUnRead_messages = '';

        $team_id = TeamMember::where('employee_id',  $current_user_id)->first();

        

        if ($request->ajax()) {
            // $team_id = Team::where('user_id',  $current_user_id)->first();
            // dd($team_id);
            $employees = User::join('team_members', 'team_members.employee_id', '=', 'users.id')
                                ->join('teams', 'teams.id', '=', 'team_members.team_id')
                                ->where('users.id', '!=', auth()->user()->id)
                                ->where('team_members.team_id',  $team_id)
                                ->select('users.id as id', 'users.image', 'users.username', 'users.first_name', 'users.last_name',
                                'teams.id as team_id', 'teams.team_name')->get();

            $employees = json_decode(json_encode($employees));
           

            $categories_menu = '';
            foreach($employees as $value){
                $categories_menu .= "
                   ".$this->count_unRead_message($value->id, $current_user_id)."
              ";
               
            }
           
            $user_detail = auth()->user()->first_name . ' '. auth()->user()->last_name;

            $output = '
                    <div class="people-list" id="people-list">
                    <div class="search">
                    <div class="col-md-12">
                    <div class="col-md-8 pull-left" style="text-transform:uppercase">
                    <span>'.$user_detail.'</span>
                    </div>
                    </div>
                    
                    <br><br>
                    </div>
                    <ul class="list">
                ';


                    foreach($employees as $row)
                    {
                        

                    $status = '';
                    $image = '';
                    $is_onlineUser = '';

                    $employee_last_act = EmployeeDetail::
                        where('employee_id',  $row->id)->
                        where('is_online',  1)
                        ->get();
        
                        foreach($employee_last_act as $last_act)
                        {
                          $is_onlineUser = $last_act->is_online;
                        }
        
                    // $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
                    // $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
                   
                    // $user_last_activity = $this->fetch_employee_last_activity($row['id']);
                    // $is_onlineUser = $this-> IsOnline_User($row->id);

                    if($is_onlineUser == 1 )
                    {
                    $status = '<i class="fa fa-circle online"></i> online';
                    }
                    else
                    {
                    $status = '<i class="fa fa-circle offline"></i> offline';
                    }

                    if($row->image != '' )
                    {
                        $image = ' '.asset("uploads/gallery/" .$row->image).'';
                    }
                    else
                    {
                        $image = ' '.asset("uploads/gallery/no-image.jpg").'';
                    }
                      

                    $output .= '

                    <li class="clearfix start_chat name_chat" data-touserid="'.$row->id.'"
                        data-tousername="'.$row->username.' "  data-toteamid="'.$row->team_id.' " data-toteamname="'.$row->team_name.' ">
                       
                         <img src="'.$image.' " alt="avatar" class="rounded-circle"/ style=" width:60px;height: 60px;border-radius:50%">
                        <input type="hidden" id="group_team_id" value="'.$row->team_id.'" name="group_team_id">
                        <div class="about">
                        '. $this->count_unRead_message($row->id, $current_user_id) .'  '.$this->Fetch_IsTyping($row->id).'
                            <div class="">'.ucfirst($row->username).' </div>
                            <div class="status">
                                '.$status.'
                            </div>
                        </div>
                    </li> ';







                    
                    // <tr>
                    // <td>'.$row['username'].' '. $this->count_unRead_message($row['id'], $current_user_id) .'  '.$this->Fetch_IsTyping($row['id']).' </td>
                    // <td>'.$status.'</td>
                    // <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['id'].'" data-tousername="'.$row['username'].'">Start Chat</button></td>
                    // </tr>
                   
                    }
                  

                $output .= ' </ul></div>';

                // $view = view('admin.chat_app.chat_template',compact('categories_menu'))
                // ->with('employees', $employees)
                // // ->with('employee_last_act', $employee_last_act)
                // ->render();

                // return response($view);

                return response()->json($output);
        }
     
       return view('admin.chat_app.index', compact('employees'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChatMessage  $chatMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(ChatMessage $chatMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChatMessage  $chatMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        if($request->ajax()){
           $data = DB::table('employment_details')->where('employee_id', $id)
                        ->update(['last_activity' => now()]);

           return response($data);
        }
    }

    public function IsOffline_User(Request $request,  $id)
    {
        if($request->ajax()){
           $data = DB::table('employment_details')->where('employee_id', $id)
                        ->update(['is_online' => 0]);

           return response($data);
        }
    }


    public function IsOnline_User($id)
    {
        if(\Request::ajax()){
           $data = DB::table('employment_details')->where('employee_id', $id)
                        ->update(['is_online' => 1]);

           return response($data);
        }
    }

    public function MessageRead(Request $request)
    {
        // dd($request->all());
        if($request->ajax()){

        $Read_messages = DB::table('chat_messages')
                                    ->where('from_employee_id', $request->to_user_id)
                                    ->where('to_employee_id', $request->id)
                                    ->update(['status' => 1]);

            return response($Read_messages);

    }
}

   public function fetch_employee_last_activity($user_id)
    {

        $employee_last_act = DB::table('employment_details')->where('employee_id', $user_id)
                            ->orderBy('last_activity', 'DESC')->latest()->get();

                foreach($employee_last_act as $last_act)
                {
                return $last_act->last_activity;
                }
    }

   public function fetch_employee_chat_history(Request $request)
{
        $to_employee_id = $request->to_user_id;
        $from_employee_id = auth()->user()->id;

    if ($request->ajax()) {

            $query =  DB::select( DB::raw("SELECT * FROM chat_messages 
            WHERE (to_employee_id = '".$to_employee_id."' 
            AND from_employee_id = '".$from_employee_id."') 
            OR (to_employee_id = '".$from_employee_id."' 
            AND from_employee_id = '".$to_employee_id."') 
            ORDER BY created_at DESC"));

            // $Read_messages = DB::table('chat_messages')
            //                 ->where('from_employee_id', $request->id)
            //                 ->where('to_employee_id', $request->to_user_id)
            //                 ->update(['status' => 1]);
            // DB::select( DB::raw("SELECT * FROM chat_messages 
            // WHERE (to_employee_id = '".$to_employee_id."' 
            // AND from_employee_id = '".$from_employee_id."') 
            // OR (to_employee_id = '".$from_employee_id."' 
            // AND from_employee_id = '".$to_employee_id."') 
            // ORDER BY created_at DESC")->update(['status' => 1]));




            $output = '<div class="msg ">';
        foreach($query as $row)
        {

            $employee_detail = EmployeeDetail::where('employee_id', $from_employee_id)->first();

            $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
            $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);

            $user_name = '';
            $dynamic_design_you = '';
            $dynamic_design_me = '';
            $chat_message = '';
            if($row->from_employee_id == $from_employee_id)
            {
            if($row->status == '2')
            {
            $chat_message = '<i class="fas fa-ban"></i> <em>You deleted this message.</em>';
            $user_name = '<span class="text-success">You</span>';
            }
            else
            {
            $chat_message = $row->message;
            $user_name = '<a data-toggle="modal" data-target="#delete_chat" data-chat-id="'.$row->chat_id.'"  class="text-success remove_chat">You</a>';
            }
            
            if ($row->status == 1 && $employee_detail->is_online == 1) {
            $dynamic_design_me = '
            <div class="bubble me">
            <span class="name">'.$user_name.'</span>
            <span class="msg" >'.$chat_message.'</span>
            <span class="timestamp">'.date('H:i A' ,strtotime($row->created_at)).'  <i class="fas fa-check-double" style="color:DeepSkyBlue"></i></span>
           
            </div>'; 
            }
            elseif ($row->status == 0 && $employee_detail->is_online == 1) {
                $dynamic_design_me = '
                <div class="bubble me">
                <span class="name">'.$user_name.'</span>
                <span class="msg" >'.$chat_message.'</span>
                <span class="timestamp">'.date('H:i A' ,strtotime($row->created_at)).'  <i class="fas fa-check-double"></i></span>
                </div>';
            }else{
                $dynamic_design_me = '
                <div class="bubble me">
                <span class="name">'.$user_name.'</span>
                <span class="msg" >'.$chat_message.'</span>
                
                <span class="timestamp">'.date('H:i A' ,strtotime($row->created_at)).' <i class="fas fa-check" style="float-right"></i></span>
               
                </div>'; 
            }
            }
            else
            {
            if($row->status == '2')
            {
            $chat_message = '<em>This message has been removed</em>';
            }
            else
            {
            $chat_message = $row->message;
            }
            $user_name = '<b class="text-danger">'.$this->get_user_name($row->from_employee_id).'</b>';
            $dynamic_design_you = '
            <div class="bubble you">
            <span class="name">'.$user_name.'</span>
            <span class="msg" >'.$chat_message.'</span>
            <span class="timestamp">'.date('H:i A' ,strtotime($row->created_at)).'</span>
            </div>
            ';
            }
            $output .= '
            <div class="chat" style=" ">
                    '.$dynamic_design_me .'

                    '.$dynamic_design_you.'
                </div>
                </div>
                            
            ';
            }
            
            $output .= '</div>';
        return response($output);
    }
}

    function get_user_name($user_id)
    {
        // $user_id = auth()->user()->id;
        $query =  User::select('username')->where('id',  $user_id)->get();

        foreach($query as $row)
        {
        return $row['username'];
        }
    }


    function count_unRead_message($from_employee_id, $to_employee_id)
    {

            // $countUnRead_messages =  DB::select( DB::raw("SELECT * FROM chat_messages 
            // WHERE from_employee_id = '$from_employee_id' 
            // AND to_employee_id = '$to_employee_id' 
            // AND status = '1'"));

        $countUnRead_messages = DB::table('chat_messages')
                                ->where('from_employee_id', $from_employee_id)
                                ->where('to_employee_id', $to_employee_id)
                                ->where('status', 0)
                                ->count();
                                // dd($countUnRead_messages);

        $output = '';
        if($countUnRead_messages > 0)
        {
        $output = "  <span style='color:white; font-weight:bold;'> Message <sup class='badge  badge-success' style='color:white; background:red'>".$countUnRead_messages."</sup></span>";
        }else {
            echo $output;
        }
       
        return $output;
    }


    function count_unRead_group_chat_message($from_employee_id, $to_team_id)
    {

            // $countUnRead_messages =  DB::select( DB::raw("SELECT * FROM chat_messages 
            // WHERE from_employee_id = '$from_employee_id' 
            // AND to_employee_id = '$to_employee_id' 
            // AND status = '1'"));

        $countUnRead_messages = DB::table('chat_messages')
                                ->where('from_employee_id', $from_employee_id)
                                ->where('team_id', $to_team_id)
                                ->where('status', 0)
                                ->count();
                                // dd($countUnRead_messages);

        $output = '';
        if($countUnRead_messages > 0)
        {
        $output = "  <span style='color:white; font-weight:bold;'> Message <sup class='badge  badge-success' style='color:white; background:red'>".$countUnRead_messages."</sup></span>";
        }else {
            echo $output;
        }
       
        return $output;
    }


    public function Fetch_IsTyping($current_use_id)
    {

        if(\Request::ajax()){

                $query =  DB::select( DB::raw("SELECT * FROM employment_details 
                WHERE employee_id = '".$current_use_id."' 
                ORDER BY last_activity DESC  LIMIT 1"));

                $output = '';
                    foreach ($query as $row) {
                        if($row->is_typing == 'yes')
                        {
                        $output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
                        }
                    }
                
                // echo $output;
 
            return $output;
         }
    }

    public function Update_IsTyping(Request $request, $id)
    {
        dd($request->all());
        if($request->ajax()){
            $data = DB::table('employment_details')->where('employee_id', $id)
                            ->update(['is_typing' =>$request->is_typing]);
    
                            dd($data);
            return response($data);
            }

    }

    public function Delete_Signle_ChatMessage(Request $request, $chat_id)
    {
        if($request->ajax()){
            $data = DB::table('chat_messages')->where('chat_id', $chat_id)
                         ->update(['status' => 2, 'created_at' => now()]);
 
            return response($data);
         }
    }


    // GTOUP CHAT FUNCTION START HERE 

    function fetch_employee_groupchat_history(Request $request)
    {
             $from_employee_id = auth()->user()->id;

            // dd( $request->all());

        $team_id = TeamMember::where('employee_id',  $from_employee_id)->first();
        $team = TeamMember::where('employee_id',  $from_employee_id)->first();
        $teams = team::where('user_id',  $from_employee_id)->get();
        $projectManager = ProjectManager::where('user_id', $from_employee_id)->first();

  
        if (\Request::ajax()) {
           
                if ( $projectManager) {

                        $employees = User::join('team_members', 'team_members.employee_id', '=', 'users.id')
                        ->join('chat_messages', 'chat_messages.team_id', '=', 'team_members.team_id')
                        ->join('teams', 'teams.id', '=', 'team_members.team_id')
                        ->where('users.id', auth()->user()->id)
                        ->where('team_members.team_id',  $request->to_team_id)
                        ->where('to_employee_id', 0)
                        ->orderBy('chat_messages.created_at', 'DESC')->get();

                        $output = '<div class="msg ">';
                        foreach($employees as $row)
                        {
                            $user_name = '';
                            $dynamic_design_you = '';
                            $dynamic_design_me = '';
                            $chat_message = '';
                            $team_name = '';
                            if($row->from_employee_id == $from_employee_id)
                            {
                            if($row->status == '2')
                            {
                            $chat_message = '<i class="fas fa-ban"></i> <em>You deleted this message.</em>';
                            $user_name = '<b class="text-success">You</b>';
                        
                            }
                            else
                            {
                            $chat_message = $row->message;
                            $user_name = '<a data-toggle="modal" data-target="#delete_chat" data-chat-id="'.$row->chat_id.'"  class="text-success remove_chat">You</a>';
                            }
                            
                            $dynamic_design_me = '
                            <div class="bubble me images">
                            <span class="name">'.$user_name.'</span>
                            <span class="msg">'.$chat_message.'</span>
                            <div id="image-viewer">
                            <span class="close">&times;</span>
                            <img class="modal-content" id="full-image">
                            </div>
                            <span class="timestamp">'.date('H:i A' ,strtotime($row->created_at)).'</span>
                            </div>';
                            if($row->image != ''){
                        
                                if ($row->status == '2' && $row->image != '') {
                                    $chat_message = '<i class="fas fa-ban"></i> <em>You deleted this message.</em>
                                    <img src="" alt="" width="200px" height="100px" ></span>';
                                    $user_name = '<b class="text-success">You</b>';
                                    }else {
                                    $dynamic_design_me = '
                                    <div class="bubble me images">
                                    <span class="name">'.$user_name.'</span>
                                    <span class="msg">'.$chat_message.'</span>
                                    <div id="image-viewer">
                                    <span class="close">&times;</span>
                                    <img class="modal-content" id="full-image">
                                    </div>
                                    <a class=""><img src="'.asset("chat_files/" .$row->image).'" alt="" width="200px" height="100px" ></a><br>
                                    <span class="timestamp">'.date('H:i A' ,strtotime($row->created_at)).'</span>
                                    </div>';
                                    }
                            
                            }
                            
                    }
                    else
                    {
                        if($row->status == '2')
                        {
                        $chat_message = '<em>This message has been removed</em>';
                        }
                        else
                        {
                        $chat_message = $row->message;
                        }
                        $user_name = '<b class="text-danger">'.$this->get_user_name($row->from_employee_id).'</b>';
                        $dynamic_design_you = '
                        <div class="bubble you images">
                        <span class="name">'.$user_name.'</span>
                        <span class="team_name">'.$row->team_name.'</span>
                        <span class="msg">'.$chat_message.'</span>
                        <div id="image-viewer">
                        <span class="close">&times;</span>
                        <img class="modal-content" id="full-image">
                        </div>
                        <span class="timestamp">'.date('H:i A' ,strtotime($row->created_at)).'</span>
                        </div>
                        ';
                        if($row->image != ''){
                            $dynamic_design_you = '
                            <div class="bubble you images">
                            <span class="name">'.$user_name.'</span>
                            <span class="team_name">'.$row->team_name.'</span>
                            <span class="msg">'.$chat_message.'</span>
                            <div id="image-viewer">
                            <span class="close">&times;</span>
                            <img class="modal-content" id="full-image">
                            </div>
                            <span class="timestamp">'.date('H:i A' ,strtotime($row->created_at)).'</span>
                            </div>';

                            if($row->image != ''){
                    
                                if ($row->status == '2' && $row->image != '') {
                                    $chat_message = '<i class="fas fa-ban"></i> <em>You deleted this message.</em>
                                    <a><img src="" alt="" width="200px" height="100px" ></a>';
                                    $user_name = '<span class="text-success">You</span>';
                                    }else {
                                    $dynamic_design_you = '
                                    <div class="bubble you images">
                                    <span class="name">'.$user_name.'</span>
                                    <span class="team_name">'.$row->team_name.'</span>
                                    <span class="msg">'.$chat_message.'</span>
                                    <div id="image-viewer">
                                    <span class="close">&times;</span>
                                    <img class="modal-content" id="full-image">
                                    </div>
                                    <a class=""><img src="'.asset("chat_files/" .$row->image).'" alt="" width="200px" height="100px" ></a><br>
                                    <span class="timestamp">'.date('H:i A' ,strtotime($row->created_at)).'</span>
                                    </div>';
                                    }
                            
                            }
                        }
                        
                        }
                        $output .= '
                        <div class="chat" style=" ">
                                '.$dynamic_design_me .'

                                '.$dynamic_design_you.'
                            </div>
                            </div>
                                        
                        ';
                        }
                }
                else
                 {
                        $employees = User::join('team_members', 'team_members.employee_id', '=', 'users.id')
                        ->join('chat_messages', 'chat_messages.team_id', '=', 'team_members.team_id')
                        ->join('teams', 'teams.id', '=', 'team_members.team_id')
                        ->where('users.id', auth()->user()->id)
                        ->where('team_members.team_id',  $request->to_team_id)
                        ->where('to_employee_id', 0)
                        ->orderBy('chat_messages.created_at', 'DESC')->get();
                        // ->where('team_members.team_id',  $request->id)
                        // ->select('users.id as id', 'users.image', 'users.username', 'users.first_name', 'users.last_name',
                        // 'teams.id as team_id', 'teams.team_name')
        
        
        
                        // if ($projectManager) {
        
                        $output = '<div class="msg ">';
                        foreach($employees as $row)
                        {
                            $user_name = '';
                            $dynamic_design_you = '';
                            $dynamic_design_me = '';
                            $chat_message = '';
                            $team_name = '';
                            if($row->from_employee_id == $from_employee_id)
                            {
                            if($row->status == '2')
                            {
                            $chat_message = '<i class="fas fa-ban"></i> <em>You deleted this message.</em>';
                            $user_name = '<b class="text-success">You</b>';
                        
                            }
                            else
                            {
                            $chat_message = $row->message;
                            $user_name = '<a data-toggle="modal" data-target="#delete_chat" data-chat-id="'.$row->chat_id.'"  class="text-success remove_chat">You</a>';
                            }
                            
                            $dynamic_design_me = '
                            <div class="bubble me images">
                            <span class="name">'.$user_name.'</span>
                            <span class="msg">'.$chat_message.'</span>
                            <div id="image-viewer">
                            <span class="close">&times;</span>
                            <img class="modal-content" id="full-image">
                            </div>
                            <span class="timestamp">'.date('H:i A' ,strtotime($row->created_at)).'</span>
                            </div>';
                            if($row->image != ''){
                        
                                if ($row->status == '2' && $row->image != '') {
                                    $chat_message = '<i class="fas fa-ban"></i> <em>You deleted this message.</em>
                                    <span><img src="" alt="" width="200px" height="100px"></span>';
                                    $user_name = '<b class="text-success">You</b>';
                                    }else {
                                    $dynamic_design_me = '
                                    <div class="bubble me images">
                                    <span class="name">'.$user_name.'</span>
                                    <span class="msg">'.$chat_message.'</span>
                                    <div id="image-viewer">
                                    <span class="close">&times;</span>
                                    <img class="modal-content" id="full-image">
                                    </div>
                                    <span class=""><img src="'.asset("chat_files/" .$row->image).'" alt="" width="200px" height="100px"></span><br>
                                    <span class="timestamp">'.date('H:i A' ,strtotime($row->created_at)).'</span>
                                    </div>';
                                    }
                            
                            }
                            
                            }
                            else
                            {
                            if($row->status == '2')
                            {
                            $chat_message = '<em>This message has been removed</em>';
                            }
                            else
                            {
                            $chat_message = $row->message;
                            }
                            $user_name = '<b class="text-danger">'.$this->get_user_name($row->from_employee_id).'</b>';
                            $dynamic_design_you = '
                            <div class="bubble you images">
                            <span class="name">'.$user_name.'</span>
                            <span class="team_name">'.$row->team_name.'</span>
                            <span class="msg">'.$chat_message.'</span>
                            <div id="image-viewer">
                            <span class="close">&times;</span>
                            <img class="modal-content" id="full-image">
                            </div>
                            <span class="timestamp">'.date('H:i A' ,strtotime($row->created_at)).'</span>
                            </div>
                            ';
                            if($row->image != ''){
                                $dynamic_design_you = '
                                <div class="bubble you images">
                                <span class="name">'.$user_name.'</span>
                                <span class="team_name">'.$row->team_name.'</span>
                                <span class="msg">'.$chat_message.'</span>
                                <div id="image-viewer">
                                <span class="close">&times;</span>
                                <img class="modal-content" id="full-image">
                                </div>
                                <span class="timestamp">'.date('H:i A' ,strtotime($row->created_at)).'</span>
                                </div>';
        
                                if($row->image != ''){
                        
                                    if ($row->status == '2' && $row->image != '') {
                                        $chat_message = '<i class="fas fa-ban"></i> <em>You deleted this message.</em>
                                        <img src="" alt="" width="200px" height="100px"></span>';
                                        $user_name = '<span class="text-success">You</span>';
                                        }else {
                                        $dynamic_design_you = '
                                        <div class="bubble you images">
                                        <span class="name">'.$user_name.'</span>
                                        <span class="team_name">'.$row->team_name.'</span>
                                        <span class="msg">'.$chat_message.'</span>
                                        <div id="image-viewer">
                                        <span class="close">&times;</span>
                                        <img class="modal-content" id="full-image">
                                        </div>
                                        <span class=""><img src="'.asset("chat_files/" .$row->image).'" alt="" width="200px" height="100px"></span><br>
                                        <span class="timestamp">'.date('H:i A' ,strtotime($row->created_at)).'</span>
                                        </div>';
                                        }
                                
                                }
                            }
                            
                            }
                            $output .= '
                            <div class="chat" style=" ">
                                    '.$dynamic_design_me .'
        
                                    '.$dynamic_design_you.'
                                </div>
                                </div>
                                            
                            ';
                            }
                }
                    
                    $output .= '</div>';
                // echo $output;
                return $output;
        }
    }



    public function uploadImages(Request $request) {
        
        // dd($request->all());
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName().'.'.$image->extension();
        $image->move(public_path('chat_files'),$imageName);
        $data  =   ChatMessage::create(['image' => $imageName, 'from_employee_id' => auth()->user()->id , 'to_employee_id' => 0, 'team_id' => $request->team]);
        return response()->json(["status" => "success", "data" => $data]);
    }

// --------------------- [ Delete image ] -----------------------------

    public function deleteImage(Request $request) {
        $image = $request->file('filename');
        $filename =  $request->get('filename').'.jpeg';
        ChatMessage::where('image', $filename)->delete();
        $path = public_path().'/images/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }





    public function GroupChatStore(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {

            
           

            $employee = new ChatMessage();
            // if($request->file('chat_file')  == ''){

                // $file = $request->file('chat_file');
                // // return $file;
                // $extension = $file->getClientOriginalExtension();
                // $filename = time().'.'.$extension;
                // // return $filename;
                // $file -> move('/', $filename);
                // $employee->image = $filename;
            // }else{
        //    return $request;
            // $employee->image = '';
            // }
            $employee -> from_employee_id = auth()->user()->id;
            $employee -> to_employee_id = 0;
            $employee -> team_id = $request -> to_team_id;
            $employee -> message = $request -> chat_message;
            $employee -> status = 0;
            // $employee->image = $request->file('chat_file')->store('uploads/chat_files');
            $employee -> save();

            return response($employee);
       }
    }

    public function upload_ChatFiles(Type $var = null)
    {

        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 
        if ($files = $request->file('image')) {
            
            $fileName =  "image-".time().'.'.$request->image->getClientOriginalExtension();
            $request->image->storeAs('image', $fileName);
            
            $image = new Image;
            $image->image = $fileName;
            $image->save();

            return Response()->json([
                "image" => $fileName
            ], Response::HTTP_OK);
 
        }

        // if(!empty($_FILES))
        //     {
        //     if(is_uploaded_file($_FILES['uploadFile']['tmp_name']))
        //     {
        //     $_source_path = $_FILES['uploadFile']['tmp_name'];
        //     $target_path = 'upload/' . $_FILES['uploadFile']['name'];
        //     if(move_uploaded_file($_source_path, $target_path))
        //     {
        //     echo '<p><img src="'.$target_path.'" class="img-thumbnail" width="200" height="160" /></p><br />';
        //     }
        //     }
        //     }
    }

 
     



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChatMessage  $chatMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChatMessage $chatMessage)
    {
        //
    }
}