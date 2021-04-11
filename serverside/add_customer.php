<?php

include '../database/connection.php';

$Name = $_POST['Name'];
$Surname = $_POST['Surname'];
$Address = $_POST['Address'];
$PhoneNumber = $_POST['PhoneNumber'];

$sql = "CALL add_customer('$Name', '$Surname', '$Address', '$PhoneNumber')";

$result = mysqli_query($conn, $sql);

echo json_encode(array("success" => true));