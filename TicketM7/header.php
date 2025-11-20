<?php 
      session_start();

      if(!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] == false)
      {
         $extra="index.php";
         echo "<script>window.location.href='".$extra."'</script>";
        exit();
      }
      $user = $_SESSION['user'];
      $role = $_SESSION['role'];
      $usertype=$_SESSION['usertype'];
      require_once './src/Database.php';
      $db = Database::getInstance();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CRM - Dashboard</title>


   <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <!--<link href="fonts/symbols.css" rel="stylesheet" type="text/css"> -->
  
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

 <?php //echo "<br>".$role."<br>";die(); ?>
 
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
  <?php if($usertype== 'ticketsolver'): ?>
      <?php if($role == 'admin'): ?>
            <a class="navbar-brand mr-1" href="dashboard.php">CRM</a>
      <?php endif; ?>

       <?php if($role == 'member'): ?>
            <a class="navbar-brand mr-1" href="dashboardmember.php">CRM</a>
      <?php endif; ?>
<?php endif; ?>
<?php if($usertype== 'ticketcreater'): ?>
      <a class="navbar-brand mr-1" href="dashboardmember.php">CRM</a>
      <?php endif; ?>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>


    <ul class="navbar-nav ml-auto mr-md-0">
      
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i> <?php echo $user; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          
          <a class="dropdown-item" href="./logout.php" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    
    <ul class="sidebar navbar-nav">
    <?php if($usertype== 'ticketsolver'): ?>
      <?php if($role == 'admin'): ?>
      <li class="nav-item active">
        <a class="nav-link" href="./dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span> Dashboard</span>
        </a>
      </li>
       <?php endif; ?>
        <?php endif; ?>

        <?php if($usertype == 'ticketcreater'): ?>
          <li class="nav-item active">
        <a class="nav-link" href="./dashboardmember.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span> Dashboard</span>
        </a>
      </li>
       <?php endif; ?>
       
        <?php if($usertype== 'ticketcreater'): ?>
      <li class="nav-item active">
        <a class="nav-link" href="Newticket.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span> Create Ticket</span>
        </a>
      </li>
       <?php endif; ?>
       
      <li class="nav-item active">
    <?php if($usertype== 'ticketsolver'): ?>
       <?php if($role == 'admin'): ?>
        <a class="nav-link" href="./mytickets.php">
        <?php endif; ?>
          <?php if($role == 'member'): ?>
        <a class="nav-link" href="./dashboardmember.php">
        <?php endif; ?>
          <i class="fa fa-fw fa-award"></i>
          <span> My tickets</span>
        </a>
      </li>
       <?php //endif; ?>
      <!-- to check -->
     <?php if($role == 'admin'): ?>
      <li class="nav-item active">
        <a class="nav-link" href="./team.php">
          <i class="fa fa-fw fa-users"></i>
          <span> Teams</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./users.php">
          <i class="fa fa-fw fa-users"></i>
          <span> Users</span>
        </a>
      </li>
      <?php endif; ?>
   <?php endif; ?>
    </ul>
    
