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
    <title>Tìm kiếm thông tin tôn vinh</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <link rel="stylesheet" href="style/style-timkiemthongtin.css">
</head>

<?php
$cboHuyen = array_key_exists('cboHuyen', $_POST) ?  $_POST['cboHuyen'] : null;
$cboSoLanHM = array_key_exists('cboSoLanHM', $_POST) ?  $_POST['cboSoLanHM'] : null;
$cboMucTonVinh = array_key_exists('cboMucTonVinh', $_POST) ?  $_POST['cboMucTonVinh'] : null;
$cboNhomMau = array_key_exists('cboNhomMau', $_POST) ?  $_POST['cboNhomMau'] : null;
$txtTimKiem = array_key_exists('txtTimKiem', $_POST) ?  $_POST['txtTimKiem'] : null;

function InThongTin($cboHuyen, $cboSoLanHM, $cboMucTonVinh, $cboNhomMau, $txtTimKiem)
{
    $thongtin = "";
    if ($cboHuyen != "null") {
        $thongtin = $thongtin . "Địa chỉ: " . $cboHuyen;
    }
    if ($cboSoLanHM != "null") {
        $thongtin = $thongtin . " Số lần hiến máu: " . $cboSoLanHM;
    }
    if ($cboMucTonVinh != "null") {
        $thongtin = $thongtin . " Mức tôn vinh: " . $cboMucTonVinh;
    }
    if ($cboNhomMau != "null") {
        $thongtin = $thongtin . " Nhóm máu: " . $cboNhomMau;
    }
    if ($txtTimKiem != "") {
        $thongtin = $thongtin . " Họ tên: " . $txtTimKiem;
    }
    // echo '<h3>'.$cboHuyen .' '.$cboSoLanHM .' '.$cboMucTonVinh .' '.$cboNhomMau .' '.$txtTimKiem .'</h3>';
    echo '<h4>' . $thongtin . '</h4>';
}

