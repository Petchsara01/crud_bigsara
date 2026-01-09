<?php
include "../connect.php";

$inv_id     = $_POST['inv_id'];
$inv_name   = $_POST['inv_name'];
$inv_number = $_POST['inv_number'];
$inv_type   = $_POST['inv_type'];
$inv_unit   = $_POST['inv_unit'];
$inv_price  = $_POST['inv_price'];


$inv_image_name = ''; 

if (!empty($_FILES['inv_image']['name'])) { //หากเลือกรูปใหม่ให้ทำการอัพโหลดรูปภาพ ถ้าไม่ก็ใช้รูปเดิม

    $upload = $_FILES['inv_image'];
    $allowed_types = ['jpg', 'jpeg', 'png'];

    $extension = explode('.', $upload['name']);
    $fileActualExt = strtolower(end($extension));

    // ถ้า นามสกุลไฟล์ที่อัปโหลดมาไม่อยู่ ในรายการนามสกุลไฟล์ที่อนุญาตให้แสดงข้อความ
    if (!in_array($fileActualExt, $allowed_types)) {
        echo "ประเภทไฟล์รูปภาพไม่ถูกต้อง";
        exit;
    }

    // ถ้าขนาดไฟล์เป็น 0 หรือมี error ระหว่างอัปโหลดแสดงข้อความ
    if ($upload['size'] <= 0 && $upload['error'] != 0) {
        echo "ไฟล์รูปภาพมีปัญหา";
        exit;
    }

    // ตั้งชื่อไฟล์ใหม่
    $inv_image_name = rand() . "." . $fileActualExt;
    $filePath = "../assets/image_uploads/" . $inv_image_name;

    // ถ้าย้ายไฟล์ไม่สำเร็จแสดงข้อความ
    if (!move_uploaded_file($upload['tmp_name'], $filePath)) {
        echo "ไม่สามารถอัปโหลดไฟล์ได้";
        exit;
    }
}


$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("error " . mysqli_connect_error());
}


//ถ้าไม่เลือกรูปใหม่ → ใช้รูปเดิม
if ($inv_image_name == '') {
    $sql = "SELECT inv_image FROM inventory WHERE inv_id='$inv_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $inv_image_name = $row['inv_image'];
}

//อัปเดตข้อมูล
$sql = "UPDATE inventory SET
            inv_number = '$inv_number',
            inv_name   = '$inv_name',
            inv_price  = '$inv_price',
            inv_unit   = '$inv_unit',
            inv_type   = '$inv_type',
            inv_image  = '$inv_image_name'
        WHERE inv_id = '$inv_id'";

if (mysqli_query($conn, $sql)) { //ตรวสอบการรันคำสั่ง SQL ว่าสำเร็จหรือไม่
    header("Refresh:0;url=inventory_list.php");
} else {
    echo "Error" . mysqli_error($conn);
}

mysqli_close($conn);
