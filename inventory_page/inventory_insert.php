<?php
include "../connect.php"; 


$inv_name = $_POST["inv_name"]; 
$inv_number = $_POST["inv_number"]; 
$inv_type = $_POST["inv_type"]; 
$inv_unit = $_POST["inv_unit"]; 
$inv_price = $_POST["inv_price"]; 
$inv_image = $_FILES["inv_image"]; 

$allowed_types = ['jpeg', 'jpg', 'png']; 
$extension = explode('.', $inv_image['name']); 
$fileActualExt = strtolower(end($extension)); 
$fileNewName = rand() . "." . $fileActualExt; 


$filePath = '../assets/image_uploads/' . $fileNewName; 




if (!in_array($fileActualExt, $allowed_types)) {
    echo "ประเภทไฟล์รูปภาพไม่ถูกต้อง";
    exit;
}


if ($inv_image['size'] <= 0) {
    echo "ไม่พบไฟล์รูปภาพ";
    exit;
}

if ($inv_image['error'] != 0) {
    echo "เกิดข้อผิดพลาดระหว่างการอัปโหลดไฟล์";
    exit;
}


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

if (mysqli_query($conn, $sql)) { 
    header("Refresh:0;url=inventory_list.php");
} else {
    echo "Error" . mysqli_error($conn);
}

mysqli_close($conn);
?>