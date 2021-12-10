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
    <title>Quên mật khẩu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <link rel="stylesheet" href="style/style-QuenMatKhau.css">
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

    <div class="container-fluid" style="margin-top:30px; margin-bottom:30px;">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
                <h1 style="text-align: center; color: red;">QUÊN MẬT KHẨU</h1>
                <br>
                <form action="" class="needs-validation" method="POST" novalidate>
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group">
                                <input type="text" class="form-control" style="font-size: 25px; border-radius: 20px;" placeholder="Nhập email" name="txtEmail" required autocomplete="off" >
                                <div class="valid-feedback">Hợp lệ.</div>
                                <div class="invalid-feedback">Vui lòng không được bỏ trống thông tin!</div>
                            </div>
                        </div>
                        <div class="col-sm-3" style="margin: auto;">
                            <button type="submit" class="btn btn-danger btn-block" style="margin: auto; display: block; font-size: 25px;  border-radius: 6px;" name="btnQuenMatKhau">SEND</button>
                        </div>
                    </div>
                    
                    
                    <br>

                    <?php
                        if ($_POST) {
                            if (isset($_POST['btnQuenMatKhau']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                                quenmatkhau();
                            }
                        }
                    ?>
                
                </form>
                <br>
            </div>
            <div class="col-sm-6"></div>
        </div>
    </div>
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
function matkhaumoi($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}

function quenmatkhau()
{
    include "bocuc/Connect.php";

    $txtEmail = array_key_exists('txtEmail', $_POST) ? $_POST['txtEmail'] : null;

    $timEmail = "select * from tk_canbo where email = '".$txtEmail."'";
    $kqtimEmail = mysqli_query($kn, $timEmail);
    $row1 = mysqli_fetch_array($kqtimEmail);

    if (!$row1) {
        echo '<div class="alert alert-danger" style="font-size: 20px;"> Email không tồn tại !! </div>';
    } else {
        $chuoimatkhau = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $matkhaumoi = matkhaumoi($chuoimatkhau, 20);

        $sql = "update tk_canbo set password = '" . $matkhaumoi . "' where email = '" . $txtEmail . "'";
        $kq = mysqli_query($kn, $sql);
        echo '<div class="alert alert-success" style="font-size: 20px;"> 
                    Email: <b>'.$txtEmail.'</b>
                    <br><br>
                    Mật khẩu mới: <b>'.$matkhaumoi.'</b> 
                    <br><br>
                    Vui lòng trở lại trang <a href="index.php" class="link">Đăng nhập</a>
                </div>';
    }
       
}

?>