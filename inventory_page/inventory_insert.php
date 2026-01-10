<?php
include "../connect.php"; 


$inv_name = $_POST["inv_name"]; 
$inv_number = $_POST["inv_number"]; 
$inv_type = $_POST["inv_type"]; 
$inv_unit = $_POST["inv_unit"]; 
$inv_price = $_POST["inv_price"]; 
$inv_image = $_FILES["inv_image"]; 

$allowed_types = ['jpeg', 'jpg', 'png']; // นามสกุลไฟล์ที่อนุญาต
$extension = explode('.', $inv_image['name']); // แยกชื่อไฟล์ตาม '.' เพื่อดึงนามสกุล
$fileActualExt = strtolower(end($extension)); // เอานามสกุลไฟล์ตัวสุดท้ายแปลงเป็นตัวพิมพ์เล็กแล้วเก็บไว้ในตัวแปร
$fileNewName = rand() . "." . $fileActualExt; // สร้างชื่อไฟล์ใหม่ โดยเป็นการสุ่มตัวเลขแล้วต่อด้วยนามสกุลเไฟล์เดิม


$filePath = '../assets/image_uploads/' . $fileNewName; // พาธปลายทาง 



// ถ้า นามสกุลไฟล์ที่อัปโหลดมาไม่อยู่ ในรายการนามสกุลไฟล์ที่อนุญาตให้แสดงข้อความ
if (!in_array($fileActualExt, $allowed_types)) {
    echo "ประเภทไฟล์รูปภาพไม่ถูกต้อง";
    exit;
}

// ถ้าขนาดไฟล์เป็น 0 แสดงข้อความ
if ($inv_image['size'] <= 0) {
    echo "ไม่พบไฟล์รูปภาพ";
    exit;
}

// ถ้า error ระหว่างอัปโหลดไม่เท่ากับ 0 แสดงข้อความ
if ($inv_image['error'] != 0) {
    echo "เกิดข้อผิดพลาดระหว่างการอัปโหลดไฟล์";
    exit;
}

// ถ้าย้ายไฟล์ไม่สำเร็จแสดงข้อความ
if (!move_uploaded_file($inv_image['tmp_name'], $filePath)) {
    echo "ไม่สามารถอัปโหลดไฟล์ได้";
    exit;
}



$conn = mysqli_connect(
    $servername,
    $username,
    $password,
    $dbname
);

if (!$conn) {
    die("error" . mysqli_connect_error());
}
$sql = "INSERT INTO inventory (inv_name,inv_price,
             inv_unit,inv_number,inv_type,inv_image)
         VALUES('$inv_name','$inv_price',
            '$inv_unit','$inv_number','$inv_type','$fileNewName'
            )";

if (mysqli_query($conn, $sql)) { //ตรวสอบการรันคำสั่ง SQL ว่าสำเร็จหรือไม่
    header("Refresh:0;url=inventory_list.php");
} else {
    echo "Error" . mysqli_error($conn);
}

mysqli_close($conn);
?>