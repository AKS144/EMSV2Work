<style>
/* ---------- NAVEGAÇÃO ABAS ---------- */

.tabs {
    display: flex;
    flex-wrap: wrap;
    max-width: 960px;
    margin: 0 auto;
    padding: 60px 0;
}

.tabs>label {
    order: 1;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    width: 120px;
    height: 50px;
    margin-right: 0.2rem;
    /* font-size: 1rem; */
    cursor: pointer;
    border-radius: 3px 3px 0 0;
    /* background: bisque; */
    font-weight: bold;
    transition: background ease-in-out 0.2s;
}

.tabs>label>img {
    width: 30px;
    max-width: 100%;
}

.tabs .tab {
    order: 99;
    flex-grow: 1;
    width: 100%;
    display: none;
    padding: 1rem;
    /* background: #c4c4c4; */
    border-radius: 3px;
}

.tabs input[type="radio"] {
    display: none;
}

.tabs input[type="radio"]:checked+label {
    background: #2A3F54;
    color: #ffff;
}

.tabs input[type="radio"]:checked+label+.tab {
    display: block;
}


.team_id {
    width: 50px;
    height: 30px;
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.33;
    border-radius: 25px;
}

/* CASO QUEIRA DEIXAR RESPONSIVO*/
@media (max-width: 739px) {

    /*.tabs .tab, .tabs label {
    order: initial;
  }*/
    .tab-1,
    .tab-2,
    .tab-3 {
        /*width: 100%;
    margin-right: 0;
    margin-top: 0.2rem;*/
        flex-direction: column;
        width: 80px;
        height: 80px;
    }
}

/*------------ Formulário ------------*/

/* Ajeitar input de passageiros/pessoas/quartos, colocar responsivo e com grid, botar ícones dentro de placeholder */

.form-label {
    /* margin-top: 10px;
  margin-bottom: 5px; */
}

.form-input {
    padding: 10px 15px;
    margin: 0 20px 10px 5px;
    border-radius: 3px;
    /* font-family: Lato, 'Segoe UI', Tahoma, Verdana, sans-serif; */
    color: #7D7575;
    border: none;
}

input[type="text"] {
    padding: 12px;
}

.form-btn {
    background-color: dodgerblue;
    border-radius: 3px;
    width: 200px;
    padding: 12px;
    text-transform: uppercase;
    color: #fff;
    border: none;
    cursor: pointer;
}
</style>


