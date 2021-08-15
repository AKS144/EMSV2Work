@extends('admin.layout.master')

<?php 
// use Carbon;
?>
@section('content')
@include('admin.tasks.create')

<style>

.filterable {
  margin-top: 15px;
}
.filterable .panel-heading .pull-right {
  margin-top: -20px;
}
.filterable .filters input[disabled] {
  background-color: transparent;
  border: none;
  cursor: auto;
  box-shadow: none;
  padding: 0;
  height: auto;
}
.filterable .filters input[disabled]::-webkit-input-placeholder {
  color: #333;
}
.filterable .filters input[disabled]::-moz-placeholder {
  color: #333;
}
.filterable .filters input[disabled]:-ms-input-placeholder {
  color: #333;
}

</style>

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
                    <h4 class="page-title">Tasks</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a
                                        href="{{route('task.index')}}">Tasks</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2" style="float:right">

        </div>
        <br><br>
        <div class="container-fluid">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title alert alert-dark btn-dark">
                        <h2><i class="fa fa-tasks fa-lg" aria-hidden="true"></i> Task List Filters</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <!-- <li class="dropdown"> -->
                                <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a> -->
                                @can('isEmployee')
                                <a class="btn btn-round btn-dark" href="#" data-toggle="modal" data-target="#task"><i
                                        class="fa fa-project"></i> Create Task</a>
                                @endcan
                            <!-- </li> -->
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content ">

                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr class="filters">
                                        <th>Assigned User
                                            <select id="assigned-user-filter" class="form-control">
                                                <option>None</option>
                                                <option>John</option>
                                                <option>Rob</option>
                                                <option>Larry</option>
                                                <option>Donald</option>
                                                <option>Roger</option>
                                            </select>
                                        </th>
                                        <th>Status
                                            <select id="status-filter" class="form-control">
                                                <option>Any</option>
                                                <option>Not Started</option>
                                                <option>In Progress</option>
                                                <option>Completed</option>
                                            </select>
                                        </th>
                                        <th>Milestone
                                            <select id="milestone-filter" class="form-control">
                                                <option>None</option>
                                                <option>Milestone 1</option>
                                                <option>Milestone 2</option>
                                                <option>Milestone 3</option>
                                            </select>
                                        </th>
                                        <th>Priority
                                            <select id="priority-filter" class="form-control">
                                                <option>Any</option>
                                                <option>Low</option>
                                                <option>Medium</option>
                                                <option>High</option>
                                                <option>Urgent</option>
                                            </select>
                                        </th>
                                        <th>Tags
                                            <select id="tags-filter" class="form-control">
                                                <option>None</option>
                                                <option>Tag 1</option>
                                                <option>Tag 2</option>
                                                <option>Tag 3</option>
                                            </select>
                                        </th>
                                    </tr>
                                </thead>
                            </table>


                            <div class="panel panel-dark filterable">
                                <div class="panel-heading">
                                    <div class="pull-right"></div>
                                </div>
                                <div class="table-responsive">
                                <table id="task-list-tbl" class="table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Planned Start - End</th>
                                            <th>Actual Start - End</th>
                                            <th>Priority</th>
                                            <th>Milestone</th>
                                            <th>Assigned</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    @foreach($tasks as $task)
                                        <tr id="task-1" class="task-list-row" data-task-id="1" data-user="Larry"
                                            data-status="In Progress" data-milestone="Milestone 2"
                                            data-priority="Urgent" data-tags="Tag 2">
                                            <td>{{$task->task_name}} <br><br> <sup>[{{$task->project_name}}]</sup></td>
                                            <td>{{$task->planned_start_date}}   <i class="fas fa-exchange-alt"></i>  {{$task->planned_end_date}}</td>
                                            <td>{{$task->actual_start_date}}   <i class="fas fa-exchange-alt"></i>  {{$task->actual_end_date}}</td>
                                            <td>{{$task->priority}}</td>
                                            <td>Milestone 2</td>
                                            <td><button class="btn-dark"  data-toggle="modal" data-target="#assign-team" data-task-id="{{$task->id}}" data-task-name="{{$task->task_name}}">Team / User</button></td>
                                            @if($task->planned_end_date == now()->addDays(1)->toDateString())
                                         <label for="" class="label label-warning" > your time is up</label>
                                            @else

                                            @endif
                                            <td>
                                            @if($task->status == "In Progress")
                                                <label for="" class="label label-warning"> {{$task->status}}</label>
                                            @elseif($task->status == "Not Started")
                                            <label for="" class="label label-default"> {{$task->status}}</label>
                                            @elseif($task->status == "Completed")
                                            <label for="" class="label label-success"> {{$task->status}}</label>
                                            @endif
                                            </td>
                                            <td><button class="btn-round btn-default" data-toggle="modal" data-target="#activity" data-task-id="{{$task->id}}" data-task-name="{{$task->task_name}}"> Add Activity</button></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>
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