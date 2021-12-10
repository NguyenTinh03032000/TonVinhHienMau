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
    <title>Xác nhận kết quả</title>
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

        p {
            margin: auto;
            text-align: center;
        }
    </style>
</head>

<?php

$matonvinh = $_GET['matonvinh'];

function TongMuc($matonvinh, $muctonvinh)
{
    include "bocuc/Connect.php";
    $sql = "SELECT DISTINCT donvi.madonvi, donvi.tendonvi,
                        COUNT(case when danhsachtonvinh.MucTonVinh = '5' then 1 else null end) as Muc5, 
                        COUNT(case when danhsachtonvinh.MucTonVinh = '10' then 1 else null end) as Muc10,
                        COUNT(case when danhsachtonvinh.MucTonVinh = '15' then 1 else null end) as Muc15,
                        COUNT(case when danhsachtonvinh.MucTonVinh = '20' then 1 else null end) as Muc20,
                        COUNT(case when danhsachtonvinh.MucTonVinh = '30' then 1 else null end) as Muc30,
                        COUNT(case when danhsachtonvinh.MucTonVinh = '40' then 1 else null end) as Muc40,
                        COUNT(case when danhsachtonvinh.MucTonVinh = '50' then 1 else null end) as Muc50,
                        COUNT(case when danhsachtonvinh.MucTonVinh = '60' then 1 else null end) as Muc60,
                        COUNT(case when danhsachtonvinh.MucTonVinh = '70' then 1 else null end) as Muc70,
                        COUNT(case when danhsachtonvinh.MucTonVinh = '80' then 1 else null end) as Muc80,
                        COUNT(case when danhsachtonvinh.MucTonVinh = '90' then 1 else null end) as Muc90,
                        COUNT(case when danhsachtonvinh.MucTonVinh = '100' then 1 else null end) as Muc100 
                        FROM danhsachtonvinh INNER JOIN donvi ON donvi.madonvi = danhsachtonvinh.MaDonVi 
                                            INNER JOIN nguoihienmau ON nguoihienmau.ID_NguoiHienMau = danhsachtonvinh.ID_NguoiHienMau 
                                            INNER JOIN tonvinh on tonvinh.matonvinh = danhsachtonvinh.MaTonVinh 
                                            WHERE tonvinh.matonvinh = '" . $matonvinh . "'";
    $kq = mysqli_query($kn, $sql) or die("lỗi truy vấn");
    $row = mysqli_fetch_array($kq);

    if ($muctonvinh == "5") {
        $tongmuc5 = $row['Muc5'];
        return $tongmuc5;
    } elseif ($muctonvinh == "10") {
        $tongmuc10 = $row['Muc10'];
        return $tongmuc10;
    } elseif ($muctonvinh == "15") {
        $tongmuc15 = $row['Muc15'];
        return $tongmuc15;
    } elseif ($muctonvinh == "20") {
        $tongmuc20 = $row['Muc20'];
        return $tongmuc20;
    } elseif ($muctonvinh == "30") {
        $tongmuc30 = $row['Muc30'];
        return $tongmuc30;
    } elseif ($muctonvinh == "40") {
        $tongmuc40 = $row['Muc40'];
        return $tongmuc40;
    } elseif ($muctonvinh == "50") {
        $tongmuc50 = $row['Muc50'];
        return $tongmuc50;
    } elseif ($muctonvinh == "60") {
        $tongmuc60 = $row['Muc60'];
        return $tongmuc60;
    } elseif ($muctonvinh == "70") {
        $tongmuc70 = $row['Muc70'];
        return $tongmuc70;
    } elseif ($muctonvinh == "80") {
        $tongmuc80 = $row['Muc80'];
        return $tongmuc80;
    } elseif ($muctonvinh == "90") {
        $tongmuc90 = $row['Muc90'];
        return $tongmuc90;
    } elseif ($muctonvinh == "100") {
        $tongmuc100 = $row['Muc100'];
        return $tongmuc100;
    }
}

