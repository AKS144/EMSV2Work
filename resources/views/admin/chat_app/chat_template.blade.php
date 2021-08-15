<style>
.name_chat {
    cursor: pointer;
}
.rounded-circle{
  width:60px;
  height: 60px;
  border-radius:50%
}

ul li{
  text-decoration:none;
  list-style:none;
}

.user_dialog{
  text-transform:uppercase !important;
}

</style>
    <div class="people-list" id="people-list">
        <div class="search">
        <div class="col-md-12">
        <div class="col-md-8 pull-left" style="text-transform:uppercase">
        <span>{{auth()->user()->first_name . ' '. auth()->user()->last_name}}</span>
        </div>
        <div class="col-md-2 pull-right">
            <a class="btn btn-info btn-round btn-sm" id="online_back"> <i class="fa fa-refresh fa-lg "></i></a>
        </div>
        </div>
        <br><br>
        </div>
        <ul class="list">
            @foreach($employees as $key => $employee)

            <?php  
              
            $status_check = '';
                $employee_last_act = App\EmployeeDetail::
                where('employee_id',  $employee->id)->
                where('is_online',  1)
                ->get();

                $countUnRead_messages = App\ChatMessage::
                             where('from_employee_id', $employee->id)
                            ->where('to_employee_id', auth()->user()->id )
                            ->where('status', 0)->count();
                            // ->count();

                            // dd($employee->username);
                foreach($employee_last_act as $last_act)
                {
                  $status_check = $last_act->is_online;
                }

                $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
                $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);

            ?>



                  {{$employee->id}}
            <li class="clearfix start_chat name_chat" data-touserid="{{$employee->id}}"
                        data-tousername="{{$employee->username}}"  data-toteamid="{{$employee->team_id}}" data-toteamname="{{$employee->team_name}}">
                        @if($employee->image != '')
                <img src="{{asset('uploads/gallery/' .$employee->image)}}" alt="avatar" class="rounded-circle" />
                        @else
                        <img src="{{asset('uploads/gallery/no-image.jpg')}}" alt="avatar" class="rounded-circle" />
                        @endif
                <div class="about">
                @if($countUnRead_messages > 0)
                <span style="color:red; font-weight:bold;"> New <sup class="badge badge-success">{{$countUnRead_messages}}</sup></span>
                @endif
                    <div class="">{{ucfirst($employee->username)}} </div>
                    <div class="status">
                        @if($status_check == 1)
                        <i class="fa fa-circle online"></i> online
                        @else
                        <i class="fa fa-circle offline"></i> offline
                        @endif
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

 
<script id="message-template" type="text/x-handlebars-template">
    <li class="clearfix">
    <div class="message-data align-right">
      <span class="message-data-time" >{{date('Y-m-d')}}, Today</span> &nbsp; &nbsp;
      <span class="message-data-name" >Olia</span> <i class="fa fa-circle me"></i>
    </div>
    <div class="message other-message float-right">
       <!--  Message Output -->
    </div>
  </li>
</script>

<script id="message-response-template" type="text/x-handlebars-template">
    <li>
    <div class="message-data">
      <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
      <span class="message-data-time">{{date('Y-m-d')}}, Today</span>
    </div>
    <div class="message my-message">
      <!-- Message Response  -->
    </div>
  </li>
</script>