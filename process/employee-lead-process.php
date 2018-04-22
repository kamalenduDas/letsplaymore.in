<?php
include '../database/database.php';
session_start();

if(isset($_POST['empchk'])){

   $clubname = rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_POST['clubname']))," \t ")," \t ");

   $pin = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['pin'])," \t ")," \t ");
   preg_match_all('!\d+!', $pin, $matches);
   $pin = implode(' ', $matches[0]);

           if(!isset($clubname) || $clubname == '' || !isset($pin) || $pin == '' ){
             $error="There's somthing wrong in the fields";
             header('Location: ../employee/employee-view.php?error='.urlencode($error));
             exit();
           }
           else{
            $inquery = "SELECT * FROM `club-info` WHERE CLUBNAME ='$clubname' AND PIN='$pin'";
                  if(mysqli_query($con,$inquery)){
                        $inq_rslt = mysqli_query($con,$inquery);
                         if(mysqli_num_rows($inq_rslt)){
                           $error="The Club Already Exists";
                           header('Location: ../employee/employee-view.php?error='.urlencode($error));
                           exit();
                         }
                         else{
                           $error="Ok For insertion";
                           header('Location: ../employee/employee-view.php?error='.urlencode($error));
                           exit();

                             }
                  }
                  else{
                        mysqli_error($con);

                      }
           }

}


if(isset($_POST['empsubmit'])){

    $fname = rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_POST['fname']))," \t ")," \t ");
    $sname = rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_POST['sname']))," \t ")," \t ");
    $email = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['email'])," \t ")," \t ");
    $pass  = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['pass'])," \t ")," \t ");
    $clubname = rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_POST['clubname']))," \t ")," \t ");
    $sport = rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_POST['spt']))," \t ")," \t ");
    $address = rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_POST['addr']))," \t ")," \t ");
    $amntes = rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_POST['amnts']))," \t ")," \t ");
    $contact = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['contact'])," \t ")," \t ");

    $pin = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['pin'])," \t ")," \t ");
    preg_match_all('!\d+!', $pin, $matches);
    $pin = implode(' ', $matches[0]);

    $price = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['price'])," \t ")," \t ");
    preg_match_all('!\d+!', $price, $matche);
    $price = implode(' ', $matche[0]);


    if(!isset($fname) || $fname == '' || !isset($sname) || $sname == '' ||
       !isset($email) || $email == '' || !isset($pass) || $pass == '' ||
       !isset($clubname) || $clubname == '' || !isset($sport) || $sport == '' ||
       !isset($address) || $address == '' || !isset($amntes) || $amntes == '' ||
       !isset($contact) || $contact == ''|| strlen($contact) > 10 || strlen($contact) < 10 ){

         $succ="There's somthing wrong in the fields";
         header('Location: ../employee/employee-view.php?succ='.urlencode($succ));
         exit();
       }
       else{

              $cid = random_int ( 1111111111 , 9999999999 );
              $query1 = "SELECT `CID` FROM `owner-info` where `CID` = '$cid'";
                           $rslt1 =  mysqli_query($con,$query1);

                             while( mysqli_num_rows($rslt1) != 0 ) {
                                                          // loops till an unique value is found
                                           $cid = random_int ( 1111111111 , 9999999999 );
                                           $rslt1 = mysqli_query($con,$query1);
                                        }
                                        echo "INSERTED"."$cid";

              $query2 = "INSERT INTO `club-info` VALUES ($cid,'$clubname','$sport','$address',$pin,$price,'$amntes')";
              $query3 = "INSERT INTO  `owner-info` VALUES ('$fname','$sname','$email','$pass','$contact','$clubname',$cid,0)";
              $query2_remove = "DELETE FROM `club-info` WHERE `cid`=$cid";
              $query3_remove = "DELETE FROM `owner-info` WHERE `cid`=$cid";

              if(mysqli_query($con,$query2)){
                  if(mysqli_query($con,$query3)){
                    //head to somewhere
                  }
                  else{
                    mysqli_query($con,$query2_remove);
                  }
              }
              echo mysqli_error($con);
           }

    // $sql_club = "INSERT INTO `club-info` VALUES "
}









 ?>
