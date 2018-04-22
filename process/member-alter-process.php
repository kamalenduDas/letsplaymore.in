<?php
 session_start();
include '../database/database.php';

$clb = '';
$sdate = date("Y-m-d");
$status = '';

if(isset($_POST['slot-book'])){
$cid = $_SESSION['cid'];

$sdate = $_POST['date'];
$col = rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_POST['slot']))," \t ")," \t ");
$status_old = rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_POST['slot-book']))," \t ")," \t ");
$a = "AVAILABLE";

if((preg_match('/^BOOKED/', $status_old, $match))){
           $status = "BOOKED";
         }
    elseif( strcmp($status_old,$a) == 0){
             $status = "UNAVAILABLE";
             echo $status;

        }
        else{
          
          $status = "AVAILABLE";
          echo $status;
        }

}

$sdate_yy = (int)substr($sdate,0,4);

$sdate_mm = (int)substr($sdate,5,2);

$sdate_dd = (int)substr($sdate,8,2);
if(!isset($_SESSION['cid'])){
  $msg = "Invalid clubname";
  header('Location: ../member/alter-book.php?succ='.urlencode($msg));
  exit();
}else {

  $query3 = "UPDATE `book-info` SET ".$col."= '$status' WHERE ( CLUBNAME= (SELECT `CLUBNAME` FROM `owner-info`
      WHERE `CID`='$cid') AND YEAR(DATE)=$sdate_yy AND MONTH(DATE)=$sdate_mm
  AND DAY(DATE) = $sdate_dd);" ;
}


if(!mysqli_query($con, $query3)){

  die('error :'.mysqli_error($con));
}
else{
  $succ = $sdate;
  header('Location: ../member/alter-book.php?succ='.urlencode($succ));
  exit();

}

 ?>
