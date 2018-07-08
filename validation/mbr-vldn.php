<?php
include '../database/database.php';

//include("config.php");
   session_start();
$cid = 0; $club = '';
   if(isset($_POST['ownersubmit'])) {
      // username and password sent from form

              $email = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['email'])," \t ")," \t ");
            //  echo "$email";
              $pass = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['pass'])," \t ")," \t ");
            //  echo "$pass";

         $sql = "SELECT * FROM `owner-info`,`club-info` WHERE (`owner-info`.`CID`=`club-info`.`CID` AND `EMAIL` = '$email' and `PASS` = '$pass')";

         $rslt = mysqli_query($con,$sql);

              while($row1 = mysqli_fetch_assoc($rslt)){
                  $cid =  $row1["CID"];
                  $club = $row1["CLUBNAME"];
                  $spt = $row1['SPORT1'];

                }

     $count = mysqli_num_rows($rslt);


    //  If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {

        $_SESSION['cid'] = $cid;
        $_SESSION['club'] = $club;
        $_SESSION['email'] = $email;
        $_SESSION['spt'] = $spt;
        $sql_club = "SELECT `CLUBNAME` FROM `club-info` WHERE `CID` = '$cid'";
        $rslt_club = mysqli_query($con,$sql_club);
        $count_club = mysqli_num_rows($rslt_club);
            if($count_club >= 1){
              header("location: ../member/member-view.php");

            }
            else {
              header("location: ../member/mbr-sports-insert.php");
            }

        // echo "$cid ";
      }else {
         $error = "Your Login Name or Password is invalid";
         header('location: ../member/member-login.php?succ='.urlencode($error));
      }
   }



 ?>
