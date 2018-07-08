<?php include '../database/database.php';?>
<?php session_start();
if(isset($_SESSION['uid'])){
  $uid = $_SESSION['uid'];
  $u_query = "select uname from `user-info` WHERE uid = $uid;";
  $u_rslt = mysqli_query($con,$u_query);
  while ($row = mysqli_fetch_assoc($u_rslt)){
  $name = $row['uname'];
  }

}

        $spt = strtoupper(mysqli_real_escape_string($con,$_GET['sptname']));
        $str1 = strtoupper(mysqli_real_escape_string($con,$_GET['pin']));
        $loc1 = "NULL";
        $loc2 = "NULL";
    // check if entered value is string or numeric
         if( is_numeric($str1)){
           preg_match_all('!\d+!', $str1, $matches);
           $loc = implode(' ', $matches[0]);
         }
         elseif(is_string($str1)) {

           $loc = mysqli_real_escape_string($con,$_GET['pin']);
           $loc = preg_replace('/\s+/', '', $loc);

          $num = strlen($loc);
          $num1 = floor(strlen($loc) / 2);

          $loc1 = substr(strtoupper($loc),0,$num1);
          $loc2 = substr(strtoupper($loc),$num1,$num);


         }
            $_SESSION["spt"] = $spt ;
            $_SESSION["loc"] = $loc;
           $query = "select * from `club-info` where (SPORT1 ='$spt' OR SPORT2 = '$spt' OR SPORT3 = '$spt') and (ADDRESS LIKE '%$loc1%' OR ADDRESS LIKE '%$loc2%'OR PIN LIKE '%$loc%') and `MBR` = 1;";
       $rslt = mysqli_query($con,$query);
    ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../css/custom-style.css">
<link rel="stylesheet" href="../css/mdb.min.css">
    <title>Grounds of your choice</title>
  </head>
  <body class="bdy">
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
          <a class="dropdown-item" href="user-login.php">User Login</a>
          <a class="dropdown-item" href="../member/member-login.php">Member Login</a>
          <!-- <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../employee/employee-login.php">Employee Login</a>
        </div> -->
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
    </ul>
    <?php if(isset($name)){
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
    <br>
    <br>
    <br>
    <div class="text-center">
     <h1 class="white-text mb-5 mt-4 font-bold"><a class="text-dark font-bold"><strong><?php echo $spt." TRAINING"; ?></strong></a><strong> CLUBS NEAR</strong> <a class="text-dark font-bold"><strong><?php echo strtoupper($loc); ?></strong></a></h1>
    </div>
    <div class="container" style="background-color: #e0e0e0 ; padding: 30px;">
    <hr>

           <?php if(mysqli_num_rows($rslt) == 0) :  ?>
               <div >
                 <p> <h1 class="display-4" style="color: white;"> <?php echo "No Results found ! Try Again with somthing else" ?> </h1> </p>
               </div>
             <?php endif; ?>

        <div class="card-group">

          <?php while($row = mysqli_fetch_assoc($rslt)) : ?>
          <form class="form-inline" action="booking.php" method="get">
      <div class="card card-dark" style="width: 20rem; margin: 20px; background-color: #212121; color: #e0e0e0">

      <img class="card-img-top" src="../images/images.jpeg" alt="" >
      <div class="card-body">
           <h5 class="card-title"><?php echo strtoupper($row['CLUBNAME']); ?></h5>
           <hr class="hr-light">

           <p class="card-text" style="color: #e0e0e0"><?php echo strtoupper($row['ADDRESS']); ?></p>
           <!-- <a href="#" class="btn btn-primary" type="submit">Book Now</a> -->
           <button type="submit" class="btn btn-outline-success" name="clubname" value="<?php echo $row['CLUBNAME']; ?>">view Schedule</button>
           <!-- <input type="text" name="" value=""> -->
      </div>
      </div>
    </form>
  <?php endwhile; ?>
    </div>

    </div>
    <!--Footer-->
    <div class="" style="height: 200px;">

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
<!-- <script src="../js/custom_js.js"></script> -->
<script src="../js/mdb.min.js"></script>
  </body>
</html>
