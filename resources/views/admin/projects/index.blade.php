@extends('admin.layout.master')

@section('content')
@include('admin.projects.create')
@include('admin.project_managers.create')



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
                    <h4 class="page-title">Projects</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a
                                        href="{{route('leave')}}">Projects</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <a href="#" data-toggle="#assign-team" data-target="modal" class="btn btn-success"> Show Task</a>
        <div class="col-md-1" style="float:right; padding-right:10%">
           <a  class="btn btn-dark btn-round" href="{{url()->previous()}}"><i class="fa fa-arrow-left"> Return</i></a>
        </div>
        <br><br>
        <div class="container-fluid">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title alert alert-dark btn-dark">
                    @can('isAdmin')
                        <h2><i class="fa fa-arrows fa-lg"></i> List of Projects </h2>
                        <ul class="nav navbar-right panel_toolbox">
                        <a class="btn btn-round btn-dark" href="#" data-toggle="modal" data-target="#project"><i
                        class="fa fa-project"></i> Create Project</a>
                        </ul>
                    @endcan
                    @can('isEmployee')
                        <h2><i class="fa fa-arrows fa-lg"></i> Your Projects </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li> -->
                            <a href="{{route('team.index')}}" class="btn btn-dark btn-round"> Create Team</a>
                        </ul>
                        @endcan
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content ">
                    <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                        @can('isAdmin')
                                            <th>S.N.</th>
                                        @endcan
                                            <th>Project Name</th>
                                            <th>Planned Start Date</th>
                                            <th>Planned End Date</th>
                                            <th>Actual Etart</th>
                                            <th>Actual End</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($projects as $project)
                                        <?php $manager = App\ProjectManager::join('users', 'users.id', '=', 'project_managers.user_id')->where('project_id', $project->id)->first() ?>
                                        <?php $assign_user = App\ProjectManager::join('users', 'users.id', '=', 'project_managers.user_id')->where('user_id', auth()->user()->id)->first() ?>
                                        @can('isAdmin')
                                        @if($manager)
                                            <tr style="background-color:#4B5F71; color:#ffffff">
                                                <td>{{$loop -> index+1 }}</td>
                                                <td>{{$project->project_name}}</td>
                                                <td>{{$project->planned_start_date}}</td>
                                                <td>{{$project->planned_end_date}}</td>
                                                <td>{{$project->actual_start_date}}</td>
                                                <td>{{$project->actual_end_date}}</td>
                                                <td>
                                                    <form id="delete-form-{{ $project->id }}" action="{{route('project.destroy',$project->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        @if($projectManager)
                                                        @if($manager)
                                                        <a class="btn btn-round btn-dark" href="{{route('project_manager.show',$project->id)}}"><i class="fa fa-check-circle bg-green"></i> {{$manager->first_name .' '. $manager->last_name}} </a>
                                                        @else
                                                        <a class="btn btn-round btn-dark" href="#" data-toggle="modal" data-target="#project_manager" data-project-id="{{$project->id}}"  data-project-name="{{$project->project_name}}"><i class="fa fa-male"></i> Assign Manager</a>
                                                        @endif
                                                        @else
                                                        <a class="btn btn-round btn-dark" href="#" data-toggle="modal" data-target="#project_manager" data-project-id="{{$project->id}}"  data-project-name="{{$project->project_name}}"><i class="fa fa-group"></i> Assign Team</a>
                                                        @endif
                                                        <a href="#" class="btn btn-sm btn-dark  btn-round"
                                                         data-project-id="{{$project->id}}"  data-project-name="{{$project->project_name}}"
                                                        data-project-p-start="{{$project->planned_start_date}}" 
                                                        data-project-p-end="{{$project->planned_end_date}}"
                                                        data-project-a-start="{{$project->actual_start_date}}"
                                                        data-project-a-end="{{$project->actual_end_date}}"
                                                        data-project-description="{{$project->project_description}}"
                                                         data-toggle="modal" data-target="#project_edit">
                                                         Edit</a>
                                                        <a href="#" onclick="deleteProject({{ $project->id }})" class="btn btn-sm btn-round btn-danger">Delete</a>
                                                    </form>
                                                </td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td>{{$loop -> index+1 }}</td>
                                                <td>{{$project->project_name}}</td>
                                                <td>{{$project->planned_start_date}}</td>
                                                <td>{{$project->planned_end_date}}</td>
                                                <td>{{$project->actual_start_date}}</td>
                                                <td>{{$project->actual_end_date}}</td>
                                                <td>
                                                <form id="delete-form-{{ $project->id }}" action="{{route('project.destroy',$project->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        @if($projectManager)
                                                        @if($manager)
                                                        <a class="btn btn-round btn-dark" href="{{route('project_manager.show',$project->id)}}"><i class="fa fa-check-circle bg-green"></i> {{$manager->first_name .' '. $manager->last_name}} </a>
                                                        @else
                                                        <a class="btn btn-round btn-dark" href="#" data-toggle="modal" data-target="#project_manager" data-project-id="{{$project->id}}"  data-project-name="{{$project->project_name}}"><i class="fa fa-male"></i> Assign Manager</a>
                                                        @endif
                                                        @else
                                                        <a class="btn btn-round btn-dark" href="#" data-toggle="modal" data-target="#project_manager" data-project-id="{{$project->id}}"  data-project-name="{{$project->project_name}}"><i class="fa fa-group"></i> Assign Team</a>
                                                        @endif
                                                        <a href="#" class="btn btn-sm btn-dark btn-round"
                                                         data-project-id="{{$project->id}}"  data-project-name="{{$project->project_name}}"
                                                        data-project-p-start="{{$project->planned_start_date}}" 
                                                        data-project-p-end="{{$project->planned_end_date}}"
                                                        data-project-a-start="{{$project->actual_start_date}}"
                                                        data-project-a-end="{{$project->actual_end_date}}"
                                                        data-project-description="{{$project->project_description}}"
                                                         data-toggle="modal" data-target="#project_edit">
                                                         Edit</a>
                                                        <a href="#" onclick="deleteProject({{ $project->id }})" class="btn btn-sm btn-round btn-danger">Delete</a>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endif
                                            @endcan
                                            @endforeach

                                            @can('isEmployee')
                                            @if($assign_user)
                                            <tr style="background-color:#4B5F71; color:#ffffff">
                                               
                                                <td>{{$project->project_name}}</td>
                                                <td>{{$project->planned_start_date}}</td>
                                                <td>{{$project->planned_end_date}}</td>
                                                <td>{{$project->actual_start_date}}</td>
                                                <td>{{$project->actual_end_date}}</td>
                                                <td>
                                               
                                                    <form id="delete-form-{{ $project->id }}" action="{{route('project.destroy',$project->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        @if($projectManager)
                                                        @if($manager)
                                                        <a class="btn btn-round btn-dark" href="{{route('project_manager.show',$project->id)}}"><i class="fa fa-check-circle bg-green"></i> {{$manager->first_name .' '. $manager->last_name}} </a>
                                                        @else
                                                        <a class="btn btn-round btn-dark" href="#" data-toggle="modal" data-target="#project_manager" data-project-id="{{$project->id}}"  data-project-name="{{$project->project_name}}"><i class="fa fa-group"></i> Assign Team</a>
                                                        @endif
                                                        @else
                                                        <a class="btn btn-round btn-dark" href="#" data-toggle="modal" data-target="#project_manager" data-project-id="{{$project->id}}"  data-project-name="{{$project->project_name}}"><i class="fa fa-group"></i> Assign Team</a>
                                                        @endif
                                                        @can('!isEmployee')
                                                        <a href="{{route('project.edit',$project->id)}}" class="btn btn-sm btn-dark btn-round">Edit</a>
                                                        <a href="#" onclick="deleteProject({{ $project->id }})" class="btn btn-sm btn-round btn-danger"><i class="fa fa-trash"></i></a>
                                                        @endcan
                                                    </form>
                                                </td>
                                            </tr>
                                            @endif
                                            @endcan
                                        </tbody>
                                       
                                    </table>
                                    {{ $projects->links() }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">

    function deleteProject(id)

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
                document.getElementById('delete-form-'+id).submit();
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