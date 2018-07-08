<?php session_start();
 include '../database/database.php';
 date_default_timezone_set("India/Kolkata");

  $cid = $_SESSION['cid'];
  $clb = $_SESSION['clubname'];
  $spt = $_SESSION['spt'];

  $date = date('Y-m-d');
  $s_date = date_create($date);
  date_add($s_date, date_interval_create_from_date_string('31 days'));
  $sdate = date_format($s_date, 'Y-m-d');

  $query="SELECT * FROM `club-info` WHERE `CID`= $cid";
  $rslt1 = mysqli_query($con,$query);
  if(mysqli_num_rows($rslt1) == 0){
    header('Location: mbr-sports-insert.php');
     exit();
  }

  if(!isset($_SESSION['cid'])){
         $error = "Please Login To Alter your availbility informtion !";
         header('Location: member-login.php?error='.urlencode($error));

      }

        elseif(isset($_GET['alterBtn'])){

            $sdate = $_GET['sdate'];
            $spt = $_GET['sptname'];
            //echo $spt;
          }
          elseif(isset($_GET['succ'])){

           $time = strtotime($_GET['succ']);

           $sdate = date('Y-m-d',$time);
          }

 if($sdate < date("Y-m-d")){
     $msg = "Can't alter past data !";

     }
     elseif(floor((strtotime($sdate) - strtotime(date("Y-m-d")))/(24*60*60)) <= 30
         || floor((strtotime($sdate) - strtotime(date("Y-m-d")))/(24*60*60)) >= 60){
        $msg = "Must be Minimum 30 & Maximun 60 days prior to alter booking data!";
      }
       else{


             $sdate_yy = (int)substr($sdate,0,4);

             $sdate_mm = (int)substr($sdate,5,2);

             $sdate_dd = (int)substr($sdate,8,2);


           
        $query = "select * from `book-info` where ( CID= $cid AND SPORT = '$spt' AND  YEAR(DATE)=$sdate_yy AND MONTH(DATE)=$sdate_mm
        AND DAY(DATE) = $sdate_dd);";

        $query2 = "INSERT INTO `book-info` (`CID`,`SPORT`,`DATE`) VALUES ($cid,'$spt',STR_TO_DATE('$sdate', '%Y-%m-%d'));";

        if(!mysqli_query($con, $query2)){
            echo "Error query2-----";
            echo $cid."----";
            echo $spt."----";
            echo $sdate."----";
        }
        if(!mysqli_query($con,$query)){
          echo "error query-----";
        }
        $rslt = mysqli_query($con,$query);
            //  echo $spt;
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
    <title>Alter Availability</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">Lets Play</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</div>
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
    <li >
      <a class=\"dropdown-item\" href="../logout.php">Logout</a>
    </div>
    </li>
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
  </div>
