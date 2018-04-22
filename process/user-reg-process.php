
<?php include '../database/database.php';
session_start();
 //check for submission

 if(isset($_POST['submit'])){



     $fname = rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_POST['uname']))," \t ")," \t ");
     $sname =  rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_POST['sname']))," \t ")," \t ");
     $email = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['email'])," \t ")," \t ");
     $pass = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['pass'])," \t ")," \t ");
     $contact = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['contact'])," \t ")," \t ");
     preg_match_all('!\d+!', $contact, $matches);
     $contact = implode(' ', $matches[0]);


        //validate non empty

         if( !isset($fname) || $fname=='' || !isset($sname) || $sname=='' ||
             !isset($email) || $email == '' || !isset($pass) || $pass == '' ||
             !isset($contact) || $contact == '' ){

                $error = "please fill the necessary columns";
             header('Location: ../user/new-user-reg.php?error='.urlencode($error));
             exit();

           }
            else {
                 $query = "SELECT  `EMAIL` FROM `user-info` WHERE `EMAIL` = '$email'";
                 $rslt = mysqli_query($con,$query);

                 $ins_query = "INSERT INTO `user-info` (`UNAME`, `SNAME`, `EMAIL`, `PASS`,`CONTACT`) VALUES ('$fname','$sname','$email','$pass','$contact');";

                 if(mysqli_num_rows($rslt) == 0){

                     if(!mysqli_query($con, $ins_query)){
                              echo "error";
                              die('error :'.mysqli_error($con));
                           }
                           else{
                             $error = "you are in the system ! login Now ";
                             header('Location: ../user/user-login.php?error='.urlencode($error));
                           }

            }
            else{
              $error = "you are already in the system ! try loggin in ";
              header('Location: ../user/user-login.php?error='.urlencode($error));
              exit();
            }

       }
}
?>
