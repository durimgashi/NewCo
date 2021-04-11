<?php
	include 'inclusions/header.php';
    include 'database/connection.php';
?>

<div class="container-fluid w-75">
    <div class="row">
        <div class="card mt-5 bg-light col-md-6">
            <div class="card-body">
                <h3 style="text-align: center" class="mb-4">Best & Worst selling products</h3>
                <table class="table">
                    <thead>
                        <th></th>
                        <th>Description</th>
                        <th>Total Sold</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM view_bestworstproduct";

                        $resBestWorstProduct = mysqli_query($conn, $sql);

                        while($row = mysqli_fetch_array($resBestWorstProduct)){
                    ?>
                        <tr>
                            <td><?= $row[0] ?></td>
                            <td><?= $row[1] ?></td>
                            <td><?= $row[2] ?></td>
                            <td>$ <?= $row[3] ?></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-5 bg-light col-md-6">
            <div class="card-body">
                <h3 style="text-align: center" class="mb-4">Best & Worst selling services</h3>
                <table class="table">
                    <thead>
                        <th></th>
                        <th>Description</th>
                        <th>Total Sold</th>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM view_bestworstservice";

                        $resBestWorstService = mysqli_query($conn, $sql);

                        while($row = mysqli_fetch_array($resBestWorstService)){
                    ?>
                        <tr>
                            <td><?= $row[0] ?></td>
                            <td><?= $row[1] ?></td>
                            <td><?= $row[2] ?></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <br><hr>

    <div class="row">
        <div class="card mt-5 bg-light col-md-6">
            <div class="card-body">
                <h3 style="text-align: center" class="mb-4">Best & Worst selling assistants(Product Sales)</h3>
                <table class="table">
                    <thead>
                        <th></th>
                        <th>Assistant</th>
                        <th>Total Sold</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM view_bestworstassistant";

                        $resBestWorstAssitant = mysqli_query($conn, $sql);

                        while($row = mysqli_fetch_array($resBestWorstAssitant)){
                    ?>
                        <tr>
                            <td><?= $row[0] ?></td>
                            <td><?= $row[1] ?></td>
                            <td><?= $row[2] ?></td>
                            <td>$ <?= $row[3] ?></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-5 bg-light col-md-6">
            <div class="card-body">
                <h3 style="text-align: center" class="mb-4">Top 3 sold services</h3>
                <table class="table">
                    <thead>
                        <th>Service</th>
                        <th>Total Sold</th>
                        <th>Money Made</th>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM view_salesbyservice ORDER BY TotalSold DESC LIMIT 3;";

                        $resBestWorstAssitant = mysqli_query($conn, $sql);

                        while($row = mysqli_fetch_array($resBestWorstAssitant)){
                    ?>
                        <tr>
                            <td><?= $row[1] ?></td>
                            <td><?= $row[2] ?></td>
                            <td>$ <?= $row[3] ?></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br><hr><br>

    <h3 class="mb-4 text-center">Product sales(Filter by: Product, Customer, Assistant, Shop)</h3>
    <div class="row">
        <div class="form-group col-md-3">
            <select name="Product" id="Product" class="form-control" onchange="filterSale(this, 'ProductID')">
                <option disabled selected>Filter by product</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            <select name="Customer" id="Customer" class="form-control" onchange="filterSale(this, 'CustomerID')">
                <option disabled selected>Filter by customer</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <select name="Assistant" id="Assistant" class="form-control" onchange="filterSale(this, 'AssistantID')">
                <option disabled selected>Filter by assistant</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <select name="Shop" id="Shop" class="form-control" onchange="filterSale(this, 'ShopID')">
                <option disabled selected>Filter by shop</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <button class="btn btn-primary w-100" onclick="allProductSales()">All Sales</button>
        </div>
    </div>
    <table id="productSales" class="">
        <thead>
            <th>ID</th>
            <th>Assistant</th>
            <th>Shop</th>
            <th>Customer</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Sale Date</th>
        </thead>
    </table>
    <br><hr><br><br><br><br><br>
</div>

<script src="scripts/sales.js"></script>

<?php
	include 'inclusions/footer.php';
?>