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

    // if ($txtTimKiem != "" and $cboMucTonVinh != "null" and $cboHuyen != "null" and $cboNhomMau != "null" and $cboSoLanHM != "null") {
    //     if ($cboHuyen == "null") {
    //         $diachi = "";
    //     }
    //     if ($cboHuyen != "null") {
    //         $diachi = "%" . $cboHuyen . "%";
    //     }
    //     if ($cboSoLanHM == "null") {
    //         $cboSoLanHM = "";
    //     }
    //     if ($cboNhomMau == "null") {
    //         $cboNhomMau = "";
    //     }
    //     if ($txtTimKiem == "") {
    //         $timkiem = "";
    //     }
    //     if ($txtTimKiem != "") {
    //         $timkiem = "%" . $txtTimKiem . "%";
    //     }
    //     if ($cboMucTonVinh == "null") {
    //         $cboMucTonVinh = "";
    //     }

    //     $sql = "select * from nguoihienmau INNER JOIN danhsachtonvinh ON nguoihienmau.ID_NguoiHienMau = danhsachtonvinh.ID_NguoiHienMau 
    //                 INNER JOIN donvi ON donvi.madonvi = danhsachtonvinh.MaDonVi
    //                 where  (nguoihienmau.DiaChi like '" . $diachi . "')
    //                         AND nguoihienmau.SoLanHienMau = '" . $cboSoLanHM . "'
    //                         AND  nguoihienmau.NhomMau = '" . $cboNhomMau . "'
    //                         AND  danhsachtonvinh.MucTonVinh = '" . $cboMucTonVinh . "'
    //                         AND  nguoihienmau.HoTen like '" . $timkiem . "'";
    // } else if ($txtTimKiem != "" and $cboHuyen != "null" and $cboNhomMau != "null" and $cboSoLanHM != "null") {
    //     if ($cboHuyen == "null") {
    //         $diachi = "";
    //     }
    //     if ($cboHuyen != "null") {
    //         $diachi = "%" . $cboHuyen . "%";
    //     }
    //     if ($cboSoLanHM == "null") {
    //         $cboSoLanHM = "";
    //     }
    //     if ($cboNhomMau == "null") {
    //         $cboNhomMau = "";
    //     }
    //     if ($txtTimKiem == "") {
    //         $timkiem = "";
    //     }
    //     if ($txtTimKiem != "") {
    //         $timkiem = "%" . $txtTimKiem . "%";
    //     }

    //     $sql = "select * from nguoihienmau where nguoihienmau.DiaChi like '" . $diachi . "'
    //                     AND nguoihienmau.SoLanHienMau = '" . $cboSoLanHM . "' 
    //                     AND nguoihienmau.NhomMau = '" . $cboNhomMau . "' 
    //                     AND nguoihienmau.HoTen like '" . $timkiem . "'";
    // } else if ($cboMucTonVinh == "null") {
    //     if ($cboHuyen == "null") {
    //         $diachi = "";
    //     }
    //     if ($cboHuyen != "null") {
    //         $diachi = "%" . $cboHuyen . "%";
    //     }
    //     if ($cboSoLanHM == "null") {
    //         $cboSoLanHM = "";
    //     }
    //     if ($cboNhomMau == "null") {
    //         $cboNhomMau = "";
    //     }
    //     if ($txtTimKiem == "") {
    //         $timkiem = "";
    //     }
    //     if ($txtTimKiem != "") {
    //         $timkiem = "%" . $txtTimKiem . "%";
    //     }

    //     $sql = "select * from nguoihienmau where nguoihienmau.DiaChi like '" . $diachi . "'
    //                     OR nguoihienmau.SoLanHienMau = '" . $cboSoLanHM . "' 
    //                     OR nguoihienmau.NhomMau = '" . $cboNhomMau . "' 
    //                     OR nguoihienmau.HoTen like '" . $timkiem . "'";
    // } else {
    //     if ($cboHuyen == "null") {
    //         $diachi = "";
    //     }
    //     if ($cboHuyen != "null") {
    //         $diachi = "%" . $cboHuyen . "%";
    //     }
    //     if ($cboSoLanHM == "null") {
    //         $cboSoLanHM = "";
    //     }
    //     if ($cboNhomMau == "null") {
    //         $cboNhomMau = "";
    //     }
    //     if ($txtTimKiem == "") {
    //         $timkiem = "";
    //     }
    //     if ($txtTimKiem != "") {
    //         $timkiem = "%" . $txtTimKiem . "%";
    //     }
    //     if ($cboMucTonVinh == "null") {
    //         $cboMucTonVinh = "";
    //     }
    //     $sql = "select * from nguoihienmau INNER JOIN danhsachtonvinh ON nguoihienmau.ID_NguoiHienMau = danhsachtonvinh.ID_NguoiHienMau 
    //                     INNER JOIN donvi ON donvi.madonvi = danhsachtonvinh.MaDonVi
    //                     where  (nguoihienmau.DiaChi like '" . $diachi . "')
    //                             OR nguoihienmau.SoLanHienMau = '" . $cboSoLanHM . "'
    //                             OR  nguoihienmau.NhomMau = '" . $cboNhomMau . "'
    //                             OR  danhsachtonvinh.MucTonVinh = '" . $cboMucTonVinh . "'
    //                             OR  nguoihienmau.HoTen like '" . $timkiem . "'";
    // }

    if ($cboHuyen != "null") {
        $diachi = "%" . $cboHuyen . "%";
        $timkiem = "nguoihienmau.DiaChi like '" . $diachi . "'";
    }

    if ($cboSoLanHM != "null") {
        $timkiem = "nguoihienmau.SoLanHienMau = '" . $cboSoLanHM . "'";
    }

    if ($cboMucTonVinh != "null") {
        $timkiem = "danhsachtonvinh.MucTonVinh = '" . $cboMucTonVinh . "'";
    }

    if ($cboNhomMau != "null") {
        $timkiem = "nguoihienmau.NhomMau = '" . $cboNhomMau . "'";
    }

    if ($txtTimKiem != "") {
        $timkiem = "nguoihienmau.HoTen like '" . $timkiem . "'";
    }

    if ($cboHuyen != "null" and $cboSoLanHM != null) {
        $diachi = "%" . $cboHuyen . "%";
        $timkiem = "nguoihienmau.DiaChi like '" . $diachi . "' and nguoihienmau.SoLanHienMau = '" . $cboSoLanHM . "'";
    }

    if ($cboHuyen != "null" and $cboMucTonVinh != "null") {
        $diachi = "%" . $cboHuyen . "%";
        $timkiem = "nguoihienmau.DiaChi like '" . $diachi . "' and danhsachtonvinh.MucTonVinh = '" . $cboMucTonVinh . "'";
    }

    if ($cboHuyen != "null" and $cboNhomMau != "null") {
        $diachi = "%" . $cboHuyen . "%";
        $timkiem = "nguoihienmau.DiaChi like '" . $diachi . "' and nguoihienmau.NhomMau = '" . $cboNhomMau . "'";
    }

    if ($cboHuyen != "null" and $txtTimKiem != "") {
        $diachi = "%" . $cboHuyen . "%";
        $timkiem = "nguoihienmau.DiaChi like '" . $diachi . "' and nguoihienmau.HoTen like '" . $timkiem . "'";
    }

    if ($cboSoLanHM != null and $cboMucTonVinh != null) {
        $timkiem = "nguoihienmau.SoLanHienMau = '" . $cboSoLanHM . "' and danhsachtonvinh.MucTonVinh = '" . $cboMucTonVinh . "'";
    }

    if ($cboSoLanHM != null and $cboNhomMau != null) {
        $timkiem = "nguoihienmau.SoLanHienMau = '" . $cboSoLanHM . "' and nguoihienmau.NhomMau = '" . $cboNhomMau . "'";
    }

    if ($cboSoLanHM != null and $txtTimKiem != "") {
        $timkiem = "nguoihienmau.SoLanHienMau = '" . $cboSoLanHM . "' and nguoihienmau.HoTen like '" . $timkiem . "'";
    }

    if ($cboMucTonVinh != "null" and $cboNhomMau != "null") {
        $timkiem = "danhsachtonvinh.MucTonVinh = '" . $cboMucTonVinh . "' and nguoihienmau.NhomMau = '" . $cboNhomMau . "'";
    }

    if ($cboMucTonVinh != "null" and $txtTimKiem != "") {
        $timkiem = "danhsachtonvinh.MucTonVinh = '" . $cboMucTonVinh . "' and nguoihienmau.HoTen like '" . $timkiem . "'";
    }

    if ($cboNhomMau != "null" and $txtTimKiem != "") {
        $timkiem = "nguoihienmau.NhomMau = '" . $cboNhomMau . "' and nguoihienmau.HoTen like '" . $timkiem . "'";
    }

    if ($cboHuyen != "null" and $cboSoLanHM != "null" and $cboMucTonVinh != "null") {
        $diachi = "%" . $cboHuyen . "%";
        $timkiem = "nguoihienmau.DiaChi like '" . $diachi . "' and nguoihienmau.SoLanHienMau = '" . $cboSoLanHM . "' and danhsachtonvinh.MucTonVinh = '" . $cboMucTonVinh . "'";
    }

    if ($cboHuyen != "null" and $cboSoLanHM != "null" and $cboNhomMau != "null") {
        $diachi = "%" . $cboHuyen . "%";
        $timkiem = "nguoihienmau.DiaChi like '" . $diachi . "' and nguoihienmau.SoLanHienMau = '" . $cboSoLanHM . "' and nguoihienmau.NhomMau = '" . $cboNhomMau . "'";
    }

    if ($cboHuyen != "null" and $cboSoLanHM != "null" and $txtTimKiem != "") {
        $diachi = "%" . $cboHuyen . "%";
        $timkiem = "nguoihienmau.DiaChi like '" . $diachi . "' and nguoihienmau.SoLanHienMau = '" . $cboSoLanHM . "' and nguoihienmau.HoTen like '" . $timkiem . "'";
    }

    if ($cboHuyen != "null" and $cboMucTonVinh != "null" and $cboNhomMau != "null") {
        $diachi = "%" . $cboHuyen . "%";
        $timkiem = "nguoihienmau.DiaChi like '" . $diachi . "' and danhsachtonvinh.MucTonVinh = '" . $cboMucTonVinh . "' and nguoihienmau.NhomMau = '" . $cboNhomMau . "'";
    }

    if ($cboHuyen != "null" and $cboMucTonVinh != "null" and $txtTimKiem != "") {
        $diachi = "%" . $cboHuyen . "%";
        $timkiem = "nguoihienmau.DiaChi like '" . $diachi . "' and danhsachtonvinh.MucTonVinh = '" . $cboMucTonVinh . "' and nguoihienmau.HoTen like '" . $timkiem . "'";
    }

    if ($cboHuyen != "null" and $cboNhomMau != "null" and $txtTimKiem != "") {
        $diachi = "%" . $cboHuyen . "%";
    }

    if ($cboSoLanHM != "null" and $cboMucTonVinh != "null" and $cboNhomMau != "null") {
    }

    if ($cboSoLanHM != "null" and $cboMucTonVinh != "null" and $txtTimKiem != "") {
    }

    if ($cboSoLanHM != "null" and $cboNhomMau != "null" and $txtTimKiem != "") {
    }

    if ($cboMucTonVinh != "null" and $cboNhomMau != "null" and $txtTimKiem != "") {
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
                <td style="vertical-align: inherit; text-align: left">' . $row['HoTen'] . '</td>
                <td style="vertical-align: inherit;">' . $row['NgaySinh'] . '</td>
                <td style="vertical-align: inherit;">' . $row['SDT'] . '</td>
                <td style="vertical-align: inherit;  text-align: left">' . $row['DiaChi'] . '</td>
                <td style="vertical-align: inherit;  text-align: left">' . $row['NoiLamViec'] . '</td>
                <td style="vertical-align: inherit;">' . $row['SoLanHienMau'] . '</td>
                <td style="vertical-align: inherit;">' . $row['NhomMau'] . '</td>
                <td style="vertical-align: inherit;">' . $row['NhomRH'] . '</td>';

        echo '<td>
                    <div class="row">';
        while ($rowtonvinh = mysqli_fetch_array($kqtonvinh)) {
            echo '<div class="col-sm-1">
                                <a class="btn btnTonVinh" data-toggle="tooltip" data-placement="top" title="Đã tôn vinh ở đợt ' . $rowtonvinh['MaTonVinh'] . '">' . $rowtonvinh['MucTonVinh'] . '</a>
                            </div>';
        }
        echo '</div>
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
                                    <th style="width: 50px;" onclick="sortTable(0)">STT</th>
                                    <th hidden>Mã hiến máu</th>
                                    <th style="width: 200px;" onclick="sortTable(2)">Họ tên</th>
                                    <th style="width: 110px;" style="width: 107px;" onclick="sortTable(3)">Ngày sinh</th>
                                    <th style="width: 110px;" onclick="sortTable(4)">Số điện thoại</th>
                                    <th onclick="sortTable(5)">Địa chỉ</th>
                                    <th onclick="sortTable(6)">Nơi làm việc</th>
                                    <th style="width: 95px;" onclick="sortTable_Number(7)">Số lần hiến máu</th>
                                    <th style="width: 10px;" onclick="sortTable(8)">Nhóm ABO</th>
                                    <th style="width: 105px;" onclick="sortTable(9)">Nhóm Rh</th>
                                    <th style="width: 235px;" onclick="sortTable(10)">Đã tôn vinh</th>
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

    function sortTable_1(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("myTable");
        switching = true;
        //Set the sorting direction to ascending:
        dir = "asc";
        /*Make a loop that will continue until
        no switching has been done:*/
        while (switching) {
            //start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /*Loop through all table rows (except the
            first, which contains table headers):*/
            for (i = 1; i < (rows.length - 1); i++) {
                //start by saying there should be no switching:
                shouldSwitch = false;
                /*Get the two elements you want to compare,
                one from current row and one from the next:*/
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                /*check if the two rows should switch place,
                based on the direction, asc or desc:*/
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /*If a switch has been marked, make the switch
                and mark that a switch has been done:*/
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                //Each time a switch is done, increase this count by 1:
                switchcount++;
            } else {
                /*If no switching has been done AND the direction is "asc",
                set the direction to "desc" and run the while loop again.*/
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }

    function sortTable_Number(n) {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("myTable");
        switching = true;
        /*Make a loop that will continue until
        no switching has been done:*/
        while (switching) {
            //start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /*Loop through all table rows (except the
            first, which contains table headers):*/
            for (i = 1; i < (rows.length - 1); i++) {
                //start by saying there should be no switching:
                shouldSwitch = false;
                /*Get the two elements you want to compare,
                one from current row and one from the next:*/
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                //check if the two rows should switch place:
                if (Number(x.innerHTML) > Number(y.innerHTML)) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                /*If a switch has been marked, make the switch
                and mark that a switch has been done:*/
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
            sortTable_Number(7);
        } else if (tieuchi == "muctonvinh") {
            sortTable(11);
        } else {
            sortTable(6);
        }
    }
</script>