</nav>
  <body>
    <div class="container">
       <!-- choosing club -->
  <br><br>
         <div class="container" style="background-color: #e0e0e0 ; padding: 60px;">

           <h1 class="display-4" ><?php  echo " Manage Time Slots For ". $sdate; ?></h1>


           <form class="" action="alter-book.php" method="get">
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
             <input type="date" name="sdate" required>
             <input type="submit" name="alterBtn" >
           </form>
         <hr>
             <div class="container">
               <?php
                  if($msg){
                  echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                   <strong> $msg </strong>
                   <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                     <span aria-hidden=\"true\">&times;</span>
                   </button>
                   </div>";

                  }
                  elseif(isset($_GET['succ'])){
                    echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                     <strong> Successfully Altered Time Slot</strong>
                     <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                       <span aria-hidden=\"true\">&times;</span>
                     </button>
                     </div>";
                  }


                ?>
                    <!-- my table goes here -->
                    <div class="">
                     <h3 class="display-5" style="padding:20px;">Showing Availability Information </h3>
                      <hr>
                    </div>
                    <div class="card">
                        <div class="card-body">



                                <!--Table-->
                                <table class="table table-responsive-md table-striped table-hover">
                                    <thead class="mdb-color darken-3">
                                        <tr>
                                            <!-- <th class="th-lg" style="color: white;">Clubname</th> -->
                                            <th class="th-lg" style="color: white;">Date</th>
                                            <th class="th-lg" style="color: white;">Time</th>
                                            <th class="th-lg" style="color: white;">Availability</th>

                                        </tr>
                                    </thead>
                                    <?php while($row = mysqli_fetch_assoc($rslt)) : ?>
                                    <tbody>

                                        <tr>

                                            <!-- <td><?php echo  $clb; ?></td> -->
                                            <td><?php echo $sdate; ?></td>
                                            <td>07:00 -- 08:00</td>

                                            <td>
                                              <?php
                                              $a = 'A';
                                             if($row[$a] == 'AVAILABLE'){

                                               echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                               echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                               echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                               echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-success\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                               echo "</form>";

                                              }
                                              elseif($row[$a] == 'BOOKED'){
                                               echo "<button type=\"button\" class=\"btn btn-blue-grey\" style=\"padding: 13px 50px 13px 50px;\" disabled>".$row[$a]."</button>";
                                              }
                                              else{
                                                echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                                echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                                echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                                echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-elegant\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                                echo "</form>";
                                              }
                                             ?>
                                           </td>
                                        </tr>
                                        <tr>

                                            <!-- <td><?php echo  $clb; ?></td> -->

                                            <td><?php echo $sdate; ?></td>
                                            <td>08:00 -- 09:00</td>
                                            <td>
                                              <?php
                                              $a = 'B';
                                             if($row[$a] == 'AVAILABLE'){

                                               echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                               echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                               echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                               echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-success\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                               echo "</form>";

                                              }
                                              elseif($row[$a] == 'BOOKED'){
                                               echo "<button type=\"button\" class=\"btn btn-blue-grey\" style=\"padding: 13px 50px 13px 50px;\" disabled>".$row[$a]."</button>";
                                              }
                                              else{
                                                echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                                echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                                echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                                echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-elegant\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                                echo "</form>";
                                              }
                                             ?>
                                           </td>

                                        </tr>
                                        <tr>

                                            <!-- <td><?php echo  $clb; ?></td> -->

                                            <td><?php echo $sdate; ?></td>
                                            <td>09:00 -- 10:00</td>
                                            <td>
                                              <?php
                                              $a = 'C';
                                             if($row[$a] == 'AVAILABLE'){

                                               echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                               echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                               echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                               echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-success\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                               echo "</form>";

                                              }
                                              elseif($row[$a] == 'BOOKED'){
                                               echo "<button type=\"button\" class=\"btn btn-blue-grey\" style=\"padding: 13px 50px 13px 50px;\" disabled>".$row[$a]."</button>";
                                              }
                                              else{
                                                echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                                echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                                echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                                echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-elegant\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                                echo "</form>";
                                              }
                                             ?>
                                           </td>

                                        </tr>
                                        <tr>

                                            <!-- <td><?php echo  $clb; ?></td> -->

                                            <td><?php echo $sdate; ?></td>
                                            <td>10:00 -- 11:00</td>
                                            <td>
                                              <?php
                                              $a = 'D';
                                             if($row[$a] == 'AVAILABLE'){

                                               echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                               echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                               echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                               echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-success\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                               echo "</form>";

                                              }
                                              elseif($row[$a] == 'BOOKED'){
                                               echo "<button type=\"button\" class=\"btn btn-blue-grey\" style=\"padding: 13px 50px 13px 50px;\" disabled>".$row[$a]."</button>";
                                              }
                                              else{
                                                echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                                echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                                echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                                echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-elegant\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                                echo "</form>";
                                              }
                                             ?>
                                           </td>

                                        </tr>
                                        <tr>

                                            <!-- <td><?php echo  $clb; ?></td> -->

                                            <td><?php echo $sdate; ?></td>
                                            <td>11:00 -- 12:00</td>
                                            <td>
                                              <?php
                                              $a = 'E';
                                             if($row[$a] == 'AVAILABLE'){

                                               echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                               echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                               echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                               echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-success\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                               echo "</form>";

                                              }
                                              elseif($row[$a] == 'BOOKED'){
                                               echo "<button type=\"button\" class=\"btn btn-blue-grey\" style=\"padding: 13px 50px 13px 50px;\" disabled>".$row[$a]."</button>";
                                              }
                                              else{
                                                echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                                echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                                echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                                echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-elegant\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                                echo "</form>";
                                              }
                                             ?>
                                           </td>

                                        </tr>
                                        <tr>

                                            <!-- <td><?php echo  $clb; ?></td> -->

                                            <td><?php echo $sdate; ?></td>
                                            <td>12:00 -- 13:00</td>
                                            <td>
                                              <?php
                                              $a = 'F';
                                             if($row[$a] == 'AVAILABLE'){

                                               echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                               echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                               echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                               echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-success\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                               echo "</form>";

                                              }
                                              elseif($row[$a] == 'BOOKED'){
                                               echo "<button type=\"button\" class=\"btn btn-blue-grey\" style=\"padding: 13px 50px 13px 50px;\" disabled>".$row[$a]."</button>";
                                              }
                                              else{
                                                echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                                echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                                echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                                echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-elegant\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                                echo "</form>";
                                              }
                                             ?>
                                           </td>

                                        </tr>
                                        <tr>

                                            <!-- <td><?php echo  $clb; ?></td> -->

                                            <td><?php echo $sdate; ?></td>
                                            <td>13:00 -- 14:00</td>
                                            <td>
                                              <?php
                                              $a = 'G';
                                             if($row[$a] == 'AVAILABLE'){

                                               echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                               echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                               echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                               echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-success\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                               echo "</form>";

                                              }
                                              elseif($row[$a] == 'BOOKED'){
                                               echo "<button type=\"button\" class=\"btn btn-blue-grey\" style=\"padding: 13px 50px 13px 50px;\" disabled>".$row[$a]."</button>";
                                              }
                                              else{
                                                echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                                echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                                echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                                echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-elegant\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                                echo "</form>";
                                              }
                                             ?>
                                           </td>

                                        </tr>
                                        <tr>

                                            <!-- <td><?php echo  $clb; ?></td> -->

                                            <td><?php echo $sdate; ?></td>
                                            <td>14:00 -- 15:00</td>
                                            <td>
                                              <?php
                                              $a = 'H';
                                             if($row[$a] == 'AVAILABLE'){

                                               echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                               echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                               echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                               echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-success\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                               echo "</form>";

                                              }
                                              elseif($row[$a] == 'BOOKED'){
                                               echo "<button type=\"button\" class=\"btn btn-blue-grey\" style=\"padding: 13px 50px 13px 50px;\" disabled>".$row[$a]."</button>";
                                              }
                                              else{
                                                echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                                echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                                echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                                echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-elegant\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                                echo "</form>";
                                              }
                                             ?>
                                           </td>

                                        </tr>
                                        <tr>

                                            <!-- <td><?php echo  $clb; ?></td> -->

                                            <td><?php echo $sdate; ?></td>
                                            <td>15:00 -- 16:00</td>
                                            <td>
                                              <?php
                                              $a = 'I';
                                             if($row[$a] == 'AVAILABLE'){

                                               echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                               echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                               echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                               echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-success\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                               echo "</form>";

                                              }
                                              elseif($row[$a] == 'BOOKED'){
                                               echo "<button type=\"button\" class=\"btn btn-blue-grey\" style=\"padding: 13px 50px 13px 50px;\" disabled>".$row[$a]."</button>";
                                              }
                                              else{
                                                echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                                echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                                echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                                echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-elegant\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                                echo "</form>";
                                              }
                                             ?>
                                           </td>

                                        </tr>
                                        <tr>

                                            <!-- <td><?php echo  $clb; ?></td> -->

                                            <td><?php echo $sdate; ?></td>
                                            <td>16:00 -- 17:00</td>
                                            <td>
                                              <?php
                                              $a = 'J';
                                             if($row[$a] == 'AVAILABLE'){

                                               echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                               echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                               echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                               echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-success\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                               echo "</form>";

                                              }
                                              elseif($row[$a] == 'BOOKED'){
                                               echo "<button type=\"button\" class=\"btn btn-blue-grey\" style=\"padding: 13px 50px 13px 50px;\" disabled>".$row[$a]."</button>";
                                              }
                                              else{
                                                echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                                echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                                echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                                echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-elegant\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                                echo "</form>";
                                              }
                                             ?>
                                           </td>

                                        </tr>
                                        <tr>

                                            <!-- <td><?php echo  $clb; ?></td> -->

                                            <td><?php echo $sdate; ?></td>
                                            <td>17:00 -- 18:00</td>
                                            <td>
                                              <?php
                                              $a = 'K';
                                             if($row[$a] == 'AVAILABLE'){

                                               echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                               echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                               echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                               echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-success\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                               echo "</form>";

                                              }
                                              elseif($row[$a] == 'BOOKED'){
                                               echo "<button type=\"button\" class=\"btn btn-blue-grey\" style=\"padding: 13px 50px 13px 50px;\" disabled>".$row[$a]."</button>";
                                              }
                                              else{
                                                echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                                echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                                echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                                echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-elegant\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                                echo "</form>";
                                              }
                                             ?>
                                           </td>

                                        </tr>
                                        <tr>

                                            <!-- <td><?php echo  $clb; ?></td> -->

                                            <td><?php echo $sdate; ?></td>
                                            <td>18:00 -- 19:00</td>
                                            <td>
                                              <?php
                                              $a = 'L';
                                             if($row[$a] == 'AVAILABLE'){

                                               echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                               echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                               echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                               echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-success\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                               echo "</form>";

                                              }
                                              elseif($row[$a] == 'BOOKED'){
                                               echo "<button type=\"button\" class=\"btn btn-blue-grey\" style=\"padding: 13px 50px 13px 50px;\" disabled>".$row[$a]."</button>";
                                              }
                                              else{
                                                echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                                echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                                echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                                echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-elegant\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                                echo "</form>";
                                              }
                                             ?>
                                           </td>

                                        </tr>
                                        <tr>

                                            <!-- <td><?php echo  $clb; ?></td> -->

                                            <td><?php echo $sdate; ?></td>
                                            <td>19:00 -- 20:00</td>
                                            <td>
                                              <?php
                                              $a = 'M';
                                             if($row[$a] == 'AVAILABLE'){

                                               echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                               echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                               echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                               echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-success\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                               echo "</form>";

                                              }
                                              elseif($row[$a] == 'BOOKED'){
                                               echo "<button type=\"button\" class=\"btn btn-blue-grey\" style=\"padding: 13px 50px 13px 50px;\" disabled>".$row[$a]."</button>";
                                              }
                                              else{
                                                echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                                echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                                echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                                echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-elegant\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                                echo "</form>";
                                              }
                                             ?>
                                           </td>

                                        </tr>
                                        <tr>

                                            <!-- <td><?php echo  $clb; ?></td> -->

                                            <td><?php echo $sdate; ?></td>
                                            <td>20:00 -- 21:00</td>
                                            <td>
                                              <?php
                                              $a = 'N';
                                             if($row[$a] == 'AVAILABLE'){

                                               echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                               echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                               echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                               echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-success\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                               echo "</form>";

                                              }
                                              elseif($row[$a] == 'BOOKED'){
                                               echo "<button type=\"button\" class=\"btn btn-blue-grey\" style=\"padding: 13px 50px 13px 50px;\" disabled>".$row[$a]."</button>";
                                              }
                                              else{
                                                echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                                echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                                echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                                echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-elegant\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                                echo "</form>";
                                              }
                                             ?>
                                           </td>

                                        </tr>
                                        <tr>

                                            <!-- <td><?php echo  $clb; ?></td> -->

                                            <td><?php echo $sdate; ?></td>
                                            <td>21:00 -- 22:00</td>
                                            <td>
                                              <?php
                                              $a = 'O';
                                             if($row[$a] == 'AVAILABLE'){

                                               echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                               echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                               echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                               echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-success\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                               echo "</form>";

                                              }
                                              elseif($row[$a] == 'BOOKED'){
                                               echo "<button type=\"button\" class=\"btn btn-blue-grey\" style=\"padding: 13px 50px 13px 50px;\" disabled>".$row[$a]."</button>";
                                              }
                                              else{
                                                echo "<form action=\"../process/member-alter-process.php\" method=\"post\">";
                                                echo "<input type=\"hidden\" name=\"date\" value=\"$sdate\">";
                                                echo  "<input type=\"hidden\" name=\"slot\" value=\"$a\">";
                                                echo "<button type=\"submit\" id=\"btnAlter\" class=\"btn btn-elegant\" style=\"padding: 12px 45px 12px 41px;\" value=\"$row[$a]\" name=\"slot-book\">$row[$a]</button>";
                                                echo "</form>";
                                              }
                                             ?>
                                           </td>

                                        </tr>

                                    </tbody>
                                  <?php endwhile; ?>
                                </table>
                                <!--Table-->



                              </div>
                        </div>
                    </div>







                    <!-- my table goes here -->

               </div>
               <div class="block2" style="margin-top: 50px;">
                  <h2>TERMS & CONDITIONS FOR PRIOR UNVAILABILITY</h2>
                  <p>1. Past Booking Information cant Be Changed.
                  </br>2. Difference Between Today & Prior unavailabilty is Minimum 30 days.
                </br>3. Difference Between Today & Future unavilability is maximum 60 days </p>


               </div>

             </div>

           </div>
             <!-- more entry for time slots -->

   </div>
  </body>
  <div class="" style="height: 100px;">

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
              <p><i class="fa fa-home mr-3"></i>SM Bose Road, Sankar Bagan</p>
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
