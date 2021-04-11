var customerTable;

$(document ).ready(function() {
    // Initializes customers datatable
    customerTable = $('#customersTable').DataTable({
        ajax: {
            url: "serverside/get_customers.php",
            dataSrc: ''
        },
        columns: [{
                "data": 'ID'
            },{
                "data": 'Name'
            },
            {
                "data": 'Surname'
            },
            {
                "data": 'Address'
            },
            {
                "data": 'PhoneNumber'
            },
            {
                "data": 'editBtn'
            }
        ]
    });
});
 
/**
 * Opens modal and fills it with data by ID
 * @param  {Number} ID The ID of the customer, with which to fill the modal data
 */
function openEditModal(ID){
    $("#EditCustomerModal").modal("show");

    $.ajax({
        type: 'GET',
        url: 'serverside/get_customers.php?ID=' + ID,
        dataType: 'json',
        success: function (data) { 
            $("#IDEdit").val(data.ID);
            $("#NameEdit").val(data.Name);
            $("#SurnameEdit").val(data.Surname);
            $("#AddressEdit").val(data.Address);
            $("#PhoneNumberEdit").val(data.PhoneNumber);
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

/**
 * Simple validation of data and add customer
 */
function addCustomer(){
    var formData = new FormData($("form#customerForm")[0]);

    // Simple validation
    if(formData.get("Name") == "" || 
        formData.get("Surname") == "" || 
        formData.get("Address") == "" || 
        formData.get("Address") == ""){
            alert("Please fill out all the fields!");
            return;
        }

    $.ajax({
        type: 'POST',
        url: 'serverside/add_customer.php',
        data: formData,
        dataType: 'json',
        success: function (data) { 
            customerTable.ajax.reload();
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

/**
 * Calls the edit_cutomer.php files
 */
function editCustomer(){
    var formData = new FormData($("form#editCustomerForm")[0]);

    $.ajax({
        type: 'POST',
        url: 'serverside/edit_customer.php',
        data: formData,
        dataType: 'json',
        success: function (data) { 
            $("#EditCustomerModal").modal("hide");
            customerTable.ajax.reload();
        },
        cache: false,
        contentType: false,
        processData: false
    });
}