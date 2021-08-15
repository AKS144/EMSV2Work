

 
  <!-- Modal -->
  <div class="modal fade" id="team_member" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top " style="width:50%" role="document">
      <div class="modal-content">
        <div class="modal-header" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="exampleModalLongTitle" id="exampleModalLongTitle" >Assign Member To <label for="" class="btn btn-dark btn-round" id="team_name_text"></label></h5>
        </div>
        <div class="modal-body">
            <form action="{{route('team_member.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="panel-body">
                @csrf
                <div class="form-group">
                        <div class="col-sm-12">
                        <label for="">Team Name</label>
                        <input type="hidden" name="team_id" id="team_id" value=" ">
                        <input type="text" name="team_name" id="team_name" class="form-control" readonly>
                        </div>
                </div>
               
                <div class="form-group">
                        <div class="col-sm-12">
                        <label for="">Employee Name</label>
                        <select name="employee_id" id="employee_name" class="form-control">
                        @foreach($employees_assign as $employee)
                        <?php $team_member = App\TeamMember::join('teams', 'teams.id', '=', 'team_members.team_id')->where('employee_id', $employee->id)->first() ?>

                        @if($team_member)
                       <!-- <option value="" selected="true" disabled="true">All the Employees are currently busy! Please try and contact the Admin</option> -->
                       <option selected="true" disabled="true" value="{{$employee->id}}">{{$employee->first_name . ' ' . $employee->last_name}} ------ [ {{$team_member->team_name}} ] </option>
                        @else
                        <option value="{{$employee->id}}">{{$employee->first_name . ' ' . $employee->last_name}}</option>
                        @endif
                        @endforeach
                        </select>
                        </div>
                </div>

                <div class="form-group">
                        <div class="col-sm-12">
                        <label for="">Role</label>
                        <select name="role_id" id="role" class="form-control">
                        @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                        </select>
                        </div>
                </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-dark">Create Project</button>
        </div>
    </form>
      </div>
    </div>
    </div>