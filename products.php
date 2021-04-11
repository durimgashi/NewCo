<?php
	include 'inclusions/header.php';
?>

<div class="container-fluid" style="width: 100%; margin-top: 2%">
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-9"><h3>Products</h3></div>
				<div class="col-md-3"><button class="btn btn-primary mb-2 w-100" data-toggle="modal" data-target="#AddProductModal">Add Product</button></div>
			</div>
			<hr>
            <table class="table table-striped" id="productsTable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Description</th>
						<th>Validity</th>
						<th>Status</th>
						<th>Available</th>
						<th>Stock</th>
						<th>Edit</th>
						<th>Services</th>
						<th>Sell</th>
					</tr>
				</thead>
			</table>
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-8"><h3>Services</h3></div>
				<div class="col-md-4"><button class="btn btn-primary mb-2 w-100" id="serviceBtn">Add service to product</button></div>
			</div>
			<hr>
			<table class="table table-striped" id="servicesTable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Belongs To</th>
						<th>Description</th>
						<th>Price</th>
						<th>Active</th>
						<th>Edit</th>
						<th>Delete</th>
						<th>Sell</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<!-- Add product modal -->
<div class="modal fade" id="AddProductModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="addProductForm">
                <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
					<div class="col-md-6">
						<h4>Product</h4><hr>
						<div class="form-group">
							<label>Product description</label>
							<input type="text" name="Description" id="Description" class="form-control" placeholder="Description">
						</div>
						<div class="form-group">
							<label>Validity</label>
							<input type="date" name="Validity" id="Validity" class="form-control">
						</div>
						<div class="form-group">
							<label>Stock</label>
							<input type="number" name="Stock" id="Stock" class="form-control" placeholder="Stock">
						</div>
						<div class="form-group">
							<input type="checkbox" name="State" id="State" checked> Available
						</div>
					</div>
					<div class="col-md-6">
						<h4>Service</h4><hr>
						<div class="form-group">
							<label>Service description</label>
							<input type="text" name="PS_Description" id="PS_Description" class="form-control" placeholder="Description">
						</div>
						<div class="form-group">
							<label>Price</label>
							<input type="number" name="PS_Price" id="PS_Price" class="form-control">
						</div>
						<div class="form-group">
							<input type="checkbox" name="PS_Active" id="PS_Active" checked> Available
						</div>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addProduct()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add service modal -->
<div class="modal fade" id="AddServiceModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addServiceForm">
                <div class="modal-header">
                    <h5 class="modal-title">Add Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<input type="hidden" name="ServiceProductID" id="ServiceProductID">
                    <div class="form-group">
						<label for="ServiceDescription">Description:</label>
						<input type="text" name="ServiceDescription" id="ServiceDescription" class="form-control" placeholder="Description">
                    </div>
                    <div class="form-group">
						<label for="ServicePrice">Price:</label>
						<input type="number" name="ServicePrice" id="ServicePrice" class="form-control">
					</div>
                    <div class="form-group">
						<input type="checkbox" name="ServiceActive" id="ServiceActive"> Active
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addService()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit service modal -->
<div class="modal fade" id="EditServiceModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editServiceForm">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
						<input type="hidden" name="ServiceIDEdit" id="ServiceIDEdit" class="form-control">
					</div>
                    <div class="form-group">
						<label>Service Description</label>
						<input type="text" name="ServiceDescEdit" id="ServiceDescEdit" class="form-control">
					</div>
                    <div class="form-group">
						<label>Service Price</label>
						<input type="number" name="ServicePriceEdit" id="ServicePriceEdit" class="form-control">
					</div>
                    <div class="form-group">
						<input type="checkbox" name="ServiceActiveEdit" id="ServiceActiveEdit"> Active
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="editService()">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit product modal -->
<div class="modal fade" id="EditProductModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editProductForm">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<input type="hidden" name="ProductIDEdit" id="ProductIDEdit">
                    <div class="form-group">
						<input type="text" name="DescriptionEdit" id="DescriptionEdit" class="form-control" placeholder="Description">
                    </div>
                    <div class="form-group">
						<input type="date" name="ValidityEdit" id="ValidityEdit" class="form-control">
					</div>
                    <div class="form-group">
						<input type="checkbox" name="StateEdit" id="StateEdit"> Available
					</div>
                    <div class="form-group">
						<input type="number" name="StockEdit" id="StockEdit" class="form-control" placeholder="Stock">
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="editProduct()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Sell Product Modal -->
<div class="modal fade" id="SellProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sell Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<form id="sellProductForm">
			<div class="row">
				<input type="hidden" name="SellProductID" id="SellProductID">
				<div class="form-group col-md-2">
					<label>Assistant</label>
					<input class="form-control" type="text" name="Assistant" id="Assistant" value="<?php if(isset($_SESSION['assistant'])) { echo $_SESSION['assistant']->Name; } ?>" readonly>
				</div>
				<div class="form-group col-md-2">
					<label>Select customer</label>
					<select name="Customer" id="Customer" class="form-control">
						<option selected disabled>Select customer</option>
					</select>
				</div>
				<div class="form-group col-md-2">
					<label>Product</label>
					<input type="text" name="ProductSell" id="ProductSell" class="form-control">
				</div>
				<div class="form-group col-md-1">
					<label>Stock</label>
					<input type="number" name="Available" id="Available" class="form-control" readonly>
				</div>
				<div class="form-group col-md-1">
					<label>Quantity</label>
					<input type="number" name="Quantity" id="Quantity" value="1" class="form-control" oninput="calTotal()">
				</div>
				<div class="form-group col-md-2">
					<label>Active services price:</label>
					<input type="number" name="ASPrice" id="ASPrice" class="form-control" readonly>
				</div>
				<div class="form-group col-md-2">
					<label>Total:</label>
					<input type="number" name="ASTotal" id="ASTotal" class="form-control" readonly>
				</div>
			</div>  
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="sellProduct()">Sell</button>
      </div>
    </div>
  </div>
</div>


<!-- Sell Product Modal -->
<div class="modal fade" id="SellServiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sell Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<form id="sellServiceForm">
			<div class="row">
				<input type="hidden" name="SellServiceID" id="SellServiceID">
				<div class="form-group col-md-3">
					<label>Assistant</label>
					<input class="form-control" type="text" name="AssistantS" id="AssistantS" value="<?php if(isset($_SESSION['assistant'])) { echo $_SESSION['assistant']->Name; } ?>" readonly>
				</div>
				<div class="form-group col-md-3">
					<label>Select customer</label>
					<select name="CustomerService" id="CustomerService" class="form-control">
						<option selected disabled>Select customer</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<label>Service</label>
					<input type="text" name="ServiceSell" id="ServiceSell" class="form-control">
				</div>
				<div class="form-group col-md-2">
					<label>Price:</label>
					<input type="text" name="ServicePriceSell" id="ServicePriceSell" class="form-control" readonly>
				</div>
			</div>  
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="sellService()">Sell</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="scripts/products.js"></script>

<?php
	include 'inclusions/footer.php';
?>