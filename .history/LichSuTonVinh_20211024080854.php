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

    <form action="" method="post">
        <div class="container-fluid" style="margin-top:30px; margin-bottom:30px;">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <?php
                    if ($user) {

                        $sql = "select * from tonvinh ORDER BY ngaytonvinh DESC";
                        $kq = mysqli_query($kn, $sql);

                    ?>

                        <h1>LỊCH SỬ TÔN VINH</h1>
                        <br>

                        <button type="button" class="btn btn-danger btnThem" data-toggle="modal" data-target="#modalThem">THÊM ĐỢT TÔN VINH</button>


                        <!-- The Modal cập nhật-->
                        <div class="modal fade" id="modalThem">
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
                                            <p>Ngày tôn vinh</p>
                                            <input type="date" class="form-control" name="dateNgayTonVinh">
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>
                                        <button type="submit" class="btn btn-secondary btnThem1" name="btnThem">Thêm</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <br>

                        <ul class="nav nav-pills btnXuLy" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link btnThongTin active" data-toggle="pill" href="#home">DANH SÁCH ĐỢT TÔN VINH</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btnThongTin" data-toggle="pill" href="LichSuTonVinh_DanhSach.php">LỊCH SỬ TÔN VINH</a>
                            </li>
                        </ul>

                        <div class="tab-content border">
                            <!-- Danh sách tôn vinh -->
                            <div id="home" class="container-fluid tab-pane active"><br>
                                <h3>DANH SÁCH ĐỢT TÔN VINH</h3>
                                <table class="table-bordered">
                                    <tr>
                                        <td>
                                            <p>STT</p>
                                        </td>
                                        <td>
                                            <p>ĐỢT TÔN VINH</p>
                                        </td>
                                        <td>
                                            <p>NGÀY TẠO</p>
                                        </td>
                                        <td>
                                            <p>NGÀY CẬP NHẬT</p>
                                        </td>
                                        <td>
                                            <p>XÓA</p>
                                        </td>
                                    </tr>

                                    <?php

                                    $stt = 0;
                                    while ($row = mysqli_fetch_array($kq)) {
                                        if (!$row) {
                                            echo '<tr><td colspan="6" style="text-align: center; font-size: 20px">CHƯA CÓ DỮ LIỆU</td></tr>';
                                        } else {

                                    ?>
                                            <tr>
                                                <td>
                                                    <p><?php echo $stt += 1 ?></p>
                                                </td>
                                                <td>
                                                    <p><?php echo $row['matonvinh'] ?></p>
                                                </td>
                                                <td>
                                                    <p><?php echo htmlspecialchars(date_format(date_create($row['ngaytonvinh']), "d/m/Y")); ?></p>
                                                </td>
                                                <td>
                                                    <p>
                                                        <?php
                                                        if ($row['update_at'] == "0000-00-00") {
                                                            echo "";
                                                        } else {
                                                            echo htmlspecialchars(date_format(date_create($row['update_at']), "d/m/Y"));
                                                        }
                                                        ?>
                                                    </p>
                                                </td>
                                                <td>

                                                    <button type="button" class="btn" data-toggle="modal" data-target="#modalXoa">
                                                        <img src="image/delete.png" alt="" style="width: 35px;">
                                                    </button>

                                                    <!-- The Modal cập nhật-->
                                                    <div class="modal fade" id="modalXoa">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">

                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Xóa thông tin</h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>

                                                                <!-- Modal body -->
                                                                <div class="modal-body">
                                                                    <div class="container-fluid">
                                                                        <input type="text" hidden class="form-control" name="txtMaTonVinh_Xoa" value="<?php echo $row['matonvinh'] ?>">
                                                                        <h4><small>Bạn muốn xóa thông tin đợt tôn vinh này?</small></h4>
                                                                    </div>
                                                                </div>

                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>
                                                                    <button type="submit" class="btn btn-secondary btnThem1" name="btnXoa">Xóa</button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>

                                    <?php }
                                    } ?>
                                </table>
                            </div>

                        <?php
                    } else {
                        include "loadDangNhap.php";
                    }
                        ?>
                        </div>

                        <div class="col-sm-1"></div>
                </div>
            </div>

    </form>

    <!-- chân trang -->
    <div class="jumbotron text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>
</body>

</html>

<?php

$dateNgayTonVinh = array_key_exists('dateNgayTonVinh', $_POST) ?  $_POST['dateNgayTonVinh'] : null;
$txtMaTonVinh_Xoa = array_key_exists('txtMaTonVinh_Xoa', $_POST) ?  $_POST['txtMaTonVinh_Xoa'] : null;

$username = $_SESSION['Username'];

function ThemDotTonVinh($dateNgayTonVinh)
{
    include "bocuc/Connect.php";

    $arrTonVinh = explode("-", $dateNgayTonVinh);
    $nam = array_shift($arrTonVinh);
    $ngay = array_pop($arrTonVinh);
    $thang = implode("", $arrTonVinh);

    $matonvinh = $thang . "-" . $nam;

    $sql = "insert into tonvinh (matonvinh, ngaytonvinh, create_at, update_at) values ('" . $matonvinh . "', '" . $dateNgayTonVinh . "', '" . $dateNgayTonVinh . "', '')";
    $kq = mysqli_query($kn, $sql) or die("lỗi truy vấn");

    if ($kq) {
        echo '<meta http-equiv="refresh" content="0">';
        echo "<script>alert('Thêm thành công');</script>";
    } else {
        echo "<script>alert('Không thể thêm thông tin. Vui lòng thử lại sau!!!');</script>";
    }
}

function XoaDotTonVinh($txtMaTonVinh_Xoa)
{
    include "bocuc/Connect.php";

    $sql = "delete from tonvinh where matonvinh = '" . $txtMaTonVinh_Xoa . "'";
    $kq = mysqli_query($kn, $sql) or die("lỗi truy vấn");

    if ($kq) {
        echo '<meta http-equiv="refresh" content="0">';
        echo "<script>alert('Xóa thành công');</script>";
    } else {
        echo "<script>alert('Không thể xóa thông tin. Vui lòng thử lại sau!!!');</script>";
    }
}

if ($_POST) {
    if (isset($_POST['btnThem']) and $_SERVER['REQUEST_METHOD'] == "POST") {
        ThemDotTonVinh($dateNgayTonVinh);
    }
    if (isset($_POST['btnXoa']) and $_SERVER['REQUEST_METHOD'] == "POST") {
        XoaDotTonVinh($txtMaTonVinh_Xoa);
    }
}

?>