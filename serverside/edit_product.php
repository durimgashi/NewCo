<?php

include '../database/connection.php';

$ProductIDEdit = $_POST['ProductIDEdit'];
$DescriptionEdit = $_POST['DescriptionEdit'];
$ValidityEdit = $_POST['ValidityEdit'];
$StockEdit = $_POST['StockEdit'];
// $StateEdit = $_POST['StateEdit'];

if(isset($_POST['StateEdit'])){
    $StateEdit = 1;
} else {
    $StateEdit = 0;
}

$sql = "CALL edit_product($ProductIDEdit, '$DescriptionEdit', '$ValidityEdit', $StockEdit, $StateEdit)";
// echo $sql;

$result = mysqli_query($conn, $sql);
echo json_encode(array("success" => true));