<!-- Modal -->
<div class="modal fade" id="task" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-top " style="width:50%" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle" id="exampleModalLongTitle">Create New Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('task.store')}}" method="post" class="form-horizontal"
                    enctype="multipart/form-data" autocomplete="off">
                    <div class="panel-body">
                        @csrf

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="">Project Name</label>
                                <select name="project_id" id="project_id" class="form-control">
                                    @foreach($projects as $project)
                                    <option value="{{$project->id}}">{{$project->project_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="">Task Name</label>
                                <input type="text" name="task_name" class="form-control" id="task_name"
                                    placeholder="Enter Task Name" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <select id="priority-filter" class="form-control" name="priority">
                                    <option>Low</option>
                                    <option>Medium</option>
                                    <option>High</option>
                                    <option>Urgent</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="">Planned Budget</label>
                                <input type="number" name="planned_budget" class="form-control" id="planned_budget"
                                    placeholder="Enter Planned Project Budget">
                            </div>

                            <div class="col-sm-6">
                                <label for="">Actual Budget</label>
                                <input type="number" name="actual_budget" class="form-control" id="actual_budget"
                                    placeholder="Enter Actual Project Budget">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="">Planned Start Date</label>
                                <input type="text" name="planned_start_date" class="form-control"
                                    id="planned_start_date" placeholder="Enter Project Name">
                            </div>

                            <div class="col-sm-6">
                                <label for="">Planned End Date</label>
                                <input type="text" name="planned_end_date" class="form-control" id="planned_end_date"
                                    placeholder="Enter Project Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="">Actual Start Date</label>
                                <input type="text" name="actual_start_date" class="form-control" id="actual_start_date"
                                    placeholder="Enter Project Name">
                            </div>

                            <div class="col-sm-6">
                                <label for="">Actual End Date</label>
                                <input type="text" name="actual_end_date" class="form-control" id="actual_end_date"
                                    placeholder="Enter Project Name" autocomplet="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="">Project Description</label>
                                <textarea name="description" id="task_description" cols="10" rows="3"
                                    class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <select id="status-filter" class="form-control" name="status">
                                    <option>Not Started</option>
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark">Create Task</button>
            </div>
            </form>
        </div>
    </div>
</div>



<!-- Add ACTIVITY -->

<!-- Modal -->
<div class="modal fade" id="activity" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-top " style="width:60%" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLongTitle" id="exampleModalLongTitle">Create New Activity for
                    <label for="" id="task_name_text"></label>
                </h5>
            </div>
            <div class="modal-body">
                <form action="{{route('task.store')}}" method="post" class="form-horizontal"
                    enctype="multipart/form-data" autocomplete="off">
                    <div class="panel-body">
                        @csrf

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="">Activity Name</label>
                                <input type="text" name="activity_name" class="form-control" id="activity_name"
                                    placeholder="Enter Activity Name" autocomplete="off">
                            </div>
                        </div>
                        <input type="text" name="task_id" id="">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <select id="priority-filter" class="form-control" name="priority">
                                    <option>Low</option>
                                    <option>Medium</option>
                                    <option>High</option>
                                    <option>Urgent</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="">Planned Budget</label>
                                <input type="number" name="planned_budget" class="form-control" id="planned_budget"
                                    placeholder="Enter Planned Project Budget">
                            </div>

                            <div class="col-sm-6">
                                <label for="">Actual Budget</label>
                                <input type="number" name="actual_budget" class="form-control" id="actual_budget"
                                    placeholder="Enter Actual Project Budget">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="">Planned Start Date</label>
                                <input type="text" name="planned_start_date" class="form-control"
                                    id="planned_start_date" placeholder="Enter Project Name">
                            </div>

                            <div class="col-sm-6">
                                <label for="">Planned End Date</label>
                                <input type="text" name="planned_end_date" class="form-control" id="planned_end_date"
                                    placeholder="Enter Project Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="">Actual Start Date</label>
                                <input type="text" name="actual_start_date" class="form-control" id="actual_start_date"
                                    placeholder="Enter Project Name">
                            </div>

                            <div class="col-sm-6">
                                <label for="">Actual End Date</label>
                                <input type="text" name="actual_end_date" class="form-control" id="actual_end_date"
                                    placeholder="Enter Project Name" autocomplet="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="">Project Description</label>
                                <textarea name="description" id="task_description" cols="10" rows="3"
                                    class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <select id="status-filter" class="form-control" name="status">
                                    <option>Not Started</option>
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark">Create Task</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- AASSIGN TASK ACTIVITY TO A TEAM OR USER -->

<!-- Modal -->
<div class="modal fade" id="assign-team" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-top " style="width:100%" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLongTitle" id="exampleModalLongTitle">Create New Activity for
                    <label for="" id="task_name_text"></label>
                </h5>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('assigned.store')}}" method="post" enctype="multipart/form-data"
                    autocomplete="off">
                    <div class="panel-body">
                        @csrf

                        <nav class="nav-abas">
                            <div class="tabs">
                                <input type="radio" name="tabs" id="tab-1" checked="checked">
                                <label for="tab-1">
                                    <i class="fa fa-users fa-lg"></i>
                                    <span>Teams</span>
                                </label>
                                <div class="tab">

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title alert alert-dark btn-dark">
                                                <h2><i class="fa fa-group fa-sm"></i> Team </h2>
                                                <div class="clearfix"></div>
                                            </div>
                                            <!-- <div class="x_content "> -->
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="table-responsive">
                                                    <table id="zero_config" class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Team Name</th>
                                                                <th>Members</th>
                                                                <th>Operation</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($team_member_users as $member)
                                                            <tr>
                                                                <td>{{$member->team_name}}</td>
                                                                <td style="text-align:center"><a
                                                                        href="{{route('team_member.show',$member->id)}}"
                                                                        data-toggle="tooltip" data-placement="right"
                                                                        title="See Members"
                                                                        class="btn btn-round btn-success">{{$member->total}}</a>
                                                                </td>
                                                                <td>
                                                                    <label for=""></label>
                                                                    <button class="form-btn"
                                                                        data-team-id="{{$member->id}}"
                                                                        data-team-name="{{$member->team_name}}"
                                                                        data-toggle="modal"
                                                                        data-target="#assigned-option" name="">Assign
                                                                        Team</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        @endforeach
                                                    </table>
                                                    {{ $team_member_users->links() }}
                                                </div>
                                            </div>
                                            <!-- </div> -->
                                        </div>
                                    </div>
                </form>
            </div>


            <div class="modal fade" id="assigned-option" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-top " style="width:50%" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle" id="exampleModalLongTitle">Create New
                                Task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" name="team_id" id="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark">Assign</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <input type="radio" name="tabs" id="tab-2">
            <label for="tab-2">
                <i class="fa fa-user fa-lg"></i>
                <span>Individual </span>
            </label>

            <div class="tab">

                <div class="x_panel">
                    <div class="x_title alert alert-dark btn-dark">
                        <h2><i class="fa fa-user fa-sm"></i> User </h2>
                        <ul class="nav navbar-right panel_toolbox">
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for=""> Select User</label>
                        <Select name="" class="form-control">
                            <option value="" selected>--------</option>
                            @foreach($team_members as $members)
                            <option value="{{$members->user_id}}">
                                {{$members->first_name .' '. $members->last_name }}</option>
                            @endforeach
                        </Select>
                    </div>
                    <button class="form-btn" type="submit" name="">Assign User</button>
                    </form>
                </div>

            </div>
            </nav>
            <input type="hidden" name="task_id" id="">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-dark">Assign</button>
    </div>
    </form>
</div>
</div>
</div>