<?php

include '../database/connection.php';

if(isset($_GET['ID'])){ // Gets a single shop by ID
    $ID = $_GET['ID'];
    $sql = "SELECT * FROM shops WHERE ID = $ID ORDER BY ID ASC";

    $result = mysqli_query($conn, $sql);

    $object = mysqli_fetch_object($result);
    $shops = $object;
} else { // Gets all shops
    $sql = "SELECT * FROM shops ORDER BY ID ASC";

    $result = mysqli_query($conn, $sql);

    $shops = array();
    while($object = mysqli_fetch_object($result)){
        $object->editBtn = '<i class="fa fa-edit" style="color: #007bff;" onclick="openEditModal(' . $object->ID . ')"></i>';
        $shops[] = $object;
    }
}

echo json_encode($shops);