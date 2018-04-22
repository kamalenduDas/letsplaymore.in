<?php include './database/database.php';
 session_start();

  $visit = file_get_contents('visit.txt');
  $visit = $visit + 1;
  file_put_contents('visit.txt',$visit);



     $query="select SPORTS from `sports`;";
     $rslt = mysqli_query($con,$query);


if(isset($_SESSION['uid'])){
  $uid = $_SESSION['uid'];
  $u_query = "select uname from `user-info` WHERE uid = $uid;";
  $u_rslt = mysqli_query($con,$u_query);
  while ($row = mysqli_fetch_assoc($u_rslt)){
  $name = $row['uname'];
  }

}
else if(isset($_SESSION['cid'])){
       $cid = $_SESSION['cid'];
       $m_query = "select fname from `owner-info` WHERE cid = $cid;";
       $m_rslt = mysqli_query($con,$m_query);
       while ($row = mysqli_fetch_assoc($m_rslt)){
       $name = $row['fname'];
       }

}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/custom-style.css">
    <link rel="stylesheet" href="css/mdb.min.css">
    <title>Lets play</title>
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
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/admin/coming_soon.php">Training</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Login
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="user/user-login.php">User Login</a>
          <a class="dropdown-item" href="member/member-login.php">Member Login</a>
          <!-- <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="employee/employee-login.php">Employee Login</a>
        </div> -->
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
    </ul>
    <?php if(isset($name) && isset($uid)){
      echo "<li class=\"nav-item dropdown\">";
      echo "<a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">";
      echo "Hello $name";
      echo "</a>";
      echo "<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">";
      echo "<a class=\"dropdown-item\" href=\"#\">History</a>";
      echo "<div class=\"dropdown-divider\"></div>";
      echo "<a class=\"dropdown-item\" href=\"logout.php\">Logout</a>";
      echo "</div>";
      echo "</li>";
    }
    else if(isset($name) && isset($cid)){
      echo "<li class=\"nav-item dropdown\">";
      echo "<a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">";
      echo "Hello $name";
      echo "</a>";
      echo "<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">";
      echo "<a class=\"dropdown-item\" href=\"./member/member-view.php\">Bookings</a>";
      echo "<a class=\"dropdown-item\" href=\"./member/alter-book.php\">Alterfications</a>";
      echo "<div class=\"dropdown-divider\"></div>";
      echo "<a class=\"dropdown-item\" href=\"logout.php\">Logout</a>";
      echo "</div>";
      echo "</li>";


    }
    ?>
  </div>
</nav>
<hr>
<hr>

<!--Carousel Wrapper-->
<div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
    <!--Indicators-->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-2" data-slide-to="1"></li>
        <li data-target="#carousel-example-2" data-slide-to="2"></li>
        <li data-target="#carousel-example-2" data-slide-to="3"></li>
        <li data-target="#carousel-example-2" data-slide-to="4"></li>
    </ol>
    <!--/.Indicators-->
    <!--Slides-->
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <div class="view">
              <img class="d-block w-100" src="images/carousel/carousel1.jpg" alt="Second slide">
              <div class="mask rgba-black-light"></div>
          </div>

         <div class="carousel-caption">
           <blockquote class="blockquote bq-success">
              <p class="bq-title">LetsplayMore</p>
          <p class="white-text">Your One-Stop Solution For All sports Necessities</p>
          </blockquote>
       </div>

        </div>
        <div class="carousel-item">
            <!--Mask color-->
            <div class="view">
                <img class="d-block w-100" src="images/carousel/carousel2.jpg" alt="Second slide">
                <div class="mask rgba-black-light"></div>
            </div>
            <div class="carousel-caption">
               <blockquote class="blockquote bq-success">
              <p class="bq-title">LetsplayMore</p>
          <p class="white-text">Created For The Sportsmen Envisioned By A Sportslover</p>
          </blockquote>
            </div>
        </div>
        <div class="carousel-item">
          <div class="view">
              <img class="d-block w-100" src="images/carousel/carousel3.jpg" alt="Second slide">
              <div class="mask rgba-black-light"></div>
          </div>
          <div class="carousel-caption">
              <!-- <h3 class="h3-responsive">Strong mask</h3>
              <p>Secondary text</p> -->
          </div>
        </div>
        <div class="carousel-item">
          <div class="view">
              <img class="d-block w-100" src="images/carousel/carousel4.jpg" alt="Second slide">
              <div class="mask rgba-black-light"></div>
          </div>
          <div class="carousel-caption">
              <!-- <h3 class="h3-responsive">Strong mask</h3>
              <p>Secondary text</p> -->
          </div>
        </div>
        <div class="carousel-item">
          <div class="view">
              <img class="d-block w-100" src="images/carousel/carousel5.jpg" alt="Second slide">
              <div class="mask rgba-black-light"></div>
          </div>
          <div class="carousel-caption">
              <!-- <h3 class="h3-responsive">Strong mask</h3>
              <p>Secondary text</p> -->
          </div>
        </div>
    </div>
    <!--/.Slides-->
    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
</div>
<!--/.Carousel Wrapper-->

  <div class="container" >




    <form class="form-inline" action="./user/showresult.php" method="get" style="padding: 50px;">



        <div class="input-group mb-3" >
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">SPORTS</label>
            </div>
            <select name="sptname"class="custom-select" id="inputGroupSelect01" >
              <option value="#">Select Your Sport</option>
                <!-- <option selected>Choose Your Preferred Sports</option> -->
                <?php  while ($row = mysqli_fetch_assoc($rslt)) : ?>
            <option value= "<?php echo $row['SPORTS']; ?>"><?php echo $row['SPORTS']; ?></option>
            <?php endwhile; ?>
            </select>
        </div>

        <div class="" style="width: 30px;">

        </div>

    <div class="input-group mb-2 mr-sm-2" style="height: 40px;">
      <div class="input-group-prepend">
          <div class="input-group-text">LOCATION</div>
      </div>
          <input type="text" class="form-control" style="height: 20px;" name="pin" id="inlineFormInputGroupUsername2" placeholder=" City or Area or Pincode " required>
    </div>

<div class="form-check mb-2 mr-sm-2">

</div>

<button type="submit" class="btn btn-primary mb-2">Submit</button>
</form>
    </div>


<!--Footer-->
<footer class="page-footer stylish-color-dark" style=" width: 100%; margin-top: 150px;">

    <!--Footer Links-->
    <div class="container">

        <!-- Footer links -->
        <div class="row text-center text-md-left mt-3 pb-3">

            <!--First column-->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="title mb-4 font-bold">Let's Play</h6>
                <p>Site Visited : <?php echo $visit; ?> Times</p>
                <p><a href="about.html">About Us</a></p>
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
                <p><a href="user/user-login.php">Your Account</a></p>
                <p><a href="member/new-member-reg.php">Become a Member</a></p>
                <p><a href="#!">Pricing</a></p>
                <p><a href="#!">Terms & Conditions</a></p>
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


 <script src="jquery/jquery-3.3.1.slim.min.js" ></script>
 <script src="ajax/popper.min.js" ></script>
 <script src="js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 <script src="js/custom_js.js"></script>
 <script src="js/mdb.min.js"></script>


  </body>
</html>
