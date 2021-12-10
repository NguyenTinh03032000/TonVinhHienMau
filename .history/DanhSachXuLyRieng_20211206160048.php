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
    <title>Danh sách xử lý riêng</title>
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

<body>
    <!-- top đầu trang -->
    <div>

        <?php load_top(); ?>

    </div>

    <!-- menu của trang / menu user 1 -->
    <?php load_menu(); ?>

    <div class="container-fluid" style="margin-top:30px; margin-bottom:30px;">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?php
                if ($user) {
                ?>
                    <div>
                        <h1 style="text-align: center;">DANH SÁCH XỬ LÝ RIÊNG</h1>
                    </div>
                    <form action="" method="POST">
                        <div class="table-responsive" id="tbsv3">
                            <table class="table table-bordered" style="text-align: center;">
                                <tr>
                                    <td>STT</td>
                                    <td>Họ tên</td>
                                    <td style="width: 110px;">Ngày sinh</td>
                                    <td>Số điện thoại</td>
                                    <td>Địa chỉ</td>
                                    <td style="width: 95px;">Số lần hiến máu</td>
                                    <td style="width: 65px;">Nhóm ABO</td>
                                    <td style="width: 65px;">Nhóm Rh</td>
                                    <td style="width: 85px;">Đề xuất tôn vinh</td>
                                    <!-- <td>Đã tôn vinh</td> -->
                                    <td></td>
                                    <td></td>
                                </tr>

                                <?php
                                $sql = "select * from danhsachxulyrieng";
                                $kq = mysqli_query($kn, $sql) or die("lỗi truy vấn");

                                $stt = 0;
                                while ($row = mysqli_fetch_array($kq)) {
                                    $sql1 = "select * from nguoihienmau where HoTen='" . $row['HoTen'] . "' and NgaySinh='" . $row['NgaySinh'] . "' and NhomMau='" . $row['NhomMau'] . "'";
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
                                        <td style="text-align: left"><?php echo $row['HoTen'] ?></td>
                                        <td><?php echo $row['NgaySinh'] ?></td>
                                        <td><?php echo $row['SDT'] ?></td>
                                        <td style="text-align: left"><?php echo $row['DiaChi'] ?></td>
                                        <td><?php echo $row['SoLanHienMau'] ?></td>
                                        <td><?php echo $row['NhomMau'] ?></td>
                                        <td style="text-align: center;">-</td>
                                        <td><?php echo "Mức " . $row['MucTonVinh'] ?></td>
                                        <!-- <td></td> -->
                                        <td></td>
                                        <td> <?php echo "<input type='checkbox' name='mangchon[]' value = $id >"; ?></td>
                                    </tr>
                                    <?php
                                    while ($row1 = mysqli_fetch_array($kq1)) { ?>

                                        <tr>
                                            <td>
                                                <div class="div-icon">
                                                    <?php echo $stt ?>
                                                    <img style="margin: 0 0 0 5px; width: 30px" src="style/database.png">
                                                </div>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td><?php echo $row1['SDT'] ?></td>
                                            <td><?php echo $row1['DiaChi'] ?></td>
                                            <td><?php echo $row1['SoLanHienMau'] ?></td>
                                            <td><?php echo $row1['NhomMau'] ?></td>
                                            <td><?php echo $row1['NhomRH'] ?></td>
                                            <!-- đề xuất tôn vinh -->
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
                                            <!-- đã tôn vinh -->
                                            <!-- <td></td> -->
                                            <td>
                                                <img style="width: 30px;" src="<?php echo $mauco ?>">
                                            </td>
                                            <td></td>
                                        </tr>

                                    <?php } ?>

                                    <tr>
                                        <td colspan="11">
                                            <div class="grp-btn" style="display: flex;">
                                                <?php
                                                $sql2 = "select * from nguoihienmau where HoTen='" . $row['HoTen'] . "' and NgaySinh='" . $row['NgaySinh'] . "' and NhomMau='" . $row['NhomMau'] . "'";
                                                $kq2 = mysqli_query($kn, $sql2);
                                                $row2 = mysqli_fetch_array($kq2);
                                                if ($row2) { ?>
                                                    <a href="XoaXuLyRieng.php?id=<?php echo $row['ID']; ?>" type="button" class="btn btn-danger" id="btnXoa<?php echo $row['ID'] ?>">
                                                        <b>Xóa</b>
                                                    </a>
                                                <?php } else { ?>
                                                    <a href="XoaXuLyRieng.php?id=<?php echo $row['ID']; ?>" type="button" class="btn btn-danger btn-apply" id="btnXoa<?php echo $row['ID'] ?>">
                                                        <b>Xóa</b>
                                                    </a>
                                                    <a href="ThemvaTonVinh.php?id=<?php echo $row['ID']; ?>" type="button" class="btn btn-danger" id="btnApply<?php echo $row['ID'] ?>">
                                                        <b>Thêm và Tôn vinh</b>
                                                    </a>
                                                <?php } ?>


                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                            <div>
                                <button name="btnThem" type="submit" class="btn btn-danger grp-btn">
                                    <b>Thêm </b>
                                </button>
                                <button name="btnXoa" type="submit" class="btn btn-danger grp-btn btn-apply">
                                    <b>Xóa</b>
                                </button>
                                <!-- <button name="btnApply" type="submit" class="btn btn-danger grp-btn btn-apply">
                                                <b>Apply</b>
                                            </button> -->
                            </div>
                        </div>

                    </form>

                <?php
                } else {
                    include "loadDangNhap.php";
                }

                if (isset($_POST['btnThem'])) {
                    if (isset($_POST['mangchon'])) {
                        foreach ($_POST['mangchon'] as $id) {
                            $sqlDS = "select * from danhsachxulyrieng where ID = '" . $id . "'";
                            $kqDS = mysqli_query($kn, $sqlDS) or die("Lỗi truy vấn");
                            $rowDS = mysqli_fetch_array($kqDS);

                            $hoten = $rowDS['HoTen'];
                            $ngaysinh = $rowDS['NgaySinh'];
                            $nghenghiep = $rowDS['NgheNghiep'];
                            $sdt = $rowDS['SDT'];
                            $diachi = $rowDS['DiaChi'];
                            $nhommau = $rowDS['NhomMau'];
                            $muctonvinh = $rowDS['MucTonVinh'];
                            $SLHM = $rowDS['SoLanHienMau'];
                            $madonvi = $rowDS['MaDonVi'];
                            $matonvinh = $rowDS['MaTonVinh'];

                            // $sql1 = "select * from nguoihienmau where HoTen = '" . $hoten . "' and NgaySinh = '" . $ngaysinh . "' and NhomMau = '" . $nhommau . "'";
                            // $kq1 =  mysqli_query($kn, $sql1) or die("Lỗi truy vấn select");

                            // if ($row1 = mysqli_fetch_array($kq1)) {
                            //     echo '<meta http-equiv="refresh" content="0">';
                            //     echo '<script> alert("Lỗi");</script>';
                            // } else {
                            $sqlDS1 = "insert into nguoihienmau(ID_NguoiHienMau, HoTen, NgaySinh, NgheNghiep, NoiLamViec, SDT, DiaChi, SoLanHienMau, NhomMau, NhomRH)
                                values ('', '" . $hoten . "', '" . $ngaysinh . "', '" . $nghenghiep . "', '', '" . $sdt . "', '" . $diachi . "', '" . $SLHM . "', '" . $nhommau1 . "', '')";
                            $kqDS1 = mysqli_query($kn, $sqlDS1) or die("Lỗi truy vấn");

                            $sqlDS1 = "insert into danhsachtonvinh(ID, MaTonVinh, ID_NguoiHienMau, MucTonVinh, MaDonVi)
                                values ('', '" . $hoten . "', '" . $ngaysinh . "', '" . $nghenghiep . "', '5', '" . $madonvi . "')";
                            $kqDS1 = mysqli_query($kn, $sqlDS1) or die("Lỗi truy vấn");

                            // }

                            $sql2 = "delete from danhsachxulyrieng where ID = '" . $id . "'";
                            $kq2 = mysqli_query($kn, $sql2) or die("Lỗi truy vấn delete");
                        }
                        echo '<meta http-equiv="refresh" content="0">';
                        echo '<script> alert("Thêm thành công");</script>';
                    } else {
                        echo '<meta http-equiv="refresh" content="0">';
                        echo '<script> alert("Lỗi! Không thể thêm");</script>';
                    }
                }

                if (isset($_POST['btnXoa'])) {
                    if (isset($_POST['mangchon'])) {
                        foreach ($_POST['mangchon'] as $id) {
                            $sql2 = "delete from danhsachxulyrieng where ID = '" . $id . "'";
                            $kq2 = mysqli_query($kn, $sql2) or die("Lỗi truy vấn delete");
                        }
                        echo '<meta http-equiv="refresh" content="0">';
                        echo '<script> alert("Xóa thành công");</script>';
                    } else {
                        echo '<meta http-equiv="refresh" content="0">';
                        echo '<script> alert("Lỗi! Xóa không thành công");</script>';
                    }
                }
                ?>
                <br>
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>

    <!-- chân trang -->
    <div class="jumbotron text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>
</body>

</html>