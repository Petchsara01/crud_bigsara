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
</head>

<body>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">กรอกข้อมูลรายการสินค้า</h3>
        </div>
        <form action="inventory_insert.php" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="inv_number">รหัสสินค้า</label>&nbsp;<sub class="text-danger fw-bold fs-5 ">*</sub>
                            <input placeholder="กรุณากรอกข้อมูลรหัสสินค้า" type="text" class="form-control" name="inv_number" id="input_inv_number" required autofocus>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="inv_name">ชื่อสินค้า</label>&nbsp;<sub class="text-danger fw-bold fs-5 ">*</sub>
                            <input placeholder="กรุณากรอกชื่อสินค้า" type="text" class="form-control" name="inv_name" id="input_inv_name" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="inv_type">ประเภทสินค้า</label>&nbsp;<sub class="text-danger fw-bold fs-5 ">*</sub>
                            <div class="d-flex justify-content-start gap-4">

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="inv_type" id="input_inv_type" value="ผัก">
                                    <label class="form-check-label">ผัก</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="inv_type" id="input_inv_type" value="ผลไม้">
                                    <label class="form-check-label">ผลไม้</label>
                                </div>

                            </div>


                        </div>
                        <br>
                        <div class="form-group">
                            <label for="inv_unit">หน่วยนับ</label>&nbsp;<sub class="text-danger fw-bold fs-5 ">*</sub>
                            <input placeholder="กรุณากรอกหน่วยนับ" type="text" class="form-control" name="inv_unit" id="input_inv_unit" required>
                        </div>

                        <br>
                        <div class="form-group">
                            <label for="inv_price">ราคาขาย (บาท)</label>&nbsp;<sub class="text-danger fw-bold fs-5 ">*</sub>
                            <input placeholder="กรุณากรอกราคาขาย" type="number" class="form-control" name="inv_price" id="input_inv_price" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inv_image">ไฟล์รูปภาพ</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imageInput" name="inv_image">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <img id="previewImage" style="width: 50%;  object-fit: cover;" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">ยืนยันเพิ่มรายการ</button>
                <a href="inventory_list.php" class="btn btn-secondary">ยกเลิก</a>
            </div>
        </form>
    </div>

</body>
<script>
    let imageInput = document.getElementById('imageInput');
    let previewImage = document.getElementById('previewImage');

    imageInput.onchange = evt => {
        const file = imageInput.files[0];
        if (file) {
            previewImage.src = URL.createObjectURL(file)
        }
    }
</script>

</html>