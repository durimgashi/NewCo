<?php

include '../database/connection.php';

if(isset($_GET['ProductID'])){ // Fetches a single product by ID
    $ID = $_GET['ProductID'];
    $sql = "SELECT * FROM products WHERE ID = $ID";
    $result = mysqli_query($conn, $sql);

    $object = mysqli_fetch_object($result);
    $products = $object;
} else { // Fetches all productts
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);

    $products = array();
    while($object = mysqli_fetch_object($result)){
        if($object->State == 1){ 
            $object->State = '<div style="color: blue">Active</div>';
        } else {
            $object->State = '<div style="color: red">Inactive</div>';
        }

        // If stock is 0, then it return the sell button, else it returns an empty string
        if($object->Stock != 0){
            $object->sellBtn = '<button class="btn btn-primary" onclick="openSellProductModal(' . $object->ID . ')">Sell</button>';
            $object->Available = '<div style="color: blue">Available</div>';
        } else {
            $object->sellBtn = '';
            $object->Available = '<div style="color: red">Out of stock</div>';
        }
        $object->editBtn = '<i class="fa fa-edit" style="color: #007bff;" onclick="openEditProductModal(' . $object->ID . ')"></i>';
        $object->services = '<button class="btn btn-primary" onclick="getServicesByProduct(' . $object->ID . ')">Services</button>';
        $products[] = $object;
    }
}

echo json_encode($products);