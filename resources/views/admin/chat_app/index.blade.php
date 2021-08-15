@extends('admin.layout.master')

@section('content')

<style>
.chat_message_area {
    position: relative;
    width: 100%;
    height: auto;
    background-color: #FFF;
    border: 1px solid #CCC;
    border-radius: 3px;
}

#group_chat_message {
    width: 100%;
    height: auto;
    min-height: 80px;
    overflow: auto;
    padding: 6px 24px 6px 12px;
}

.image_upload {
    position: absolute;
    top: 3px;
    right: 3px;
}

.image_upload>form>input {
    display: none;
}

.image_upload img {
    width: 24px;
    cursor: pointer;
}
</style>

<style>
/* .chat {
    width: 300px;
} */

.bubble {
    background-color: #f2f2f2;
    border-radius: 5px;
    box-shadow: 0 0 6px #b2b2b2;
    display: inline-block;
    padding: 15px 18px;
    position: relative;
    vertical-align: top;
}

.bubble::before {
    background-color: #f2f2f2;
    content: "\00a0";
    display: block;
    height: 16px;
    position: absolute;
    top: 11px;
    transform: rotate(29deg) skew(-35deg);
    -moz-transform: rotate(29deg) skew(-35deg);
    -ms-transform: rotate(29deg) skew(-35deg);
    -o-transform: rotate(29deg) skew(-35deg);
    -webkit-transform: rotate(29deg) skew(-35deg);
    width: 20px;
}

.me {
    float: left;
    margin: 5px 45px 5px 20px;
    /* width:100%; */
    background: #dcf8c6;
}

.name .timestamp {
    font-weight: 600;
    font-size: 14px;
    display: inline-table;
    padding: 0 15px 0 15px;
    margin: 0 0 4px 0;
    color: #3498db;
    background: #dcf8c6;
}

.name .timestamp span {
    font-weight: normal;
    color: #b3b3b3;
    overflow: hidden;
}

.name .timestamp.alt {
    color: #2ecc51;
}

.me::before {
    box-shadow: -2px 2px 2px 0 rgba(178, 178, 178, .4);
    left: -9px;
    background: #dcf8c6;
}

.you {
    float: right;
    margin: 5px 20px 5px 45px;
     /* width:100%; */
}

.you .msg {
    margin-top: 3px;
}

.you::before {
    box-shadow: 2px -2px 2px 0 rgba(178, 178, 178, .4);
    right: -9px;
}

.user_dialog {
    border-radius: 30px;
    background: red;
}

.timestamp {
    font-size: 11px;
    margin: auto;
    padding: 0 15px 0 0;
    display: table;
    float: right;
    position: relative;
    text-transform: uppercase;
    color: #999;
}

.msg {
    font-size: 14px;
    font-weight: 500;
    padding: 0 0px 0 15px;
    margin: auto;
    color: #2b2b2b;
    display: table;
}

.remove_chat {
    cursor: pointer;
}

.pull-right{
    cursor: pointer;
}

.dropzone {
/* width: 100px; */
/* height: 100px; */
min-height: 0px !important;
zoom: 0.5;
} 

.ui-dialog{
    /* margin-top: 20%; */
    /* float:left !important; */

}
</style>

<!-- <audio controls id="message_sound">
    <source src="{{asset('message/sound/message_sound.mp3')}}" type="audio/mpeg">
</audio> -->

@include('admin.chat_app.chat_bubble_style')


<!-- <button class="chat">Send Chat Message</button> -->

<div id="delete_chat" class="modal modal-child" data-backdrop-limit="1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-modal-parent="#myModal">
    <div class="modal-dialog modal-dialog-centered" style="margin-top:20%; width:15%">
        <!-- Modal content-->
        <div class="modal-content">
            <input type="hidden" name="chat_id" id="">
            <div class="modal-body">
                <p> Star <i class="fa fa-star  pull-right"></i></p>
                <p> Reply <i class="fa fa-reply  pull-right"></i></p>
                <p> Forward <i class="fa fa-share  pull-right"></i></p>
                <p style="color:red"> Delete <i class="fa fa-trash pull-right" id="remove_chat"></i></p>
            </div>
            <div class="modal-footer">
                <a class="pull-left" data-dismiss="modal" data-dismiss="modal" aria-hidden="true">More...</a>
            </div>

        </div>
    </div>
