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

        h5 {
            margin: auto;
            text-align: center;
        }
    </style>
</head>

<?php
$sqlDotTonVinh_1 = "select * from tonvinh ORDER BY ngaytonvinh DESC";
$kqDotTonVinh_1 = mysqli_query($kn, $sqlDotTonVinh_1);
$rowDotTonVinh_1 = mysqli_fetch_array($kqDotTonVinh_1);

$matonvinh = $rowDotTonVinh_1['matonvinh'];
$cboDotTonVinh = array_key_exists('cboDotTonVinh', $_POST) ?  $_POST['cboDotTonVinh'] : null;
$cboDonVi = array_key_exists('cboDonVi', $_POST) ?  $_POST['cboDonVi'] : null;

function ThongTin($matonvinh)
{
    echo 'KẾT QUẢ ĐỢT TÔN VINH ' . $matonvinh;
}

function ThongTin_1($cboDotTonVinh)
{
    echo 'KẾT QUẢ ĐỢT TÔN VINH ' . $cboDotTonVinh;
}

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

function TongMuc_1($cboDotTonVinh, $muctonvinh, $cboDonVi)
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
                                            WHERE tonvinh.matonvinh = '" . $cboDotTonVinh . "' and donvi.madonvi = '" . $cboDonVi . "'";
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

    echo ' <thead>
        <tr style="text-align: center;">
            <th style="vertical-align: inherit;">STT</th>
            <th style="vertical-align: inherit;">Họ tên</th>
            <th style="vertical-align: inherit;">Ngày sinh</th>
            <th style="width: 50px; vertical-align: inherit;">Nhóm máu</th>
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
    <tbody>';

    $stt = 0;
    $stt_LaMa = 0;

    $STT_LaMa = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII", "XIII", "XIV", "XV", "XVI", "XVII", "XVIII", "XIX", "XX", "XXI", "XXII", "XXIII", "XXIV", "XXV");

    $sqldonvi = "SELECT DISTINCT donvi.madonvi, donvi.tendonvi FROM donvi INNER JOIN danhsachtonvinh ON donvi.madonvi = danhsachtonvinh.MaDonVi where danhsachtonvinh.MaTonVinh = '" . $matonvinh . "' ORDER BY donvi.madonvi ASC";
    $kqdonvi = mysqli_query($kn, $sqldonvi) or die("lỗi truy vấn 1");
    while ($rowdonvi = mysqli_fetch_array($kqdonvi)) {

        $stt_LaMa += 1;

        echo '<tr>
                    <td style="text-align: center">
                        <h5 style="margin: 10px auto;">' . $STT_LaMa[$stt_LaMa] . '</h5>
                    </td>
                    <td colspan="19" style="text-align: left">
                        <h5 style="margin: 10px auto; text-align: left">' . $rowdonvi['tendonvi'] . '</h5>
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
                    <h5>' . TongMuc($matonvinh, 5) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($matonvinh, 10) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($matonvinh, 15) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($matonvinh, 20) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($matonvinh, 30) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($matonvinh, 40) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($matonvinh, 50) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($matonvinh, 60) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($matonvinh, 70) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($matonvinh, 80) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($matonvinh, 90) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($matonvinh, 100) . '</h5>
                </td>
            </tr>
        </tbody>';
}

