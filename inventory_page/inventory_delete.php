<?php
include '../connect.php';

 $inv_id = $_GET["inv_id"];
 
 $conn = mysqli_connect($servername,$username,
  $password,$dbname);

 if(!$conn)
 { die("error".mysqli_connect_error()); }

 $sql = "DELETE FROM inventory WHERE inv_id='$inv_id'";
 
 if(mysqli_query($conn,$sql))
 {
    header("Refresh:0;url=inventory_list.php");
 }
 else{ echo "Error".mysqli_error($conn);}
 
?>
