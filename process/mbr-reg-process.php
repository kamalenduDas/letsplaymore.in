
<?php include '../database/database.php';
session_start();
 //check for submission

 if(isset($_POST['submit'])){



     $fname = rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_POST['fname']))," \t ")," \t ");
     $sname =  rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_POST['sname']))," \t ")," \t ");
     $email = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['email'])," \t ")," \t ");
     $pass = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['pass'])," \t ")," \t ");
     $club = rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_POST['club']))," \t ")," \t ");
     $contact = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['contact'])," \t ")," \t ");
     preg_match_all('!\d+!', $contact, $matches);
     $contact = implode(' ', $matches[0]);


        //validate non empty

         if( !isset($fname) || $fname=='' || !isset($sname) || $sname=='' ||
           !isset($email) || $email == '' || !isset($pass) || $pass == '' ||
           !isset($contact) || $contact == '' ||  !isset($club) || $club == '' ){

                $error = "please fill the necessary columns";
             header('Location: ../member/new-member-reg.php?error='.urlencode($error));
             exit();

           }
            else {
                 $cid = random_int ( 1111111111 , 9999999999 );

                 $query = "SELECT  `EMAIL` FROM `owner-info` WHERE `EMAIL` = '$email'";
                 $rslt = mysqli_query($con,$query);

                 $query1 = "SELECT `CID` FROM `owner-info` where `CID` = '$cid'";
                 $rslt1 =  mysqli_query($con,$query1);

                 $ins_query = "INSERT INTO `owner-info` (`FNAME`, `LNAME`, `EMAIL`, `PASS`,`CONTACT`, `CLUBNAME`,`CID`) VALUES ('$fname','$sname','$email','$pass','$contact','$club','$cid');";

                 if(mysqli_num_rows($rslt) == 0){

                           while( mysqli_num_rows($rslt1) != 0 ) {
                                                // loops till an unique value is found
                                 $cid = random_int ( 1111111111 , 9999999999 );
                                 $rslt1 = mysqli_query($con,$query1);
                              }


            if(!mysqli_query($con, $ins_query)){
                    echo "error";
                    die('error :'.mysqli_error($con));
                   }
                  else {
                    $_SESSION['cid'] = $cid;
                    $_SESSION['club'] = $club;
                    $succ = "Insert your club info";
                  header('Location: ../member/mbr-sports-insert.php?succ='.urlencode($succ));
                  exit();
                     }
            }
            else{
              $error = "you are already in the system ! try loggin in ";
           header('Location: ../member/new-member-reg.php?error='.urlencode($error));
           exit();
            }

       }
}
?>
