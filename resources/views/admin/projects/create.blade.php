
  <!-- Modal -->
  <div class="modal fade" id="project" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top " style="width:50%" role="document">
      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="exampleModalLongTitle" id="exampleModalLongTitle">Create New Project</h5>
        </div>
        <div class="modal-body">
            <form action="{{route('project.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="panel-body">
                @csrf
                <div class="form-group">
                        <div class="col-sm-12">
                        <label for="">Project Name</label>
                        <input type="text" name="project_name" class="form-control" id="project_name" placeholder="Enter Project Name">
                        </div>
                </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                        <label for="">Planned Start Date</label>
                            <input type="text" name="planned_start_date"  class="form-control" id="planned_start_date" placeholder="Enter Project Name">
                        </div>

                        <div class="col-sm-6">
                        <label for="">Planned End Date</label>
                            <input type="text" name="planned_end_date"  class="form-control" id="planned_end_date" placeholder="Enter Project Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                        <label for="">Actual Start Date</label>
                            <input type="text" name="actual_start_date"  class="form-control" id="actual_start_date" placeholder="Enter Project Name">
                        </div>

                        <div class="col-sm-6">
                        <label for="">Actual End Date</label>
                            <input type="text" name="actual_end_date"  class="form-control" id="actual_end_date" placeholder="Enter Project Name">
                        </div>
                </div>
                <div class="form-group">
                        <div class="col-sm-12">
                        <label for="">Project Description</label>
                        <textarea name="project_description" id="project_description" cols="10" rows="3" class="form-control"></textarea>
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


     <!-- Modal -->
  <div class="modal fade" id="project_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top " style="width:50%" role="document">
      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="exampleModalLongTitle" id="exampleModalLongTitle" >Edit Project</h5>
        </div>
        <div class="modal-body">
            <form action="{{route('project.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="panel-body">
                @csrf
                <div class="form-group">
                        <div class="col-sm-12">
                        <label for="">Project Name</label>
                        <input type="text" name="project_name" class="form-control" id="project_name" placeholder="Enter Project Name">
                            <input type="hidden" name="project_id" class="form-control" id="project_id" placeholder="Enter Project Name">
                        </div>
                </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                        <label for="">Planned Start Date</label>
                            <input type="text" name="planned_start_date"  class="form-control" id="planned_start_date" placeholder="Enter Project Name">
                        </div>

                        <div class="col-sm-6">
                        <label for="">Planned End Date</label>
                            <input type="text" name="planned_end_date"  class="form-control" id="planned_end_date" placeholder="Enter Project Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                        <label for="">Actual Start Date</label>
                            <input type="text" name="actual_start_date"  class="form-control" id="actual_start_date" placeholder="Enter Project Name">
                        </div>

                        <div class="col-sm-6">
                        <label for="">Actual End Date</label>
                            <input type="text" name="actual_end_date"  class="form-control" id="actual_end_date" placeholder="Enter Project Name">
                        </div>
                </div>
                <div class="form-group">
                        <div class="col-sm-12">
                        <label for="">Project Description</label>
                        <textarea name="project_description" id="project_description" cols="10" rows="3" class="form-control"></textarea>
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