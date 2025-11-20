<?php
     session_start();
     error_reporting(0);
     $_SESSION['logged-in'] = false;
     include("dbconnection.php");
     if(isset($_POST['login']))
     {
     //echo "test1";
      $ret=mysqli_query($con,"SELECT * FROM tbluser WHERE email='".$_POST['email']."' and password='".$_POST['password']."'");
      $num=mysqli_fetch_array($ret);
      
      $ret1=mysqli_query($con,"SELECT * FROM tblrequester WHERE email='".$_POST['email']."' and password='".$_POST['password']."'");
      $num1=mysqli_fetch_array($ret1);
      
      //echo "<br>num=".$ret->num_rows."<br>";
      $rec=$ret->num_rows;
       $rec1=$ret1->num_rows;
      //die();
      if(($rec > 0) ||( $rec1> 0))
      {
        $_SESSION['logged-in'] = true;

     // echo "tet2";
        if($rec>0)
        {
             $_SESSION['usertype']='ticketsolver';
         //$_SESSION['login']=$_POST['email'];
             $_SESSION['id']=$num['id'];
             $_SESSION['name']=$num['name'];
               //
             $_SESSION['role']=$num['role'];

             $role= $num['role'];
     //
             $val3 =date("Y/m/d");
             date_default_timezone_set("Asia/Calcutta");
             $time=date("h:i:sa");
             $tim = $time;

             $_SESSION['user'] = $num['name'];
             if ($role=='admin')
             {
              $extra="dashboard.php";
              }
              else if ($role=='member')
              {
               $extra="dashboardmember.php";
               }
        }
        if($rec1>0)
        {
         $_SESSION['usertype']='ticketcreater';
         $_SESSION['id']=$num1['id'];
         $_SESSION['name']=$num1['name'];
         $_SESSION['user'] = $num1['name'];
         $extra="dashboardmember.php";
        }
        echo "<script>window.location.href='".$extra."'</script>";
        exit();
       }
       else
       {
        $_SESSION['action1']="Invalid username or password";
        $extra="login.php";

        echo "<script>window.location.href='".$extra."'</script>";
       exit();
      }
  }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>CRM | Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
   <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css1/style.css">

</head>
<body class="error-body no-top">

<div class="main">

        <section class="signup">

            <div class="container">
                <div class="signup-content">


                    <form id="login-form" name="login-form"  action="" method="post">

                        <h2 class="form-title">Sign In</h2>
                                      <p style="color:#F00"><?php echo $_SESSION['action1'];?><?php echo $_SESSION['action1']="";?></p>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email"  required="true" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password" required="true" />

                        </div>

                        <div class="form-group">

                            <input type="submit" name="login" id="login" class="form-submit" value="Sign In"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        create an new account ? <a href="registration.php" class="loginhere-link">Sign Up</a>
                    </p>
                </div>
            </div>
        </section>

    </div>




</body>
</html>