</div>


<div class="page-wrapper">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">employee Management</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="{{route('employee')}}">Employee</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> -->
    <!-- GROUP CHAT START START HERE -->

    <div id="group_chat_dialog" title="Group Chat ">
        <div id="group_chat_history"
            style="height:300px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;">

        </div>
        <div class="form-group">
            <!--<textarea name="group_chat_message" id="group_chat_message" class="form-control"></textarea>!-->
            <div class="chat_message_area" id="">

                <form method="post" action="{{route('chat_file_store')}}" enctype="multipart/form-data"
                            class="dropzone" id="dropzone">
                            <input type="hidden" name="team" id="team" value="{{$team->team_id}}">
                @csrf
                </form>

                <!-- FILE UPLOAD END HERE -->
                <div id="group_chat_message" contenteditable class="form-control">

                </div>

            </div>
        </div>
        <div class="form-group" align="right">
            <button type="button" name="send_group_chat" id="send_group_chat" class="btn btn-info">Send</button>
        </div>
    </div>


   

    <!-- GROUP CHAT START END HERE -->

    <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title alert alert-dark btn-dark">
                    <!-- <h2>Team Members ChatRoom</h2> -->
                    <div class="col-md-6 pull-left">
                        <a class="btn btn-round btn-xm online_back" id="online_back"> <i class="fa fa-refresh "></i></a>
                        <div id="offline_note" style=" font-weight:bold; "></div>
                    </div>
                    
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li>
                            <div class="col-md-2" style="float:right; margin-right:7%;">
                            <input type="hidden" id="is_active_group_chat_window" value="no" />
                            @if($projectManager)
                            @foreach($teams as $team)

                                <?php  $count_group_message = App\ChatMessage::where('from_employee_id', auth()->user()->id)
                                ->where('team_id', $team->id)
                                ->where('status', 0)
                                ->count();

                                // dd($count_group_message);
                                
                                ?>
                                <a class="btn btn-lg btn-dark btn-sm pull-right start_group_chat" name="group_chat"  href="#" data-toggle="modal"
                                  data-teamid="{{$team->id}}" data-teamname="{{$team->team_name}}" data-target="#employee"> <i class="fa fa-group"></i> Group Chat with {{$team->team_name}}</a>
                            @endforeach
                            @else
                            <a class="btn btn-lg btn-dark btn-sm pull-right" name="group_chat" id="group_chat" href="#" data-toggle="modal"
                                    data-target="#employee"> <i class="fa fa-group"></i> Group Chat</a>
                            @endif
                            </div>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <!-- <h4 align="center">Online User</h4>
                        <p align="right">Hi {{auth()->user()->username}}</p> -->
                        <div id="employee_details"></div>
                        <div id="user_model_details"></div>

                        <div id="groupChat_model_details"></div>

                        <input type="hidden" name="current_user" id="current_user" value="{{auth()->user()->id}}">
                        <input type="hidden" name="team" id="team" value="{{$team->team_id}}">
                        <input type="hidden" name="is_onlineUser" id="is_onlineUser" value="{{$is_onlineUser}}">
                        
                    </div>

                </div>
            </div>
        </div>
        {{-- </div> --}}

        {{--sweetalert box for deleting start--}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>

        <script type="text/javascript">
        function deletePost(id)

        {
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
            })

            swalWithBootstrapButtons({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                        'Cancelled',
                        'Your file is safe :)',
                        'error'
                    )
                }
            })
        }
        </script>
        {{--sweetalert box for deleting end--}}
    </div>

</div>
</div>



<!-- Modal -->
<div class="modal fade" id="delete_chat1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " style="width:20%" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle" id="exampleModalLongTitle"
                    style="font-weight:bolder; text-transform:uppercase; font-family: 'Times New Roman', Times, serif; color:red">
                    Create New Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark">Create Project</button>
            </div>
            </form>
        </div>
    </div>
</div>




@endsection