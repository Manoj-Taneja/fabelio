<?php
include 'config.php';
include 'header.php';

if(!isset($_SESSION['user_id'])){

  $sql="select id from users where username='".$_POST["username"]."' and password='".$_POST["password"]."'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $_SESSION['user_id']=$row["id"];
    }
} 
else { 
    header("Location: http://".$host."/warehouse/?invalid_login=1sis");
}
}

$conn->close();
?>


<div class="container">
<center>
  <!-- <a class="btn btn-success btn-lg" href="inbound.php" role="button">Inbound Form</a>
  <a class="btn btn-success btn-lg" href="qcnow.php" role="button">QC Now!</a>
 -->
Lets put some nice dashboard here!
</center>
</div>

</body>
</html>