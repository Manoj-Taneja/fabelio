<?php
session_start();
include 'config.php';
?>
<style type="text/css">
  .container {
    vertical-align: middle;
    margin-top: 10%;
    border-color: #F8F8F9;
    border-left-style: groove;
    padding: 15;
    border-right-style: groove;
    border-bottom-style: groove;
  }
</style>
<html>

<head>
  
  <title>Fabelio Warehouse Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="bootstrap/datetime/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="bootstrap/fileinput/css/fileinput.min.css">
  <link rel="stylesheet" href="bootstrap/datatable/datatables.min.css">
  <link rel="stylesheet" href="css/custom.css">
  
  <script src="bootstrap/datetime/js/moment.js"></script>
  <script src="bootstrap/jquery-1.11.3.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/fileinput/js/fileinput.min.js"></script>
  <script src="bootstrap/datatable/datatables.min.js"></script>
  <script src="bootstrap/datetime/js/bootstrap-datetimepicker.min.js"></script>
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
      <a class="navbar-brand" href="dashboard.php">Fabelio Warehouse Management System</a>
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
  
<div class="container">
  <div class ="login-head">
  <legend><center>Login</center></legend>
  </div>

    <div class="well">
        <form class="form-horizontal" method="post" action="dashboard.php">
        <fieldset>
        <?php 
        if(isset($_SESSION['user_id'])){
          header("Location: http://".$host."/warehouse/dashboard.php");
        }
        if(isset($_GET['invalid_login'])){
          if($_GET['invalid_login']==1)
          {
          ?>
            <div class="alert alert-danger" role="alert"><center>Wrong Username or Password. Try again!</center></div>
          <?php
          }
        }
        ?>
        
        <div class="form-group">
          <label class="col-md-4 control-label" for="textinput">Username</label>  
          <div class="col-md-4">
          <input id="username" name="username" placeholder="username" class="form-control input-md" required="" type="text">
            
          </div>
        </div>

        
        <div class="form-group">
          <label class="col-md-4 control-label" for="password">Password</label>
          <div class="col-md-4">
            <input id="password" name="password" placeholder="password" class="form-control input-md" required="" type="password">
            
          </div>
        </div>

        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="submit"></label>
          <div class="col-md-4">
            <center><button id="submit" name="submit" class="btn btn-primary">Submit</button></center>
          </div>
        </div>

        </fieldset>
        </form>

    </div>
</div>

</body>
</html>
