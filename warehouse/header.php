<?php
session_start();
$host=$_SERVER['HTTP_HOST'];

if(!isset($_POST['username'])){
  if(!isset($_SESSION['user_id'])) {
    header("Location: http://".$host."/warehouse/?invalid_login=1bro");
  }
}
?>
  <head>
  
  <title>Fabelio Warehouse Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="bootstrap/datetime/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="bootstrap/fileinput/css/fileinput.min.css">
  <link rel="stylesheet" href="bootstrap/datatable/datatables.min.css">
  <link rel="stylesheet" href="bootstrap/datatable/css/dataTables.tableTools.css">
  <link rel="stylesheet" href="css/custom.css">
  
  <script src="bootstrap/datetime/js/moment.js"></script>
  <script src="bootstrap/jquery-1.11.3.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/datatable/datatables.min.js"></script>
  <script src="bootstrap/datatable/js/dataTables.tableTools.js"></script>
  <script src="bootstrap/datetime/js/bootstrap-datetimepicker.min.js"></script>
  <script src="bootstrap/fileinput/js/fileinput.min.js"></script>
  <script src="bootstrap/checkbox/bootstrap-checkbox.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>
  
  </head>
  <body>

  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">Fabelio Warehouse Management System</a>
    </div>
    
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li ><a href="dashboard.php">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Inbound Form<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="inbound.php">Fresh Inbound</a></li>
            <li><a href="reinbound.php">Re-Inbound</a></li>
          </ul>
        </li>
        <li><a href="qcnow.php">QC Dashboard</a></li>
        <li><a href="returned.php">Returned Items</a></li>
        <li><a href="shipped.php">Shipped Items</a></li>
      </ul>
    </div>
  </div>
</nav>
  