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
    <title>demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- <script src="js/chonkhoa.js"></script>
    <script src="js/chonkhoa1.js"></script>
    <script src="js/chonkhoa2.js"></script>
    <script src="js/chonnamhoc.js"></script> -->
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <link rel="stylesheet" href="style/reponsive.css">
</head>

<body>
    <!-- top đầu trang -->
    <div>

        <?php load_top(); ?>

    </div>

    <!-- menu của trang / menu user 1 -->
    <?php load_menu(); ?>
    <?php
    if ($user) {
    ?>
        <h1 style="text-align: center;">QUẢN LÝ NHẬP XUẤT DỮ LIỆU CƠ SỞ</h1>
        <br>

        <div class="container-fluid bgnx">
            <div class="row bg-item">
                <div class="col-lg-1"></div>
                <div class="col-lg-10" style="margin-top:60px; margin-bottom:30px;">

                    <div class="item">
                        <h1 class="item-h1">Hello</h1>
                        <h1 class="item-h1">Tỉnh Bình Định</h1>
                        <br>
                        <button type="button" class="btn btn-danger btnimport">
                            <h4><b>IMPORT</b></h4>
                        </button>
                    </div>
                    <div style="display: flex; justify-content: center;">
                        <div class="row">
                            <?php
                            $sql1 = "select * from donvi";
                            $kq1 = mysqli_query($kn, $sql1);
                            while ($row = mysqli_fetch_array($kq1)) {
                            ?>

                                <div class="col-lg-3 col-md-6">
                                    <div class="donvi">
                                        <img src="image/logoDV.png">
                                        <p style="text-transform: uppercase; font-size: 25px;">
                                            <b><?php echo $row['tendonvi'] ?></b>
                                        </p>
                                        <div class="row" style="margin: 1px;">
                                            <div class="col-lg-6" style="margin-bottom: 25px;">
                                                <button type="button" class="btn btn-danger btn-block">
                                                    <b>IMPORT</b>
                                                </button>
                                            </div>
                                            <div class="col-lg-6" style="margin-bottom: 25px;">
                                                <button type=" button" class="btn btn-success btn-block">
                                                    <b>VIEW</b>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
    <?php
    } else {
        include "loadDangNhap.php";
    }
    ?>
    <!-- chân trang -->
    <div class="jumbotron text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>
</body>

</html>