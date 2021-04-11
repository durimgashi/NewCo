<!DOCTYPE html>
<html>
<head>
  <title>NewCo</title>

  <!-- Bootstrao imports -->
  <link rel="stylesheet" type="text/css"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js">
  </script>

  <!-- jQuery import -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>

  <!-- DataTable imports -->
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
  <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

  <!-- FontAwesome 4 import -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
    #productsTable:hover {
      cursor: pointer;
    }

    #servicesTable:hover {
      cursor: pointer;
    }

    td, th{
      text-align: center;
    }
    a.dropdown-item{
      cursor: pointer;
    }
  </style>
</head>

<?php session_start(); ?>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">NewCo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Shops <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="customers.php">Customers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="shopassistants.php">Shop Assistants</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sales.php">Sales & Stats</a>
        </li>
      </ul>
    </div>

    <?php 
      if(isset($_SESSION['assistant'])){
        echo '<p style="margin: 0; margin-right: 20px;">Logged in as: '. $_SESSION['assistant']->Name .'</p>';
      } else {
        echo '<p style="margin: 0; margin-right: 20px;">You are not logged in</p>';
      }
    ?>

    <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Choose assistant
      </button>
      <div class="dropdown-menu" id="assistantsLogIn" aria-labelledby="dropdownMenuButton"></div>
    </div>
  </nav>

  <script>
    // Fills the dropdown list with assistants
    $.ajax({
			type: 'GET',
			url: 'serverside/get_assistants.php',
			dataType: 'json',
			success: function (data) { 
				for(var i = 0; i < data.length; i++) {
					var selectOpt = '<a class="dropdown-item" id="' + data[i].ID + '" onclick="logIn(this)">' + data[i].Name + '</a>';
									
					$("#assistantsLogIn").append(selectOpt);
				}
			},
			cache: false,
			contentType: false,
			processData: false
		});

    function logIn(element){
      var ID = element.id;

      $.ajax({
        type: 'POST',
        url: 'serverside/log_in.php',
        data: { ID : ID },
        dataType: 'json',
        success: function (data) { 
        }
      });
      
      document.location.reload();
    }
  </script>