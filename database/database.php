<?php
// connection to mysql
$con = mysqli_connect("localhost","","","");
if(mysqli_connect_errno()){

  die("failed to connect".mysqli_connect_error());
}
?>
