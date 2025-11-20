<?php
  include './header.php';
 
  require_once './src/user.php';

  $err = '';
  $msg = '';

  if(isset($_POST['submit']))
  {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_pass = $_POST['confirm-password'];

   if($password != $confirm_pass)
    {
       $err = "password doesnot match";
   }
   else
   {

    try {
    //echo "<br>1".$err."<br>";

        $user = new User([

            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
            'role' => 'member'
        ]);

        $user->save();
           //echo "<br>2".$err."<br>";
        $msg = "User Created successfully";

    } catch (Exception $e) {
      // echo "<br>3".$err."<br>";
       $err = "Unable to create user";
    }

    
}
}

 ?>
<div id="content-wrapper">

    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>

        </ol>

        <div class="card mb-3">

            <div class="card-body">
               
              <?php if(strlen($err) > 1) :?>
                <div class="alert alert-danger text-center my-3" role="alert"> <strong>Failed! </strong> <?php echo $err;?></div>
                <?php endif?>

                <?php if(strlen($msg) > 1) :?>
                <div class="alert alert-success text-center my-3" role="alert"> <strong>Success! </strong> <?php echo $msg;?></div>
                <?php endif?>

                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
                    <div class="form-group row col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12">
                        <label for="name" class="col-sm-12 col-lg-2 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="" placeholder="Enter name" required="true">
                        </div>
                    </div>
                    <div class="form-group row col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12">
                        <label for="email" class="col-sm-12 col-lg-2 col-md-2 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="" placeholder="Enter email" required="true">
                        </div>
                    </div>
                    <div class="form-group row col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12">
                        <label for="email" class="col-sm-12 col-lg-2 col-md-2 col-form-label">Phone</label>
                        <div class="col-sm-8">
                            <input type="text" name="phone" class="form-control" id="" pattern="[0-9]{10}" title="10 numeric characters only" required="true" placeholder="Enter phone number">
                        </div>
                    </div>
                 
                   
                 
                    <div class="form-group row col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12">
                        <label for="email" class="col-sm-12 col-lg-2 col-md-2 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="password" class="form-control" id="" placeholder="Enter password" required="true">
                        </div>
                    </div>
                    <div class="form-group row col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12">
                        <label for="email" class="col-sm-12 col-lg-2 col-md-2 col-form-label">Confirm Password </label>
                        <div class="col-sm-8">
                            <input type="password" name="confirm-password" class="form-control" id="" placeholder="Enter confirm password" required="true">
                        </div>
                    </div>
                 
                 
                   
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-lg btn-primary"> Create</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <!-- Sticky Footer -->
    <footer class="sticky-footer">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
            <span>Copyright &copy; CRM</span>
            </div>
        </div>
    </footer>

</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="js/demo/datatables-demo.js"></script>
<script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
