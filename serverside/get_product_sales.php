<?php

include '../database/connection.php';


/*
    All types of filtering done in one file.
    We send the column that we want to filter and the values of that column through the URL 
    The column can be the following:
    --- ProductID
    --- AssistantID
    --- CustomerID
    --- ShopID

    Else if no column is set, the file return all sales from the query
*/

if(isset($_GET['Column']) && isset($_GET['ID'])){
    $ID = $_GET['ID'];
    $Column = $_GET['Column'];

    $sql = "SELECT * FROM View_ProductSales WHERE $Column = $ID";
    
    $result = mysqli_query($conn, $sql);

    $product_sales = array();
    while($object = mysqli_fetch_object($result)){
        $product_sales[] = $object;
    }

} else {
    $sql = "SELECT * FROM View_ProductSales";
    $result = mysqli_query($conn, $sql);

    $product_sales = array();
    while($object = mysqli_fetch_object($result)){
        $product_sales[] = $object;
    }
}

echo json_encode($product_sales);