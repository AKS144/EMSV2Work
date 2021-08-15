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
        <div class="col-md-2" style="float:right">
            @can('isAdmin')
            <!-- <a class="btn btn-round btn-dark" href="#" data-toggle="modal" data-target="#team"><i
                    class="fa fa-team"></i> Create team</a> -->
            @endcan
        </div>
        <br><br>
        <div class="container-fluid">
            {{-- -------------------------- Search Form Start here ------------ --}}
            <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title alert alert-dark btn-dark">
                        <h2><i class="fa fa-search fa-lg"></i> Search</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content collapse">
                        <form action="{{route('leave.search')}}" method="GET" class="form-horizontal">
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <input type="text" name="search" class="form-control" id="fname"
                                        placeholder="Leave type">
                                </div>

                                <button type="submit" class="btn btn-dark"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->

            {{-- -------------------------- Search Form Start here ------------ --}}
            @can('isAdmin')
            <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title alert alert-dark btn-dark">
                        <h2><i class="fa fa-arrows fa-lg"></i> Team Names</h2>
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
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.N.</th>
                                                <th>team Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($teams as $team)
                                            <tr>
                                                <td>{{$loop -> index+1 }}</td>
                                                <td>{{$team->team_name}}</td>
                                                <td>
                                                    <form action="{{route('team.destroy',$team->id)}}" method="put">
                                                        @csrf
                                                        @method('DELETE')
                                                        <!-- <a class="btn btn-round btn-dark" href="#" data-toggle="modal" data-target="#team"><i class="fa fa-group"></i> Assign Team</a> -->
                                                        <a href="{{route('team.edit',$team->id)}}"
                                                            class="btn btn-sm btn-dark">Edit</a>
                                                        <button type="submit"
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
                <div class="col-md-7 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title alert alert-dark btn-dark">
                            <h2><i class="fa fa-group fa-lg"></i> Members </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <a class="btn btn-round btn-dark" href="#" data-toggle="modal" data-target="#team"><i
                                class="fa fa-team"></i> Assign Team Members</a>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content ">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.N.</th>
                                                <th>team Name</th>
                                                <th>team Members</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($teams as $team)
                                            <tr>
                                                <td>{{$loop -> index+1 }}</td>
                                                <td>{{$team->team_name}}</td>
                                                <td>

                                                    <form action="{{route('team.destroy',$team->id)}}" method="put">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="btn btn-round btn-dark" href="#" data-toggle="modal"
                                                            data-target="#team"><i class="fa fa-group"></i> Assign
                                                            Team</a>
                                                        <a href="{{route('team.edit',$team->id)}}"
                                                            class="btn btn-sm btn-dark">Edit</a>
                                                        <button type="submit"
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
            </div>
            @endcan

            @can('isEmployee')
            <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title alert alert-dark btn-dark">
                        <h2><i class="fa fa-arrows fa-lg"></i> Team Names</h2>
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
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.N.</th>
                                                <th>team Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($teams as $team)
                                            <tr>
                                                <td>{{$loop -> index+1 }}</td>
                                                <td>{{$team->team_name}}</td>
                                                <td>
                                                    <form action="{{route('team.destroy',$team->id)}}" method="put">
                                                        @csrf
                                                        @method('DELETE')
                                                        <!-- <a class="btn btn-round btn-dark" href="#" data-toggle="modal" data-target="#team"><i class="fa fa-group"></i> Assign Team</a> -->
                                                        <a href="{{route('team.edit',$team->id)}}"
                                                            class="btn btn-sm btn-dark">Edit</a>
                                                        <button type="submit"
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
                <div class="col-md-7 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title alert alert-dark btn-dark">
                            <h2><i class="fa fa-group fa-lg"></i> Members </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <a class="btn btn-round btn-dark" href="#" data-toggle="modal" data-target="#team"><i
                                class="fa fa-team"></i> Assign Team Members</a>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content ">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.N.</th>
                                                <th>team Name</th>
                                                <th>team Members</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($teams as $team)
                                            <tr>
                                                <td>{{$loop -> index+1 }}</td>
                                                <td>{{$team->team_name}}</td>
                                                <td>

                                                    <form action="{{route('team.destroy',$team->id)}}" method="put">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="btn btn-round btn-dark" href="#" data-toggle="modal"
                                                            data-target="#team"><i class="fa fa-group"></i> Assign
                                                            Team</a>
                                                        <a href="{{route('team.edit',$team->id)}}"
                                                            class="btn btn-sm btn-dark">Edit</a>
                                                        <button type="submit"
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
            </div>
            @endcan
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