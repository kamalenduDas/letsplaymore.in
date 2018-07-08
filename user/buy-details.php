<?php
include '../database/database.php';
date_default_timezone_set("Asia/Kolkata");
// if($_GET['succ']){
//   //$msg = $_get['succ'];
//   // echo $_GET['succ'];
// }
session_start();

$uid = $_SESSION['uid'];
$sdate = date("Y-m-d");

$sdate_yy = (int)substr($sdate,0,4);

$sdate_mm = (int)substr($sdate,5,2);

$sdate_dd = (int)substr($sdate,8,2);

$sql = "SELECT * FROM `user-book-info`,`club-info` WHERE  UID=$uid AND `user-book-info`.CID = `club-info`.CID AND YEAR(BDATE)=$sdate_yy AND MONTH(BDATE)=$sdate_mm AND DAY(BDATE)=$sdate_dd";
//AND YEAR(BDATE) = $sdate_yy AND MONTH(BDATE) = $sdate_mm AND DAY(BDATE)=$sdate_dd
$rslt = mysqli_query($con,$sql);
// while($row = mysqli_fetch_assoc($rslt)){
//   echo $row['UID'];
//   echo $row['BDATE'];
//   echo $row['CLUBNAME'];
//   echo $row['BSLOT'];
//   echo $row['BSPORT'];
// }


 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Booking confirmation</title>
  </head>
  <link rel="stylesheet" href="../css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom-style.css">
    <link rel="stylesheet" href="../css/mdb.min.css">
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
            <a class="dropdown-item" href="../member/member-login.php">Member Login</a>
            <!-- <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../employee/employee-login.php">Employee Login</a>
          </div> -->
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
    <div class="container"style="margin-bottom: 620px;">


     <div class="alert alert-success" role="alert">
      succes in booking
      </div>
     <h3><a href="../index.php" class="badge badge-success">Success in booking, click here to go back for more</a></h3>
     <!-- <a href=>back to booking</a> -->
     <h1>Your Booking Information</h1>

     <!--Grid row-->
     <div class="row wow fadeIn">
        <?php while($row = mysqli_fetch_assoc($rslt)): ?>
                <!--Grid column-->
                <div class="col-md-6 mb-4">

                    <!--Card-->
                    <div class="card">

                        <!--Card content-->
                        <div class="card-body">

                            <!-- Table  -->
                            <table class="table table-hover">

                                <tbody>

                                  <p>
                                    <!-- <form class="" action="../process/user_checkout_process.php" method="post"> -->
                                    <?php
                                    echo "ORDER ID : ". $row['ORDRID']."<br>";
                                    echo "SPORT : ".$row['BSPORT']."<br>";
                                    echo "CLUBNAME : ".$row['CLUBNAME']."<br>";
                                    echo "DATE : ".$row['BDATE']."<br>";
                                    echo "SLOT : ".$row['BSLOT']."<br>";
                                    

                                    ?>
                                    <input type="hidden" name="cid" value="<?php echo $row['CID']; ?>">
                                    <input type="hidden" name="cid" value="<?php echo $row['CID']; ?>">
                                    <?php
                                      $diff = date_diff(date_create($row['BDATE']),date_create(date("Y-m-d")));
                                     if($diff->format('%R%a') <= 0){
                                         echo "<button type=\"submit\" name=\"delete\" value=\"delete\" class=\"btn btn-danger\">DELETE FROM CART</button>";
                                         echo "<button type=\"submit\" name=\"confirm\" value=\"delete\" class=\"btn btn-success\">CONFIRM BOOKING</button>";
                                     }
                                     //echo "date diff :".$diff->format('%a');
                                    ?>
                                    
                                  </form>

                                  </p>
                                  <p>

                                  </p>

                                </tbody>
                                <!-- Table body -->
                            </table>
                            <!-- Table  -->

                        </div>

                    </div>
                    <!--/.Card-->

                </div>
                <!--Grid column-->
          <?php endwhile; ?>



            </div>


            <!--Grid row-->



















       <p>

       <?php


// while($row = mysqli_fetch_assoc($rslt)){
//   echo $row['UID'];
//   echo $row['BDATE'];
//   echo $row['CLUBNAME'];
//   echo $row['BSLOT'];
//   echo $row['BSPORT'];
// }



        ?>

       </p>





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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="../js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
