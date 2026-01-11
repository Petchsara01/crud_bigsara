<?php
include '../connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD_PROJECT</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        th {
            text-align: center;
        }

        td {
            vertical-align: middle;
            text-align: center;
        }
    </style>

</head>


<body>
    <div class="container mt-4 ">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>รายการคลังสินค้า | หมวดผักและผลไม้</h2>
            <a href="inventory_form.php" class="btn btn-primary">เพิ่มรายการ<i class="bi bi-chevron-double-right"></i></a>
        </div>

        <table cellpadding="10" class="table table-striped table-bordered" style="border: solid 1px black;">
            <thead>
                <tr>
                    <th hidden>ลำดับ</th>
                    <th>รูปภาพ</th>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>ประเภทสินค้า</th>
                    <th>หน่วยนับ</th>
                    <th>ราคาต่อหน่วย (บาท)</th>
                    <th>การตั้งค่า</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM inventory";
                $result = mysqli_query($conn, $sql); 

                if (mysqli_num_rows($result) > 0) { 
                    while ($row = mysqli_fetch_assoc($result)) { 
                        echo "<tr>";
                        echo "<td hidden>" . $row['inv_id'] . "</td>";
                        echo "<td><img style=\"width: 100px; height: 80px; mix-blend-mode: multiply; object-fit: cover\" src='../assets/image_uploads/" . $row['inv_image'] . "' alt='Image'></td>";
                        echo "<td>" . $row['inv_number'] . "</td>";
                        echo "<td>" . $row['inv_name'] . "</td>";
                        echo "<td>" . $row['inv_type'] . "</td>";
                        echo "<td>" . $row['inv_unit'] . "</td>";
                        echo "<td style=\"text-align: right;\">" . $row['inv_price'] . "</td>";
                        echo "<td >
                                <a  href='inventory_edit.php?inv_id=" . $row['inv_id'] . "' class='btn btn-warning btn-sm' ><i class='bi bi-pencil'></i></a>  
                                <a href='inventory_delete.php?inv_id=" . $row['inv_id'] . "' onclick=\"return confirm('คุณแน่ใจที่จะลบรายการนี้หรือไม่?');\" class='btn btn-danger btn-sm'><i class='bi bi-trash'></i></a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr style='text-align: center;'><td colspan='100%'>ไม่มีรายการในคลังสินค้า</td></tr>";
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>