<?php
require 'site.php';
include "bocuc/Connect.php";
require('PHPExcel/Classes/PHPExcel.php');
require_once('PHPExcel/Classes/PHPExcel/IOFactory.php');
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <link rel="stylesheet" href="style/reponsive.css">
</head>

<?php
if (isset($_POST['btnThemBV'])) {
    if (array_key_exists('fileBenhVien', $_POST)) {
        $file = $_FILES['fileBenhVien']['tmp_name'];

        $objReader = PHPExcel_IOFactory::load($file);

        echo $file;
    }
    // foreach ($objReader->getWorksheetIterator() as $workSheet) {
    //     $highestRow = $workSheet->getHighestRow();

    //     for ($row = 2; $row < $highestRow; $row++) {
    //         $masv = $workSheet->getCellByColumnAndRow(0, $row)->getValue();
    //         $hoten = $workSheet->getCellByColumnAndRow(1, $row)->getValue();
    //         $ngaysinh = $workSheet->getCellByColumnAndRow(2, $row)->getValue();
    //         $gioitinh = $workSheet->getCellByColumnAndRow(3, $row)->getValue();
    //         $sdt = $workSheet->getCellByColumnAndRow(4, $row)->getValue();
    //         $email = $workSheet->getCellByColumnAndRow(5, $row)->getValue();
    //         $chucvu = $workSheet->getCellByColumnAndRow(6, $row)->getValue();
    //         $tinhtranghoc = $workSheet->getCellByColumnAndRow(7, $row)->getValue();

    //         $unix_date = ($ngaysinh - 25569) * 86400;
    //         $excel_date = 25569 + ($unix_date / 86400);
    //         $unix_date = ($excel_date - 25569) * 86400;
    //         $date = gmdate("Y-m-d", $unix_date);

    //         if ($masv != '') {
    //             echo $masv . " - " . $hoten . "<br>";

    //             // $sqlThem = "insert into sinhvien (MaSinhVien, HoTen, NgaySinh, GioiTinh, SDT, Email, MaLop, ChucVu, TinhTrangHoc, MatKhau, Quyen)
    //             //             values ('$masv', '$hoten', '$date', '$gioitinh', '$sdt', '$email', '$malop', '$chucvu', '$tinhtranghoc', '$masv', '$quyen')";
    //             // $kq2 = mysqli_query($kn, $sqlThem) or die("lỗi truy vấn");
    //         }
    //     }
    // echo "<script>alert('Thêm thành công');</script>";
    // }
}
?>

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

        <form action="" method="POST">
            <div class="container-fluid bgnx">
                <div class="row bg-item">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10" style="margin-top:60px; margin-bottom:30px;">

                        <div class="item">
                            <h1 class="item-h1">Bệnh viện Đa khoa</h1>
                            <h1 class="item-h1">Tỉnh Bình Định</h1>
                            <br>
                            <button type="button" class="btn btn-danger btnimport" data-toggle="modal" data-target="#modalBenhVien">
                                <h4><b>IMPORT</b></h4>
                            </button>

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

                        </div>
                        <div style="display: flex; justify-content: center;">
                            <div class="row">
                                <?php
                                $sql1 = "select * from donvi";
                                $kq1 = mysqli_query($kn, $sql1);
                                while ($row = mysqli_fetch_array($kq1)) {
                                ?>

                                    <div class="col-lg-3 col-md-6">
                                        <div class="donvi" style="height: 350px">
                                            <img src="image/logoDV.png">
                                            <p style="text-transform: uppercase; font-size: 20px;">
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
        </form>
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