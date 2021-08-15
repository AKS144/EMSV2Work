@extends('admin.layout.master')

@section('content')



<?php $team = $team_members->where('team_id', request('id'))->first() ?>
          <div class="">
            <div class="page-title">
              <div class="title_left">
             
                <h3><b class="btn btn-round btn-dark"> {{$team->team_name}}</b> - Team Members</h3>
              
              </div>

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
                      @foreach($team_members as $member)
                      <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                          <div class="left col-xs-9">
                            <h4 class="brief"><i>{{$member->name }}</i></h4>
                            </div>
                            <!-- Remove Member Section -->
                            <div class="right col-xs-3 text-center">
                            @if($project_manager)
                            <form id="delete-form-{{ $member->member_id}}" 
                              action="{{route('team_member.destroy', $member->member_id)}}" method="post">
                              @csrf
                              @method('DELETE')
                                  <button type="button" onclick="removeMember({{ $member->member_id }})"
                                  class="btn btn-sm btn-round btn-danger">remove</button>
                              </form>
                              @endif
                            <!-- <button type="button" class="btn btn-danger btn-xs"> <i class="fa fa-remove"> -->
                               <!-- </i>remove</button> -->
                            </div>
                            <!-- End Remove Member Section -->

                            <div class="left col-xs-7">
                              <h2>{{$member->first_name .' '. $member->last_name}}</h2>
                              <p><strong>About: </strong> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                              <ul class="list-unstyled">
                                <li><i class="fa fa-building"></i> Address: {{$member->address}} </li>
                                <li><i class="fa fa-phone"></i> Phone #: <br> {{$member->phone}} </li>
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                            @if($member->image != '')
                              <img src="{{asset('uploads/gallery/' .$member->image)}}" alt="" style="border-radius:50%; height:100px; width:100px" class="img-circle img-responsive">
                            @else
                            <img src="{{asset('uploads/gallery/no-image.jpg' )}}" alt="" style="border-radius:50%; height:100px; width:100px" class="img-circle img-responsive">
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
                              <button type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-user"> </i> View Profile
                              </button>
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
          </div>
        <!-- </div> -->
        <!-- /page content -->






@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">






    function removeMember(id)

    {
        const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
        })

        swalWithBootstrapButtons({
            title: 'Are you sure?',
            text: "You want to remove this member!",
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