function TimKiem($matonvinh)
{
    include "bocuc/Connect.php";

    $stt = 0;
    $stt_LaMa = 0;

    $STT_LaMa = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII", "XIII", "XIV", "XV", "XVI", "XVII", "XVIII", "XIX", "XX", "XXI", "XXII", "XXIII", "XXIV", "XXV");

    $sqldonvi = "SELECT DISTINCT donvi.madonvi, donvi.tendonvi FROM donvi INNER JOIN danhsachtonvinh ON donvi.madonvi = danhsachtonvinh.MaDonVi where danhsachtonvinh.MaTonVinh = '" . $matonvinh . "' ORDER BY donvi.madonvi ASC";
    $kqdonvi = mysqli_query($kn, $sqldonvi) or die("lỗi truy vấn 1");
    while ($rowdonvi = mysqli_fetch_array($kqdonvi)) {

        echo '<tr>
                        <td colspan="20" stylr="text-align: center">
                            <h5 style="margin: 10px auto;">' . $rowdonvi['tendonvi'] . '</h5>
                        </td>
                    </tr>';

        $sql = "SELECT nguoihienmau.ID_NguoiHienMau, nguoihienmau.HoTen, nguoihienmau.NgaySinh, nguoihienmau.NhomMau, nguoihienmau.SDT, nguoihienmau.NgheNghiep, nguoihienmau.DiaChi, nguoihienmau.SoLanHienMau,
                            case when danhsachtonvinh.MucTonVinh = '5' then 1 else null end as Muc5, 
                            case when danhsachtonvinh.MucTonVinh = '10' then 1 else null end as Muc10,
                            case when danhsachtonvinh.MucTonVinh = '15' then 1 else null end as Muc15,
                            case when danhsachtonvinh.MucTonVinh = '20' then 1 else null end as Muc20,
                            case when danhsachtonvinh.MucTonVinh = '30' then 1 else null end as Muc30,
                            case when danhsachtonvinh.MucTonVinh = '40' then 1 else null end as Muc40,
                            case when danhsachtonvinh.MucTonVinh = '50' then 1 else null end as Muc50,
                            case when danhsachtonvinh.MucTonVinh = '60' then 1 else null end as Muc60,
                            case when danhsachtonvinh.MucTonVinh = '70' then 1 else null end as Muc70,
                            case when danhsachtonvinh.MucTonVinh = '80' then 1 else null end as Muc80,
                            case when danhsachtonvinh.MucTonVinh = '90' then 1 else null end as Muc90,
                            case when danhsachtonvinh.MucTonVinh = '100' then 1 else null end as Muc100 
                            FROM danhsachtonvinh INNER JOIN donvi ON donvi.madonvi = danhsachtonvinh.MaDonVi 
                                                    INNER JOIN nguoihienmau ON nguoihienmau.ID_NguoiHienMau = danhsachtonvinh.ID_NguoiHienMau 
                                                    INNER JOIN tonvinh on tonvinh.matonvinh = danhsachtonvinh.MaTonVinh 
                                                    WHERE tonvinh.matonvinh = '" . $matonvinh . "' and danhsachtonvinh.MaDonVi = '" . $rowdonvi['madonvi'] . "' ORDER BY danhsachtonvinh.MucTonVinh ASC";
        $kq = mysqli_query($kn, $sql) or die("lỗi truy vấn");

        while ($row = mysqli_fetch_array($kq)) {
            $stt +=  1;
            $ngaysinh = htmlspecialchars(date_format(date_create($row['NgaySinh']), "d/m/Y"));

            $muc5 = "";
            $muc10 = "";
            $muc15 = "";
            $muc20 = "";
            $muc30 = "";
            $muc40 = "";
            $muc50 = "";
            $muc60 = "";
            $muc70 = "";
            $muc80 = "";
            $muc90 = "";
            $muc100 = "";

            if ($row['Muc5'] == "null") {
                $muc5 = "";
            } elseif ($row['Muc5'] == "1") {
                $muc5 = $row['SoLanHienMau'];
            }

            if ($row['Muc10'] == "null") {
                $muc10 = "";
            } elseif ($row['Muc10'] == "1") {
                $muc10 = $row['SoLanHienMau'];
            }

            if ($row['Muc15'] == "null") {
                $muc15 = "";
            } elseif ($row['Muc15'] == "1") {
                $muc15 = $row['SoLanHienMau'];
            }

            if ($row['Muc20'] == "null") {
                $muc20 = "";
            } elseif ($row['Muc20'] == "1") {
                $muc20 = $row['SoLanHienMau'];
            }

            if ($row['Muc30'] == "null") {
                $muc30 = "";
            } elseif ($row['Muc30'] == "1") {
                $muc30 = $row['SoLanHienMau'];
            }

            if ($row['Muc40'] == "null") {
                $muc40 = "";
            } elseif ($row['Muc40'] == "1") {
                $muc40 = $row['SoLanHienMau'];
            }

            if ($row['Muc50'] == "null") {
                $muc50 = "";
            } elseif ($row['Muc50'] == "1") {
                $muc50 = $row['SoLanHienMau'];
            }

            if ($row['Muc60'] == "null") {
                $muc60 = "";
            } elseif ($row['Muc60'] == "1") {
                $muc60 = $row['SoLanHienMau'];
            }

            if ($row['Muc70'] == "null") {
                $muc70 = "";
            } elseif ($row['Muc70'] == "1") {
                $muc70 = $row['SoLanHienMau'];
            }

            if ($row['Muc80'] == "null") {
                $muc80 = "";
            } elseif ($row['Muc80'] == "1") {
                $muc80 = $row['SoLanHienMau'];
            }

            if ($row['Muc90'] == "null") {
                $muc90 = "";
            } elseif ($row['Muc90'] == "1") {
                $muc90 = $row['SoLanHienMau'];
            }

            if ($row['Muc100'] == "null") {
                $muc100 = "";
            } elseif ($row['Muc100'] == "1") {
                $muc100 = $row['SoLanHienMau'];
            }

            echo '<tr>
                <td style="vertical-align: inherit;">
                    <p>' . $stt . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . $row['HoTen'] . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . $ngaysinh . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . $row['NhomMau'] . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . $row['SDT'] . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . $row['NgheNghiep'] . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . $row['DiaChi'] . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . $muc5 . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . $muc10 . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . $muc15 . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . $muc20 . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . $muc30 . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . $muc40 . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . $muc50 . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . $muc60 . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . $muc70 . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . $muc80 . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . $muc90 . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . $muc100 . '</p>
                </td>
            </tr>';
        }
    }

    $sqlTong = "SELECT COUNT(nguoihienmau.ID_NguoiHienMau) as Tong FROM danhsachtonvinh 
                    INNER JOIN donvi ON donvi.madonvi = danhsachtonvinh.MaDonVi 
                    INNER JOIN nguoihienmau ON nguoihienmau.ID_NguoiHienMau = danhsachtonvinh.ID_NguoiHienMau 
                    INNER JOIN tonvinh on tonvinh.matonvinh = danhsachtonvinh.MaTonVinh 
                    WHERE tonvinh.matonvinh = '" . $matonvinh . "'";
    $kqTong = mysqli_query($kn, $sqlTong) or die("lỗi truy vấn");
    $rowTong = mysqli_fetch_array($kqTong);

    echo '<tr>
                <td colspan="7" style="text-align: center; vertical-align: inherit;">
                    <h5>Tổng: ' . $rowTong['Tong'] . ' cá nhân</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . TongMuc($matonvinh, 5) . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . TongMuc($matonvinh, 10) . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . TongMuc($matonvinh, 15) . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . TongMuc($matonvinh, 20) . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . TongMuc($matonvinh, 30) . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . TongMuc($matonvinh, 40) . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . TongMuc($matonvinh, 50) . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . TongMuc($matonvinh, 60) . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . TongMuc($matonvinh, 70) . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . TongMuc($matonvinh, 80) . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . TongMuc($matonvinh, 90) . '</p>
                </td>
                <td style="vertical-align: inherit;">
                    <p>' . TongMuc($matonvinh, 100) . '</p>
                </td>
            </tr>';
}

