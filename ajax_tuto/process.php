<?php

$conn = mysqli_connect("localhost","root","MRROBOT","ajaxtest");

echo "processing....";

if(isset($_GET['name'])){
    echo "name : ".$_GET['name'];
}

if(isset($_POST['name'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    echo "name : ".$_POST['name'];

    $query = "INSERT INTO `users`(`name`) values('$name')";
    if(mysqli_query($conn,$query)){
        echo "user added";
    }
    else{
        echo 'Error'.mysqli_error($conn);
    }
}

?>