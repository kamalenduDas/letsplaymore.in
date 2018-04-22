<?php
include '../database/database.php';
session_start();

if(isset($_POST['slot'])){
$_SESSION['bslot'] = $_POST['slot'];
}

if(!isset($_SESSION['uid']) || $_SESSION['uid']==0){
  $error = "Please Login To Make the purchase";
  header('location: ../user/user-login.php?succ='.urlencode($error));
}
$uid = $_SESSION['uid'];
$clb = $_SESSION['slctd_clb'];
$bdate = $_SESSION['bdate'];
$bslot = $_SESSION['bslot'];
$bsport = $_SESSION["spt"];
$cid = 0;

$c_sql = "SELECT `CID` FROM `club-info` WHERE `CLUBNAME` = '$clb';";

$rslt = mysqli_query($con,$c_sql);
while ($row = mysqli_fetch_assoc($rslt)) {
  $cid = $row['CID'];
}
    $bdate_yy = (int)substr($bdate,0,4);

    $bdate_mm = (int)substr($bdate,5,2);

    $bdate_dd = (int)substr($bdate,8,2);

$u_query = "INSERT INTO `user-book-info` (`UID`,`CID`,`BSPORT`,`BDATE`,`BSLOT`) VALUES
($uid,$cid,'$bsport',STR_TO_DATE('$bdate', '%Y-%m-%d'),'$bslot')";

$status = 'BOOKED';

$b_query = "UPDATE `book-info` SET ".$bslot."= '$status' WHERE ( CLUBNAME= '$clb' AND YEAR(DATE)=$bdate_yy AND MONTH(DATE)=$bdate_mm
  AND DAY(DATE) = $bdate_dd);" ;


if(!mysqli_query($con,$u_query) || !mysqli_query($con,$b_query)){
  //die(mysqli_error($con));
  echo "Already Booked This Slot!";
}
else{
  $msg = "Success In Booking!";
  header('Location: ../user/buy-details.php?succ='.urlencode($msg));
}
    // echo "uid : " . $uid;
    // echo "\n";
    // echo " date :".$_SESSION['bdate'];
    // echo "\n";
    // echo "slot :".$bslot;
    // echo "\n";
    // echo " club ID: ".$cid;
    // echo "\n";
    // echo "club name :".$clb;
    // u_sql = "INSERT INTO `user-book-info` "



 ?>
