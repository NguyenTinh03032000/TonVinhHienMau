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
    <?php

    $dateNgayTonVinh = array_key_exists('dateNgayTonVinh', $_POST) ?  $_POST['dateNgayTonVinh'] : null;
    $cboDotTonVinh = array_key_exists('cboDotTonVinh', $_POST) ?  $_POST['cboDotTonVinh'] : null;
    $cboMucTonVinh = array_key_exists('cboMucTonVinh', $_POST) ?  $_POST['cboMucTonVinh'] : null;

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

    function TimKiem($cboDotTonVinh, $cboMucTonVinh)
    {
        if ($cboDotTonVinh == "" or $cboMucTonVinh == "") {
            echo "<script>alert('Vui lòng không bỏ trống thông tin');</script>";
        } else {
            include "bocuc/Connect.php";

            $sql = "SELECT * FROM danhsachtonvinh INNER JOIN tonvinh ON tonvinh.matonvinh = danhsachtonvinh.MaTonVinh 
                                                INNER JOIN nguoihienmau ON nguoihienmau.ID_NguoiHienMau = danhsachtonvinh.ID_NguoiHienMau 
                                                INNER JOIN donvi ON donvi.madonvi = danhsachtonvinh.MaDonVi 
                                                where tonvinh.MaTonVinh = '" . $cboDotTonVinh . "' and danhsachtonvinh.MucTonVinh = '" . $cboMucTonVinh . "'";
            $kq = mysqli_query($kn, $sql) or die("lỗi truy vấn");

            $stt = 0;
            while ($row = mysqli_fetch_array($kq)) {
                $stt +=  1;
                $ngaysinh = htmlspecialchars(date_format(date_create($row['NgaySinh']), "d/m/Y"));

                if ($row['ID'] == null) {
                    echo "<script>alert('Thông tin tìm kiếm không tồn tại');</script>";
                } else {
                    echo '<tr>
                    <td>
                        <p>' . $stt . '</p>
                    </td>
                    <td>
                        <p>' . $row['HoTen'] . '</p>
                    </td>
                    <td>
                        <p>' . $ngaysinh . '</p>
                    </td>
                    <td>
                        <p>' . $row['SDT'] . '</p>
                    </td>
                    <td>
                        <p>' . $row['DiaChi'] . '</p>
                    </td>
                    <td>
                        <p>' . $row['SoLanHienMau'] . '</p>
                    </td>
                    <td>
                        <p>' . $row['NhomMau'] . '</p>
                    </td>
                    <td>
                        <p>' . $row['NhomRH'] . '</p>
                    </td>
                    <td>
                        <p>' . $row['MucTonVinh'] . '</p>
                    </td>
                    <td>
                        <p>' . $row['MaTonVinh'] . '</p>
                    </td>
                </tr>';
                }
            }
        }
    }

    if ($_POST) {
        if (isset($_POST['btnThem']) and $_SERVER['REQUEST_METHOD'] == "POST") {
            ThemDotTonVinh($dateNgayTonVinh);
        }
    }

    ?>

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
                        <ul class="nav nav-pills btnXuLy" role="tablist">
                            <li>
                                <button type="button" class="btn btnThem" data-toggle="modal" data-target="#modalThem">THÊM ĐỢT TÔN VINH</button>
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

                            </li>

                            <li class="nav-item">
                                <a class="nav-link btnThongTin" href="LichSuTonVinh.php">DANH SÁCH ĐỢT TÔN VINH</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btnThongTin active" data-toggle="pill" href="#menu1">LỊCH SỬ TÔN VINH</a>
                            </li>
                        </ul>

                        <div class="tab-content border">
                            <!-- Lịch sử tôn vinh -->
                            <div id="menu1" class="container-fluid tab-pane active"><br>
                                <h3>LỊCH SỬ TÔN VINH</h3>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <select class="form-control" name="cboDotTonVinh" id="cboDotTonVinh">
                                            <option value="" selected="selected">-- Chọn đợt tôn vinh --</option>
                                            <?php
                                            $sqlDotTonVinh = "select * from tonvinh ORDER BY ngaytonvinh DESC";
                                            $kqDotTonVinh = mysqli_query($kn, $sqlDotTonVinh);
                                            while ($rowDotTonVinh = mysqli_fetch_array($kqDotTonVinh)) {
                                                echo '<option value="' . $rowDotTonVinh['matonvinh'] . '">Đợt ' . $rowDotTonVinh['matonvinh'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <script type='text/javascript'>
                                            document.getElementById('cboDotTonVinh').value = "<?php echo $_POST['cboDotTonVinh']; ?>";
                                        </script>
                                    </div>
                                    <div class="col-lg-4">
                                        <select class="form-control" name="cboMucTonVinh" id="cboMucTonVinh">
                                            <option value="" selected="selected">-- Chọn mức tôn vinh --</option>
                                            <?php
                                            $muctonvinh = 0;
                                            for ($i = 0; $i <= 20; $i++) {
                                                $muctonvinh += 5;
                                                echo '<option value="' . $muctonvinh . '">Mức ' . $muctonvinh . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <script type='text/javascript'>
                                            document.getElementById('cboMucTonVinh').value = "<?php echo $_POST['cboMucTonVinh']; ?>";
                                        </script>
                                    </div>
                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-secondary btnThem1 form-control" name="btnTimKiem">XEM THÔNG TIN</button>
                                    </div>
                                </div>

                                <table class="table-bordered">
                                    <tr class="table-danger">
                                        <td>
                                            <p>STT</p>
                                        </td>
                                        <td>
                                            <p>Họ tên</p>
                                        </td>
                                        <td>
                                            <p>Ngày sinh</p>
                                        </td>
                                        <td>
                                            <p>Số điện thoại</p>
                                        </td>
                                        <td>
                                            <p>Địa chỉ</p>
                                        </td>
                                        <td style="width: 80px;">
                                            <p>Số lần hiến máu</p>
                                        </td>
                                        <td style="width: 80px;">
                                            <p>Nhóm ABO</p>
                                        </td>
                                        <td>
                                            <p>Nhóm RH</p>
                                        </td>
                                        <td style="width: 80px;">
                                            <p>Đã tôn vinh</p>
                                        </td>
                                        <td>
                                            <p>Đợt tôn vinh</p>
                                        </td>
                                    </tr>

                                    <?php
                                    if ($_POST) {
                                        if (isset($_POST['btnTimKiem']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                                            TimKiem($cboDotTonVinh, $cboMucTonVinh);
                                        }
                                    }
                                    ?>

                                </table>
                            </div>
                        </div>

                    <?php
                    } else {
                        include "loadDangNhap.php";
                    }
                    ?>
                </div>

                <div class="col-sm-1"></div>

                <br>

            </div>
        </div>

    </form>

    <!-- chân trang -->
    <div class="jumbotron text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>
</body>

</html>