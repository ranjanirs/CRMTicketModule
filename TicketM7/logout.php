<?php
     session_start();
      $_SESSION['logged-in']=false;
      $_SESSION['role']="";
      $_SESSION['user']="";
      $_SESSION['usertype']="";
      $_SESSION['id']="";
     session_destroy();
     header('Location: ./index.php');
     exit();

?>
