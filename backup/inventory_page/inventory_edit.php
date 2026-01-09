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
            <h3 class="card-title">ข้อมูลรายการสินค้า</h3>
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
                        <div class="form-group ">
                            <label for="inv_id">ลำดับ</label>
                            <input type="text" disabled class="form-control" name="inv_id" id="input_inv_id" placeholder="enter inv_id" value='<?php echo $row["inv_id"]; ?>'>
                            <input type="hidden" name="old_inv_id" value='<?php echo $row["inv_id"]; ?>'>
                        </div>
                        <div class="form-group">
                            <label for="inv_number">รหัสสินค้า</label>
                            <input type="text" class="form-control" name="inv_number" id="input_inv_number" placeholder="enter inv_number" autofocus value='<?php echo $row["inv_number"]; ?>'>
                        </div>
                        <div class="form-group">
                            <label for="inv_name">ชื่อสินค้า</label>
                            <input type="text" class="form-control" name="inv_name" id="input_inv_name" placeholder="enter inv_name" value='<?php echo $row["inv_name"]; ?>'>
                        </div>
                        <div class="form-group">
                            <label for="inv_type">ประเภทสินค้า</label>
                            <input type="text" class="form-control" name="inv_type" id="input_inv_type" placeholder="enter inv_type" value='<?php echo $row["inv_type"]; ?>'>
                        </div>
                        <div class="form-group">
                            <label for="inv_unit">หน่วยนับ</label>
                            <input type="text" class="form-control" name="inv_unit" id="input_inv_unit" placeholder="enter inv_unit" value='<?php echo $row["inv_unit"]; ?>'>
                        </div>
                        <div class="form-group">
                            <label for="inv_price">ราคาขาย</label>
                            <input type="text" class="form-control" name="inv_price" id="input_inv_price" placeholder="enter inv_price" value='<?php echo $row["inv_price"]; ?>'>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image">ไฟล์รูปภาพ</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imageInput" name="image">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <img src="../assets/image_uploads/<?php echo $row['inv_image']; ?>" class="img-fluid" id="previewImage" />
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