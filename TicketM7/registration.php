<?php

     session_start();
     $_SESSION['logged-in']=false;

    include("dbconnection.php");
    if(isset($_POST['submit']))
    {
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$mobile=$_POST['phone'];
	$gender=$_POST['gender'];
	$query=mysqli_query($con,"select email from tblrequester where email='$email'");
	$num=mysqli_fetch_array($query);
	if($num>1)
	{
          echo "<script>alert('Email-id already register with us. Please try with diffrent email id.');</script>";
          echo "<script>window.location.href='registration.php'</script>";
	}
	else
	{
        mysqli_query($con,"insert into tblrequester(name,email,password,phone,gender) values('$name','$email','$password','$mobile','$gender')");
        echo "<script>alert('Successfully register with us. Now you can login');</script>";
        echo "<script>window.location.href='login.php'</script>";
}
	}


?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>CRM | Registration</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />



      <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- Main css -->
    <link rel="stylesheet" href="css1/style.css">

<script type="text/javascript">

        function checkpass()
        {
         if(document.signup.password.value!=document.signup.cpassword.value)
         {
           alert('New Password and Re-Password field does not match');
           document.signup.cpassword.focus();
           return false;
         }
         return true;
        }

</script>

</head>
<body>
<div class="main">

        <section class="signup">

            <div class="container">
                <div class="signup-content">

                    <form id="signup" name="signup" class="signup-form" onsubmit="return checkpass();" method="post">
                        <h2 class="form-title">Create account</h2>
                        <div class="form-group">

                            <input type="text" class="form-input" name="name" id="name" placeholder="Your Name" required="true"  />
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email"  required="true" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password" required="true" />

                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="cpassword" id="cpassword" placeholder="Repeat your password" required="true"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="phone" id="phone" placeholder="Mobile Number" pattern="[0-9]{10}" title="10 numeric characters only" required="true" />
                        </div>

                         <div class="form-group">
                              <label class="form-label">Gender</label>
                              <input type="radio" value="m" name="gender" checked > Male
                                     <input type="radio" value="f" name="gender" > Female
                                </div>

                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="login.php" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>



</body>
</html>
