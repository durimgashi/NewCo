<?php

include '../database/connection.php';

$ServiceID = $_GET["ServiceID"];

$sql = "CALL delete_service($ServiceID)";
// echo $sql;

$result = mysqli_query($conn, $sql);
echo json_encode(array("success" => "success"));