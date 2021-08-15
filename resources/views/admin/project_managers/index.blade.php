@extends('admin.layout.master')

@section('content')
@include('admin.projects.create')

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
        <div class="col-md-2" style="float:right">
            @can('isAdmin')
            <a href="" class="btn btn-round btn-dark">Create Team</a>
            <a class="btn btn-round btn-dark" href="#" data-toggle="modal" data-target="#project"><i
                    class="fa fa-project"></i> Create Project</a>
            @endcan
        </div>
        <br><br>
        <div class="container-fluid">
            {{-- -------------------------- Search Form Start here ------------ --}}
            <div class="col-md-12 col-sm-12 col-xs-12">
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
            </div>


            {{-- -------------------------- Search Form Start here ------------ --}}
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title alert alert-dark btn-dark">
                        <h2><i class="fa fa-arrows fa-lg"></i> List of Request Leave</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <a href="#" class="btn bnt-dark btn-round"> </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content ">


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