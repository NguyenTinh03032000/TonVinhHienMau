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
            <div class="col-sm-2"></div>
            <div class="col-sm-5">
                <?php
                if ($user) {

                    $sql = "select * from tk_canbo where username = '" . $_SESSION['Username'] . "'";
                    $kq = mysqli_query($kn, $sql);
                    $row = mysqli_fetch_array($kq);
                ?>

                    <h1>THÔNG TIN TÀI KHOẢN</h1>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            <img class="anhnen" src="image/thongtin.png" alt="">
                            <br>
                            <button type="button" class="btn btn-primary btnUpdate" data-toggle="modal" data-target="#modalUpdate" style="margin: auto;">CẬP NHẬT</button>

                            <!-- The Modal cập nhật-->
                            <div class="modal fade" id="modalUpdate">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Cập nhật thông tin</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <div class="container">
                                                <p>Họ tên</p>
                                                <input type="text" class="form-control" value="<?php echo $row['hoten'] ?>">
                                                <p>Ngày sinh</p>
                                                <input type="text" class="form-control">
                                                <p>Số điện thoại</p>
                                                <input type="text" class="form-control" value="<?php echo $row['sdt'] ?>">
                                                <p>Địa chỉ</p>
                                                <input type="text" class="form-control" value="<?php echo $row['diachi'] ?>">
                                                <p>Email</p>
                                                <input type="text" class="form-control" value="<?php echo $row['email'] ?>">
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btnUpdate1" data-dismiss="modal">Thoát</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-8">
                            <table>
                                <tr>
                                    <td>Họ tên:</td>
                                    <td><?php echo $row['hoten'] ?></td>
                                </tr>
                                <tr>
                                    <td>Ngày sinh:</td>
                                    <td><?php echo $row['ngaysinh'] ?></td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại:</td>
                                    <td><?php echo $row['sdt'] ?></td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ:</td>
                                    <td><?php echo $row['diachi'] ?></td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><?php echo $row['email'] ?></td>
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
            <div class="col-sm-5"></div>
        </div>
    </div>

    <!-- chân trang -->
    <div class="jumbotron text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>
</body>

</html>