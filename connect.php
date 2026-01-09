<?php
//ใช้สำหรับเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crudbigsara";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
  
}
// echo "เชื่อมต่อฐานข้อมูลสำเร็จ";
?>