?>

<body>
    <!-- top đầu trang -->
    <div>

        <?php load_top(); ?>

    </div>

    <!-- menu của trang / menu user 1 -->
    <?php load_menu(); ?>

    <form action="ExportExcel.php" method="POST">
        <div class="container-fluid" style="margin-top:30px; margin-bottom:30px;">
            <h1 style="text-align: center; color: #e34230;">XÁC NHẬN KẾT QUẢ ĐỢT TÔN VINH <?php echo $matonvinh ?></h1>
            <br>
            <button type="button" data-toggle="modal" data-target="#modalExcel" class="btn btn-danger" style="display: flex; margin: auto;">Xuất file excel</button>
            <!-- The Modal -->
            <div class="modal" id="modalExcel">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">EXCEL TỔNG HỢP</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <p style="text-align: left;">Nhập tên người lập biểu</p>
                            <input type="text" name="txtTenLapBieu" class="form-control">
                            <p style="text-align: left;">Nhập tên chủ tịch</p>
                            <input type="text" name="txtTenChuTich" class="form-control">
                            <h5>Bạn có đồng ý xuất file excel?</h5>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">THOÁT</button>
                            <button name="btnMaTonVinh" value="<?php echo $matonvinh ?>" class="btn btn-danger">XUẤT EXCEL</button>
                        </div>

                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    if ($user) {
                    ?>
                        <div class="table-responsive-xl">
                            <table class="table table-bordered">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th style="vertical-align: inherit;">STT</th>
                                        <th style="vertical-align: inherit;">Họ tên</th>
                                        <th style="vertical-align: inherit;">Ngày sinh</th>
                                        <th style="width: 50px; vertical-align: inherit;">Nhóm máu</th>
                                        <th style="vertical-align: inherit;">SĐT</th>
                                        <th style="vertical-align: inherit;">Nghề nghiệp</th>
                                        <th style="vertical-align: inherit;">Địa chỉ</th>
                                        <th style="vertical-align: inherit;">Mức 5</th>
                                        <th style="vertical-align: inherit;">Mức 10</th>
                                        <th style="vertical-align: inherit;">Mức 15</th>
                                        <th style="vertical-align: inherit;">Mức 20</th>
                                        <th style="vertical-align: inherit;">Mức 30</th>
                                        <th style="vertical-align: inherit;">Mức 40</th>
                                        <th style="vertical-align: inherit;">Mức 50</th>
                                        <th style="vertical-align: inherit;">Mức 60</th>
                                        <th style="vertical-align: inherit;">Mức 70</th>
                                        <th style="vertical-align: inherit;">Mức 80</th>
                                        <th style="vertical-align: inherit;">Mức 90</th>
                                        <th style="vertical-align: inherit;">Mức 100</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    TimKiem($matonvinh);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    } else {
                        include "loadDangNhap.php";
                    }
                    ?>
                    <br>
                </div>
            </div>
        </div>
    </form>

    <!-- chân trang -->
    <div class="jumbotron text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>
</body>

</html>