<?php

include '../database/connection.php';

if(isset($_GET['ID'])){ // Gets a single assistant by ID
    $ID = $_GET['ID'];

    $sql =  "SELECT a.ID AS 'ID', 
                    a.Name AS 'Name', 
                    a.Surname AS 'Surname', 
                    s.Name AS 'ShopName',
                    s.ID AS 'ShopID' 
                    FROM assistants a 
                    INNER JOIN shops s ON s.ID = a.ShopID WHERE a.ID = $ID ";

    $result = mysqli_query($conn, $sql);

    $assistants = mysqli_fetch_object($result);

} else { //Fetches all assistans when no ID is set

    $sql =  "SELECT a.ID AS 'ID', 
                    a.Name AS 'Name', 
                    a.Surname AS 'Surname', 
                    s.Name AS 'ShopName' 
                    FROM assistants a 
                    INNER JOIN shops s ON s.ID = a.ShopID  ";


    $result = mysqli_query($conn, $sql);

    $assistants = array();
    while($object = mysqli_fetch_object($result)){
        $object->editBtn = '<i class="fa fa-edit" style="color: #007bff;" onclick="openEditModal(' . $object->ID . ')"></i>';
        $assistants[] = $object;
    }
}

echo json_encode($assistants);