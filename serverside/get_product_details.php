<?php

include '../database/connection.php';

if(isset($_GET['ProductID'])){
    $ID = $_GET['ProductID'];
    $sql = "SELECT p.ID, 
                p.Description,
                p.Stock,
                COALESCE(ROUND(SUM(s.Price), 2), 0) AS 'ServicesPrice' 
            FROM products p INNER JOIN services s ON p.ID = s.ProductID WHERE p.ID = $ID AND s.Active = 1;";
    $result = mysqli_query($conn, $sql);

    $object = mysqli_fetch_object($result);
    $shops = $object;
}



echo json_encode($shops);