<?php

session_start();
include '../database/connection.php';

$AssistantID = $_SESSION['assistant']->ID;

$CustomerID = $_POST['Customer'];
$ProductID = $_POST['SellProductID'];
$Quantity = $_POST['Quantity'];
$AS_Price = $_POST['ASPrice'];
$TotalPrice = $_POST['ASTotal'];

$sql = "CALL sell_product($AssistantID, $CustomerID, $ProductID, $Quantity, $AS_Price, $TotalPrice)";
// echo $sql;
$result = mysqli_query($conn, $sql);
if($result){
    echo json_encode(array("success" => true));
}