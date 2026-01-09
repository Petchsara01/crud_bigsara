<?php
include "../connect.php";

$inv_name = $_POST["inv_name"];
$inv_number = $_POST["inv_number"];
$inv_type = $_POST["inv_type"];
$inv_unit = $_POST["inv_unit"];
$inv_price = $_POST["inv_price"];
$old_inv_id = $_POST["old_inv_id"];
$inv_image_name = '';


$fileKey = isset($_FILES['image']) ? 'image' : (isset($_FILES['inv_image']) ? 'inv_image' : null);
if ($fileKey && isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] == 0) {
    $upload = $_FILES[$fileKey];
    $allowed_types = ['jpeg', 'jpg', 'png'];
    $extension = explode('.', $upload['name']);
    $fileActualExt = strtolower(end($extension));
    if (in_array($fileActualExt, $allowed_types)) {
        if ($upload['size'] > 0 && $upload['error'] == 0) {
            $filenew = rand() . "." . $fileActualExt;
            $filePath ='../assets/image_uploads/' . $filenew;
            if (move_uploaded_file($upload['tmp_name'], $filePath)) {
                $inv_image_name = $filenew; 
            }
        } else {
            echo "ไฟล์รูปภาพมีขนาดใหญ่เกินไป";
            exit;
        }
    } else {
        echo "ประเภทไฟล์รูปภาพไม่ถูกต้อง";
        exit;
    }
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

if ($inv_image_name == '') {
    $sql = "SELECT inv_image FROM inventory WHERE inv_id='$old_inv_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $inv_image_name = $row['inv_image'];
}

$sql = "  UPDATE inventory SET inv_number='$inv_number',
            inv_name='$inv_name',inv_price='$inv_price',
             inv_unit='$inv_unit',inv_type='$inv_type',inv_image='$inv_image_name'";

$sql = $sql . " WHERE inv_id='$old_inv_id'";
if (mysqli_query($conn, $sql)) {
    header("Refresh:5;url=inventory_list.php");
} else {
    echo "Error" . mysqli_error($conn);
}

mysqli_close($conn);
