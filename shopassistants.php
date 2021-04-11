<?php
	include 'inclusions/header.php';
?>

<script>

// $(document ).ready(function() {

// });
</script>

<div class="container-fluid" style="width: 80%; margin-top: 5%">
	<div class="row">
		<div class="col-md-5">
			<h2>Add Shop Assistant</h2>
			<form id="assistantForm">
				<div class="form-group">
					<label>Name:</label>
					<input type="text" class="form-control" id="Name" name="Name">
				</div>
				<div class="form-group">
					<label>Surname:</label>
					<input type="text" class="form-control" id="Surname" name="Surname">
				</div>
				<div class="form-group">
					<label for="city">Shop:</label>
					<select name="Shop" id="Shop" class="form-control" >
                        <option selected disabled>Select a shop</option>
                    </select>
				</div>
				<button type="button" class="btn btn-primary" onclick="addAssistant()">Submit</button>
			</form>
		</div>
		<div class="col-md-7">
			<table class="table table-striped" id="assistantTable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Surname</th>
						<th>Shop</th>
						<th>Edit</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<!-- Edit assistant modal -->
<div class="modal fade" id="EditAssistantModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editAssistantForm">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Assistant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<input type="hidden" name="IDEdit" id="IDEdit">
                    <div class="form-group">
						<label>Name:</label>
						<input type="text" name="NameEdit" id="NameEdit" class="form-control">
					</div>
                    <div class="form-group">
						<label>Surname:</label>
						<input type="text" name="SurnameEdit" id="SurnameEdit" class="form-control">
					</div>
                    <div class="form-group">
						<label for="city">Shop:</label>
						<select name="ShopEdit" id="ShopEdit" class="form-control" >
						</select>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="editAssistant()">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="scripts/shopassistants.js"></script>

<?php
	include 'inclusions/footer.php';
?>