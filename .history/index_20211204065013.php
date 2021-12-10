<?php
require 'site.php';
include "bocuc/Connect.php";
include "bocuc/KiemTraSession.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <link rel="stylesheet" href="style/style-dangnhap_1.css">
    <style>
        .form-control {
            margin: 15px 0;
        }
    </style>
</head>

<body>
    <!-- top đầu trang -->
    <div>

        <?php load_top(); ?>

    </div>

    <!-- menu của trang / menu user 1 -->
    <!-- <?php load_menu(); ?> -->


    <div class="container-fluid" style="margin-top:30px; margin-bottom:30px;">
        <div class="row">
            <div class="col-xl-3"></div>
            <div class="col-xl-4" style="margin-bottom:30px; margin-top: 150px;">
                <h1 style="text-align: center; color:red ">ĐĂNG NHẬP</h1>
                <br>
                <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="form-group">
                        <input type="text" class="form-control border-danger" name="txtusername" style=" margin: auto; font-size: 25px; border-radius: 20px;" placeholder="Nhập tên đăng nhập" required>
                        <div class="valid-feedback">Hợp lệ.</div>
                        <div class="invalid-feedback">Vui lòng không được bỏ trống thông tin!</div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control border-danger" name="txtpassword" style="margin: auto; font-size: 25px; border-radius: 20px;" placeholder="Nhập mật khẩu" placeholder="Nhập mật khẩu" required></input>
                        <div class="valid-feedback">Hợp lệ.</div>
                        <div class="invalid-feedback">Vui lòng không được bỏ trống thông tin!</div>
                    </div>
                    <a href="QuenMatKhau.php" style="justify-content: right; display: flex;">Quên mật khẩu</a>
                    <br>
                    <div class="form-group">
                        <button class="btn btn-danger btn-block" type="submit" name="btnDangNhap" style="margin: auto; display: block; font-size: 25px;  border-radius: 7px; background-color: #e34230; ">ĐĂNG NHẬP</button>
                    </div>
                    <br>

                </form>
                <br>
            </div>
            <div class="col-sm-5"></div>
        </div>
    </div>

    <!-- chân trang -->
    <div class="jumbotron text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>
</body>

</html>

<script>
    // Disable form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<?php
if (isset($_POST["btnDangNhap"])) {
    $username = $_POST["txtusername"];
    $pass = array_key_exists('txtpassword', $_POST) ? $_POST["txtpassword"] : null;

    $sql1 = "select * from tk_canbo where username='" . $username . "'";
    $kq1 = mysqli_query($kn, $sql1);

    if (!($row1 = mysqli_fetch_array($kq1))) {
        echo '<script>alert("Tên đăng nhập không tồn tại");</script>';
    } else {
        if ($pass != $row1['password']) {
            echo '<script>alert("Sai mật khẩu");</script>';
        } else {
            $_SESSION['Username'] = $_POST["txtusername"];
            header("Location: QuanLyNhapXuat.php");
        }
    }
}
?>