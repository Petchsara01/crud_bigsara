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
</head>

<body>
    <div class=" m-5 card card-primary">
        <div class="card-header bg-warning">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">ฟอร์มแก้ไขรายการสินค้า <i class="bi bi-pencil"></i></h3>
                <div class="d-flex">
                    <a class="p text-decoration-none text-dark" href="inventory_list.php">รายการสินค้าทั้งหมด</a>
                    &nbsp;
                    <p class="text-dark">/</p>
                    &nbsp;
                    <p class="text-dark">ฟอร์มแก้ไขรายการสินค้า <i class="bi bi-pencil"></i></p>

                </div>
            </div>
        </div>
        <?php
        include "../connect.php";
        $inv_id = $_GET["inv_id"];
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("error" . mysqli_connect_error());
        }

        $sql = "SELECT * FROM inventory WHERE inv_id='$inv_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <form action="inventory_save.php" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group " hidden>
                            <label for="inv_id" class="fw-bold   ">ลำดับ</label>
                            <input type="text" readonly class="form-control" name="inv_id" id="input_inv_id" value='<?php echo $row["inv_id"]; ?>'>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="inv_number" class="fw-bold">รหัสสินค้า</label>
                            <input type="text" class="form-control" name="inv_number" id="input_inv_number" readonly value='<?php echo $row["inv_number"]; ?>'>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="inv_name" class="fw-bold">ชื่อสินค้า</label>
                            <input type="text" class="form-control" name="inv_name" id="input_inv_name" value='<?php echo $row["inv_name"]; ?>'>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="inv_type" class="fw-bold">ประเภทสินค้า</label>
                            <div class="d-flex justify-content-start gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="inv_type" id="input_inv_type_veg" value="ผัก" <?php echo (isset($row['inv_type']) && $row['inv_type'] === 'ผัก') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="input_inv_type_veg">ผัก</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="inv_type" id="input_inv_type_fruit" value="ผลไม้" <?php echo (isset($row['inv_type']) && $row['inv_type'] === 'ผลไม้') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="input_inv_type_fruit">ผลไม้</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="inv_unit" class="fw-bold">หน่วยนับ</label>
                            <input type="text" class="form-control" name="inv_unit" id="input_inv_unit" value='<?php echo $row["inv_unit"]; ?>'>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="inv_price" class="fw-bold">ราคาขาย</label>
                            <input type="number" class="form-control" name="inv_price" id="input_inv_price" value='<?php echo $row["inv_price"]; ?>'>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inv_image" class="fw-bold">ไฟล์รูปภาพ</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imageInput" name="inv_image">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <img src="../assets/image_uploads/<?php echo $row['inv_image']; ?>" style="width: 50%;  object-fit: cover;" id="previewImage" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                <a href="inventory_list.php" class="btn btn-secondary">ยกเลิก</a>
            </div>
        </form>
    </div>
</body>

<script>
    let imageInput = document.getElementById('imageInput');
    let previewImage = document.getElementById('previewImage');

    imageInput.onchange = evt => {
        const [file] = imageInput.files
        if (file) {
            previewImage.src = URL.createObjectURL(file)
        }
    }
</script>

</html>