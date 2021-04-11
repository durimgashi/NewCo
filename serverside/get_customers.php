<?php

include '../database/connection.php';

if(isset($_GET['ID'])){ //Fetches a single customer when ID is set
    $ID = $_GET['ID'];

    $sql =  "SELECT * FROM customers WHERE ID = $ID ";

    $result = mysqli_query($conn, $sql);
    $customers = mysqli_fetch_object($result);

} else { //Fetches all customers when no ID is set

    $sql =  "SELECT * FROM customers";

    $result = mysqli_query($conn, $sql);

    $customers = array();
    while($object = mysqli_fetch_object($result)){
        $object->editBtn = '<i class="fa fa-edit" style="color: #007bff;" onclick="openEditModal(' . $object->ID . ')"></i>';
        $customers[] = $object;
    }
}

echo json_encode($customers);