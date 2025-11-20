<?php

     session_start();
     error_reporting(0);
     
     if(!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] == false)
      {
         $extra="index.php";
         echo "<script>window.location.href='".$extra."'</script>";
        exit();
      }
     include("dbconnection.php");

     include './header.php';
     require_once './src/ticket.php';
     require_once './src/requester.php';
     require_once './src/team.php';

      $usertype=$_SESSION['usertype'] ;
      $_SESSION['uid']= $_SESSION['id'];
      $id=$_SESSION['uid'];

      if($usertype=='ticketsolver')
      {
          $ret=mysqli_query($con,"SELECT id FROM tblteam_member WHERE user=$id");

          $num=mysqli_fetch_array($ret);
          if($num>0)
          {
           $tid=$num['id'];
         }
        $tickets = Ticket::findByMember($tid);
      }
      else if ($usertype=='ticketcreater')
      {

        //$sql="SELECT * FROM tblticket WHERE requester='$id' and deleted_at IS NULL";
           $ret1=mysqli_query($con,"SELECT * FROM tblticket WHERE requester='$id' and deleted_at IS NULL");
          //echo "<br>sql=".$sql."<br>";
      }

?>
<div id="content-wrapper">

    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">My tickets</li>
        </ol>
        <div class="card mb-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <?php if($usertype=='ticketsolver'): ?>

                                 <th>Subject</th>
                                 <th>Requester</th>
                                 <th>Team</th>
                                  <th>Status</th>
                                 <th>Created At</th>
                                  <th>Action</th>
                                <?php endif; ?>
                                
                                 <?php if($usertype=='ticketcreater') : ?>

                                 <th>Subject</th>
                                 <th>Ticket Description</th>
                                 <th>Status</th>
                                 <th>Created At</th>
                                 <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if($usertype=='ticketsolver') : ?>
                            <?php foreach ($tickets as $ticket) : ?>
                                <tr>
                                    <td><a href="./ticket-details-member.php?id=<?php echo $ticket->id ?>"><?php echo $ticket->title ?></a>
                                    </td>
                                    <td><?php echo Requester::find($ticket->requester)->name ?></td>
                                    <td><?php echo Team::find($ticket->team)->name; ?></td>
                                    <?php $usr =  $ticket->team_member ?>
                                    <?php if ($usr == '') : ?>
                                        <td><?php echo $usr ?></td>
                                    <?php endif; ?>
                                    <?php if ($ticket->status == 'completed') : ?>
                                        <td>
                                            <button class="btn btn-success"><?php echo $ticket->status ?></button>
                                        </td>

                                    <?php else : ?>
                                        <td>
                                            <button class="btn btn-warning"><?php echo $ticket->status ?></button>
                                        </td>
                                    <?php endif; ?>
                                    <?php $date = new DateTime($ticket->created_at) ?>
                                    <td><?php echo $date->format('d-m-Y H:i:s') ?> </td>
                                    <td width="100px">
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="dropdown-item" href="./ticket-details-member.php?id=<?php echo $ticket->id ?>">View</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            
                            <?php endif; ?>

                            <?php if($usertype=='ticketcreater') : ?>

                                  <?php  while($numt = $ret1->fetch_assoc()){  ?>
                                  <tr>
                                    <td><?php echo $numt['title']; ?></a></td>
                                     <td><?php echo $numt['body']; ?></a></td>
                                    <?php if ($numt['status'] == 'completed') : ?>
                                        <td>
                                            <button class="btn btn-success"><?php echo $numt['status']; ?></button>
                                        </td>

                                    <?php else : ?>
                                        <td>
                                            <button class="btn btn-warning"><?php echo $numt['status']; ?></button>
                                        </td>
                                    <?php endif; ?>
                                    <?php $date = new DateTime($numt['created_at']); ?>
                                    <td><?php echo $date->format('d-m-Y H:i:s') ?> </td>
                                 </tr>
                                 <?php }  ?>
                            <?php endif; ?>

                            
                        </tbody>
                    </table>
                </div>
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
