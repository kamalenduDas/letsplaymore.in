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
//get the club names where session sport & session address matches
$spt = $_SESSION["spt"]; $loc = $_SESSION["loc"];
if(is_numeric($loc)){
  preg_match_all('!\d+!', $loc, $matches);
  $loc = implode(' ', $matches[0]);
}
elseif(is_string($loc)) {

  $loc = mysqli_real_escape_string($con,$loc);
  $loc = preg_replace('/\s+/', '', $loc);

 $num = strlen($loc);
 $num1 = floor(strlen($loc) / 2);

 $loc1 = substr(strtoupper($loc),0,$num1);
 $loc2 = substr(strtoupper($loc),$num1,$num);


}

$query1="select * from `club-info` where SPORTS='$spt' and (ADDRESS LIKE '%$loc1%' or ADDRESS like '%$loc2%' or PIN LIKE '%$loc%');";
$rslt1 = mysqli_query($con,$query1);

?>

<?php
date_default_timezone_set("Asia/Kolkata");

//default date will be today's date
 $sdate = date("Y-m-d");
 $clb = '';
 $msg = '';
//when button name clubname pressed from showresult check & get clubname
  if(isset($_GET['clubname'])){

      $clb = rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_GET['clubname']))," \t ")," \t ");

      $sdate_yy = (int)substr($sdate,0,4);

      $sdate_mm = (int)substr($sdate,5,2);

      $sdate_dd = (int)substr($sdate,8,2);

      // insert some default data in book-info about that specific date & club
      $query2 = "INSERT INTO `book-info` (`CLUBNAME`,`DATE`) VALUES ((select CLUBNAME FROM `club-info` where CLUBNAME = '$clb'), STR_TO_DATE('$sdate', '%Y-%m-%d'));";

      //insert data first
      mysqli_query($con,$query2);



      // get data from book-info about that specific date & club
      $query = "select * from `book-info` where ( CLUBNAME= '$clb' AND  YEAR(DATE)=$sdate_yy AND MONTH(DATE)=$sdate_mm
      AND DAY(DATE) = $sdate_dd);";

      $_SESSION['slctd_clb'] = $clb;
      //get later to show availbility
      $rslt = mysqli_query($con,$query);



      }
      // when date is selected from this page check if booking named button is pressed
          if(isset($_GET['clbname'])){

            $clb = rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_GET['clbname']))," \t ")," \t ");

            $sdate = rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_GET['sdate']))," \t ")," \t ");
          //  $_SESSION['slctd_date'] = $sdate;

                          if(floor((strtotime($sdate) - strtotime(date("Y-m-d")))/(24*60*60)) < 0){

                                $msg = "cant book in the past !";

                             }elseif(floor((strtotime($sdate) - strtotime(date("Y-m-d")))/(24*60*60)) >= 31){

                                $msg = "cant book that far in the future !";

                             }else{


                               $sdate_yy = (int)substr($sdate,0,4);

                               $sdate_mm = (int)substr($sdate,5,2);

                               $sdate_dd = (int)substr($sdate,8,2);

                               // insert some default data in book-info about that specific date & club
                               $query2 = "INSERT INTO `book-info` (`CLUBNAME`,`DATE`) VALUES ((select CLUBNAME FROM `club-info` where CLUBNAME = '$clb'), STR_TO_DATE('$sdate', '%Y-%m-%d'));";

                               //insert data first
                               mysqli_query($con,$query2);



                               // get data from book-info about that specific date & club
                               $query = "select * from `book-info` where ( CLUBNAME= '$clb' AND  YEAR(DATE)=$sdate_yy AND MONTH(DATE)=$sdate_mm
                               AND DAY(DATE) = $sdate_dd);";

                               $_SESSION['slctd_clb'] = $clb;
                               //get later to show availbility
                               $rslt = mysqli_query($con,$query);
                             }

            }

            //  $rslt_s = mysqli_query($con,$query);

