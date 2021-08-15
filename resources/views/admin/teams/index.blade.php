@extends('admin.layout.master')

@section('content')
@include('admin.teams.create')
@include('admin.team_members.create')

<div id="main-wrapper">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Teams</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a
                                        href="{{route('team.index')}}">Teams</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="container-fluid">
 
            @can('isAdmin')
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title alert alert-dark btn-dark">
                            <h2><i class="fa fa-group fa-sm"></i> Members </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <a class="btn btn-round btn-dark" href="{{url()->previous()}}" ><i
                                class="fa fa-arrow-left"></i> Return</a>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content ">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <!-- <th>S.N.</th> -->
                                                <th>Team Name</th>
                                                <th>Members</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($team_members as $member)
                                            <tr>
                                                <!-- <td>{{$loop -> index+1 }}</td> -->
                                                <td>{{$member->team_name}}</td>
                                                <td style="text-align:center"><a href="{{route('team_member.show',$member->id)}}" data-toggle="tooltip" data-placement="right" title="See Members" class="btn btn-round btn-success">{{$member->total}}</a></td>
                                              
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                    {{ $teams->links() }}
                                </div>
                                <!-- <div class="col-md-6">
                                <select name="" id="" class="form-control select2">
                                <option value="">select</option>
                                <option value="">select</option>
                                </select>
                            </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
            @can('isEmployee')
            @if($project_manager)
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title alert alert-dark btn-dark">
                        <h2><i class="fa fa-arrows fa-sm"></i> Team Names</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <a class="btn btn-round btn-dark" href="#" data-toggle="modal" data-target="#team"><i
                            class="fa fa-user"></i> Create team</a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content ">
                    
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered" style="text-align:center">
                                        <thead>
                                            <tr style="text-align:center">
                                                <th style="text-align:center">S.N.</th>
                                                <th style="text-align:center">Team Name</th>
                                                <th style="text-align:center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user_teams as $team)
                                            <tr>
                                                <td>{{$loop -> index+1 }}</td>
                                                <td> <i class="fa fa-edit"><a
                                                href="#" data-toggle="modal" id="team_edit" data-target="#team_edit" data-team-id="{{$team->id}}"  data-team-name="{{$team->team_name}}"
                                                class="btn btn-sm btn-dark1" data-toggle="tooltip" data-placement="top" title="Edit">{{$team->team_name}}</a></i> 
                                                </td>
                                               
                                                <td>
                                                    <form id="delete-form-{{ $team->id }}" 
                                                    action="{{route('team.delete', $team->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                     <!-- Assign team -->
                                                    <a class="btn btn-round btn-dark" href="#" data-toggle="modal" id="team_member" data-target="#team_member" data-team-id="{{$team->id}}"  data-team-name="{{$team->team_name}}"><i class="fa fa-group"></i> Assign Team</a>
                                                      
                                                       <button type="button" onclick="deleteTeam({{ $team->id }})"
                                                        class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                    {{ $teams->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title alert alert-dark btn-dark">
                            <h2><i class="fa fa-group fa-sm"></i> Members </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <a href="{{route('chat.index')}}"
                                target="_blank" class="btn btn-sm btn-round btn-dark"><i class="fab fa-whatsapp fa-lg"></i>  Chat</a>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content ">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Team Name</th>
                                                <th>Members</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($team_member_users as $member)
                                            <tr>
                                                <td>{{$member->team_name}}</td>
                                                <td style="text-align:center"><a href="{{route('team_member.show',$member->id)}}" data-toggle="tooltip" data-placement="right" title="See Members" class="btn btn-round btn-success">{{$member->total}}</a></td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                    {{ $teams->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title alert alert-dark btn-dark">
                            <h2><i class="fa fa-group fa-sm"></i> Team Members </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content ">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <!-- <th>S.N.</th> -->
                                                <th>Team Name</th>
                                                <th>Members</th>
                                                <th>Chat Room</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($team_member_users as $member)
                                            <tr>
                                                <!-- <td>{{$loop -> index+1 }}</td> -->
                                                <td>{{$member->team_name}}</td>
                                                <td style="text-align:center"><a href="{{route('team_member.show',$member->id)}}" data-toggle="tooltip" data-placement="right" title="See Members" class="btn btn-round btn-success">{{$member->total}}</a></td>
                                                <td>
                                                <a href="{{route('chat.index')}}"
                                                data-team-id="{{$member->team_id}}" target="_blank" class="btn btn-sm btn-warning"><i class="fab fa-whatsapp fa-lg"></i>  Chat</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                    {{ $teams->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endcan
        </div>
    </div>
</div>

</div>


@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>


<script>
$(document).ready(function() {
$('.select2').select2({
closeOnSelect: false
});
});
</script>



<script type="text/javascript">
function deleteTeam(id)

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