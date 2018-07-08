<?php session_start(); ?>
<?php include '../database/database.php';

$clb = '';
$sdate = date("Y-m-d");
$cid = $_SESSION['cid'];
$spt = $_SESSION['spt'];
// echo "this line";
// echo "$cid";
$query="SELECT * FROM `club-info` WHERE `CID`= $cid ";
$rslt1 = mysqli_query($con,$query);
if(mysqli_num_rows($rslt1) == 0){
  header('Location: mbr-sports-insert.php');
   exit();
}

if(!isset($_SESSION['cid'])){

  $error = "Please Login To View your availbility informtion !";
  header('Location: member-login.php?error='.urlencode($error));
}
       elseif(isset($_GET['date']) && isset($_GET['sptname'])){

              //  $clb = $_GET['clubname'];
                $sdate = $_GET['sdate'];
                $spt = $_GET['sptname'];


       }

         date_default_timezone_set("India/Kolkata");

               $sdate_yy = (int)substr($sdate,0,4);

               $sdate_mm = (int)substr($sdate,5,2);

               $sdate_dd = (int)substr($sdate,8,2);



$query2 = "INSERT INTO `book-info` (`CID`,`SPORT`,`DATE`) VALUES ($cid,'$spt',STR_TO_DATE('$sdate', '%Y-%m-%d'));";

    //insert data first
    mysqli_query($con,$query2);
           
          $query = "select * from `book-info` where ( CID= $cid AND SPORT='$spt' AND  YEAR(DATE)=$sdate_yy AND MONTH(DATE)=$sdate_mm
          AND DAY(DATE) = $sdate_dd);";
          $rslt = mysqli_query($con,$query);
          // $query_info = "select `owner-info`.`CID`, `owner-info`.`CLUBNAME`,`owner-info`.`EMAIL`,
          // `owner-info`.pass,`club-info`.`ADDRESS`,`owner-info`.`ACCS`,`owner-info`.`CONTACT`
          // from `club-info` INNER JOIN `owner-info` ON `club-info`.cid = `owner-info`.cid;";
          // $rslt_info = mysqli_query($con,$query_info);
          // if(!mysqli_query($con,$query_info)){
          //    echo "Error";
          // }

          if(mysqli_num_rows($rslt) == 0){

            $msg = "No Users have checked your club on date this date!";
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
  <link rel="stylesheet" href="../css/custom-style.css">
  <link rel="stylesheet" href="../css/mdb.min.css">
  <title>View Bookings</title>
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
          Member's Area
        </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="member-view.php">Recent Bookings</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="alter-book.php">Alter Future Slots</a>

          </div>
        </li>
        <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
      </ul>
      <li>
        <a class=\ "dropdown-item\" href="../logout.php">Logout</a>
    </div>
    </li>
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
    </div>
  </nav>


  <!-- choosing club -->
  <br><br><br><br><br><br>
  <div class="container" style="background-color: #e0e0e0 ; padding: 60px;">
    <h1 class="display-4"> Showing Booking Information</h1>
    <p>
      <h2><?php

           echo "Booked Time Slots For ". $sdate ; ?></h2> </p>
    <form class="" action="member-view.php" method="get">
       <section>
       <div class="input-group mb-3" >
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">SPORTS</label>
            </div>
            <select name="sptname"class="custom-select" id="inputGroupSelect01" >
              <option value="#">Select Your Sport</option>
                <!-- <option selected>Choose Your Preferred Sports</option> -->
                <?php  while ($row = mysqli_fetch_assoc($rslt1)) : ?>
            <option value= "<?php echo $row['SPORT1']; ?>"><?php echo $row['SPORT1']; ?></option>
            <option value= "<?php echo $row['SPORT2']; ?>"><?php echo $row['SPORT2']; ?></option>
            <option value= "<?php echo $row['SPORT3']; ?>"><?php echo $row['SPORT3']; ?></option>
            <?php endwhile; ?>
            </select>
        </div>
       </section>
      <input class="mdb-select colorful-select dropdown-primary" type="date" name="sdate" id="inputGroupSelect01" required>
      <button type="submit" class="btn btn-primary" name="date">ENTER</button>
      <!-- <input type="submit" name="date" > -->
    </form>

  <div class="" style="margin-bottom: 25px;">

  </div>

    <!-- fancy table -->


    <div class="card">
      <div class="card-body">

        <div class="table-wrapper-2">

          <!--Table-->
          <table class="table table-responsive-md">
            <thead class="mdb-color lighten-4">
              <tr>


                <th class="th-lg">Date</th>
                <th class="th-lg">Time</th>
                <th class="th-lg">Booking Information</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row = mysqli_fetch_assoc($rslt)) : ?>
              <?php $_SESSION['clubname'] = $row['CLUBNAME']; ?>


              <tr>
                <td>
                  <?php echo "$sdate"; ?>
                </td>
                <td>07:00 -- 08:00</td>
                <td>
                  <?php  if($row['A'] == 'AVAILABLE'){

                echo "<button type=\"button\" class=\"btn btn-outline-warning waves-effect\" disabled>NO BOOKING</button>";
              }
              elseif($row['A'] == 'BOOKED'){
                echo "<button type=\"button\" class=\"btn btn-outline-success waves-effect\" disabled>BOOKED</button>";
              }
              else{
                echo "<button type=\"button\" class=\"btn btn-warning waves-effect\" disabled>N/A</button>";
              }
              ?>
                </td>

              </tr>
              <tr>
                <td>
                  <?php echo "$sdate"; ?>
                </td>
                <td>08:00 -- 09:00</td>
                <td>
                  <?php  if($row['B'] == 'AVAILABLE'){

                echo "<button type=\"button\" class=\"btn btn-outline-warning waves-effect\" disabled>NO BOOKING</button>";
              }
              elseif($row['B'] == 'BOOKED'){
                echo "<button type=\"button\" class=\"btn btn-outline-success waves-effect\" disabled>BOOKED</button>";
              }
              else{
                echo "<button type=\"button\" class=\"btn btn-warning waves-effect\" disabled>N/A</button>";
              }
              ?>
                </td>
              </tr>
              <tr>
                <td>
                  <?php echo "$sdate"; ?>
                </td>
                <td>09:00 -- 10:00</td>
                <td>
                  <?php  if($row['C'] == 'AVAILABLE'){

                echo "<button type=\"button\" class=\"btn btn-outline-warning waves-effect\" disabled>NO BOOKING</button>";
              }
              elseif($row['C'] == 'BOOKED'){
                echo "<button type=\"button\" class=\"btn btn-outline-success waves-effect\" disabled>BOOKED</button>";
              }
              else{
                echo "<button type=\"button\" class=\"btn btn-warning waves-effect\" disabled>N/A</button>";
              }
              ?>
                </td>

              </tr>
              <tr>
                <td>
                  <?php echo "$sdate"; ?>
                </td>
                <td>10:00 -- 11:00</td>
                <td>
                  <?php  if($row['D'] == 'AVAILABLE'){

                echo "<button type=\"button\" class=\"btn btn-outline-warning waves-effect\" disabled>NO BOOKING</button>";
              }
              elseif($row['D'] == 'BOOKED'){
                echo "<button type=\"button\" class=\"btn btn-outline-success waves-effect\" disabled>BOOKED</button>";
              }
              else{
                echo "<button type=\"button\" class=\"btn btn-warning waves-effect\" disabled>N/A</button>";
              }
              ?>
                </td>


              </tr>
              <tr>
                <td>
                  <?php echo "$sdate"; ?>
                </td>
                <td>11:00 -- 12:00</td>
                <td>
                  <?php  if($row['E'] == 'AVAILABLE'){

                echo "<button type=\"button\" class=\"btn btn-outline-warning waves-effect\" disabled>NO BOOKING</button>";
              }
              elseif($row['E'] == 'BOOKED'){
                echo "<button type=\"button\" class=\"btn btn-outline-success waves-effect\" disabled>BOOKED</button>";
              }
              else{
                echo "<button type=\"button\" class=\"btn btn-warning waves-effect\" disabled>N/A</button>";
              }
              ?>
                </td>

              </tr>
              <tr>
                <td>
                  <?php echo "$sdate"; ?>
                </td>
                <td>12:00 -- 13:00</td>
                <td>
                  <?php  if($row['F'] == 'AVAILABLE'){

                echo "<button type=\"button\" class=\"btn btn-outline-warning waves-effect\" disabled>NO BOOKING</button>";
              }
              elseif($row['F'] == 'BOOKED'){
                echo "<button type=\"button\" class=\"btn btn-outline-success waves-effect\" disabled>BOOKED</button>";
              }
              else{
                echo "<button type=\"button\" class=\"btn btn-warning waves-effect\" disabled>N/A</button>";
              }
              ?>
                </td>

              </tr>
              <tr>
                <td>
                  <?php echo "$sdate"; ?>
                </td>
                <td>13:00 -- 14:00</td>
                <td>
                  <?php  if($row['G'] == 'AVAILABLE'){

                echo "<button type=\"button\" class=\"btn btn-outline-warning waves-effect\" disabled>NO BOOKING</button>";
              }
              elseif($row['G'] == 'BOOKED'){
                echo "<button type=\"button\" class=\"btn btn-outline-success waves-effect\" disabled>BOOKED</button>";
              }
              else{
                echo "<button type=\"button\" class=\"btn btn-warning waves-effect\" disabled>N/A</button>";
              }
              ?>
                </td>

              </tr>
              </tr>
              <tr>
                <td>
                  <?php echo "$sdate"; ?>
                </td>
                <td>14:00 -- 15:00</td>
                <td>
                  <?php  if($row['H'] == 'AVAILABLE'){

                echo "<button type=\"button\" class=\"btn btn-outline-warning waves-effect\" disabled>NO BOOKING</button>";
              }
              elseif($row['H'] == 'BOOKED'){
                echo "<button type=\"button\" class=\"btn btn-outline-success waves-effect\" disabled>BOOKED</button>";
              }
              else{
                echo "<button type=\"button\" class=\"btn btn-warning waves-effect\" disabled>N/A</button>";
              }
              ?>
                </td>

              </tr>
              <tr>

                <td>
                  <?php echo "$sdate"; ?>
                </td>
                <td>15:00 -- 16:00</td>
                <td>
                  <?php  if($row['I'] == 'AVAILABLE'){

                echo "<button type=\"button\" class=\"btn btn-outline-warning waves-effect\" disabled>NO BOOKING</button>";
              }
              elseif($row['I'] == 'BOOKED'){
                echo "<button type=\"button\" class=\"btn btn-outline-success waves-effect\" disabled>BOOKED</button>";
              }
              else{
                echo "<button type=\"button\" class=\"btn btn-warning waves-effect\" disabled>N/A</button>";
              }
              ?>
                </td>
              </tr>
              <tr>

                <td>
                  <?php echo "$sdate"; ?>
                </td>
                <td>16:00 -- 17:00</td>
                <td>
                  <?php  if($row['J'] == 'AVAILABLE'){

                echo "<button type=\"button\" class=\"btn btn-outline-warning waves-effect\" disabled>NO BOOKING</button>";
              }
              elseif($row['J'] == 'BOOKED'){
                echo "<button type=\"button\" class=\"btn btn-outline-success waves-effect\" disabled>BOOKED</button>";
              }
              else{
                echo "<button type=\"button\" class=\"btn btn-warning waves-effect\" disabled>N/A</button>";
              }
              ?>
                </td>
              </tr>
              <tr>

                <td>
                  <?php echo "$sdate"; ?>
                </td>
                <td>17:00 -- 18:00</td>
                <td>
                  <?php  if($row['K'] == 'AVAILABLE'){

                echo "<button type=\"button\" class=\"btn btn-outline-warning waves-effect\" disabled>NO BOOKING</button>";
              }
              elseif($row['K'] == 'BOOKED'){
                echo "<button type=\"button\" class=\"btn btn-outline-success waves-effect\" disabled>BOOKED</button>";
              }
              else{
                echo "<button type=\"button\" class=\"btn btn-warning waves-effect\" disabled>N/A</button>";
              }
              ?>
                </td>
              </tr>
              <tr>

                <td>
                  <?php echo "$sdate"; ?>
                </td>
                <td>18:00 -- 19:00</td>
                <td>
                  <?php  if($row['L'] == 'AVAILABLE'){

                echo "<button type=\"button\" class=\"btn btn-outline-warning waves-effect\" disabled>NO BOOKING</button>";
              }
              elseif($row['L'] == 'BOOKED'){
                echo "<button type=\"button\" class=\"btn btn-outline-success waves-effect\" disabled>BOOKED</button>";
              }
              else{
                echo "<button type=\"button\" class=\"btn btn-warning waves-effect\" disabled>N/A</button>";
              }
              ?>
                </td>
              </tr>
              <tr>

                <td>
                  <?php echo "$sdate"; ?>
                </td>
                <td>19:00 -- 20:00</td>
                <td>
                  <?php  if($row['M'] == 'AVAILABLE'){

                echo "<button type=\"button\" class=\"btn btn-outline-warning waves-effect\" disabled>NO BOOKING</button>";
              }
              elseif($row['M'] == 'BOOKED'){
                echo "<button type=\"button\" class=\"btn btn-outline-success waves-effect\" disabled>BOOKED</button>";
              }
              else{
                echo "<button type=\"button\" class=\"btn btn-warning waves-effect\" disabled>N/A</button>";
              }
              ?>
                </td>
              </tr>
              <tr>

                <td>
                  <?php echo "$sdate"; ?>
                </td>
                <td>20:00 -- 21:00</td>
                <td>
                  <?php  if($row['N'] == 'AVAILABLE'){

                echo "<button type=\"button\" class=\"btn btn-outline-warning waves-effect\" disabled>NO BOOKING</button>";
              }
              elseif($row['N'] == 'BOOKED'){
                echo "<button type=\"button\" class=\"btn btn-outline-success waves-effect\" disabled>BOOKED</button>";
              }
              else{
                echo "<button type=\"button\" class=\"btn btn-warning waves-effect\" disabled>N/A</button>";
              }
              ?>
                </td>
              </tr>
              <tr>

                <td>
                  <?php echo "$sdate"; ?>
                </td>
                <td>21:00 -- 22:00</td>
                <td>
                  <?php  if($row['O'] == 'AVAILABLE'){

              echo "<button type=\"button\" class=\"btn btn-outline-warning waves-effect\" disabled>NO BOOKING</button>";
            }
            elseif($row['O'] == 'BOOKED'){
              echo "<button type=\"button\" class=\"btn btn-outline-success waves-effect\" disabled>BOOKED</button>";
            }
            ?>
                </td>


              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
          <!--Table-->

        </div>

      </div>
    </div>




    <!-- fancy table -->


  </div>









  <!-- TODO craete a log table for altering database -->


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


  <script src="../jquery/jquery-3.3.1.slim.min.js"></script>
  <script src="../ajax/popper.min.js"></script>
  <script src="../js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="../js/custom_js.js"></script>
  <script src="../js/mdb.min.js"></script>
</body>

</html>
