<?php
require 'site.php';
include "bocuc/Connect.php";
include "bocuc/KiemTraSession.php";
$madonvi = $_GET['madonvi'];
$matonvinh = $_GET['matonvinh'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiểm duyệt tôn vinh</title>
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
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
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
        <h1 style="text-align: center;">KIỂM DUYỆT TÔN VINH</h1>
        <br>

        <form action="" method="POST">
            <div class="container-fluid">
                <div class="row bg-item">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10" style="margin-top:30px; margin-bottom:30px;">

                        <div class="grp-btn">
                            <a href="DanhSachXuLyRieng.php" class="btn btn-danger btn-apply"><b>Danh sách xử lý riêng</b> </a>

                            <a href="DuyetTonVinh.php" type="submit" class="btn btn-danger">
                                <b>Kết quả</b>
                            </a>
                        </div>
                        <br>
                        <br>
                        <hr style="border-top: 1px solid #e34230;">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td>STT</td>
                                    <td>Họ tên</td>
                                    <td>Ngày sinh</td>
                                    <td>Số điện thoại</td>
                                    <td>Địa chỉ</td>
                                    <td style="width: 100px;">Số lần hiến máu</td>
                                    <td style="width: 65px;">Nhóm ABO</td>
                                    <td>Nhóm Rh</td>
                                    <td>Đề xuất tôn vinh</td>
                                    <td>Đã tôn vinh</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <?php
                                $sql = "select * from excel_tonvinh where MaDonVi='" . $madonvi . "'";
                                $kq = mysqli_query($kn, $sql);

                                $stt = 0;
                                while ($row = mysqli_fetch_array($kq)) {
                                    $sql1 = "select *, count(HoTen) as dem from nguoihienmau where HoTen='" . $row['HoTen'] . "' and NgaySinh='" . $row['NgaySinh'] . "' and NhomMau='" . $row['NhomMau'] . "'";
                                    $kq1 = mysqli_query($kn, $sql1);
                                    $id = $row['ID'];
                                ?>
                                    <tr>
                                        <td>
                                            <div class="div-icon">
                                                <?php echo $stt += 1 ?>
                                                <img style="margin: 0 0 0 5px; width: 30px" src="style/excel.png">
                                            </div>
                                        </td>
                                        <td><?php echo $row['HoTen'] ?></td>
                                        <td><?php echo $row['NgaySinh'] ?></td>
                                        <td><?php echo $row['SDT'] ?></td>
                                        <td><?php echo $row['DiaChi'] ?></td>
                                        <td><?php echo $row['SoLanHienMau'] ?></td>
                                        <td><?php echo $row['NhomMau'] ?></td>
                                        <td style="text-align: center;">-</td>
                                        <td><?php echo "Mức " . $row['MucTonVinh'] ?></td>
                                        <td></td>
                                        <td>

                                        </td>
                                        <td> <?php echo "<input type='checkbox' name='mangchon[]' value = $id >"; ?></td>
                                    </tr>
                                    <?php
                                    while ($row1 = mysqli_fetch_array($kq1)) { ?>
                                        <?php
                                        if ($row1['dem'] != 0) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="div-icon">
                                                        <?php echo $stt ?>
                                                        <img style="margin: 0 0 0 5px; width: 30px" src="style/database.png">
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td><?php echo $row1['NgaySinh'] ?></td>
                                                <td><?php echo $row1['SDT'] ?></td>
                                                <td><?php echo $row1['DiaChi'] ?></td>
                                                <td><?php echo $row1['SoLanHienMau'] ?></td>
                                                <td><?php echo $row1['NhomMau'] ?></td>
                                                <td><?php echo $row1['NhomRH'] ?></td>
                                                <td>
                                                    <select name="cboMucTonVinh<?php echo $row1['ID_NguoiHienMau'] ?>" id="cboMucTonVinh<?php echo $row1['ID_NguoiHienMau'] ?>" onchange="thaydoitonvinh<?php echo $row1['ID_NguoiHienMau'] ?>()">
                                                        <?php
                                                        $sql2 = "select * from muctonvinh";
                                                        $kq2 = mysqli_query($kn, $sql2) or die("Lỗi truy vấn");
                                                        while ($row2 = mysqli_fetch_array($kq2)) {
                                                            if (($row1['SoLanHienMau'] >= 5 && $row1['SoLanHienMau'] < 10)) {
                                                                $muctonvinh = 5;
                                                            } elseif ($row1['SoLanHienMau'] >= 10 && $row1['SoLanHienMau'] < 15) {
                                                                $muctonvinh = 10;
                                                            } elseif ($row1['SoLanHienMau'] >= 15 && $row1['SoLanHienMau'] < 20) {
                                                                $muctonvinh = 15;
                                                            } elseif ($row1['SoLanHienMau'] >= 20 && $row1['SoLanHienMau'] < 30) {
                                                                $muctonvinh = 20;
                                                            } elseif ($row1['SoLanHienMau'] >= 30 && $row1['SoLanHienMau'] < 40) {
                                                                $muctonvinh = 30;
                                                            } elseif ($row1['SoLanHienMau'] >= 40 && $row1['SoLanHienMau'] < 50) {
                                                                $muctonvinh = 40;
                                                            } elseif ($row1['SoLanHienMau'] >= 50 && $row1['SoLanHienMau'] < 60) {
                                                                $muctonvinh = 70;
                                                            } else {
                                                                $muctonvinh = 0;
                                                            }
                                                            $mauco = "style/flagG.png";
                                                            $sql4 = "select * from danhsachtonvinh where ID_NguoiHienMau = '" . $row1['ID_NguoiHienMau'] . "' and MaDonVi = '" . $madonvi . "' ORDER BY MucTonVinh DESC LIMIT 1";
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
                                                            // if ($muctonvinh != 0) {
                                                            //     echo "Mức " .  $muctonvinh;
                                                            // } else {
                                                            //     echo "Chưa đủ điều kiện tôn vinh";
                                                            // }
                                                        ?>
                                                            <?php
                                                            $thongtin_apply = array(
                                                                "muctonvinh" => $row2['ID'],
                                                                "id_nguoihienmau" => $row1['ID_NguoiHienMau'],
                                                                "hoten" => $row['HoTen'],
                                                                "ngaysinh" => $row['NgaySinh'],
                                                                "nhommau" => $row['NhomMau'],
                                                                "solanhienmau_excel" => $row['SoLanHienMau']

                                                            );
                                                            ?>
                                                            <option <?php if ($muctonvinh == $row2['ID']) {
                                                                        echo "selected = 'selected'";
                                                                    } ?> value="<?php echo $row2['ID'] ?>"><?php echo $row2['TenMuc'] ?></option>

                                                            <!-- <option <?php if ($muctonvinh == $row2['ID']) {
                                                                                echo "selected = 'selected'";
                                                                            } ?> value="<?php echo urlencode(serialize($thongtin_apply)) ?>"><?php echo $row2['TenMuc'] ?></option> -->
                                                            <!-- <input class="txtMucTonVinh" type="text" id='dexuattonvinh' name="txtdexuattonvinh" value=""> -->
                                                            <!-- <button type="button" class="btn btn-light" style="background-color: #ffff;" data-toggle="modal" data-target="#myModal">
                                                            <i style="color: black;" class="fas fa-pencil-alt"></i>
                                                        </button> -->
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="div-mucTV">
                                                        <?php
                                                        $sql3 = "select * from danhsachtonvinh where ID_NguoiHienMau = '" . $row1['ID_NguoiHienMau'] . "' and MaDonVi = '" . $madonvi . "'";
                                                        $kq3 = mysqli_query($kn, $sql3) or die("Lỗi truy vấn");
                                                        while ($row3 = mysqli_fetch_array($kq3)) { ?>
                                                            <a class="p-mucTV" data-toggle="tooltip" data-placement="top" title="<?php echo "Đã tôn vinh ở đợt " . $row3['MaTonVinh'] ?>"><?php echo $row3['MucTonVinh'] ?></a>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img style="width: 30px;" src="<?php echo $mauco ?>">
                                                </td>
                                                <td></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="12">
                                                <div class="grp-btn" style="display: flex;">
                                                    <?php

                                                    $cboMucTonVinh = array_key_exists('cboMucTonVinh', $_POST) ?  $_POST['cboMucTonVinh'] : null;
                                                    if ($row1['dem'] == 0) { ?>
                                                        <a href="XuLyRieng.php?id=<?php echo $row['ID']; ?>&madonvi=<?php echo $madonvi; ?>&matonvinh=<?php echo $matonvinh; ?> " type="button" class="btn btn-danger" id="btnXuLyRieng<?php echo $row1['ID_NguoiHienMau'] ?>">
                                                            <b>Xử lý riêng</b>
                                                        </a>
                                                        </a>
                                                        <?php } else {
                                                        if ($mauco == "style/flagR.png") { ?>
                                                            <a href="XuLyRieng.php?id=<?php echo $row['ID']; ?>&madonvi=<?php echo $madonvi; ?>&matonvinh=<?php echo $matonvinh; ?> " type="button" class="btn btn-danger" id="btnXuLyRieng<?php echo $row1['ID_NguoiHienMau'] ?>">
                                                                <b>Xử lý riêng</b>
                                                            </a>
                                                        <?php } else {

                                                        ?>
                                                            <a href="ThemApplyTonVinh.php?id_excel=<?php echo $row['ID'] ?>&id_nguoihienmau=<?php echo $row1['ID_NguoiHienMau'] ?>&muctonvinh=
                                                            <?php echo $muctonvinh ?>&madonvi=<?php echo $madonvi ?>&matonvinh=<?php echo $matonvinh ?>&hoten=<?php echo $row['HoTen'] ?>&ngaysinh=
                                                            <?php echo $row['NgaySinh'] ?>&nhommau=<?php echo $row['NhomMau'] ?>&solanhienmau_excel=<?php echo $row['SoLanHienMau'] ?>&solanhienmau=<?php echo $row1['SoLanHienMau'] ?> " class="btn btn-danger btn-apply" id="btnApply<?php echo $row1['ID_NguoiHienMau'] ?>">
                                                                <b>Apply</b>
                                                            </a>


                                                            <div id="btnApply_1<?php echo $row1['ID_NguoiHienMau'] ?>"></div>

                                                            <a href="XuLyRieng.php?id=<?php echo $row['ID']; ?>&madonvi=<?php echo $madonvi; ?>&matonvinh=<?php echo $matonvinh; ?> " type="button" class="btn btn-danger" id="btnXuLyRieng<?php echo $row1['ID_NguoiHienMau'] ?>">
                                                                <b>Xử lý riêng</b>
                                                            </a>
                                                    <?php }
                                                    } ?>

                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                        $chuoidau = "<a class='btn btn-danger' href='ThemApplyTonVinh.php?id_excel=";
                                        $chuoigiua_1 = "&id_nguoihienmau=";
                                        $chuoigiua_2 = "&muctonvinh=";
                                        $chuoigiua_3 = "&madonvi=";
                                        $chuoigiua_4 = "&matonvinh=";
                                        $chuoicuoi = "'><b>Apply</b></a>";
                                        echo '<script type="text/javascript">
                                                function thaydoitonvinh' . $row1['ID_NguoiHienMau'] . '()
                                                {
                                                    var muctonvinh' . $row1['ID_NguoiHienMau'] . ' = document.getElementById("cboMucTonVinh' . $row1['ID_NguoiHienMau'] . '");
                                                    var giatritonvinh' . $row1['ID_NguoiHienMau'] . ';
                                                    for (var i = 0; i <  muctonvinh' . $row1['ID_NguoiHienMau'] . '.length; i++){
                                                        if ( muctonvinh' . $row1['ID_NguoiHienMau'] . '[i].selected){
                                                            giatritonvinh' . $row1['ID_NguoiHienMau'] . ' =  muctonvinh' . $row1['ID_NguoiHienMau'] . '[i].value;
                                                        }
                                                    }

                                                    document.getElementById("btnApply' . $row1['ID_NguoiHienMau'] . '").style.display = "none";
                                                    document.getElementById("btnApply_1' . $row1['ID_NguoiHienMau'] . '").innerHTML = "' . $chuoidau . '' . $row['ID'] . '' . $chuoigiua_1 . '' . $row1['ID_NguoiHienMau'] . '' . $chuoigiua_2 . '" + giatritonvinh' . $row1['ID_NguoiHienMau'] . ' + "' . $chuoigiua_3 . '' . $madonvi . '' . $chuoigiua_4 . '' . $matonvinh . '' . $chuoicuoi . '";
                                                }

                                                function XuLyRieng' . $row1['ID_NguoiHienMau'] . '()
                                                {
                                                    document.getElementById("btnApply' . $row1['ID_NguoiHienMau'] . '").style.display = "none";
                                                    document.getElementById("btnXuLyRieng' . $row1['ID_NguoiHienMau'] . '").style.display = "none";
                                                    document.getElementById("btnApply_1' . $row1['ID_NguoiHienMau'] . '").innerHTML = "<i>Đã thêm vào danh sách xử lý riêng</i>";
                                                }
                                                </script>';
                                    }
                                }  ?>
                            </table>

                        </div>
                        <div>
                            <button name="btnDSXuLyRieng" type="submit" class="btn btn-danger grp-btn">
                                <b>Thêm vào danh sách riêng</b>
                            </button>
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

    if (isset($_POST['btnDSXuLyRieng'])) {
        if (isset($_POST['mangchon'])) {
            foreach ($_POST['mangchon'] as $id) {
                $sqlDS = "select * from excel_tonvinh where ID = '" . $id . "'";
                $kqDS = mysqli_query($kn, $sqlDS) or die("Lỗi truy vấn");
                $rowDS = mysqli_fetch_array($kqDS);

                $hoten1 = $rowDS['HoTen'];
                $ngaysinh1 = $rowDS['NgaySinh'];
                $nghenghiep1 = $rowDS['NgheNghiep'];
                $sdt1 = $rowDS['SDT'];
                $diachi1 = $rowDS['DiaChi'];
                $nhommau1 = $rowDS['NhomMau'];
                $muctonvinh1 = $rowDS['MucTonVinh'];
                $SLHM = $rowDS['SoLanHienMau'];



                $sqlDS1 = "insert into danhsachxulyrieng(ID, HoTen, NgaySinh, NgheNghiep, SDT, DiaChi, NhomMau, MucTonVinh, MaDonVi, MaTonVinh, SoLanHienMau)
                        values ('', '" . $hoten1 . "', '" . $ngaysinh1 . "', '" . $nghenghiep1 . "', '" . $sdt1 . "', '" . $diachi1 . "', '" . $nhommau1 . "', '" . $muctonvinh1 . "', '" . $madonvi . "', '" . $matonvinh . "', '" . $SLHM . "')";
                $kqDS1 = mysqli_query($kn, $sqlDS1) or die("Lỗi truy vấn");

                $sqlDS2 = "delete from excel_tonvinh where ID = '" . $id . "'";
                $kqDS2 = mysqli_query($kn, $sqlDS2) or die("Lỗi truy vấn xóa");
            }
            echo '<meta http-equiv="refresh" content="0">';
            echo '<script> alert("Đã thêm vào danh sách xử lý riêng");</script>';
        } else {
            echo '<meta http-equiv="refresh" content="0">';
            echo '<script> alert("Lỗi! Không thể thêm vào danh sách xử lý riêng");</script>';
        }
    }
    ?>
    <!-- chân trang -->
    <div class="jumbotron text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>

</body>
<script type="text/javascript">
    $(document).ready(function() {
        $("b").click(function() {
            document.getElementById("dexuattonvinh").value = document.getElementById("cboMucTonVinh").value;
        });
        $(document).on("click", "a.remove", function() {
            $(this).parent().remove();
        });
    });
</script>

</html>