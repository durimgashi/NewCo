var assistantTable;

$(document ).ready(function() {
    // Inititalizing datatable for assistants
    assistantTable = $('#assistantTable').DataTable({
        ajax: {
            url: "serverside/get_assistants.php",
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
                "data": 'ShopName'
            },
            {
                "data": 'editBtn'
            }
        ]
    });


    // Fills dropdown menus with data about shops
    $.ajax({
        type: 'GET',
        url: 'serverside/get_shops.php',
        dataType: 'json',
        success: function (data) { 
            for(var i = 0; i < data.length; i++) {
                var selectOpt = '<option value="' + data[i].ID + '">' + data[i].Name + '</option>';
                                
                $("#Shop").append(selectOpt);
                $("#ShopEdit").append(selectOpt);
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

/**
 * Opens modal and fills it with data by ID
 * @param  {Number} ID The ID of the assistant, to filter the data
 */
function openEditModal(ID){
    $("#EditAssistantModal").modal("show");

    $.ajax({
        type: 'GET',
        url: 'serverside/get_assistants.php?ID=' + ID,
        dataType: 'json',
        success: function (data) { 
            $("#IDEdit").val(data.ID);
            $("#NameEdit").val(data.Name);
            $("#SurnameEdit").val(data.Surname);
            $("#ShopEdit").val(data.ShopID);
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

// Adds assistant and validates data
function addAssistant(){
    var formData = new FormData($("form#assistantForm")[0]);

    // Simple validation
    if(formData.get("Name") == "" || formData.get("Surname") == "" || formData.get("Shop") == null ){
        alert("Please fill out all the fields!");
        return;
    }

    $.ajax({
        type: 'POST',
        url: 'serverside/add_assistant.php',
        data: formData,
        dataType: 'json',
        success: function (data) { 
            assistantTable.ajax.reload();
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

// Calls the edit_assistant.php file
function editAssistant(){
    var formData = new FormData($("form#editAssistantForm")[0]);

    $.ajax({
        type: 'POST',
        url: 'serverside/edit_assistant.php',
        data: formData,
        dataType: 'json',
        success: function (data) { 
            $("#EditAssistantModal").modal("hide");
            assistantTable.ajax.reload();
        },
        cache: false,
        contentType: false,
        processData: false
    });
}
