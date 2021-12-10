<?php
require 'site.php';
include "bocuc/Connect.php";
// require('Classes/PHPExcel.php');
// require_once('./Classes/PHPExcel/IOFactory.php');
include "bocuc/KiemTraSession.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>demo hiển thị</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <style>
        .btn {
            margin: 15px 15px;
        }

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
    <?php load_menu(); ?>

    <div class="container-fluid" style="margin-top:30px; margin-bottom:30px;">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?php
                if ($user) {
                ?>
                    <table class="table table-bordered" style="width: 100%">
                        <tr>
                            <td>STT</td>
                            <td>Họ tên</td>
                            <td>Ngày sinh</td>
                            <td>Nhóm máu</td>
                            <td>SDT</td>
                            <td>Nghề nghiệp</td>
                            <td>Địa chỉ</td>
                            <td>Mức 5</td>
                            <td>Mức 10</td>
                            <td>Mức 15</td>
                            <td>Mức 20</td>
                            <td>Mức 30</td>
                            <td>Mức 40</td>
                            <td>Mức 50</td>
                            <td>Mức 60</td>
                            <td>Mức 70</td>
                            <td>Mức 80</td>
                            <td>Mức 90</td>
                            <td>Mức 10</td>
                            <td>Ghi chú</td>
                        </tr>
                    </table>
                <?php
                } else {
                    include "loadDangNhap.php";
                }
                ?>
                <br>
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