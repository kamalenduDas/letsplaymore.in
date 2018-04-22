<?php
include '../database/database.php';
session_start();

if(isset($_POST['adminSubmit'])){

          $id = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['id'])," \t ")," \t ");
          $pass = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['pass'])," \t ")," \t ");

          $sql = "SELECT `EMPID` FROM `emply-info` WHERE `EMAIL` = '$id' and `PASS` = '$pass' and `ACCS` = '1' ";
          $rslt = mysqli_query($con,$sql);

          // $num = mysql_num_rows($rslt);

               while($row1 = mysqli_fetch_assoc($rslt)){
                   $admid =  $row1["EMPID"];
                 }

        $count = mysqli_num_rows($rslt);


        //  If result matched $myusername and $mypassword, table row must be 1 row

           if($count == 1){

                     $_SESSION['admid'] = $admid;
                       header("location: /admin/admin.php");
              }
           else {
                $error = "Your Login Name or Password is invalid";
                header('location: /admin/admin_login.php?succ='.urlencode($error));
            }



}






 ?>
