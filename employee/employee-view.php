<?php include '../database/database.php';

 session_start();

$eid = 0;$name='';
if(isset($_SESSION['eid'])){
  $eid = $_SESSION['eid'];
  $u_query = "select `FNAME` from `emply-info` WHERE `EMPID` = '$eid';";
  if(!mysqli_query($con,$u_query)){
      die('error :'.mysqli_error($con));
  }
  $u_rslt = mysqli_query($con,$u_query);
  while ($row = mysqli_fetch_assoc($u_rslt)){
  $name = $row['FNAME'];
  }

}
else{
  $error = "Please Login To Start!";
  header('Location: employee-login.php?error='.urlencode($error));
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Developed,Created & Designed By Kamalendu Das -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom-style.css">
    <link rel="stylesheet" href="../css/mdb.min.css">
    <title>Check & Insert Entries</title>
  </head>
  <body class="bdy">
    <!-- <img src="images/thomas-serer.jpg" class="img-fluid" alt="Responsive image"> -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">Lets Play</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <!-- <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a> -->
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Training</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Employee's Area
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="../employee/follow-lead.php">Follow Lead</a>
          <a class="dropdown-item" href="../employee/check-duplicate.php">Check Club Entry</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../employee/alter-club-info.php">Alter Your Club Entry</a>
        </div>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
    </ul>
    <?php if(isset($name) && isset($eid)){
      echo "<li class=\"nav-item dropdown\">";
      echo "<a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">";
      echo "Hello $name";
      echo "</a>";
      echo "<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">";
      echo "<a class=\"dropdown-item\" href=\"#\">History</a>";
      echo "<div class=\"dropdown-divider\"></div>";
      echo "<a class=\"dropdown-item\" href=\"../logout.php\">Logout</a>";
      echo "</div>";
      echo "</li>";
    }
    ?>
  </div>
</nav>
<hr>
<hr>

<div class="container" style="margin-top: 100px;">


  <!-- form -->
  <div class="text-center">
    <h3 class="white-text mb-5 mt-4 font-bold"><strong>CHECK</strong> <a class="text-dark font-bold"><strong>LEAD</strong></a></h3>
  </div>
  <div class="container" style="background-color: #e0e0e0 ; padding: 30px;">

    <?php

    if(isset($_GET['error'])){

     echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
      <strong>". $_GET['error'] ."</strong><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
      </button>
      </div>";

     }

     ?>

    <form class="my-form" action="../process/employee-lead-process.php" method="post">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">CLUBNAME</label>
          <input type="text" class="form-control" id="inputClubname" name="clubname" placeholder="eg:XYZ CLUB" required>
          <p id="ErrorClub"></p>
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">PIN</label>
          <input type="text" class="form-control" id="inputPincode" name="pin" placeholder="eg:700###" required>
          <p id="ErrorPin"></p>
        </div>
      </div>

         <button type="submit" name="empchk" class="btn btn-primary">CHECK</button>

      </form>



   </div>




<div class="text-center">
  <h3 class="white-text mb-5 mt-4 font-bold"><strong>INSERT</strong> <a class="text-dark font-bold"><strong> LEAD</strong></a></h3>
</div>
<div class="container" style="background-color: #e0e0e0 ; padding: 30px;">

  <?php

  if(isset($_GET['succ'])){

   echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
    <strong>". $_GET['succ'] ."</strong><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
    </button>
    </div>";

   }

   ?>
<!-- Form register -->
<form class="my-form" action="../process/employee-lead-process.php" method="post">


    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">FNAME</label>
        <input type="text" class="form-control" name="fname" id="inputFname" placeholder="eg:John" required>
        <p id="ErrorFname" ></p>
      </div>
      <div class="form-group col-md-6">
        <label for="inputEmail4">SNAME</label>
        <input type="text" class="form-control" name="sname" id="inputSname" placeholder="eg:Doe" required>
        <p id="ErrorSname" ></p>
      </div>
      <div class="form-group col-md-6">
        <label for="inputEmail4">EMAIL</label>
        <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="eg:abc@xyz.com" required>
        <p id="ErrorEmail"></p>
      </div>
      <div class="form-group col-md-6">
        <label for="inputPassword4">Password</label>
        <input type="password" class="form-control" id="inputPassword4" name="pass" placeholder="at least 6 characters">
        <p id="ErrorPass"></p>
      </div>
    <div class="form-group col-md-6">
      <label for="inputAddress2">CONTACT</label>
      <input type="text" class="form-control" id="inputContact" name="contact" placeholder="mobile number" required>
      <p id="ErrorConn"></p>
    </div>
  </div>
    <div class="form-group ">
      <label for="inputAddress2">CLUBNAME</label>
      <input type="text" class="form-control" id="inputClubname" name="clubname" placeholder="eg:xyz club" required>
      <p id="ErrorClub"></p>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">SPORTS</label>
        <input type="text" class="form-control" id="inputSport" name="spt" placeholder="eg: football" required>
        <p id="ErrorSpt"></p>
      </div>
      </div>
    <div class="form-group">
      <label for="inputAddress">ADDRESS</label>
      <input type="text" class="form-control" id="inputAddress" name="addr" placeholder="some street , some number" required>
      <p id="ErrorAddr"></p>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">PINCODE</label>
        <input type="text" class="form-control" id="inputPincode" name="pin" placeholder= "700###" required>
        <p id="ErrorPin"></p>
      </div>
      <div class="form-group col-md-6">
        <label for="inputEmail4">PRICE</label>
        <input type="text" class="form-control" id="inputPrice" name="price" placeholder="999" >
        <p id="ErrorPrice"></p>
      </div>
      </div>
      <div class="form-group">
        <label for="inputAddress">AMENITIES</label>
        <input type="text" class="form-control" id="inputAddress" name="amnts" placeholder="#)club has fencing all around" required>
      </div>

    <button type="submit" name="empsubmit" class="btn btn-primary">INSERT NOW</button>



    <div class="form-row">
    </div>
    <div class="form-group">

    </div>

  </form>
<!-- Form register -->
</div>



<!-- form -->


</div>



<!--Footer-->
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
<!--/.Footer-->

<script src="../jquery/jquery-3.3.1.slim.min.js" ></script>
<script src="../ajax/popper.min.js" ></script>
<script src="../js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="../js/custom_js.js"></script>
<script src="../js/mdb.min.js"></script>
  </body>
</html>
