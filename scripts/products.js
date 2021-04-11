var GlobalProductID = null;
var GlobalServiceID = null;
var tableProducts;

$(document ).ready(function() {
    // Initializing datatable form products
    tableProducts = $('#productsTable').DataTable({
        ajax: {
            url: "serverside/get_products.php",
            dataSrc: ''
        },
        columns: [{
                "data": 'ID'
            },{
                "data": 'Description'
            },
            {
                "data": 'Validity'
            },
            {
                "data": 'State'
            },
            {
                "data": 'Available'
            },
            {
                "data": 'Stock'
            },
            {
                "data": 'editBtn'
            },
            {
                "data": "services"
            },
            {
                "data": "sellBtn"
            }
        ],
        columnDefs: [
            { "width": "1%", "targets": 0 },
            { "width": "1%", "targets": 5 },
            { "width": "1%", "targets": 6 }
        ]
    });

    $.ajax({
        type: 'GET',
        url: 'serverside/get_customers.php',
        dataType: 'json',
        success: function (data) { 
            for(var i = 0; i < data.length; i++){
                $("#Customer").append('<option value="' + data[i].ID + '">' + data[i].Name + ' ' + data[i].Surname + '</option>');
                $("#CustomerService").append('<option value="' + data[i].ID + '">' + data[i].Name + ' ' + data[i].Surname + '</option>');
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

// Inititalizing table for products
var tableServices = $('#servicesTable').DataTable();

$("#serviceBtn").click(function() {
    if(GlobalProductID == null) {
        alert("Please select a product to add a service!")
    } else {
        $("#AddServiceModal").modal("show");
        $("#ServiceProductID").val(GlobalProductID);
    }
})

/**
 * Gets services for product 
 * @param  {Number} ProductID The ID of the product to filter the services
 */
function getServicesByProduct(ProductID){
    GlobalProductID = ProductID;
    tableServices.destroy();
    
    tableServices = $('#servicesTable').DataTable({
        ajax: {
            url: "serverside/get_services.php?ProductID=" + ProductID,
            dataSrc: ''
        },
        columns: [{
                "data": 'ID'
            },{
                "data": 'BelongsTo'
            },
            {
                "data": 'Description'
            },
            {
                "data": 'Price'
            },
            {
                "data": 'Active'
            },
            {
                "data": 'editBtn'
            },
            {
                "data": 'deleteBtn'
            },
            {
                "data": 'sellBtn'
            }
        ],
        columnDefs: [
            { "width": "1%", "targets": 0 }
        ]
    });
}

// Opens the edit modal for service by ID and fills it with data
function openEditModal(ServiceID){
    $("#EditServiceModal").modal("show");

    $.ajax({
        type: 'GET',
        url: 'serverside/get_services.php?ServiceID=' + ServiceID,
        dataType: 'json',
        success: function (data) { 
            $("#ServiceIDEdit").val(data.ID);
            $("#ServiceDescEdit").val(data.Description);
            $("#ServicePriceEdit").val(data.Price);
            if(data.Active == "1"){
                $("#ServiceActiveEdit").prop('checked', true);
            } else {
                $("#ServiceActiveEdit").prop('checked', false);
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

// Opens the edit modal for product by ID and fills it with data
function openEditProductModal(ProductID){
    $("#EditProductModal").modal("show");

    $.ajax({
        type: 'GET',
        url: 'serverside/get_products.php?ProductID=' + ProductID,
        dataType: 'json',
        success: function (data) { 
            $("#ProductIDEdit").val(data.ID);
            $("#DescriptionEdit").val(data.Description);
            $("#ValidityEdit").val(data.Validity);
            $("#StockEdit").val(data.Stock);
            if(data.State == "1"){
                $("#StateEdit").prop('checked', true);
            } else {
                $("#StateEdit").prop('checked', false);
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

// Opens the edit modal for selling products and fills it with data
function openSellProductModal(ProductID){
    $("#SellProductModal").modal("show");

    $.ajax({
        type: 'GET',
        url: 'serverside/get_product_details.php?ProductID=' + ProductID,
        dataType: 'json',
        success: function (data) { 
            $("#SellProductID").val(data.ID);
            $("#ProductSell").val(data.Description);
            $("#ASPrice").val(data.ServicesPrice);
            $("#Available").val(data.Stock);
            $("#ASTotal").val($("#Quantity").val() * data.ServicesPrice);
        },
        cache: false,
        contentType: false,
        processData: false
    });
}


/**
 * Calculates the total by multiplying quantity with available services price
 */
function calTotal(){
    var Quantity = document.getElementById('Quantity').value;
    var ASPrice = document.getElementById('ASPrice').value;
    var Available = document.getElementById('Available').value;

    if(parseInt(Quantity) > parseInt(Available)) {
        document.getElementById('Quantity').value = parseInt(Available);
    }

    if((parseInt(Quantity) < 1)) {
        document.getElementById('Quantity').value = 1;
    }

    Quantity = document.getElementById('Quantity').value;
    var Total = parseInt(Quantity) * parseFloat(ASPrice);    
    $("#ASTotal").val(Total);
}

/**
 * Opens modal and fills it with data by ID
 * @param  {Number} ServiceID The ID of the service to be deleted
 */
function deleteService(ServiceID){
    $.ajax({
        type: 'GET',
        url: 'serverside/delete_service.php?ServiceID=' + ServiceID,
        dataType: 'json',
        success: function (data) { 
            tableServices.ajax.reload();
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

// Adds the product and one service
function addProduct(){
    var formData = new FormData($("form#addProductForm")[0]);

    // Simple validation
    if(formData.get('Description') == "" || formData.get('Validity') == ""
        || formData.get('Stock') == "" || formData.get('PS_Description') == ""
        || formData.get('PS_Price') == ""){

        alert("Please fill all the fields!");
        return;
    }

    $.ajax({
        type: 'POST',
        url: 'serverside/add_product.php',
        data: formData,
        dataType: 'json',
        success: function (data) { 
            // Reloads the service table with the new product id
            getServicesByProduct(data.NewProductID);
            alert("Product added!");
            $("#AddProductModal").modal("hide");
            tableProducts.ajax.reload();
        },
        cache: false,
        contentType: false,
        processData: false
    });
    
    tableProducts.ajax.reload();
}

// Adds service for selected product
function addService(){
    var formData = new FormData($("form#addServiceForm")[0]);

    // Simple validation
    if(formData.get('ServiceDescription') == "" || formData.get('ServicePrice') == ""){
        alert("Please fill all the fields");
        return;
    }

    $.ajax({
        type: 'POST',
        url: 'serverside/add_service.php',
        data: formData,
        dataType: 'json',
        success: function (data) { 
            alert("Service added!");
            tableServices.ajax.reload();
        },
        cache: false,
        contentType: false,
        processData: false
    });
            
    $("#AddServiceModal").modal("hide");
    tableServices.ajax.reload();
}

/**
 *  Calls the edit_service.php file
 */
function editService(){
    var formData = new FormData($("form#editServiceForm")[0]);

    $.ajax({
        type: 'POST',
        url: 'serverside/edit_service.php',
        data: formData,
        dataType: 'json',
        success: function (data) { 
            alert("Service edited successfully!");
            tableServices.ajax.reload();
        },
        cache: false,
        contentType: false,
        processData: false
    });
    
    $("#EditServiceModal").modal("hide");
    tableServices.ajax.reload();
}

// Calls the edit_product.php file
function editProduct(){
    var formData = new FormData($("form#editProductForm")[0]);

    $.ajax({
        type: 'POST',
        url: 'serverside/edit_product.php',
        data: formData,
        dataType: 'json',
        success: function (data) {
            alert("Product edited successfully!"); 
            tableProducts.ajax.reload();
        },
        cache: false,
        contentType: false,
        processData: false
    });
    
    $("#EditProductModal").modal("hide");
    tableProducts.ajax.reload();
}


//Validates data and sells product
function sellProduct(){
    var formData = new FormData($("form#sellProductForm")[0]);

    var object = {};
    formData.forEach(function(value, key){
        object[key] = value;
    });
    var json = JSON.stringify(object);
    // console.log(json);

    if(object.Assistant == ""){
        $("#Assistant").css('border', '2px solid red');
        alert("Please choose an assistant to continue!")
        return;
    }

    if(object.Customer == null){
        $("#Customer").css('border', '3px solid red');
        alert("Please choose a customer to continue!")
        return;
    }

    $.ajax({
        type: 'POST',
        url: 'serverside/sell_product.php',
        data: formData,
        dataType: 'json',
        success: function (data) { 
            if(data.success){
                $("#SellProductModal").modal("hide");
                
                alert("Success! The product has been sold.");
                tableProducts.ajax.reload();
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

/**
 * Opens modal and fills it with data by ID
 * @param  {Number} ServiceID The ID of the service, with which to fill the modal data
 */
function sellServiceModal(ServiceID){
    $("#SellServiceModal").modal("show");

    $.ajax({
        type: 'GET',
        url: 'serverside/get_services.php?ServiceID=' + ServiceID,
        dataType: 'json',
        success: function (data) { 
            $("#SellServiceID").val(data.ID);
            $("#ServiceSell").val(data.Description);
            $("#ServicePriceSell").val(data.Price);
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

// Validates data and sell service
function sellService() {
    var formData = new FormData($("form#sellServiceForm")[0]);

    var object = {};
    formData.forEach(function(value, key){
        object[key] = value;
    });

    if(object.AssistantS == ""){
        $("#AssistantS").css('border', '2px solid red');
        alert("Please choose an assistant to continue!")
        return;
    }

    if(object.CustomerService == null){
        $("#CustomerService").css('border', '3px solid red');
        alert("Please choose a customer to continue!")
        return;
    }

    $.ajax({
        type: 'POST',
        url: 'serverside/sell_service.php',
        data: formData,
        dataType: 'json',
        success: function (data) { 
            if(data.success == true){
                $("#SellServiceModal").modal("hide");
                alert("Success. Service has been sold.")
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}