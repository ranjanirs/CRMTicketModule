<?php
     session_start();
      $_SESSION['logged-in']=false;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Ticket Management</title>


        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <div class="container px-4 ">
                <a class="navbar-brand" href="#page-top">Ticket Management</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="registration.php">Sign Up</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Sign In</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-primary bg-gradient text-white">
            <div class="container px-4 text-center ">
                 <div style="margin-top:50px;">
                 </div>
                <h1 class="fw-bolder">CRM - Ticket Management</h1> <br>
                <p class="lead"></p>
                <a class="btn btn-lg btn-light" href="registration.php">Sign Up</a>
                 <div style="margin-top:70px;">
                 </div>
            </div>
        </header>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container px-4"><p class="m-0 text-center text-white">Copyright &copy; CRM 2025</p></div>
        </footer>

    </body>
</html>
