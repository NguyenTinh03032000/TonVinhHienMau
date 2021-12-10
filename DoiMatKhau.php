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
    <title>Đổi mật khẩu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <link rel="stylesheet" href="style/style-doimatkhau-1.css">
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
    <?php load_menu();

    if ($user) {
    ?>
        <div class="container-fluid" style="margin-top:30px; margin-bottom:30px;">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                    <h1 style="text-align: center; color: red;">ĐỔI MẬT KHẨU</h1>
                    <br>
                    <form action="DoiMatKhau.php" class="needs-validation" method="POST" novalidate>
                        <?php
                        $sql1 = "select * from tk_canbo  where username='" . $_SESSION['Username'] . "'";
                        $kq1 = mysqli_query($kn, $sql1);
                        $row = mysqli_fetch_array($kq1);
                        ?>
                        <div class="form-group">
                            <input type="text" class="form-control" style="font-size: 25px; border-radius: 20px;" placeholder="Tên đăng nhập" name="txtTenDangNhap" required autocomplete="off" value="<?php echo $row['username'] ?>">
                            <div class="valid-feedback">Hợp lệ.</div>
                            <div class="invalid-feedback">Vui lòng không được bỏ trống thông tin!</div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" style="font-size: 25px; border-radius: 20px;" placeholder="Nhập mật khẩu cũ" name="txtMatKhauCu" required autocomplete="off">
                            <div class="valid-feedback">Hợp lệ.</div>
                            <div class="invalid-feedback">Vui lòng không được bỏ trống thông tin!</div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" style="font-size: 25px; border-radius: 20px;" id="tieude" placeholder="Nhập mật khẩu mới" name="txtMatKhauMoi" required autocomplete="off">
                            <div class="valid-feedback">Hợp lệ.</div>
                            <div class="invalid-feedback">Vui lòng không được bỏ trống thông tin!</div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" style="font-size: 25px; border-radius: 20px;" id="tieude" placeholder="Nhập lại mật khẩu mới" name="txtNhapLaiMatKhauMoi" required autocomplete="off">
                            <div class="valid-feedback">Hợp lệ.</div>
                            <div class="invalid-feedback">Vui lòng không được bỏ trống thông tin!</div>
                        </div>
                        <button type="submit" class="btn btn-danger btn-block" style="margin: auto; display: block; font-size: 25px;  border-radius: 6px;" name="btnDoiMatKhau">ĐỔI MẬT KHẨU</button>
                    </form>
                    <br>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>

    <?php
    } else {
        include "loadDangNhap.php";
    }
    ?>
    <br>

    <!-- chân trang -->
    <div class="jumbotron text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>

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
</body>

</html>

<?php
function doimatkhau()
{
    include "bocuc/Connect.php";

    $user = $_SESSION['Username'];
    $txtMatKhauCu = array_key_exists('txtMatKhauCu', $_POST) ? $_POST['txtMatKhauCu'] : null;
    $txtMatKhauMoi = array_key_exists('txtMatKhauMoi', $_POST) ? $_POST['txtMatKhauMoi'] : null;
    $txtNhapLaiMatKhauMoi = array_key_exists('txtNhapLaiMatKhauMoi', $_POST) ? $_POST['txtNhapLaiMatKhauMoi'] : null;

    $timmatkhau = "select password from tk_canbo where username = '" . $user . "' and password = '" . $txtMatKhauCu . "'";
    $kqtimmatkhau = mysqli_query($kn, $timmatkhau);
    $row1 = mysqli_fetch_array($kqtimmatkhau);
    if (!$row1) {
        echo '<script>alert("Mật khẩu cũ sai và không khớp!");</script>';
    } else {
        if ($txtNhapLaiMatKhauMoi == $txtMatKhauMoi) {
            $sql = "update tk_canbo set password = '" . $txtNhapLaiMatKhauMoi . "' where username = '" . $user . "'";
            $kq = mysqli_query($kn, $sql);
            echo '<script>alert("Đổi mật khẩu thành công");</script>';
        } else {
            echo '<script>alert("Mật khẩu mới và nhập lại mật khẩu không khớp nhau!");</script>';
        }
    }
}

if ($_POST) {
    if (isset($_POST['btnDoiMatKhau']) and $_SERVER['REQUEST_METHOD'] == "POST") {
        doimatkhau();
    }
}
?>