<?php
require 'site.php';
include "bocuc/Connect.php";
require('Classes/PHPExcel.php');
require_once('./Classes/PHPExcel/IOFactory.php');
include "bocuc/KiemTraSession.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin tài khoản</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <link rel="stylesheet" href="style/style-thongtintaikhoan.css">
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
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <?php
                if ($user) {
                ?>

                    <h1>THÔNG TIN TÀI KHOẢN</h1>
                    <br>
                    <div class="row">
                        <div class="col-sm-2">
                            <img class="anhnen" src="image/thongtin.png" alt="">
                            <br>
                            <button type="button" class="btn btn-primary btnUpdate" data-toggle="modal" data-target="modalUpdate">CẬP NHẬT</button>
                        </div>
                        <div class="col-sm-10">
                            <table>
                                <tr>
                                    <td>Họ tên:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Ngày sinh:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                <?php
                } else {
                    include "loadDangNhap.php";
                }
                ?>
                <br>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>

    <!-- chân trang -->
    <div class="jumbotron text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>
</body>

</html>