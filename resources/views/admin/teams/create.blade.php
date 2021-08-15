
  <!-- Modal -->
  <div class="modal fade" id="team" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top " style="width:50%" role="document">
      <div class="modal-content">
        <div class="modal-header" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="exampleModalLongTitle" id="exampleModalLongTitle" >Create New Team</h5>

        </div>
        <div class="modal-body">
            <form action="{{route('team.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="panel-body">
                @csrf
                <div class="form-group">
                        <div class="col-sm-12">
                        <label for="">Team Name</label>
                            <input type="text" name="team_name" class="form-control" id="team_name" placeholder="Enter Team Name">
                        </div>
                </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-dark">Create Team</button>
        </div>
    </form>
      </div>
    </div>
    </div>

    <!-- Team Edit -->

    
  <!-- Modal -->
  <div class="modal fade" id="team_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top " style="width:50%" role="document">
      <div class="modal-content">
        <div class="modal-header" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="exampleModalLongTitle" id="exampleModalLongTitle" >Edit Team</h5>
          
        </div>
        <div class="modal-body">
            <form  method="post" class="form-horizontal" id="editForm" enctype="multipart/form-data">
        <div class="panel-body">
                @csrf
                <div class="form-group">
                        <div class="col-sm-12">
                        <label for="">Team Name</label>
                        <input type="text" name="team_name" class="form-control" id="team_name" placeholder="Enter Team Name">
                            <input type="hidden" name="team_id" class="form-control" id="team_id" placeholder="Enter Team Name">
                        </div>
                </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-dark">Update Team</button>
        </div>
    </form>
      </div>
    </div>
    </div>

      <!-- Team Edit -->
  <!-- Modal -->
  <div class="modal fade" id="team_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top " style="width:50%" role="document">
      <div class="modal-content">
        <div class="modal-header" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="exampleModalLongTitle" id="exampleModalLongTitle" >Delete Team</h5>
          
        </div>
        <div class="modal-body">
            <form  method="post" class="form-horizontal" id="deleteForm" enctype="multipart/form-data">
        <div class="panel-body">
                @csrf
                <div class="form-group">
                        <div class="col-sm-12">
                        <label for="">Team Name</label>
                        <input type="text" name="team_name" class="form-control" id="team_name" placeholder="Enter Team Name">
                            <input type="text" name="team_id" class="form-control" id="team_id" placeholder="Enter Team Name">
                        </div>
                </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-dark">Update Team</button>
        </div>
    </form>
      </div>
    </div>
    </div>

    