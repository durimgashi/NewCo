<?php

include '../database/connection.php';

$IDEdit = $_POST['IDEdit'];
$NameEdit = $_POST['NameEdit'];
$SurnameEdit = $_POST['SurnameEdit'];
$AddressEdit = $_POST['AddressEdit'];
$PhoneNumberEdit = $_POST['PhoneNumberEdit'];

$sql = "CALL edit_customer($IDEdit, '$NameEdit', '$SurnameEdit', '$AddressEdit', '$PhoneNumberEdit')";
// echo $sql;

$result = mysqli_query($conn, $sql);
echo json_encode(array("success" => "success"));