function TimKiem_1($cboDotTonVinh, $cboDonVi)
{
    include "bocuc/Connect.php";

    echo ' <thead>
        <tr style="text-align: center;">
            <th style="vertical-align: inherit;">STT</th>
            <th style="vertical-align: inherit;">Họ tên</th>
            <th style="vertical-align: inherit;">Ngày sinh</th>
            <th style="width: 50px; vertical-align: inherit;">Nhóm máu</th>
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
    <tbody>';

    $stt = 0;
    $stt_LaMa = 0;

    $STT_LaMa = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII", "XIII", "XIV", "XV", "XVI", "XVII", "XVIII", "XIX", "XX", "XXI", "XXII", "XXIII", "XXIV", "XXV");

    if ($cboDonVi == "null") {
        $sqldonvi = "SELECT DISTINCT donvi.madonvi, donvi.tendonvi FROM donvi INNER JOIN danhsachtonvinh ON donvi.madonvi = danhsachtonvinh.MaDonVi where danhsachtonvinh.MaTonVinh = '" . $cboDotTonVinh . "' ORDER BY donvi.madonvi ASC";
    } else {
        $sqldonvi = "SELECT DISTINCT donvi.madonvi, donvi.tendonvi FROM donvi INNER JOIN danhsachtonvinh ON donvi.madonvi = danhsachtonvinh.MaDonVi where danhsachtonvinh.MaTonVinh = '" . $cboDotTonVinh . "' and donvi.madonvi = '" . $cboDonVi . "' ORDER BY donvi.madonvi ASC";
    }

    $kqdonvi = mysqli_query($kn, $sqldonvi) or die("lỗi truy vấn 1");
    while ($rowdonvi = mysqli_fetch_array($kqdonvi)) {

        $stt_LaMa += 1;

        echo '<tr>
                    <td style="text-align: center">
                        <h5 style="margin: 10px auto;">' . $STT_LaMa[$stt_LaMa] . '</h5>
                    </td>
                    <td colspan="19" style="text-align: left">
                        <h5 style="margin: 10px auto; text-align: left">' . $rowdonvi['tendonvi'] . '</h5>
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
                                                    WHERE tonvinh.matonvinh = '" . $cboDotTonVinh . "' and danhsachtonvinh.MaDonVi = '" . $rowdonvi['madonvi'] . "' ORDER BY danhsachtonvinh.MucTonVinh ASC";
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

    if ($cboDonVi == "null") {
        $sqlTong = "SELECT COUNT(nguoihienmau.ID_NguoiHienMau) as Tong FROM danhsachtonvinh 
                    INNER JOIN donvi ON donvi.madonvi = danhsachtonvinh.MaDonVi 
                    INNER JOIN nguoihienmau ON nguoihienmau.ID_NguoiHienMau = danhsachtonvinh.ID_NguoiHienMau 
                    INNER JOIN tonvinh on tonvinh.matonvinh = danhsachtonvinh.MaTonVinh 
                    WHERE tonvinh.matonvinh = '" . $cboDotTonVinh . "'";

        $kqTong = mysqli_query($kn, $sqlTong) or die("lỗi truy vấn");
        $rowTong = mysqli_fetch_array($kqTong);

        echo '<tr>
                <td colspan="6" style="text-align: center; vertical-align: inherit;">
                    <h5>Tổng: ' . $rowTong['Tong'] . ' cá nhân</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($cboDotTonVinh, 5) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($cboDotTonVinh, 10) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($cboDotTonVinh, 15) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($cboDotTonVinh, 20) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($cboDotTonVinh, 30) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($cboDotTonVinh, 40) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($cboDotTonVinh, 50) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($cboDotTonVinh, 60) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($cboDotTonVinh, 70) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($cboDotTonVinh, 80) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($cboDotTonVinh, 90) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc($cboDotTonVinh, 100) . '</h5>
                </td>
            </tr>
        </tbody>';
    } else {
        $sqlTong = "SELECT COUNT(nguoihienmau.ID_NguoiHienMau) as Tong FROM danhsachtonvinh 
                    INNER JOIN donvi ON donvi.madonvi = danhsachtonvinh.MaDonVi 
                    INNER JOIN nguoihienmau ON nguoihienmau.ID_NguoiHienMau = danhsachtonvinh.ID_NguoiHienMau 
                    INNER JOIN tonvinh on tonvinh.matonvinh = danhsachtonvinh.MaTonVinh 
                    WHERE tonvinh.matonvinh = '" . $cboDotTonVinh . "' and donvi.madonvi = '" . $cboDonVi . "'";

        $kqTong = mysqli_query($kn, $sqlTong) or die("lỗi truy vấn");
        $rowTong = mysqli_fetch_array($kqTong);

        echo '<tr>
                <td colspan="7" style="text-align: center; vertical-align: inherit;">
                    <h5>Tổng: ' . $rowTong['Tong'] . ' cá nhân</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc_1($cboDotTonVinh, 5, $cboDonVi) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc_1($cboDotTonVinh, 10, $cboDonVi) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc_1($cboDotTonVinh, 15, $cboDonVi) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc_1($cboDotTonVinh, 20, $cboDonVi) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc_1($cboDotTonVinh, 30, $cboDonVi) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc_1($cboDotTonVinh, 40, $cboDonVi) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc_1($cboDotTonVinh, 50, $cboDonVi) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc_1($cboDotTonVinh, 60, $cboDonVi) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc_1($cboDotTonVinh, 70, $cboDonVi) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc_1($cboDotTonVinh, 80, $cboDonVi) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc_1($cboDotTonVinh, 90, $cboDonVi) . '</h5>
                </td>
                <td style="vertical-align: inherit;">
                    <h5>' . TongMuc_1($cboDotTonVinh, 100, $cboDonVi) . '</h5>
                </td>
            </tr>
        </tbody>';
    }
}

?>

<body>
    <!-- top đầu trang -->
    <div>

        <?php load_top(); ?>

    </div>

    <!-- menu của trang / menu user 1 -->
    <?php load_menu(); ?>

    <form action="" method="POST">
        <div class="container-fluid" style="margin-top:30px; margin-bottom:30px;">
            <h1 style="text-align: center; color: #e34230;">
                <?php
                if (isset($_POST['btnTimKiem']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                    ThongTin($cboDotTonVinh);
                } else if (isset($_POST['btnLamMoi']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                    ThongTin($matonvinh);
                } else {
                    ThongTin($matonvinh);
                }
                ?>
            </h1>
            <br>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-2">
                    <select class="form-control" name="cboDotTonVinh" id="cboDotTonVinh">
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
                <div class="col-sm-2">
                    <select class="form-control" name="cboDonVi" id="cboDonVi">
                        <option value="null">Đơn vị: Tất cả</option>
                        <?php
                        $sql_donvi_1 = "select * from donvi";
                        $kq_donvi_1 = mysqli_query($kn, $sql_donvi_1);
                        while ($row_donvi_1 = mysqli_fetch_array($kq_donvi_1)) {
                            echo '<option value="' . $row_donvi_1['madonvi'] . '">Đơn vị: ' . $row_donvi_1['tendonvi'] . '</option>';
                        }
                        ?>
                    </select>
                    <script type='text/javascript'>
                        document.getElementById('cboDonVi').value = "<?php echo $_POST['cboDonVi']; ?>";
                    </script>
                </div>
                <div class="col-sm-2" style="justify-content: center; display: flex;">
                    <button type="submit" name="btnTimKiem" class="btn btn-danger btn-block">Lọc dữ liệu</button>
                </div>
                <div class="col-sm-2" style="justify-content: center; display: flex;">
                    <button type="button" data-toggle="modal" data-target="#modalExcel" class="btn btn-danger btn-block">Xuất file excel</button>
                </div>
                <div class="col-sm-2" style="justify-content: center; display: flex;">
                    <button type="submit" class="btn btn-danger btn-block" name="btnLamMoi">Làm mới</button>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>

    </form>

    <form action="ExportExcel.php" method="POST">
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
                        <p style="text-align: left;">Chọn đợt tôn vinh</p>
                        <select class="form-control" name="cboDotTonVinh" id="cboDotTonVinh" onchange="thaydoidottonvinh()">
                            <?php
                            $sqlDotTonVinh = "select * from tonvinh ORDER BY ngaytonvinh DESC";
                            $kqDotTonVinh = mysqli_query($kn, $sqlDotTonVinh);
                            while ($rowDotTonVinh = mysqli_fetch_array($kqDotTonVinh)) {
                                echo '<option value="' . $rowDotTonVinh['matonvinh'] . '">Đợt ' . $rowDotTonVinh['matonvinh'] . '</option>';
                            }
                            ?>
                        </select>
                        <script type="text/javascript">
                            function thaydoidottonvinh() {
                                var dottonvinh = document.getElementById("cboDotTonVinh");
                                var giatritonvinh;
                                for (var i = 0; i < dottonvinh.length; i++) {
                                    if (dottonvinh[i].selected) {
                                        giatritonvinh = dottonvinh[i].value;
                                    }
                                }

                                document.getElementById("btn_Excel_1").remove();
                                document.getElementById("btn_Excel_2").innerHTML = "<button name='btnMaTonVinh' value='" + giatritonvinh + "' class='btn btn-danger'>XUẤT EXCEL</button>";
                            }
                        </script>
                        <p style="text-align: left;">Chọn đơn vị</p>
                        <select class="form-control" name="cboDonVi_In">
                            <option value="null">Đơn vị: Tất cả</option>
                            <?php
                            $sql_donvi_2 = "select * from donvi";
                            $kq_donvi_2 = mysqli_query($kn, $sql_donvi_2);
                            while ($row_donvi_2 = mysqli_fetch_array($kq_donvi_2)) {
                                echo '<option value="' . $row_donvi_2['madonvi'] . '">Đơn vị: ' . $row_donvi_2['tendonvi'] . '</option>';
                            }
                            ?>
                        </select>
                        <p style="text-align: left;">Nhập tên người lập biểu</p>
                        <input type="text" name="txtTenLapBieu" class="form-control">
                        <p style="text-align: left;">Nhập tên chủ tịch</p>
                        <input type="text" name="txtTenChuTich" class="form-control">

                        <h5>Bạn có đồng ý xuất file excel?</h5>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">THOÁT</button>
                        <button name="btnMaTonVinh" value="<?php echo $matonvinh ?>" class="btn btn-danger" id="btn_Excel_1">XUẤT EXCEL</button>
                        <div id="btn_Excel_2"></div>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <br>
    <div class="row">
        <div class="col-sm-12">
            <?php
            if ($user) {
            ?>
                <div class="table-responsive-xl">
                    <table class="table table-bordered">
                        <!-- <thead>
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
                                <tbody> -->
                        <?php
                        if (isset($_POST['btnTimKiem']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                            TimKiem_1($cboDotTonVinh, $cboDonVi);
                        } else if (isset($_POST['btnLamMoi']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                            TimKiem_1($matonvinh, $cboDonVi);
                        } else {
                            TimKiem($matonvinh);
                        }
                        ?>
                        <!-- </tbody> -->
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

    <!-- chân trang -->
    <div class="jumbotron text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>
</body>

</html>