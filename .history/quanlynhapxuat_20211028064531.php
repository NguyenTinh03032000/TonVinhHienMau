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
    <title>Quản lý nhập xuất</title>
    <meta charset="utf-8">
    <meta name="viewport" content=width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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
        <h3 style="text-align: center;">
            Đợt tôn vinh
            <?php
            $sql = "SELECT * FROM tonvinh ORDER BY ngaytonvinh DESC LIMIT 1";
            $kq = mysqli_query($kn, $sql);
            $row1 = mysqli_fetch_array($kq);
            echo $row1['matonvinh'];
            ?>
        </h3>
        <br>

        <div class="container-fluid bgnx">
            <div class="row bg-item">
                <div class="col-lg-1"></div>
                <div class="col-lg-10" style="margin-top:60px; margin-bottom:30px;">

                    <div class="item">
                        <h1 class="item-h1">Bệnh viện đa khoa</h1>
                        <h1 class="item-h1">Tỉnh Bình Định</h1>
                        <br>
                        <button type="button" class="btn btn-danger btnimport" data-toggle="modal" data-target="#modalBenhVien">
                            <h4><b>IMPORT</b></h4>
                        </button>

                        <form action="importBenhVien.php" method="post" enctype="multipart/form-data">
                            <!-- The Modal bệnh viện-->
                            <div class="modal" id="modalBenhVien">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Nhập thông tin bệnh viện</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <input type="file" name="fileBenhVien" class="form-control-file border">
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" style="background:cadetblue" data-dismiss="modal">THOÁT</button>
                                            <button type="submit" class="btn btn-danger" name="btnThemBV">IMPORT</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                    <div style="display: flex; justify-content: center;">
                        <div class="row">
                            <?php
                            $sql1 = "select * from donvi";
                            $kq1 = mysqli_query($kn, $sql1);
                            while ($row = mysqli_fetch_array($kq1)) {
                            ?>

                                <div class="col-lg-3 col-md-6">
                                    <div>
                                        <div class="donvi">
                                            <div style="height: 160px;">
                                                <img src="image/logoDV.png">
                                            </div>
                                            <div class="donvi-ten" style="height: 115px;">
                                                <p>
                                                    <b><?php echo $row['tendonvi'] ?></b>
                                                </p>
                                            </div>
                                            <div class="row" style="margin: 1px; height: 55px">
                                                <div class="col-lg-6">
                                                    <button type="button" class="btn btn-danger btn-block" data-toggle="collapse" data-target="#excel<?php echo $row['madonvi'] ?>">
                                                        <b>IMPORT</b>
                                                    </button>
                                                </div>
                                                <div class="col-lg-6" style="margin-bottom: 25px;">
                                                    <a href="KiemDuyetTonVinh.php?madonvi=<?php echo $row['madonvi'] ?>&matonvinh=<?php echo $row1['matonvinh'] ?>" class="btn btn-success btn-block">
                                                        <b>VIEW</b>
                                                    </a>
                                                </div>
                                            </div>

                                            <form action="ImportDV.php" method="post" enctype="multipart/form-data">
                                                <div id="excel<?php echo $row['madonvi'] ?>" class="collapse" style="margin: 1px;">
                                                    <?php
                                                    $sql2 = "SELECT * FROM excel_tonvinh WHERE MaDonVi= '" . $row['madonvi'] . "' AND MaTonVinh='" . $row1['matonvinh'] . "'  LIMIT 1";
                                                    $kq2 = mysqli_query($kn, $sql2) or die("Lỗi truy vấn");
                                                    $row2 = mysqli_fetch_array($kq2);
                                                    if (isset($row2['TenFile'])) {
                                                        //if ($row2['TenFile'] != '') {
                                                        echo 'Tên file: ' . $row2['TenFile'];
                                                        echo '<br>';
                                                    } else {
                                                        echo '<div style="padding: 10px;">
                                                        <div>
                                                            <input type="file" name="fileThemDV" style="margin-bottom: 15px;" class="form-control">
                                                            <input hidden type="text" name="txtMDV" value="' . $row['madonvi'] . '" class="form-control">
                                                            <input hidden type="text" name="txtMTV" value="' . $row1['matonvinh'] . '" class="form-control">
                                                            <button class="btn btn-success btn-block" name="btnImportDV">IMPORT EXCEL</button>
                                                        </div>
                                                    </div>';
                                                    }
                                                    ?>
                                                    <!--  -->
                                                    <br>
                                                </div>
                                            </form>

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