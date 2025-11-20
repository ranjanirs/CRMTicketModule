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




?>
<div id="content-wrapper">


    <div class="form-group row col-lg-8 offset-lg-2 col-md-8 col-sm-12 offset-md-2"style="margin-top:60px">

        <form id="formData" class="grid-form"  enctype="multipart/form-data" method="POST">
                            <label for="team"   style="margin-left:180px">Change Ticket Status</label>
                            <div class="col-sm-8">

                            <input type="hidden" autofocus name="id" value="<?php echo $id ?>">
                                <select class="form-control" id="status" name="status" style="margin-left:170px">

                                    <option >--select--</option>

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
 <!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="./index.php">Logout</a>
            </div>
        </div>
    </div>
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
