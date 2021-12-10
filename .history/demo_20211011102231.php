<?php
require 'site.php';
include "bocuc/Connect.php";
include "bocuc/KiemTraSession.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <style>
        .fakeimg {
            height: 200px;
            background: #aaa;
        }
    </style>
</head>

<body>

    <!-- top đầu trang -->
    <div class="jumbotron text-center" style="margin-bottom:0;  padding: 20px;">

        <?php load_top(); ?>

    </div>

    <!-- menu của trang / menu user 1 -->
    <?php load_MenuQuanTri(); ?>

    <!-- thân của trang -->
    <div class="container-fluid" style="margin-top:30px;">
        <div class="row">
            <div class="col-sm-1"></div>

            <div class="col-sm-10">
                <div class="container">
                    <?php
                    if ($user) {
                    ?>
                        <h2 style="text-align: center">HÒM THƯ GÓP Ý</h2>
                        <hr>
                        <a href="NoiDungGopY.php" class="btn btn-info" style="margin-bottom: 15px">THÔNG TIN GÓP Ý ĐÃ ĐÓNG GÓP</a>

                        <form action="HomThuGopY.php" class="needs-validation" method="POST" novalidate>
                            <div class="form-group">
                                <input type="text" class="form-control" id="tieude" placeholder="Tiêu đề" name="tieude" required autocomplete="off">
                                <div class="valid-feedback">Hợp lệ.</div>
                                <div class="invalid-feedback">Vui lòng không được bỏ trống thông tin!</div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="noidung" id="noidung" cols="30" rows="15" placeholder="Nội dung góp ý" required></textarea>
                                <div class="valid-feedback">Hợp lệ.</div>
                                <div class="invalid-feedback">Vui lòng không được bỏ trống thông tin!</div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary" style="position: absolute; right: 30px;">Gửi góp ý</button>
                        </form>
                        <br>
                </div>
            <?php
                    } else {
                        include "loadDangNhapUser.php";
                    }
            ?>
            <br>

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
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>

    <!-- chân trang -->
    <div class="jumbotron text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>
</body>

</html>
​