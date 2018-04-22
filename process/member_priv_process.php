<?php
include '../database/database.php';
session_start();

// $cid = $_POST['cid'];
// echo "hello";
     $cid = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['cid'])," \t ")," \t ");
     preg_match_all('!\d+!', $cid, $matches);
     $cid = implode(' ', $matches[0]);

// echo $cid;

  if(isset($_POST['grant'])){

     $sql = "UPDATE `club-info` SET `MBR`= 1 WHERE `CID`= $cid";
     mysqli_query($con,$sql);
     header('Location: /admin/admin.php');
  }
  else if(isset($_POST['revoke'])){
    $sql = "UPDATE `club-info` SET `MBR`= 0 WHERE `CID`= $cid";
    mysqli_query($con,$sql);
    header('Location: /admin/admin.php');

  }
  else if(isset($_POST['delete'])){
    $sql = "DELETE FROM `club-info` WHERE `CID` = $cid";
    mysqli_query($con,$sql);
    header('Location: /admin/admin.php');

  }


 ?>
