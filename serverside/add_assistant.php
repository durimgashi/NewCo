<?php

include '../database/connection.php';

$Name = $_POST['Name'];
$Surname = $_POST['Surname'];
$Shop = $_POST['Shop'];

$sql = "CALL add_assistant('$Name', '$Surname', $Shop)";

$result = mysqli_query($conn, $sql);
$object = mysqli_fetch_object($result);

echo json_encode($object);