//GETTING DATA FOR POPULATING COLUMNS in table
// $query3 = "select * from `club-info` where  CLUBNAME= '$clb';";
// $rslt_info = mysqli_query($con,$query3);
//
// $club_name = '';
// $club_pin = '';
//
//       while($row_info = mysqli_fetch_assoc($rslt_info)){
//
//            $club_name = $row_info['CLUBNAME'];
//            $club_pin = $row_info['PIN'];
//       }


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

    <title>Book your Slots</title>
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
    <br><br><br>

    <div class="text-center">
      <h1 class="white-text mb-5 mt-4 font-bold"><a class="text-dark font-bold"><strong>BOOK</strong></a><strong> YOUR</strong> <a class="text-dark font-bold"><strong> SLOTS</strong></a></h1>
    </div>
    <div class="container" style="background-color: #e0e0e0 ; padding: 60px;">
      <!-- <hr>
      <strong><h1 class="display-4">Choose Club & Slots According to your Suitablity</h1></strong> -->
      <hr>

      <?php
   if($msg != ''){
     echo "<div class=\"alert alert-danger alert-dimdissible fade show\" role=\"alert\">
   <strong>".$msg."</strong>
   <button type=\"button\" class=\"close\" data-dimdiss=\"alert\" aria-label=\"Close\">
     <span aria-hidden=\"true\">&times;</span>
   </button>
 </div>";
    }
   ?>
        <form class="" action="booking.php" method="get">

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">Choose Club</label>
            </div>
            <!-- input clubname -->
            <select class="custom-select" id="inputGroupSelect01" name="clbname">
          <option disabled selected> <?php echo $clb; ?></option>
    <?php  while ($row1 = mysqli_fetch_assoc($rslt1)) : ?>
          <option value= "<?php echo $row1['CLUBNAME']; ?>"><?php echo $row1['CLUBNAME']; ?></option>
          <?php endwhile; ?>
  </select>
          </div>


          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">Choose Date</label>
            </div>
            <!-- input date -->
            <input class="custom-select" type="date" name="sdate" id="inputGroupSelect01" required>
          </div>
          <!-- <input type="submit" class="btn btn-primary mb-2" name="booking" value="submit"> -->
          <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </form>


        <!-- my table goes here -->
        <hr class="hr-dark">
        <div class="text-center">
          <h4 class="white-text mb-5 mt-4 font-bold"><strong> <?php echo "$spt ";?></strong><a class="text-dark font-bold"><strong>AVAILABILITY FOR</strong></a><strong> <?php echo "$clb"; ?></strong> <a class="text-dark font-bold"><strong> ON <?php echo $sdate; ?></strong></a></h4>
        </div>


        <div class="container">
          <?php while($row = mysqli_fetch_assoc($rslt)) : ?>

          <div class="cointainer" style="background-color: #9e9e9e;padding: 2% 0.5% 2% 2%">

            <p class="text-center font-weight-bold">MORNING</p>

            <div class="cointainer row" style="padding: 2% 6% 2% 8%;">

              <div class="col-">
                <?php
              $a = 'A'; $t = 6;
             if($row[$a] == 'AVAILABLE'){

                  if($sdate == date("Y-m-d") && date("H") >= $t && date("i") >= 0 && date("s") >= 0){
                      echo "<button type=\"button\" class=\"btn btn-mdb-color btn-lg\" disabled >------N/A------</button>";
                    }else {
                          $_SESSION['bdate'] = $sdate; $_SESSION['bslot'] = $a;
                       echo "<form action=\"../process/user-purchase-process.php\" method=\"post\">";
                       // echo "<input type=\"hidden\" name=\"sdate\" value=\"  $sdate   \">";
                       echo "<input type=\"hidden\" name=\"slot\" value=\"  $a  \">";
                       echo "<button type=\"submit\" class=\"btn btn-success btn-lg\">07:00 - 08:00</button>";
                       echo " </form>";
                     }
              }
              elseif($row[$a] == 'BOOKED'){
               echo "<button type=\"button\" class=\"btn btn-blue-grey btn-lg\" disabled>07:00 - 08:00</button>";
              }
              else{
               echo "<button type=\"button\" class=\"btn btn-dark btn-lg\" disabled>".$row[$a]."</button>";
              }
             ?></div>
              <div class="col-">
                <?php
              $a = 'B'; $t = 7;
             if($row[$a] == 'AVAILABLE'){

                  if($sdate == date("Y-m-d") && date("H") >= $t && date("i") >= 0 && date("s") >= 0){
                      echo "<button type=\"button\" class=\"btn btn-mdb-color btn-lg\" disabled >------N/A------</button>";
                    }else {
                            $_SESSION['bdate'] = $sdate; //$_SESSION['bslot'] = $a;
                       echo "<form action=\"../process/user-purchase-process.php\" method=\"post\">";
                       // echo "<input type=\"hidden\" name=\"sdate\" value=\"  $sdate   \">";
                       echo "<input type=\"hidden\" name=\"slot\" value=\"  $a  \">";
                       echo "<button type=\"submit\" class=\"btn btn-success btn-lg\">08:00 - 09:00</button>";
                       echo " </form>";
                     }
              }
              elseif($row[$a] == 'BOOKED'){
               echo "<button type=\"button\" class=\"btn btn-blue-grey btn-lg\" disabled>08:00 - 09:00</button>";
              }
              else{
               echo "<button type=\"button\" class=\"btn btn-dark btn-lg\" disabled>".$row[$a]."</button>";
              }
             ?></div>
              <div class="col-">
                <?php
              $a = 'C'; $t = 8;
             if($row[$a] == 'AVAILABLE'){

                  if($sdate == date("Y-m-d") && date("H") >= $t && date("i") >= 0 && date("s") >= 0){
                      echo "<button type=\"button\" class=\"btn btn-mdb-color btn-lg\" disabled >------N/A------</button>";
                    }else {
                                 $_SESSION['bdate'] = $sdate; $_SESSION['bslot'] = $a;
                       echo "<form action=\"../process/user-purchase-process.php\" method=\"post\">";
                       // echo "<input type=\"hidden\" name=\"sdate\" value=\"  $sdate   \">";
                       echo "<input type=\"hidden\" name=\"slot\" value=\"  $a  \">";
                       echo "<button type=\"submit\" class=\"btn btn-success btn-lg\">09:00 - 10:00</button>";
                       echo " </form>";
                     }
              }
              elseif($row[$a] == 'BOOKED'){
               echo "<button type=\"button\" class=\"btn btn-blue-grey btn-lg\" disabled>".$row[$a]."</button>";
              }
              else{
               echo "<button type=\"button\" class=\"btn btn-dark btn-lg\" disabled>".$row[$a]."</button>";
              }
             ?></div>
              <div class="col-">
                <?php
              $a = 'D'; $t = 9;
             if($row[$a] == 'AVAILABLE'){

                  if($sdate == date("Y-m-d") && date("H") >= $t && date("i") >= 0 && date("s") >= 0){
                      echo "<button type=\"button\" class=\"btn btn-mdb-color btn-lg\" disabled >------N/A------</button>";
                    }else {
                             $_SESSION['bdate'] = $sdate; $_SESSION['bslot'] = $a;
                       echo "<form action=\"../process/user-purchase-process.php\" method=\"post\">";
                       // echo "<input type=\"hidden\" name=\"sdate\" value=\"  $sdate   \">";
                       echo "<input type=\"hidden\" name=\"slot\" value=\"  $a  \">";
                       echo "<button type=\"submit\" class=\"btn btn-success btn-lg\">10:00 - 11:00</button>";
                       echo " </form>";
                     }
              }
              elseif($row[$a] == 'BOOKED'){
               echo "<button type=\"button\" class=\"btn btn-blue-grey btn-lg\" disabled>".$row[$a]."</button>";
              }
              else{
               echo "<button type=\"button\" class=\"btn btn-dark btn-lg\" disabled>".$row[$a]."</button>";
              }
             ?></div>
              <div class="col-">
                <?php
              $a = 'E'; $t = 10;
             if($row[$a] == 'AVAILABLE'){

                  if($sdate == date("Y-m-d") && date("H") >= $t && date("i") >= 0 && date("s") >= 0){
                      echo "<button type=\"button\" class=\"btn btn-mdb-color btn-lg\" disabled >------N/A------</button>";
                    }else {
                            $_SESSION['bdate'] = $sdate; $_SESSION['bslot'] = $a;
                       echo "<form action=\"../process/user-purchase-process.php\" method=\"post\">";
                       // echo "<input type=\"hidden\" name=\"sdate\" value=\"  $sdate   \">";
                        echo "<input type=\"hidden\" name=\"slot\" value=\"  $a  \">";
                       echo "<button type=\"submit\" class=\"btn btn-success btn-lg\">11:00 - 12:00</button>";
                       echo " </form>";
                     }
              }
              elseif($row[$a] == 'BOOKED'){
               echo "<button type=\"button\" class=\"btn btn-blue-grey btn-lg\" disabled>".$row[$a]."</button>";
              }
              else{
               echo "<button type=\"button\" class=\"btn btn-dark btn-lg\" disabled>".$row[$a]."</button>";
              }
             ?></div>

            </div>
            <hr>
            <p class="text-center font-weight-bold">NOON</p>
            <div class="cointainer row" style="padding: 2% 6% 2% 8%;">

              <div class="col-">
                <?php
              $a = 'F'; $t = 11;
             if($row[$a] == 'AVAILABLE'){

                  if($sdate == date("Y-m-d") && date("H") >= $t && date("i") >= 0 && date("s") >= 0){
                      echo "<button type=\"button\" class=\"btn btn-mdb-color btn-lg\" disabled >------N/A------</button>";
                    }else {
                                 $_SESSION['bdate'] = $sdate; $_SESSION['bslot'] = $a;
                       echo "<form action=\"../process/user-purchase-process.php\" method=\"post\">";
                       // echo "<input type=\"hidden\" name=\"sdate\" value=\"  $sdate   \">";
                        echo "<input type=\"hidden\" name=\"slot\" value=\"  $a  \">";
                       echo "<button type=\"submit\" class=\"btn btn-success btn-lg\">12:00 - 13:00</button>";
                       echo " </form>";
                     }
              }
              elseif($row[$a] == 'BOOKED'){
               echo "<button type=\"button\" class=\"btn btn-blue-grey btn-lg\" disabled>".$row[$a]."</button>";
              }
              else{
               echo "<button type=\"button\" class=\"btn btn-dark btn-lg\" disabled>".$row[$a]."</button>";
              }
             ?></div>
              <div class="col-">
                <?php
              $a = 'G'; $t = 12;
             if($row[$a] == 'AVAILABLE'){

                  if($sdate == date("Y-m-d") && date("H") >= $t && date("i") >= 0 && date("s") >= 0){
                      echo "<button type=\"button\" class=\"btn btn-mdb-color btn-lg\" disabled >------N/A------</button>";
                    }else {
                           $_SESSION['bdate'] = $sdate; $_SESSION['bslot'] = $a;
                       echo "<form action=\"../process/user-purchase-process.php\" method=\"post\">";
                       // echo "<input type=\"hidden\" name=\"sdate\" value=\"  $sdate   \">";
                        echo "<input type=\"hidden\" name=\"slot\" value=\"  $a  \">";
                       echo "<button type=\"submit\" class=\"btn btn-success btn-lg\">13:00 - 14:00</button>";
                       echo " </form>";
                     }
              }
              elseif($row[$a] == 'BOOKED'){
               echo "<button type=\"button\" class=\"btn btn-blue-grey btn-lg\" disabled>".$row[$a]."</button>";
              }
              else{
               echo "<button type=\"button\" class=\"btn btn-dark btn-lg\" disabled>".$row[$a]."</button>";
              }
             ?></div>
              <div class="col-">
                <?php
              $a = 'H'; $t = 13;
             if($row[$a] == 'AVAILABLE'){

                  if($sdate == date("Y-m-d") && date("H") >= $t && date("i") >= 0 && date("s") >= 0){
                      echo "<button type=\"button\" class=\"btn btn-mdb-color btn-lg\" disabled >------N/A------</button>";
                    }else {
                            $_SESSION['bdate'] = $sdate; $_SESSION['bslot'] = $a;
                       echo "<form action=\"../process/user-purchase-process.php\" method=\"post\">";
                       // echo "<input type=\"hidden\" name=\"sdate\" value=\"  $sdate   \">";
                        echo "<input type=\"hidden\" name=\"slot\" value=\"  $a  \">";
                       echo "<button type=\"submit\" class=\"btn btn-success btn-lg\">14:00 - 15:00</button>";
                       echo " </form>";
                     }
              }
              elseif($row[$a] == 'BOOKED'){
               echo "<button type=\"button\" class=\"btn btn-blue-grey btn-lg\" disabled>".$row[$a]."</button>";
              }
              else{
               echo "<button type=\"button\" class=\"btn btn-dark btn-lg\" disabled>".$row[$a]."</button>";
              }
             ?></div>
              <div class="col-">
                <?php
              $a = 'I'; $t = 14;
             if($row[$a] == 'AVAILABLE'){

                  if($sdate == date("Y-m-d") && date("H") >= $t && date("i") >= 0 && date("s") >= 0){
                      echo "<button type=\"button\" class=\"btn btn-mdb-color btn-lg\" disabled >------N/A------</button>";
                    }else {
                                $_SESSION['bdate'] = $sdate; $_SESSION['bslot'] = $a;
                       echo "<form action=\"../process/user-purchase-process.php\" method=\"post\">";
                       // echo "<input type=\"hidden\" name=\"sdate\" value=\"  $sdate   \">";
                        echo "<input type=\"hidden\" name=\"slot\" value=\"  $a  \">";
                       echo "<button type=\"submit\" class=\"btn btn-success btn-lg\">15:00 - 16:00</button>";
                       echo " </form>";
                     }
              }
              elseif($row[$a] == 'BOOKED'){
               echo "<button type=\"button\" class=\"btn btn-blue-grey btn-lg\" disabled>".$row[$a]."</button>";
              }
              else{
               echo "<button type=\"button\" class=\"btn btn-dark btn-lg\" disabled>".$row[$a]."</button>";
              }
             ?></div>
              <div class="col-">
                <?php
              $a = 'J'; $t = 15;
             if($row[$a] == 'AVAILABLE'){

                  if($sdate == date("Y-m-d") && date("H") >= $t && date("i") >= 0 && date("s") >= 0){
                      echo "<button type=\"button\" class=\"btn btn-mdb-color btn-lg\" disabled >------N/A------</button>";
                    }else {
                                  $_SESSION['bdate'] = $sdate; $_SESSION['bslot'] = $a;
                       echo "<form action=\"../process/user-purchase-process.php\" method=\"post\">";
                       // echo "<input type=\"hidden\" name=\"sdate\" value=\"  $sdate   \">";
                        echo "<input type=\"hidden\" name=\"slot\" value=\"  $a  \">";
                       echo "<button type=\"submit\" class=\"btn btn-success btn-lg\">16:00 - 17:00</button>";
                       echo " </form>";
                     }
              }
              elseif($row[$a] == 'BOOKED'){
               echo "<button type=\"button\" class=\"btn btn-blue-grey btn-lg\" disabled>".$row[$a]."</button>";
              }
              else{
               echo "<button type=\"button\" class=\"btn btn-dark btn-lg\" disabled>".$row[$a]."</button>";
              }
             ?></div>

            </div>
            <hr>
            <p class="text-center font-weight-bold">EVENING</p>
            <div class="cointainer row" style="padding: 2% 6% 2% 8%;">

              <div class="col-">
                <?php
              $a = 'K'; $t = 16;
             if($row[$a] == 'AVAILABLE'){

                  if($sdate == date("Y-m-d") && date("H") >= $t && date("i") >= 0 && date("s") >= 0){
                      echo "<button type=\"button\" class=\"btn btn-mdb-color btn-lg\" disabled >------N/A------</button>";
                    }else {
                          $_SESSION['bdate'] = $sdate; $_SESSION['bslot'] = $a;
                       echo "<form action=\"../process/user-purchase-process.php\" method=\"post\">";
                       // echo "<input type=\"hidden\" name=\"sdate\" value=\"  $sdate   \">";
                        echo "<input type=\"hidden\" name=\"slot\" value=\"  $a  \">";
                       echo "<button type=\"submit\" class=\"btn btn-success btn-lg\">17:00 - 18:00</button>";
                       echo " </form>";
                     }
              }
              elseif($row[$a] == 'BOOKED'){
               echo "<button type=\"button\" class=\"btn btn-blue-grey btn-lg\" disabled>".$row[$a]."</button>";
              }
              else{
               echo "<button type=\"button\" class=\"btn btn-dark btn-lg\" disabled>".$row[$a]."</button>";
              }
             ?></div>
              <div class="col-">
                <?php
              $a = 'L'; $t = 17;
             if($row[$a] == 'AVAILABLE'){

                  if($sdate == date("Y-m-d") && date("H") >= $t && date("i") >= 0 && date("s") >= 0){
                      echo "<button type=\"button\" class=\"btn btn-mdb-color btn-lg\" disabled >------N/A------</button>";
                    }else {
                                $_SESSION['bdate'] = $sdate; $_SESSION['bslot'] = $a;
                       echo "<form action=\"../process/user-purchase-process.php\" method=\"post\">";
                       // echo "<input type=\"hidden\" name=\"sdate\" value=\"  $sdate   \">";
                        echo "<input type=\"hidden\" name=\"slot\" value=\"  $a  \">";
                       echo "<button type=\"submit\" class=\"btn btn-success btn-lg\">18:00 - 19:00</button>";
                       echo " </form>";
                     }
              }
              elseif($row[$a] == 'BOOKED'){
               echo "<button type=\"button\" class=\"btn btn-blue-grey btn-lg\" disabled>".$row[$a]."</button>";
              }
              else{
               echo "<button type=\"button\" class=\"btn btn-dark btn-lg\" disabled>".$row[$a]."</button>";
              }
             ?></div>
              <div class="col-">
                <?php
              $a = 'M'; $t = 18;
             if($row[$a] == 'AVAILABLE'){

                  if($sdate == date("Y-m-d") && date("H") >= $t && date("i") >= 0 && date("s") >= 0){
                      echo "<button type=\"button\" class=\"btn btn-mdb-color btn-lg\" disabled >------N/A------</button>";
                    }else {
                               $_SESSION['bdate'] = $sdate; $_SESSION['bslot'] = $a;
                       echo "<form action=\"../process/user-purchase-process.php\" method=\"post\">";
                       // echo "<input type=\"hidden\" name=\"sdate\" value=\"  $sdate   \">";
                        echo "<input type=\"hidden\" name=\"slot\" value=\"  $a  \">";
                       echo "<button type=\"submit\" class=\"btn btn-success btn-lg\">19:00 - 20:00</button>";
                       echo " </form>";
                     }
              }
              elseif($row[$a] == 'BOOKED'){
               echo "<button type=\"button\" class=\"btn btn-blue-grey btn-lg\" disabled>".$row[$a]."</button>";
              }
              else{
               echo "<button type=\"button\" class=\"btn btn-dark btn-lg\" disabled>".$row[$a]."</button>";
              }
             ?></div>
              <div class="col-">
                <?php
              $a = 'N'; $t = 19;
             if($row[$a] == 'AVAILABLE'){

                  if($sdate == date("Y-m-d") && date("H") >= $t && date("i") >= 0 && date("s") >= 0){
                      echo "<button type=\"button\" class=\"btn btn-mdb-color btn-lg\" disabled >------N/A------</button>";
                    }else {
                                 $_SESSION['bdate'] = $sdate; $_SESSION['bslot'] = $a;
                       echo "<form action=\"../process/user-purchase-process.php\" method=\"post\">";
                       // echo "<input type=\"hidden\" name=\"sdate\" value=\"  $sdate   \">";
                        echo "<input type=\"hidden\" name=\"slot\" value=\"  $a  \">";
                       echo "<button type=\"submit\" class=\"btn btn-success btn-lg\">20:00 - 21:00</button>";
                       echo " </form>";
                     }
              }
              elseif($row[$a] == 'BOOKED'){
               echo "<button type=\"button\" class=\"btn btn-blue-grey btn-lg\" disabled>".$row[$a]."</button>";
              }
              else{
               echo "<button type=\"button\" class=\"btn btn-dark btn-lg\" disabled>".$row[$a]."</button>";
              }
             ?></div>
              <div class="col-">
                <?php
              $a = 'O'; $t = 20;
             if($row[$a] == 'AVAILABLE'){

                  if($sdate == date("Y-m-d") && date("H") >= $t && date("i") >= 0 && date("s") >= 0){
                      echo "<button type=\"button\" class=\"btn btn-mdb-color btn-lg\" disabled >------N/A------</button>";
                    }else {
                                $_SESSION['bdate'] = $sdate; $_SESSION['bslot'] = $a;
                       echo "<form action=\"../process/user-purchase-process.php\" method=\"post\">";
                       // echo "<input type=\"hidden\" name=\"sdate\" value=\"  $sdate   \">";
                        echo "<input type=\"hidden\" name=\"slot\" value=\"  $a  \">";
                       echo "<button type=\"submit\" class=\"btn btn-success btn-lg\">21:00 - 22:00</button>";
                       echo " </form>";
                     }
              }
              elseif($row[$a] == 'BOOKED'){
               echo "<button type=\"button\" class=\"btn btn-blue-grey btn-lg\" disabled>".$row[$a]."</button>";
              }
              else{
               echo "<button type=\"button\" class=\"btn btn-dark btn-lg\" disabled>".$row[$a]."</button>";
              }
             ?></div>
            </div>

          </div>
          <?php endwhile; ?>

        </div>
    </div>
    <!-- main cointainer -->

    <!--Footer-->

    <footer class="page-footer stylish-color-dark" style=" width: 100%; margin-top: 4%;">

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
          <!-- <li><a class="btn-floating btn-md rgba-white-slight mr-xl-4"><i class="fa fa-facebook"></i></a></li> -->
          <!-- <li><a class="btn-floating btn-md rgba-white-slight mr-xl-4"><i class="fa fa-twitter"></i></a></li> -->
          <!-- <li><a class="btn-floating btn-md rgba-white-slight mr-xl-4"><i class="fa fa-google-plus"></i></a></li> -->
          <!-- <li><a class="btn-floating btn-md rgba-white-slight mr-xl-4"><i class="fa fa-linkedin"></i></a></li> -->
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
