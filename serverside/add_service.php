<?php

include '../database/connection.php';

$ServiceProductId = $_POST['ServiceProductID'];
$ServiceDescription = $_POST['ServiceDescription'];
$ServicePrice = $_POST['ServicePrice'];
// $ServiceActive = $_POST['ServiceActive'];

if(isset($_POST['ServiceActive'])){
    $ServiceActive = 1;
} else {
    $ServiceActive = 0;
}

$sql = "CALL add_service($ServiceProductId, '$ServiceDescription', $ServicePrice, $ServiceActive)";
// echo $sql;

$result = mysqli_query($conn, $sql);

echo json_encode(array("success" => true));