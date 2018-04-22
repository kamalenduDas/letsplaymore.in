<?php include './database/database.php';
 session_start();
if(isset($_SESSION['cid'])){
  header('Location: member-view.php');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="/css/custom-style.css">
      <link rel="stylesheet" href="/css/mdb.min.css">
    <title>Login To Your Account</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">Lets Play</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li> -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Login
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="../user/user-login.php">User Login</a>
          <a class="dropdown-item" href="member-login.php">Member Login</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../employee/employee-login.php">Employee Login</a>
        </div>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
    </ul>
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
  </div>
</nav>
<div class="container">
       <div class="" style="height: 100px;">

       </div>
<?php
if(isset($_GET['succ'])){

  echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
  <strong>". $_GET['succ'] ."</strong> You should check in on some of those fields below.
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
  <span aria-hidden=\"true\">&times;</span>
  </button>
  </div>";

 }
elseif(isset($_GET['error'])){
  echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
  <strong>". $_GET['error'] ."</strong>
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
  <span aria-hidden=\"true\">&times;</span>
  </button>
  </div>";


}



 ?>
<!--Section: Live preview-->
<div class="mx-auto" style="width: 350px;">
<div class="card" style="width: 23rem;">
<section class="form-dark">


<div class="card card-image" style="background-image: url('../images/login-user.jpg');">
    <div class="text-white rgba-stylish-strong py-5 px-5 z-depth-4">

        <!--Header-->
        <div class="text-center">
            <h3 class="white-text mb-5 mt-4 font-bold"><strong>LOGIN</strong> <a class="green-text font-bold"><strong> ADMIN</strong></a></h3>
        </div>

        <form class="" action="../validation/admin_vldn.php" method="post">

          <label for="Form-email5">Your ID</label>
        <div class="md-form">
            <input type="text" id="Form-email5" class="form-control white-text" name="id" placeholder="Your email">
        </div>

        <label for="Form-pass5">Your password</label>
        <div class="md-form pb-3">
            <input type="password" id="Form-pass5" class="form-control white-text" name="pass" placeholder="Your password">
            <!-- <div class="form-group">
                <input type="checkbox" id="checkbox6">
                <label for="checkbox6" class="white-text">Accept the<a href="#" class="green-text font-bold"> Terms and Conditions</a></label>
            </div> -->
        </div>

        <!--Grid row-->
        <div class="row d-flex align-items-center mb-4">

            <!--Grid column-->
            <div class="text-center mb-3 col-md-12">
                <button name="adminSubmit" type="submit" class="btn btn-success btn-block btn-rounded z-depth-1">Log in</button>
            </div>
            <!--Grid column-->
          </form>
        </div>
        <!--Grid row-->

        <!--Grid column-->
        <!-- <div class="col-md-12">
            <p class="font-small white-text d-flex justify-content-end">No account? <a href="new-member-reg.php" class="green-text ml-1 font-bold"> Register Now</a></p>
        </div> -->
        <!--Grid column-->

    </div>
</div>


    </section>
<!--Section: Live preview-->
</div>

</div>

</div>  <!--  container-->
<div class="" style="height: 25px;">

</div>
<footer class="page-footer stylish-color-dark" style=" width: 100%; margin-top: 100px;">

<!--Footer Links-->
<div class="container">

    <!-- Footer links -->
    <div class="row text-center text-md-left mt-3 pb-3">

        <!--First column-->
        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="title mb-4 font-bold">Let's Play</h6>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        </div>
        <!--/.First column-->

        <hr class="w-100 clearfix d-md-none">

        <!--Second column-->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
            <h6 class="title mb-4 font-bold">Products</h6>
            <p><a href="#!">Club Booking</a></p>
            <p><a href="#!">Training</a></p>
        </div>
        <!--/.Second column-->

        <hr class="w-100 clearfix d-md-none">

        <!--Third column-->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
            <h6 class="title mb-4 font-bold">Useful links</h6>
            <p><a href="#!">Your Account</a></p>
            <p><a href="#!">Become a Member</a></p>
            <p><a href="#!">Pricing</a></p>
            <p><a href="#!">Help</a></p>
        </div>
        <!--/.Third column-->

        <hr class="w-100 clearfix d-md-none">

        <!--Fourth column-->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="title mb-4 font-bold">Contact</h6>
            <p><i class="fa fa-home mr-3"></i> Kolkata, kol 700101, IN</p>
            <p><i class="fa fa-envelope mr-3"></i> info@example.com</p>
            <p><i class="fa fa-phone mr-3"></i> + 01 234 567 88</p>
            <p><i class="fa fa-print mr-3"></i> + 01 234 567 89</p>
        </div>
        <!--/.Fourth column-->

    </div>
    <!-- Footer links -->

    <hr>

    <div class="row py-3 d-flex align-items-center">

        <!--Grid column-->
        <div class="col-md-8 col-lg-9">

           <!--Copyright-->
           <p class="text-center text-md-left grey-text">© 2018 Copyright: <a href="#"><strong>LetsplayMore.in</strong></a></p>
                <!--/.Copyright-->


        </div>
        <!--Grid column-->

        <!--Grid column-->
        <!-- <div class="col-md-4 col-lg-3 ml-lg-0"> -->

            <!--Social buttons-->
            <!-- <div class="social-section text-center text-md-left"> -->
                <!-- <ul> -->
                    <!-- <li><a class="btn-floating btn-sm rgba-white-slight mr-xl-4"><i class="fa fa-facebook"></i></a></li> -->
                    <!-- <li><a class="btn-floating btn-sm rgba-white-slight mr-xl-4"><i class="fa fa-twitter"></i></a></li> -->
                    <!-- <li><a class="btn-floating btn-sm rgba-white-slight mr-xl-4"><i class="fa fa-google-plus"></i></a></li> -->
                    <!-- <li><a class="btn-floating btn-sm rgba-white-slight mr-xl-4"><i class="fa fa-linkedin"></i></a></li> -->
                <!-- </ul> -->
            <!-- </div> -->
            <!--/.Social buttons-->

        <!-- </div> -->
        <!--Grid column-->

    </div>

</div>


</footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
