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
    <title>Lịch sử tôn vinh</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <link rel="stylesheet" href="style/style-lichsutonvinh.css">
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
    <?php load_menu(); ?>

    <div class="container-fluid" style="margin-top:30px; margin-bottom:30px;">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?php
                if ($user) {

                    $sql = "select * from tk_canbo where username = '" . $_SESSION['Username'] . "'";
                    $kq = mysqli_query($kn, $sql);
                    $row = mysqli_fetch_array($kq);
                ?>

                    <h1>LỊCH SỬ TÔN VINH</h1>
                    <br>

                    <button type="button" class="btn btn-danger btnUpdate" data-toggle="modal" data-target="#modalUpdate" style="margin: auto;">THÊM ĐỢT TÔN VINH</button>

                    <form action="" method="post">
                        <!-- The Modal cập nhật-->
                        <div class="modal fade" id="modalUpdate">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Thêm đợt tôn vinh</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <p>Họ tên</p>
                                            <input type="text" class="form-control" name="txtHoTen" value="<?php echo $row['hoten'] ?>">
                                            <p>Ngày sinh</p>
                                            <input type="date" class="form-control" name="dateNgaySinh" value="<?php echo htmlspecialchars(date_format(date_create($row['ngaysinh']), "Y-m-d"));  ?>">
                                            <p>Số điện thoại</p>
                                            <input type="text" class="form-control" name="txtSDT" value="<?php echo $row['sdt'] ?>">
                                            <p>Địa chỉ</p>
                                            <input type="text" class="form-control" name="txtDiaChi" value="<?php echo $row['diachi'] ?>">
                                            <p>Email</p>
                                            <input type="text" class="form-control" name="txtEmail" value="<?php echo $row['email'] ?>">
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>
                                        <button type="submit" class="btn btn-secondary btnUpdate1" name="btnCapNhat">Cập nhật</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>


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