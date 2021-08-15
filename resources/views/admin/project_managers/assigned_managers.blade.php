@extends('admin.layout.master')

@section('content')



<?php $manager = $projectManager->where('project_id', request('id'))->first() ?>
          <div class="">
            <div class="page-title">
            @can('isAdmin')
              <div class="title_left">
             @if($manager)
                <h3><b class="btn btn-round btn-dark"> {{$manager->project_name}} </b> - Project Manager</h3>
              @else
              <h3><b class="btn btn-round btn-dark"> {{$projectM->project_name}} </b> - Project Manager</h3>
              @endif
              </div>
             @endcan
             @can('isEmployee')
             <div class="title_left">
             <h3> Project Manager</h3>
             </div>
             @endcan
              <div class="title_right">
                <div class="col-md-2 col-sm-12 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                   <a href="{{url()->previous()}}" class="btn btn-dark btn-round"> <i class="fa fa-arrow-left"></i> Return</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                      </div>

                      <div class="clearfix"></div>
                      @foreach($projectManager as $member)
                      <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i>{{$member->name }}</i></h4>
                            <div class="left col-xs-7">
                              <h2>{{$member->first_name .' '. $member->last_name}}</h2>
                              <p><strong>About: </strong> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                              <ul class="list-unstyled">
                                <li><i class="fa fa-building"></i> Address: {{$member->address}} </li>
                                <li><i class="fa fa-phone"></i> Phone #: {{$member->phone}} </li>
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                            @if($member->image != '')
                              <img src="{{asset('uploads/gallery/' .$member->image)}}" alt="" class="img-circle img-responsive">
                            @else
                            <img src="{{asset('uploads/gallery/no-image.jpg' )}}" alt="" class="img-circle img-responsive">
                            @endif
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <p class="ratings">
                                <a>4.0</a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star-o"></span></a>
                              </p>
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <button type="button" class="btn btn-success btn-xs"> <i class="fa fa-user">
                                </i> <i class="fa fa-comments-o"></i> </button>
                              <a href="{{route('user.profile', $member->user_id)}}"><button type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-user"> </i> View Profile
                              </button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                   

                      <div class="col-md-12 col-sm-12  ">
                            <div class="x_panel ">
                                <div class="x_title btn-dark">
                                    <h2>Projects</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <div class="table-responsive">
                                        <table class="table table-striped jambo_table bulk_action">
                                            <thead>
                                                <tr class="headings">
                                                    <th>
                                                        <input type="checkbox" id="check-all" class="flat">
                                                    </th>
                                                    <th class="column-title">Project Name </th>
                                                    <th class="column-title">Planned End </th>
                                                    <th class="column-title">Planned End </th>
                                                    <th class="column-title">Actual Start </th>
                                                    <th class="column-title">Actual End </th>
                                                    <th class="column-title">Description </th>
                                                    <th class="column-title no-link last"><span
                                                            class="nobr">Action</span>
                                                    </th>
                                                    <th class="bulk-actions" colspan="7">
                                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk
                                                            Actions ( <span class="action-cnt"> </span> ) <i
                                                                class="fa fa-chevron-down"></i></a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="even pointer">
                                                    <td class="a-center ">
                                                        <input type="checkbox" class="flat" name="table_records">
                                                    </td>
                                                    <td class=" ">{{$member->project_name}}</td>
                                                    <td class=" ">{{$member->planned_start_date}}</td>
                                                    <td class=" ">{{$member->planned_end_date}} <i class="success fa fa-long-arrow-up"></i>
                                                    </td>
                                                    <td class=" ">{{$member->actual_start_date}}</td>
                                                    <td class=" ">{{$member->actual_start_date}}</td>
                                                    <td class="a-right a-right ">{{$member->project_description}}</td>
                                                    <td class=" last"><a href="#" class=""><i class="fa fa-check"></i>approval</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- </div> -->
        <!-- /page content -->






@endsection


