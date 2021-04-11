<?php

include '../database/connection.php';

if(isset($_GET['ProductID'])){ // Gets all services by Product ID
    $ID = $_GET['ProductID'];

    $sql = "SELECT  s.ID, 
                s.ProductID, 
                p.Description AS 'BelongsTo', 
                s.Description, 
                s.Price, 
                CASE WHEN s.Active = 1 THEN 'Yes' ELSE 'No' END  AS 'Active'
            FROM services s 
            INNER JOIN products p ON s.ProductID = p.ID WHERE s.ProductID = $ID;";

            
    $result = mysqli_query($conn, $sql);

    $services = array();
    while($object = mysqli_fetch_object($result)){
        
        $object->editBtn = '<i class="fa fa-edit" style="color: #007bff;" onclick="openEditModal(' . $object->ID . ')"></i>';
        $object->deleteBtn = '<i class="fa fa-trash" style="color: #007bff;" onclick="deleteService(' . $object->ID . ')"></i>';
        $object->Price = '$'.$object->Price;

        if($object->Active == "Yes") {
            $object->sellBtn = '<button class="btn btn-primary" onclick="sellServiceModal(' . $object->ID . ')">Sell</button>';
        } else {
            $object->sellBtn = '';
        }

        $services[] = $object;
    }
} else if (isset($_GET['ServiceID'])) { // Gets a single servuce by Serivice ID
    $ID = $_GET['ServiceID'];

    $sql = "SELECT  s.ID, 
                s.ProductID, 
                p.Description AS 'BelongsTo', 
                s.Description, 
                s.Price, 
                s.Active
            FROM services s 
            INNER JOIN products p ON s.ProductID = p.ID WHERE s.ID = $ID;";

            
    $result = mysqli_query($conn, $sql);
    $services = mysqli_fetch_object($result);
}

echo json_encode($services);
