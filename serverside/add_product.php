<?php

include '../database/connection.php';

$Description = $_POST['Description'];
$Validity = $_POST['Validity'];
$Stock = $_POST['Stock'];
$PS_Description = $_POST['PS_Description'];
$PS_Price = $_POST['PS_Price'];

if(isset($_POST['State'])) {
    $State = 1;
} else {
    $State = 0;
}

if(isset($_POST['PS_Active'])) {
    $PS_Active = 1;
} else {
    $PS_Active = 0;
}

$sql = "CALL add_product('$Description', '$Validity', $State, $Stock, '$PS_Description', $PS_Price, $PS_Active)";

$result = mysqli_query($conn, $sql);
$object = mysqli_fetch_object($result);

echo json_encode($object);