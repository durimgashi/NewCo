<?php

include '../database/connection.php';

$ShopIDEdit = $_POST['ShopIDEdit'];
$ShopNameEdit = $_POST['ShopNameEdit'];
$CityEdit = $_POST['CityEdit'];

$sql = "CALL edit_shop($ShopIDEdit, '$ShopNameEdit', '$CityEdit')";
// echo $sql;

$result = mysqli_query($conn, $sql);
echo json_encode(array("success" => "success"));