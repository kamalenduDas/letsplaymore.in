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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lets Play More</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom-style.css">
    <link rel="stylesheet" href="css/mdb.min.css">
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
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="training/training_index.php">Training</a>
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
      echo "<a class=\"dropdown-item\" href=\"user/buy-details.php\">History</a>";
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
    <div class="pimg1">
        <div class="ptext ptext-top">
            <!-- <span class="border"> -->
               
                <form class="form-inline" action="./user/showresult.php" method="get" style="padding: 50px;">



        <div class="input-group mb-3" >
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">SPORTS</label>
            </div>
            <select name="sptname"class="custom-select" id="inputGroupSelect01" >
              <option value="#"><h6>Select Sport</h6></option>
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


<button type="submit" class="btn btn-primary mb-2">Submit</button>
</form>
</span>
        </div>
    </div>


    <section class="section section-light">
        <h2>Who Are We</h2>
        <p>
        Our Purpose is to create a healthy society through encouraging sports among the people.

Sports are very important for lives of all age.Adults can keep them fit with regualr sports like Badminton,Tennis,Yoga,Chess etc.Where our children can build a career in sports at the same time they can shape their body and mind through sports

So, we are trying hard to give access to the sports lovers to play at the booked ground as and when thay get the opertunity with the minimal price.Also they can create good sportsperson by training their kids in nearby sports academy.
        </p>
    </section>


    <div class="pimg2">
            <div class="ptext">
                <span class="border trans">
                    All Your Sport Necessicity
                </span>
            </div>
    </div>
    

        <section class="section section-dark">
                <h2>Our Services</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum est molestias ea ratione a, corporis qui cum laudantium? Optio doloribus rem facilis culpa molestias iure sequi cum vel dolorum natus assumenda temporibus expedita reprehenderit vero modi, eligendi, aliquid molestiae accusantium excepturi delectus, hic magnam! Facilis quaerat dolorum deserunt vero saepe, tempore nesciunt autem commodi sit eos porro repellat nulla quisquam hic impedit consequatur nam omnis enim alias? Voluptates tenetur culpa deserunt harum pariatur ipsam cupiditate, voluptate explicabo consequatur numquam? Officiis, sapiente! Modi nemo sed dignissimos praesentium temporibus molestias, maxime doloremque accusamus voluptatibus sequi aliquam perspiciatis harum quos consectetur dicta blanditiis.
                </p>
            </section>   

   <div class="pimg3">
                    <div class="ptext">
                        <span class="border trans">
                            Under One Roof
                        </span>
                    </div>
    </div>   
    
    
        <section class="section section-dark">
            <h2>About & Contacts</h2>
            <p>
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
    <p><a href="terms.html">Terms & Conditions</a></p>
    <p><a href="privacy.html">Privacy Policy</a></p>
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
            </p>
 </section>   



        <div class="pimg4">
                <div class="ptext">
                    <span class="border">
                        Check our introductory video
                    </span>
                </div>
            </div> 

<!-- Footer -->
<footer class="page-footer font-small special-color-dark pt-4">

    <!-- Footer Elements -->
    <div class="container">

      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <!-- Form -->
          <form class="form-inline">
            <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Search" aria-label="Search">
            <i class="fa fa-search" aria-hidden="true"></i>
          </form>
          <!-- Form -->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <form class="input-group">
            <input type="text" class="form-control form-control-sm" placeholder="Your email" aria-label="Your email" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-sm btn-outline-white" type="button">Sign up</button>
            </div>
          </form>

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

    </div>
    <!-- Footer Elements -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2018 Copyright:
      <a href="http://letsplaymore.in"> MDBootstrap.com</a>
    </div>
    <!-- Copyright -->

  </footer>
  <!-- Footer -->

 


 <script src="jquery/jquery-3.3.1.slim.min.js" ></script>
 <script src="ajax/popper.min.js" ></script>
 <script src="js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 <script src="js/custom_js.js"></script>
 <script src="js/mdb.min.js"></script>
           
</body>
</html>