<?php

session_start();
include '../database/connection.php';

$AssistantID = $_SESSION['assistant']->ID;

$CustomerID = $_POST['CustomerService'];
$ServiceID = $_POST['SellServiceID'];
$Total = $_POST['ServicePriceSell'];

$sql = "CALL sell_service($ServiceID, $AssistantID, $CustomerID, $Total)";

$result = mysqli_query($conn, $sql);
if($result){
    echo json_encode(array("success" => true));
}