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

function TimKiem()
{
    include "bocuc/Connect.php";

    $sqldonvi = "SELECT *, COUNT(donvi.madonvi) AS dem FROM donvi INNER JOIN danhsachtonvinh ON donvi.madonvi = danhsachtonvinh.MaDonVi where danhsachtonvinh.MaTonVinh = '10-2021'";
    $kqdonvi = mysqli_query($kn, $sqldonvi) or die("lỗi truy vấn 1");
    while ($rowdonvi = mysqli_fetch_array($kqdonvi)) {
        if ($rowdonvi['dem'] != 0) {
            echo '<tr>
                        <td colspan="20" stylr="text-align: center">
                            <h5 style="margin: 10px auto;">' . $rowdonvi['tendonvi'] . '</h5>
                        </td>
                    </tr>';

            $sql = "SELECT nguoihienmau.HoTen, nguoihienmau.NgaySinh, nguoihienmau.NhomMau, nguoihienmau.SDT, nguoihienmau.NgheNghiep, nguoihienmau.DiaChi, 
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
                                                    WHERE tonvinh.matonvinh = '10-2021' and danhsachtonvinh.MaDonVi = '" . $rowdonvi['madonvi'] . "' ORDER BY danhsachtonvinh.MucTonVinh ASC";
            $kq = mysqli_query($kn, $sql) or die("lỗi truy vấn");

            $stt = 0;
            while ($row = mysqli_fetch_array($kq)) {
                $stt +=  1;
                $ngaysinh = htmlspecialchars(date_format(date_create($row['NgaySinh']), "d/m/Y"));

                $muc5 = "";

                if ($row['Muc5'] == "null") {
                    $muc5 = "";
                } elseif ($row['Muc5'] == "1") {
                    $muc5 = "5";
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
                    </tr>';
            }
        }
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

    <div class="container-fluid" style="margin-top:30px; margin-bottom:30px;">
        <div class="row">
            <div class="col-sm-12">
                <?php
                if ($user) {
                ?>
                    <table class="table table-bordered" style="width: 100%">
                        <tr>
                            <td>STT</td>
                            <td>Họ tên</td>
                            <td>Ngày sinh</td>
                            <td>Nhóm máu</td>
                            <td>SDT</td>
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
                            <td>Mức 10</td>
                            <td>Ghi chú</td>
                        </tr>
                        <?php
                        TimKiem();
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