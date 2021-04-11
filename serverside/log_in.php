<?php
session_start();
include '../database/connection.php';

 // Creates a session variable containing an object of the user's data

if(isset($_POST['ID'])){
    $ID = $_POST['ID'];

    $sql =  "SELECT * FROM assistants WHERE ID = $ID ";
    // echo $sql;
    $result = mysqli_query($conn, $sql);

    $_SESSION['assistant'] = mysqli_fetch_object($result);
    session_start();
    $assistants = mysqli_fetch_object($result);
    
    echo json_encode($assistants);

} 
