<?php
include "../connect.php"; // นำค่าการเชื่อมต่อฐานข้อมูล (เช่น $servername) มาจากไฟล์นี้

// อ่านค่าจากฟอร์ม POST
$inv_name = $_POST["inv_name"]; // ชื่อสินค้า
$inv_number = $_POST["inv_number"]; // รหัสสินค้า
$inv_type = $_POST["inv_type"]; // ประเภทสินค้า
$inv_unit = $_POST["inv_unit"]; // หน่วยนับ
$inv_price = $_POST["inv_price"]; // ราคาสินค้า
$inv_image = $_FILES["inv_image"]; // ข้อมูลไฟล์ที่อัพโหลด (ชื่อ ชั่วคราว ขนาด และ error)

$allowed_types = ['jpeg', 'jpg', 'png']; // นามสกุลไฟล์ที่อนุญาต
$extension = explode('.', $inv_image['name']); // แยกชื่อไฟล์ตาม '.' เพื่อดึงนามสกุล
$fileActualExt = strtolower(end($extension)); // นามสกุลจริงของไฟล์เป็นตัวพิมพ์เล็ก
$fileNewName = rand() . "." . $fileActualExt; // สร้างชื่อไฟล์ใหม่ 
$filePath = '../assets/image_uploads/' . $fileNewName; // พาธปลายทาง (relative)

if (in_array($fileActualExt, $allowed_types)) {
    if ($inv_image['size'] > 0 && $inv_image['error'] == 0) {
        // 'tmp_name' คือพาธไฟล์ชั่วคราวที่ PHP เก็บไว้ขณะอัพโหลด
        // move_uploaded_file จะย้ายไฟล์นั้นมายังพาธปลายทางที่เรากำหนด
        move_uploaded_file($inv_image['tmp_name'], $filePath);
    } else {
        echo "ไฟล์รูปภาพมีขนาดใหญ่เกินไป";
        exit;
    }
} else {
    echo "ประเภทไฟล์รูปภาพไม่ถูกต้อง";
    exit;
}

$conn = mysqli_connect(
    $servername,
    $username,
    $password,
    $dbname
);
// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if (!$conn) {
    die("error" . mysqli_connect_error());
}
// สร้างคำสั่ง INSERT เพื่อบันทึกข้อมูลลงตาราง
// ข้อควรระวัง: การต่อสตริงค่าโพสต์ลงใน SQL โดยตรงเสี่ยงต่อ SQL injection
$sql = "INSERT INTO inventory (inv_name,inv_price,
             inv_unit,inv_number,inv_type,inv_image)
         VALUES('$inv_name','$inv_price',
            '$inv_unit','$inv_number','$inv_type','$fileNewName'
            )";
if (mysqli_query($conn, $sql)) {
    header("Refresh:0;url=inventory_list.php");
} else {
    echo "Error" . mysqli_error($conn);
}

mysqli_close($conn);
?>