var tableShops;

$(document ).ready(function() {

    // Initializing datatable
    tableShops = $('#tableShops').DataTable({
        ajax: {
            url: "serverside/get_shops.php",
            dataSrc: ''
        },
        columns: [{
                "data": 'ID'
            },{
                "data": 'Name'
            },
            {
                "data": 'City'
            },
            {
                "data": 'editBtn'
            }
        ]
    });
});

// Adding a shop
function addShop(){
    var formData = new FormData($("form#shopForm")[0]);


    // Simple validation of fields
    if($("#shopName").val() == ""){
        $("#shopName").css('border', '3px solid red');
        return;
    }    
    
    if($("#city").val() == ""){
        $("#city").css('border', '3px solid red');
        return;
    }

    $.ajax({
        type: 'POST',
        url: 'serverside/add_shop.php',
        data: formData,
        dataType: 'json',
        success: function (data) { 
            tableShops.ajax.reload();
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

/**
 * Opens modal and fills it with data by ID
 * @param  {Number} ShopID The ID of the shop, with which to fill the modal data
 */
function openEditModal(ShopID){
    $("#EditShopModal").modal("show");

    $.ajax({
        type: 'GET',
        url: 'serverside/get_shops.php?ID=' + ShopID,
        dataType: 'json',
        success: function (data) { 
            $("#ShopIDEdit").val(data.ID);
            $("#ShopNameEdit").val(data.Name);
            $("#CityEdit").val(data.City);
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

// Executes the edit_shop.php file
function editShop(){
    var formData = new FormData($("form#editShopForm")[0]);

    $.ajax({
        type: 'POST',
        url: 'serverside/edit_shop.php',
        data: formData,
        dataType: 'json',
        success: function (data) { 				
            $("#EditShopModal").modal("hide");
            tableShops.ajax.reload();
        },
        cache: false,
        contentType: false,
        processData: false
    });
    
}