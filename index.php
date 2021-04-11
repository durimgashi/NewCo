<?php
	include 'inclusions/header.php';
?>

<div class="container-fluid" style="width: 80%; margin-top: 5%">
	<div class="row">
		<div class="col-md-6">
			<h3>Add Shop</h3>
			<hr>
			<form id="shopForm">
				<div class="form-group">
					<label for="shopName">Shop Name:</label>
					<input type="text" class="form-control" id="shopName" name="shopName">
				</div>
				<div class="form-group">
					<label for="city">City:</label>
					<input type="text" class="form-control" id="city" name="city">
				</div>
				<button type="button" class="btn btn-primary" onclick="addShop()">Submit</button>
			</form>
		</div>
		<div class="col-md-6">
			<table class="table table-striped" id="tableShops">
				<thead>
					<tr>
						<th>ID</th>
						<th>ShopName</th>
						<th>City</th>
						<th>Edit</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<!-- Edit shop modal -->
<div class="modal fade" id="EditShopModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="editShopForm">
				<div class="modal-header">
					<h5 class="modal-title">Edit Shop</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="ShopIDEdit" id="ShopIDEdit">
					<div class="form-group">
						<label for="shopName">Shop Name:</label>
						<input type="text" class="form-control" id="ShopNameEdit" name="ShopNameEdit">
					</div>
					<div class="form-group">
						<label for="city">City:</label>
						<input type="text" class="form-control" id="CityEdit" name="CityEdit">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="editShop()">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="scripts/index.js"></script>

<?php
	include 'inclusions/footer.php';
?>