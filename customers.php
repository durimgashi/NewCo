<?php
	include 'inclusions/header.php';
?>

<div class="container-fluid" style="width: 80%; margin-top: 5%">
	<div class="row">
		<div class="col-md-5">
			<h2>Add Customer</h2>
            <hr>
			<form id="customerForm">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Name:</label>
                        <input type="text" class="form-control" id="Name" name="Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Surname:</label>
                        <input type="text" class="form-control" id="Surname" name="Surname">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label>Address:</label>
                        <input type="text" name="Address" id="Address" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>PhoneNumber:</label>
                        <input type="text" name="PhoneNumber" id="PhoneNumber" class="form-control">
                    </div>
                </div>
				<button type="button" class="btn btn-primary" onclick="addCustomer()">Add customer</button>
			</form>
		</div>
		<div class="col-md-7">
			<table class="table table-striped" id="customersTable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Surname</th>
						<th>Address</th>
						<th>PhoneNumber</th>
						<th>Edit</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<!-- Edit assistant modal -->
<div class="modal fade" id="EditCustomerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editCustomerForm">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Assistant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="IDEdit" id="IDEdit">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Name:</label>
                            <input type="text" class="form-control" id="NameEdit" name="NameEdit">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Surname:</label>
                            <input type="text" class="form-control" id="SurnameEdit" name="SurnameEdit">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label>Address:</label>
                            <input type="text" name="AddressEdit" id="AddressEdit" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>PhoneNumber:</label>
                            <input type="text" name="PhoneNumberEdit" id="PhoneNumberEdit" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="editCustomer()">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="scripts/customers.js"></script>

<?php
	include 'inclusions/footer.php';
?>