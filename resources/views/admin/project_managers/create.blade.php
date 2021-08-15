
  <!-- Modal -->
  <div class="modal fade" id="project_manager" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top " style="width:50%" role="document">
      <div class="modal-content">
        <div class="modal-header" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="exampleModalLongTitle" id="exampleModalLongTitle" > Assign <label for="" style="color:red" id="project_name_text"></label> To Project Manager</h5>
        </div>
        <div class="modal-body">
            <form action="{{route('project_manager.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                        <div class="col-sm-12">
                        <label for="">Project Name</label>
                        <input type="hidden" name="project_id" id="project_id" value=" ">
                        <input type="text" name="project_name" id="project_name" class="form-control" readonly>
                        </div>
                </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                        <label for="">Project Manager</label>
                         <select name="user_id" id="user_id" class="form-control">
                         @foreach($employees as $employee)
                         <?php $users = App\ProjectManager::where('user_id', $employee->id)->first() ?>
                         @if($users)
                       
                         @else
                         <option value="{{$employee->id}}">{{$employee->first_name .' '. $employee->last_name}}</option>
                         @endif
                         @endforeach
                         </select>
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