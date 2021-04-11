var productSales;

$(document ).ready(function() {
    // Fills the sales table with data (initializes datatable)
    productSales = $('#productSales').DataTable({
        
        "lengthChange": false,
        "searching": false,
        ajax: {
            url: "serverside/get_product_sales.php",
            dataSrc: ''
        },
        columns: [{
                "data": 'ID'
            },{
                "data": 'Assistant'
            },
            {
                "data": 'ShopName'
            },
            {
                "data": 'Customer'
            },
            {
                "data": 'Description'
            },
            {
                "data": 'Quantity'
            },
            {
                "data": "Total"
            },
            {
                "data": "Date"
            }
        ],
        columnDefs: [
            { "width": "1%", "targets": 0 },
            { "width": "1%", "targets": 5 },
            { "width": "1%", "targets": 6 }
        ]
    });

    // Fills dropdown with customers
    $.ajax({
        type: 'GET',
        url: 'serverside/get_customers.php',
        dataType: 'json',
        success: function (data) { 
            for(var i = 0; i < data.length; i++){
                $("#Customer").append('<option value="' + data[i].ID + '">' + data[i].Name + ' ' + data[i].Surname + '</option>');
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });

    // Fills dropdown with assistants
    $.ajax({
        type: 'GET',
        url: 'serverside/get_assistants.php',
        dataType: 'json',
        success: function (data) { 
            for(var i = 0; i < data.length; i++){
                $("#Assistant").append('<option value="' + data[i].ID + '">' + data[i].Name + '</option>');
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
    
    // Fills dropdown with shops
    $.ajax({
        type: 'GET',
        url: 'serverside/get_shops.php',
        dataType: 'json',
        success: function (data) { 
            for(var i = 0; i < data.length; i++){
                $("#Shop").append('<option value="' + data[i].ID + '">' + data[i].Name + '</option>');
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
    
    // Fills dropdown with products
    $.ajax({
        type: 'GET',
        url: 'serverside/get_products.php',
        dataType: 'json',
        success: function (data) { 
            for(var i = 0; i < data.length; i++){
                $("#Product").append('<option value="' + data[i].ID + '">' + data[i].Description + '</option>');
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

// Sends the id and column name, and reloads the content of the sales table
/**
 * Opens modal and fills it with data by ID
 * @param  {Element} element 
 * @param  {String} column The name of the column to be filtered
 */
function filterSale(element, column){
    var ID = $("#" + element.id).val();
    var url = 'serverside/get_product_sales.php?Column=' + column + '&ID=' + ID;
    productSales.ajax.url(url).load();
}

// Reloads all sales for the sales table
function allProductSales(){
    var url = 'serverside/get_product_sales.php';
    productSales.ajax.url(url).load();
}