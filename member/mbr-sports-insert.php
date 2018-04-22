<?php
include '../database/database.php';
session_start();

$cid = $_SESSION['cid'];

$club = $_SESSION['club'];

$email = $_SESSION['email'];

if(!isset($_SESSION['cid'])){

  $error = "Please Login or Register To Proceed Further !";
  header('Location: member-login.php?error='.urlencode($error));

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
       <link rel="stylesheet" href="/css/mdb.min.css">
       <link rel="stylesheet" href="/css/custom-style.css">
     <title>Tell Us More</title>
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
 if(isset($_GET['error'])){

   echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
   <strong>". $_GET['error'] ."</strong> You should check in on some of those fields below.
   <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
   <span aria-hidden=\"true\">&times;</span>
   </button>
   </div>";

  }
  ?>

 <!-- form -->
 <div class="text-center">
  <h3 class="white-text mb-5 mt-4 font-bold"><strong>REGISTER</strong> <a class="text-dark font-bold"><strong> <?php echo $club; ?></strong></a></h3>
</div>

 <div class="container" style="background-color: #e0e0e0 ; padding: 30px;">

<!-- <div class="">
  <h2 display> You Are Already A Member Tell Us More About Your Club <?php echo $club; ?> </h2>
</div> -->
<!-- <hr>
<hr> -->
 <!-- Form register -->
 <form class="my-form" action="../process/mbr-club-info-insert-process.php" method="post">


     <div class="form-row">
       <!-- <div class="form-group col-md-6"> -->
         <!-- <label for="inputEmail4">CLUBNAME</label> -->
         <input type="hidden" class="form-control"  name="fname" placeholder= "<?php echo $club; ?>" disabled>
       <!-- </div> -->
       <div class="form-group col-md-6">
         <label for="inputEmail4">SPORTS</label>
         <input type="text" class="form-control" name="spt" placeholder="eg: football">
       </div>
       <!-- <div class="form-group col-md-6"> -->
         <!-- <label for="inputEmail4">EMAIL</label> -->
         <input type="hidden" class="form-control" id="inputEmail4" name="email" placeholder="<?php echo $email; ?>" disabled>
       <!-- </div> -->
     </div>
     <div class="form-group">
       <label for="inputAddress">ADDRESS</label>
       <input type="text" class="form-control" id="inputAddress" name="addr" placeholder="some street , some number">
     </div>

     <div class="form-row">
       <div class="form-group col-md-6">
         <label for="inputEmail4">PINCODE</label>
         <input type="text" class="form-control" name="pin" placeholder= "700###">
       </div>
       <div class="form-group col-md-6">
         <label for="inputEmail4">PRICE</label>
         <input type="text" class="form-control" name="price" placeholder="999">
       </div>
       </div>
       <div class="form-group">
         <label for="inputAddress">AMENITIES</label>
         <input type="text" class="form-control" id="inputAddress" name="amnts" placeholder="#)club has fencing all around">
       </div>

     <button type="submit" name="submit" class="btn btn-primary">INSERT NOW</button>
   </form>
 <!-- Form register -->
 </div>



 <!-- form -->

 </div>
 <div class="" style="height: 50px;">

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
             <p><i class="fa fa-home mr-3"></i>SM Bose Road, Sarkar Bagan</p>
             <p><i class="fa fa-home mr-3"></i>Agarpara,Kolkata 700109</p>
             <p><i class="fa fa-envelope mr-3"></i>contact@letsplaymore.in</p>
             <p><i class="fa fa-phone mr-3"></i> + 91 983 091 95 64</p>
             <p><i class="fa fa-print mr-3"></i> + 91 735 836 62 93</p>
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


 <script src="../jquery/jquery-3.3.1.slim.min.js" ></script>
 <script src="../ajax/popper.min.js" ></script>
 <script src="../js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 <script src="../js/custom_js.js"></script>
 <script src="../js/mdb.min.js"></script>
   </body>
 </html>
