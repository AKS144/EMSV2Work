
@extends('admin.layout.master')

@section('content')
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
  @include('admin.salary.create')

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Salary Management</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('employee')}}">Employee</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
              
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title alert alert-dark btn-dark">
                <h2>Salary <small>List</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a class="btn btn-round btn-sm btn-dark " href="#" data-toggle="modal" data-target="#Salary"><i class="fa fa-plus"></i> Assign Salary</a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <table id="example" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Employe Name</th>
                        <th>Salary Amount</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salaries as $salary)
                        <tr>
                            <td>{{$salary ->users->username }}</td>
                            <td>{{$salary->salary_amount}}</td>
                            <td>
                                <form action="{{route('salary.delete',$salary->id)}}" method="put">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{route('salary.edit',$salary->id)}}" class="btn btn-sm btn-dark"><i class="fa fa-edit"></i> Edit</a>
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
 
              </div>
            </div>
          </div>


                            </div>
                        </div>
                    </div>
                </div>

@endsection
