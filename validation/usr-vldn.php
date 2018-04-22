<?php
include '../database/database.php';
session_start();
   if(isset($_POST['usersubmit'])) {
      // username and password sent from form

              $email = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['email'])," \t ")," \t ");

              $pass = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['pass'])," \t ")," \t ");

              

         $sql = "SELECT `UID` FROM `user-info` WHERE `EMAIL` = '$email' and `PASS` = '$pass'";
         $rslt = mysqli_query($con,$sql);

              while($row1 = mysqli_fetch_assoc($rslt)){
                  $uid =  $row1["UID"];


                }

     $count = mysqli_num_rows($rslt);


    //  If result matched $myusername and $mypassword, table row must be 1 row

          if($count == 1){

                  if(isset($_SESSION['bdate'])){
                     $_SESSION['uid'] = $uid;
                    header("location: ../process/user-purchase-process.php");
                   }
                  else{
                    $_SESSION['uid'] = $uid;
                    header("location: ../index.php");
                      }

      }else {
         $error = "Your Login Name or Password is invalid";
         header('location: ../user/user-login.php?succ='.urlencode($error));
      }
   }



 ?>
