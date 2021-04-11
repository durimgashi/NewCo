<?php

include '../database/connection.php';

$ServiceIDEdit = $_POST['ServiceIDEdit'];
$ServiceDescEdit = $_POST['ServiceDescEdit'];
$ServicePriceEdit = $_POST['ServicePriceEdit'];

if(isset($_POST['ServiceActiveEdit'])){
    $ServiceActiveEdit = 1;
} else {
    $ServiceActiveEdit = 0;
}

$sql = "CALL edit_service($ServiceIDEdit, '$ServiceDescEdit', $ServicePriceEdit, $ServiceActiveEdit)";

$result = mysqli_query($conn, $sql);
echo json_encode(array("success" => "success"));