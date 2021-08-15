
  <!-- Modal -->
  <div class="modal fade" id="Salary" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " style="50%" role="document">
      <div class="modal-content">
        <div class="modal-header" >
          <h3 class="modal-title" id="exampleModalLongTitle" id="exampleModalLongTitle" style="">Assign Employee Salary</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('salary.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_content ">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <select type="text" name="salary" class="form-control" id="salary">
                                <option value="" selected disabled>Select Salary</option>
                                @foreach($users as $user)
                                    <option>{{$user -> first_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <input type="text" name="salary_amount" class="form-control" placeholder="Enter Salary Amount">
                        </div>
                </div>
            </div>
            </div>
       
          <div class="clearfix"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-dark">Register Employee</button>
        </div>
    </form>
      </div>
    </div>
    </div>
  </div>


<script>
$('')  
</script>    