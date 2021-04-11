<?php

include '../database/connection.php';

$IDEdit = $_POST['IDEdit'];
$NameEdit = $_POST['NameEdit'];
$SurnameEdit = $_POST['SurnameEdit'];
$ShopEdit = $_POST['ShopEdit'];

$sql = "CALL edit_assistant($IDEdit, $ShopEdit, '$NameEdit', '$SurnameEdit')";
// echo $sql;

$result = mysqli_query($conn, $sql);
echo json_encode(array("success" => "success"));