
<?php include '../database/database.php';
session_start();
 //check for submission


 if(isset($_POST['submit'])){

      $cid = $_SESSION['cid'];

      $club = $_SESSION['club'];

      // $email = $_SESSION['email'];

     $spt = rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_POST['spt']))," \t ")," \t ");
     $amnts =  rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_POST['amnts']))," \t ")," \t ");
     $addr =  rtrim(ltrim(strtoupper(mysqli_real_escape_string($con,$_POST['addr']))," \t ")," \t ");
     $pin = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['pin'])," \t ")," \t ");
     preg_match_all('!\d+!', $pin, $matches);
     $pin = implode(' ', $matches[0]);

     $price = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['price'])," \t ")," \t ");
     preg_match_all('!\d+!', $price, $matche);
     $price = implode(' ', $matche[0]);

        //validate non empty

         if( !isset($spt) || $spt=='' || !isset($amnts) || $amnts=='' ||
           !isset($pin) || $pin == '' || !isset($price) || $price == '' ||
           !isset($addr) || $addr == '' ){

                $error = "please fill the necessary columns";
             header('Location: ../member/mbr-sports-insert.php?error='.urlencode($error));
             exit();

           }
            else {

                 $ins_query = "INSERT INTO `club-info` (`CID`, `CLUBNAME`, `SPORTS`, `ADDRESS`,`PIN`, `PRICE`,`AMNTES`) VALUES ('$cid','$club','$spt','$addr','$pin','$price','$amnts');";



            if(!mysqli_query($con, $ins_query)){
                    echo "error";
                    die('error :'.mysqli_error($con));
                   }
                  else {

                    $succ = "Log in To your new Account";
                  header('Location: ../member/member-login.php?succ='.urlencode($succ));
                  exit();
                     }
            }


       }

?>
