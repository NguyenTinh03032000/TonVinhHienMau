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

<?php

$matonvinh = "10-2021";

function TongMuc($matonvinh, $madonvi)
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
                                            WHERE tonvinh.matonvinh = '" . $matonvinh . "' and danhsachtonvinh.MaDonVi = '" . $madonvi . "' ORDER BY danhsachtonvinh.MucTonVinh ASC";
    $kq = mysqli_query($kn, $sql) or die("lỗi truy vấn");
    $row = mysqli_fetch_array($kq);

    $tongmuc5 = $row['Muc5'];
}

function TimKiem($matonvinh)
{
    include "bocuc/Connect.php";

    $sqldonvi = "SELECT DISTINCT donvi.madonvi, donvi.tendonvi FROM donvi INNER JOIN danhsachtonvinh ON donvi.madonvi = danhsachtonvinh.MaDonVi where danhsachtonvinh.MaTonVinh = '" . $matonvinh . "'";
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

        $stt = 0;
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
                    <p>' . $row['NhomMau'] . '</p>
                </td>
                <td>
                    <p>' . $row['SDT'] . '</p>
                </td>
                <td>
                    <p>' . $row['NgheNghiep'] . '</p>
                </td>
                <td>
                    <p>' . $row['DiaChi'] . '</p>
                </td>
                <td>
                    <p>' . $muc5 . '</p>
                </td>
                <td>
                    <p>' . $muc10 . '</p>
                </td>
                <td>
                    <p>' . $muc15 . '</p>
                </td>
                <td>
                    <p>' . $muc20 . '</p>
                </td>
                <td>
                    <p>' . $muc30 . '</p>
                </td>
                <td>
                    <p>' . $muc40 . '</p>
                </td>
                <td>
                    <p>' . $muc50 . '</p>
                </td>
                <td>
                    <p>' . $muc60 . '</p>
                </td>
                <td>
                    <p>' . $muc70 . '</p>
                </td>
                <td>
                    <p>' . $muc80 . '</p>
                </td>
                <td>
                    <p>' . $muc90 . '</p>
                </td>
                <td>
                    <p>' . $muc100 . '</p>
                </td>
            </tr>';
        }
    }
    echo '<tr>
                <td colspan="7" style="text-align: center">
                    <h5>Tổng</h5>
                </td>
                <td>
                    <p>' . $muc5 . '</p>
                </td>
                <td>
                    <p>' . $muc10 . '</p>
                </td>
                <td>
                    <p>' . $muc15 . '</p>
                </td>
                <td>
                    <p>' . $muc20 . '</p>
                </td>
                <td>
                    <p>' . $muc30 . '</p>
                </td>
                <td>
                    <p>' . $muc40 . '</p>
                </td>
                <td>
                    <p>' . $muc50 . '</p>
                </td>
                <td>
                    <p>' . $muc60 . '</p>
                </td>
                <td>
                    <p>' . $muc70 . '</p>
                </td>
                <td>
                    <p>' . $muc80 . '</p>
                </td>
                <td>
                    <p>' . $muc90 . '</p>
                </td>
                <td>
                    <p>' . $muc100 . '</p>
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

    <div class="container-fluid" style="margin-top:30px; margin-bottom:30px;">
        <div class="row">
            <div class="col-sm-12">
                <?php
                if ($user) {
                ?>
                    <table class="table table-bordered" style="width: 100%">
                        <tr style="text-align: center;">
                            <td>STT</td>
                            <td>Họ tên</td>
                            <td>Ngày sinh</td>
                            <td style="width: 50px;">Nhóm máu</td>
                            <td>SĐT</td>
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
                            <td>Mức 100</td>
                        </tr>
                        <?php
                        TimKiem($matonvinh);
                        ?>
                    </table>
                <?php
                } else {
                    include "loadDangNhap.php";
                }
                ?>
                <br>
            </div>
        </div>
    </div>

    <!-- chân trang -->
    <div class="jumbotron text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>
</body>

</html>