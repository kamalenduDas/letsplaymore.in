<?php

$conn = mysqli_connect("localhost","root","MRROBOT","ajaxtest");

$sql = "select * from `users`";

$result = mysqli_query($conn,$sql);

$users = mysqli_fetch_all($result,MYSQLI_ASSOC);

echo json_encode($users);

?>