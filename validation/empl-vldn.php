<?php
include '../database/database.php';
session_start();

$eid = 0;
   if(isset($_POST['emplsubmit'])) {
      // username and password sent from form

              $email = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['email'])," \t ")," \t ");

              $pass = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['pass'])," \t ")," \t ");


         $sql = "SELECT `EMPID` FROM `emply-info` WHERE `EMAIL` = '$email' and `PASS` = '$pass'";
         $rslt = mysqli_query($con,$sql);

              while($row1 = mysqli_fetch_assoc($rslt)){

                  $eid =  $row1["EMPID"];
                  }

     $count = mysqli_num_rows($rslt);


    //  If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1){

        $_SESSION['eid'] = $eid;
  
              header("location: ../employee/employee-view.php");
          }
          else {
         $error = "Your Login Name or Password is invalid";
        header('location: ../employee/employee-login.php?succ='.urlencode($error));
      }
   }
   else{
     header("location: ../employee/employee-login.php");
   }



 ?>
