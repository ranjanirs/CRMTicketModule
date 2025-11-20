<?php
include './header.php';
if (!isset($_GET['id']) || strlen($_GET['id']) < 1 || !ctype_digit($_GET['id'])) {
    echo '<script> history.back()</script>';
    exit();
}

require_once './src/requester.php';
require_once './src/team.php';
require_once './src/ticket.php';


$err = '';
$msg = '';
$ticket = Ticket::find($_GET['id']);
$teams = Team::findAll();


 $id = $_GET['id'];
if (isset($_POST['submit'])) {

    $team = $_POST["team_member"];
     $team1 = $_POST["selteam"];
    $id = $_GET['id'];
    
    try {

        $ticket = new Ticket([

            'team_member' => $team,
            'title' => $ticket->title,
            'body' => $ticket->body,
            'requester' => $ticket->requester,
            'team' => $team1,
            'status' => $ticket->status,
        ]);

        $updateTicket = $ticket->update($id);
        $msg = "Ticket assigned successfully";

    } catch (Exception $e) {

        $err = "Failed to assigned ticket";

    }
}



?>
<div id="content-wrapper">

    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Ticket details</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <div class="row mx-auto">
                    <div>
                        <?php echo $ticket->displayStatusBadge()?>
                        <small class="text-info ml-2"><?php echo $ticket->title?> <span class="text-muted">
                                <?php $date = new DateTime($ticket->created_at ?? '' );?>
                                <?php echo $date->format('d-m-Y H:i:s')?>
                            </span></small>
                    </div>
                  
                </div>

            </div>
            <div class="card-body">
                <form method="post">
                    <div class="col-lg-8 col-md-8 col-sm-12 offset-lg-2 offset-md-2">
                    <?php if(strlen($err) > 1) :?>
                <div class="alert alert-danger text-center my-3" role="alert"> <strong>Failed! </strong> <?php echo $err;?></div>
                <?php endif?>

                <?php if(strlen($msg) > 1) :?>
                <div class="alert alert-success text-center my-3" role="alert"> <strong>Success! </strong> <?php echo $msg;?></div>
                <?php endif?>
                        <div class="form-group row">
                            <label for="team" class="col-sm-3 col-form-label">Team</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="selteam" id="team-dropdown"
                                    onchange="getTeamMember(event.target.value)">
                                    <option>--select--</option>
                                    <?php foreach($teams as $team):?>
                                    <option <?php echo $team->id == $ticket->team ? 'selected' : null?> value="<?php echo $team->id?>"><?php echo $team->name?></option>
                                    <?php endforeach?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="assigned" class="col-sm-3 col-form-label">Assigned</label>
                            <div class="col-sm-8">
                                <select class="form-control"  name="team_member" id="team-member-dropdown">
                                    <option>--select--</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit" name="submit" >Assign</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
    
    <div class="form-group row col-lg-8 offset-lg-2 col-md-8 col-sm-12 offset-md-2"style="margin-top:60px">

        <form id="formData" class="grid-form"  enctype="multipart/form-data" method="POST">
                            <label for="team"   style="margin-left:180px">Change Ticket Status</label>
                            <div class="col-sm-8">

                            <input type="hidden" autofocus name="id" value="<?php echo  $id//$ticket->id ?>">
                                <select class="form-control" id="status" name="status" style="margin-left:170px">

                                    <option >--select--</option>

                                    <option value="pending">pending</option>
                                    <option value="inprogress">inprogress</option>
                                    <option value="completed">completed</option>
                                    <option value="onhold">onhold</option>

                                </select>
                            </div>
                            <button type="submit" name="submit" class="btn btn-success" style="margin-top:10px;margin-left:185px">change</button>
                            </form>

                        </div>
                        <div id="msg">
                    </div>
        </div>

    <footer class="sticky-footer">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
            <span>Copyright &copy; CRM </span>
            </div>
        </div>
    </footer>

</div>


 <script src="vendor/jquery/jquery.min.js"></script>
<script src="js/main.js"></script>
<script>

jQuery('#formData').submit(function (e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    jQuery('#msg').html(
        '<div class="flakes-message success" style="text-align:center"><strong>Processing...</strong></div>'
        );

    jQuery.ajax({
        url: './src/update-ticket.php',
        type: 'post',
        dataType: 'text',
        data: formData,
        contentType: false,
        processData: false,
        success: function (res) {
            let result = JSON.parse(res)
            if (result.status == 200) {

                jQuery('#msg').html(
                    '<div class="btn btn-success" style="text-align:center"><strong><span class="fa fa-check"></span> Success!</strong>' +
                    result.msg + '</div>');
                jQuery('#formEvents').trigger("reset");
            } else {

                jQuery('#msg').html(
                    '<div class="btn btn-danger" style="text-align:center"><strong><span class="fa fa-times"></span> Failed!</strong>' +
                    result.msg + '</div>');

            }

        }
    });
});

</script>