function LoadDuLieu($cboHuyen, $cboSoLanHM, $cboMucTonVinh, $cboNhomMau, $txtTimKiem)
{
    include "bocuc/Connect.php";

    if ($txtTimKiem == "" and $cboMucTonVinh == "null" and $cboHuyen == "null" and $cboNhomMau == "null" and $cboSoLanHM == "null") {
        echo "<script>alert('Vui lòng không bỏ trống thông tin');</script>";
    }

    if ($txtTimKiem != "" and $cboMucTonVinh != "null" and $cboHuyen != "null" and $cboNhomMau != "null" and $cboSoLanHM != "null") {
        if ($cboHuyen == "null") {
            $diachi = "";
        }
        if ($cboHuyen != "null") {
            $diachi = "%" . $cboHuyen . "%";
        }
        if ($cboSoLanHM == "null") {
            $cboSoLanHM = "";
        }
        if ($cboNhomMau == "null") {
            $cboNhomMau = "";
        }
        if ($txtTimKiem == "") {
            $timkiem = "";
        }
        if ($txtTimKiem != "") {
            $timkiem = "%" . $txtTimKiem . "%";
        }
        if ($cboMucTonVinh == "null") {
            $cboMucTonVinh = "";
        }

        $sql = "select * from nguoihienmau INNER JOIN danhsachtonvinh ON nguoihienmau.ID_NguoiHienMau = danhsachtonvinh.ID_NguoiHienMau 
                    INNER JOIN donvi ON donvi.madonvi = danhsachtonvinh.MaDonVi
                    where  (nguoihienmau.NoiLamViec like '" . $diachi . "')
                            AND nguoihienmau.SoLanHienMau = '" . $cboSoLanHM . "'
                            AND  nguoihienmau.NhomMau = '" . $cboNhomMau . "'
                            AND  danhsachtonvinh.MucTonVinh = '" . $cboMucTonVinh . "'
                            AND  nguoihienmau.HoTen like '" . $timkiem . "'";
    } else if ($txtTimKiem != "" and $cboMucTonVinh != "null" and $cboHuyen != "null" and $cboNhomMau != "null" and $cboSoLanHM != "null") {
        if ($cboHuyen == "null") {
            $diachi = "";
        }
        if ($cboHuyen != "null") {
            $diachi = "%" . $cboHuyen . "%";
        }
        if ($cboSoLanHM == "null") {
            $cboSoLanHM = "";
        }
        if ($cboNhomMau == "null") {
            $cboNhomMau = "";
        }
        if ($txtTimKiem == "") {
            $timkiem = "";
        }
        if ($txtTimKiem != "") {
            $timkiem = "%" . $txtTimKiem . "%";
        }
        if ($cboMucTonVinh == "null") {
            $cboMucTonVinh = "";
        }

        $sql = "select * from nguoihienmau INNER JOIN danhsachtonvinh ON nguoihienmau.ID_NguoiHienMau = danhsachtonvinh.ID_NguoiHienMau 
                    INNER JOIN donvi ON donvi.madonvi = danhsachtonvinh.MaDonVi
                    where  (nguoihienmau.NoiLamViec like '" . $diachi . "')
                            AND nguoihienmau.SoLanHienMau = '" . $cboSoLanHM . "'
                            AND  nguoihienmau.NhomMau = '" . $cboNhomMau . "'
                            AND  danhsachtonvinh.MucTonVinh = '" . $cboMucTonVinh . "'
                            AND  nguoihienmau.HoTen like '" . $timkiem . "'";
    } else if ($cboMucTonVinh == "null") {
        if ($cboHuyen == "null") {
            $diachi = "";
        }
        if ($cboHuyen != "null") {
            $diachi = "%" . $cboHuyen . "%";
        }
        if ($cboSoLanHM == "null") {
            $cboSoLanHM = "";
        }
        if ($cboNhomMau == "null") {
            $cboNhomMau = "";
        }
        if ($txtTimKiem == "") {
            $timkiem = "";
        }
        if ($txtTimKiem != "") {
            $timkiem = "%" . $txtTimKiem . "%";
        }

        $sql = "select * from nguoihienmau where nguoihienmau.NoiLamViec like '" . $diachi . "'
                        OR nguoihienmau.SoLanHienMau = '" . $cboSoLanHM . "' 
                        OR nguoihienmau.NhomMau = '" . $cboNhomMau . "' 
                        OR nguoihienmau.HoTen like '" . $timkiem . "'";
    } else {
        if ($cboHuyen == "null") {
            $diachi = "";
        }
        if ($cboHuyen != "null") {
            $diachi = "%" . $cboHuyen . "%";
        }
        if ($cboSoLanHM == "null") {
            $cboSoLanHM = "";
        }
        if ($cboNhomMau == "null") {
            $cboNhomMau = "";
        }
        if ($txtTimKiem == "") {
            $timkiem = "";
        }
        if ($txtTimKiem != "") {
            $timkiem = "%" . $txtTimKiem . "%";
        }
        if ($cboMucTonVinh == "null") {
            $cboMucTonVinh = "";
        }
        $sql = "select * from nguoihienmau INNER JOIN danhsachtonvinh ON nguoihienmau.ID_NguoiHienMau = danhsachtonvinh.ID_NguoiHienMau 
                        INNER JOIN donvi ON donvi.madonvi = danhsachtonvinh.MaDonVi
                        where  (nguoihienmau.NoiLamViec like '" . $diachi . "')
                                OR nguoihienmau.SoLanHienMau = '" . $cboSoLanHM . "'
                                OR  nguoihienmau.NhomMau = '" . $cboNhomMau . "'
                                OR  danhsachtonvinh.MucTonVinh = '" . $cboMucTonVinh . "'
                                OR  nguoihienmau.HoTen like '" . $timkiem . "'";
    }

    $kq = mysqli_query($kn, $sql) or die("Lỗi truy vấn 1");
    $stt = 0;
    while ($row = mysqli_fetch_array($kq)) {
        $sqltonvinh = "select * from danhsachtonvinh where ID_NguoiHienMau = '" . $row['ID_NguoiHienMau'] . "'";
        $kqtonvinh = mysqli_query($kn, $sqltonvinh) or die("Lỗi truy vấn 2");

        $stt += 1;
        echo '<tr>
                <td style="vertical-align: inherit;">' . $stt . '</td>
                <td hidden>' . $row['ID_NguoiHienMau'] . '</td>
                <td style="vertical-align: inherit;">' . $row['HoTen'] . '</td>
                <td style="vertical-align: inherit;">' . $row['NgaySinh'] . '</td>
                <td style="vertical-align: inherit;">' . $row['SDT'] . '</td>
                <td style="vertical-align: inherit;">' . $row['DiaChi'] . '</td>
                <td style="vertical-align: inherit;">' . $row['NoiLamViec'] . '</td>
                <td style="vertical-align: inherit;">' . $row['SoLanHienMau'] . '</td>
                <td style="vertical-align: inherit;">' . $row['NhomMau'] . '</td>
                <td style="vertical-align: inherit;">' . $row['NhomRH'] . '</td>
                <td>
                    <select class="form-control" name="cboMucTonVinh' . $row['ID_NguoiHienMau'] . '" id="cboMucTonVinh' . $row['ID_NguoiHienMau'] . '" onchange="thaydoitonvinh' . $row['ID_NguoiHienMau'] . '()">';

        $sql2 = "select * from muctonvinh";
        $kq2 = mysqli_query($kn, $sql2) or die("Lỗi truy vấn");
        while ($row2 = mysqli_fetch_array($kq2)) {
            if (($row['SoLanHienMau'] >= 5 && $row['SoLanHienMau'] < 10)) {
                $muctonvinh = 5;
            } else if ($row['SoLanHienMau'] >= 10 && $row['SoLanHienMau'] < 15) {
                $muctonvinh = 10;
            } else if ($row['SoLanHienMau'] >= 15 && $row['SoLanHienMau'] < 20) {
                $muctonvinh = 15;
            } else if ($row['SoLanHienMau'] >= 20 && $row['SoLanHienMau'] < 30) {
                $muctonvinh = 20;
            } else if ($row['SoLanHienMau'] >= 30 && $row['SoLanHienMau'] < 40) {
                $muctonvinh = 30;
            } else if ($row['SoLanHienMau'] >= 40 && $row['SoLanHienMau'] < 50) {
                $muctonvinh = 40;
            } else if ($row['SoLanHienMau'] >= 50 && $row['SoLanHienMau'] < 60) {
                $muctonvinh = 70;
            } else {
                $muctonvinh = 0;
            }
            $mauco = "style/flagG.png";
            $sql4 = "select * from danhsachtonvinh where ID_NguoiHienMau = '" . $row['ID_NguoiHienMau'] . "' ORDER BY MucTonVinh DESC LIMIT 1";
            $kq4 = mysqli_query($kn, $sql4);
            $row4 = mysqli_fetch_array($kq4);
            if (!$row4) {
                if ($muctonvinh > 0) {
                    if ($muctonvinh == 5) {
                        $mauco = "style/flagG.png";
                    } elseif ($muctonvinh != 5) {
                        $mauco = "style/flagY.png";
                    }
                    $muctonvinh = 5;
                }
            } else {
                if ($row4['MucTonVinh'] < 20) {
                    if ($muctonvinh - $row4['MucTonVinh'] > 5) {
                        $muctonvinh = $row4['MucTonVinh'] + 5;
                        $mauco = "style/flagY.png";
                    }
                } else {
                    if ($muctonvinh - $row4['MucTonVinh'] > 10) {
                        $muctonvinh = $row4['MucTonVinh'] + 10;
                        $mauco = "style/flagY.png";
                    }
                }
                if ($muctonvinh - $row4['MucTonVinh'] == 0) {
                    // echo "Đã tôn vinh ";
                    $mauco = "style/flagR.png";
                }
            }

            if ($muctonvinh == $row2['ID']) {
                $luachon = 'selected ';
            } else {
                $luachon = '';
            }

            echo '<option ' . $luachon . ' value="' . $row2['ID'] . '">' . $row2['TenMuc'] . '</option>';
        }
        echo '</select></td>';
        echo '<td>
                    <div class="row">';
        while ($rowtonvinh = mysqli_fetch_array($kqtonvinh)) {
            echo '<div class="col-sm-1">
                                <a class="btn btnTonVinh" data-toggle="tooltip" data-placement="top" title="Đã tôn vinh ở đợt ' . $rowtonvinh['MaTonVinh'] . '">' . $rowtonvinh['MucTonVinh'] . '</a>
                            </div>';
        }
        echo '</div>
                </td>
                <td>
                    <button type="button" class="btn btn-link CapNhat" data-toggle="modal" data-target="#CapNhatThongTin">
                        <img src="image/updated.png" style="width:35px" />
                    </button>
                </td>
            </tr>';
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
                    <form action="" method="POST">
                        <h2 style="margin-bottom: 25px;">TÌM KIẾM TÔN VINH </h2>
                        <div class="row">
                            <div class="col-sm-2">
                                <select class="form-control" name="cboHuyen">
                                    <option value="null">Chọn huyện</option>
                                    <?php
                                    $huyens = ["Quy Nhơn", "Phù Mỹ", "Phù Cát", "An Lão", "Hoài Nhơn", "Hoài Ân", "Tuy Phước", "An Nhơn", "Vân Canh", "Tây Sơn", "Vĩnh Thạnh"];
                                    foreach ($huyens as $huyen) {
                                        echo '<option value="' . $huyen . '">' . $huyen . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select class="form-control" name="cboSoLanHM">
                                    <option value="null">Số lần hiến máu</option>
                                    <?php
                                    $solanhienmau = 0;
                                    for ($i = 0; $i < 100; $i++) {
                                        $solanhienmau += 1;
                                        echo '<option value="' . $solanhienmau . '">' . $solanhienmau . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select class="form-control" name="cboMucTonVinh">
                                    <option value="null">Mức tôn vinh</option>
                                    <option value="5">Mức 5</option>
                                    <option value="10">Mức 10</option>
                                    <option value="15">Mức 15</option>
                                    <?php
                                    $muctonvinh = 0;
                                    for ($i = 0; $i < 10; $i++) {
                                        $muctonvinh += 10;
                                        if ($muctonvinh != 10) {
                                            echo '<option value="' . $muctonvinh . '">Mức ' . $muctonvinh . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select class="form-control" name="cboNhomMau">
                                    <option value="null">Chọn nhóm máu</option>
                                    <?php
                                    $nhommaus = ["A", "B", "AB", "O"];
                                    foreach ($nhommaus as $nhommau) {
                                        echo '<option value="' . $nhommau . '">Nhóm máu ' . $nhommau . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="txtTimKiem" placeholder="Nhập họ tên cần tìm">
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-danger btnTimKiem" name="btnTimKiem" type="submit">TÌM KIẾM</button>
                            </div>
                        </div>

                        <hr>

                        <div style="display: flex; width: 100%">
                            <p style="margin: auto 0px;">Sắp xếp:</p>
                            <select class="form-control" name="cboSapXep" id="cboSapXep" onchange="TieuChi()" style="width: 15%; margin: auto 0px auto 15px;">
                                <option value="ten">Theo tên</option>
                                <option value="solanhienmau">Số lần hiếu máu</option>
                                <option value="muctonvinh">Mức tôn vinh</option>
                                <option value="khuvuc">Khu vực</option>
                            </select>

                            <h1 id="demo"></h1>
                        </div>

                        <div>

                            <h3 style="margin-bottom: 25px;text-align: center;">Bạn đang tìm kiếm thông tin cho: </h3>

                            <div class="border border-danger rounded-lg" style="width: 100%; height: 50px; border-color: #e34230; display: flex">

                                <?php
                                if ($_POST) {
                                    InThongTin($cboHuyen, $cboSoLanHM, $cboMucTonVinh, $cboNhomMau, $txtTimKiem);
                                }
                                ?>
                            </div>
                        </div>

                        <br>

                        <div class="table-responsive">
                            <table class="table table-bordered border border-danger" style="text-align: center" id="myTable">
                                <tr>
                                    <th>STT</th>
                                    <th hidden>Mã hiến máu</th>
                                    <th>Họ tên</th>
                                    <th style="width: 107px;">Ngày sinh</th>
                                    <th>Số điện thoại</th>
                                    <th style="width: 154px;">Địa chỉ</th>
                                    <th>Nơi làm việc</th>
                                    <th style="width: 95px;">Số lần hiến máu</th>
                                    <th style="width: 10px;">Nhóm ABO</th>
                                    <th style="width: 105px;">Nhóm Rh</th>
                                    <th>Đề xuất tôn vinh</th>
                                    <th style=" width: 140px;">Đã tôn vinh</th>
                                    <th>Cập nhật</th>
                                </tr>
                                <?php
                                if ($_POST) {
                                    if (isset($_POST['btnTimKiem']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                                        LoadDuLieu($cboHuyen, $cboSoLanHM, $cboMucTonVinh, $cboNhomMau, $txtTimKiem);
                                    }
                                }
                                ?>
                            </table>
                        </div>

                    </form>
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

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>
    function sortTable(cot) {
        var table, rows, switching, i, x, y, shouldSwitch, col = cot;
        table = document.getElementById("myTable");
        switching = true;
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[col];
                y = rows[i + 1].getElementsByTagName("TD")[col];
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

    function TieuChi() {
        var tieuchi = document.getElementById("cboSapXep").value;
        if (tieuchi == "ten") {
            sortTable(2);
        } else if (tieuchi == "solanhienmau") {
            sortTable(7);
        } else if (tieuchi == "muctonvinh") {
            sortTable(11);
        } else {
            sortTable(6);
        }
    }
</script>