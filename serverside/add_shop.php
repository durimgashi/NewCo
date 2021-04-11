<?php

include '../database/connection.php';

$shopName = $_POST['shopName'];
$address = $_POST['city'];

$sql = "CALL add_shop('$shopName', '$address')";


// echo $sql;
$result = mysqli_query($conn, $sql);

$object = mysqli_fetch_object($result);

echo json_encode($object);