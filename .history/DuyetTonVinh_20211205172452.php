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
    <title>Đề xuất tôn vinh (ĐƯỢC DUYỆT)</title>
    <meta charset="utf-8">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">

    <link rel="stylesheet" href="style/danhsachduocduyet.css">

    <style>
        .btn {
            margin: 0px 10px;
        }

        .form-control {
            margin: 15px 0;
        }

        .button {
            background-color: #6666CC;
            border: none;
            color: white;
            padding: 5px 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 2px;
        }

        .button1 {
            font-size: 12px;
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
    <form action="" method="POST">
        <div class="container-fluid" style="margin-top:30px; margin-bottom:30px;">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <?php
                    if ($user) {
                    ?>
                        <!-- NỘI DUNG -->
                        <div class="container-fluid" style="margin-top:30px; margin-bottom:30px;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h1 style="text-align: center; color: red;">DANH SÁCH CÁC ĐỀ XUẤT TÔN VINH (ĐƯỢC DUYỆT)</h1>
                                    <?php
                                    $sql_dottonvinh = "select * from tonvinh order by ngaytonvinh DESC limit 1";
                                    $kq_dottonvinh = mysqli_query($kn, $sql_dottonvinh);
                                    $row_dottonvinh = mysqli_fetch_array($kq_dottonvinh);

                                    $sqld = "select COUNT(*) as dem FROM danhsachtonvinh where MaTonVinh = '" . $row_dottonvinh['matonvinh'] . "'";
                                    $kqd = mysqli_query($kn, $sqld);

                                    while ($rowd = mysqli_fetch_array($kqd)) {
                                    ?>
                                        <p style="text-align: center; font-size:20px"> Tổng số người đề xuất tôn vinh :
                                            <b> <?php echo $rowd['dem'] ?></b>
                                        </p>
                                        <p style="text-align: center; font-size:20px"> Đợt Tôn Vinh :
                                            <b> <?php echo $row_dottonvinh['matonvinh'] ?></b>
                                        </p>

                                    <?php } ?>

                                    <ul class="nav nav-pills btnXuLy" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link btnThongTin" data-toggle="modal" data-target="#modalThem">XÁC NHẬN</a>

                                            <!-- model xác nhận -->
                                            <div class="modal fade" id="modalThem">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h4 class="modal-title">XÁC NHẬN</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <h5>Bạn có muốn xác nhận ?</h5>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>
                                                            <a href="XacNhanKetQua.php?matonvinh=<?php echo $row_dottonvinh['matonvinh'] ?>" class="btn btn-secondary btnxn1" name="btnxn">Xác nhận</a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>


                                <!--menu mức -->
                                <div class="container-fluid">
                                    <ul class="nav nav-tabs">
                                        <?php
                                        $sql = "select DISTINCT muctonvinh FROM danhsachtonvinh ORDER BY MucTonVinh";
                                        $kq = mysqli_query($kn, $sql);
                                        while ($row = mysqli_fetch_array($kq)) {

                                        ?>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#muc<?php echo $row['muctonvinh']; ?>">Mức <?php echo $row['muctonvinh']; ?></a>
                                            </li>
                                        <?php
                                        } ?>

                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <?php

                                        $sql1 = "select DISTINCT muctonvinh FROM danhsachtonvinh ORDER BY MucTonVinh";
                                        $kq1 = mysqli_query($kn, $sql1);
                                        while ($row1 = mysqli_fetch_array($kq1)) {

                                        ?>
                                            <div class="tab-pane" id="muc<?php echo $row1['muctonvinh']; ?>">
                                                <?php
                                                $chon = $row1['muctonvinh'];
                                                $sqldem = "select COUNT(*) as dem FROM danhsachtonvinh WHERE MucTonVinh ='" . $chon . "' and MaTonVinh = '" . $row_dottonvinh['matonvinh'] . "' ";
                                                $kqdem = mysqli_query($kn, $sqldem);

                                                while ($rowdem = mysqli_fetch_array($kqdem)) {
                                                ?>
                                                    <div class="table-responsive">
                                                        <p>Tổng số người đề xuất tôn vinh:
                                                            <b> <?php echo $rowdem['dem'] ?> </b>
                                                        </p>

                                                        <table class="table table-bordered table-hover" style="width:100%">
                                                            <thead>
                                                                <tr style="text-align: center">
                                                                    <th style="text-align: center; vertical-align: inherit;">STT</th>

                                                                    <th style="text-align: center; vertical-align: inherit;">Họ tên</th>
                                                                    <th style="text-align: center; vertical-align: inherit; width: 110px;">Ngày sinh</th>
                                                                    <th style="text-align: center; vertical-align: inherit;">Số điện thoại</th>
                                                                    <th style="text-align: center; vertical-align: inherit;">Địa chỉ</th>
                                                                    <th style="text-align: center; vertical-align: inherit; width: 80px">Số lần hiên máu</th>
                                                                    <th style="text-align: center; vertical-align: inherit; width: 80px">Nhóm máu</th>
                                                                    <th style="text-align: center; vertical-align: inherit;">Nhóm Rh</th>
                                                                    <th style="text-align: center; vertical-align: inherit;">Đề xuất tôn vinh</th>
                                                                    <th style="text-align: center; vertical-align: inherit; width: 110px;">Đã tôn vinh</th>
                                                                    <th style="text-align: center; vertical-align: inherit;">Cập nhật</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="myTable">
                                                                <?php
                                                                $chonmuc = $row1['muctonvinh'];
                                                                $sql = "select nguoihienmau.ID_NguoiHienMau,nguoihienmau.HoTen, nguoihienmau.NgaySinh,nguoihienmau.SDT,nguoihienmau.DiaChi,nguoihienmau.SoLanHienMau,nguoihienmau.NhomMau,nguoihienmau.NhomRH,danhsachtonvinh.MucTonVinh,danhsachtonvinh.MaTonVinh, danhsachtonvinh.ID, danhsachtonvinh.MaDonVi
                                                                            FROM danhsachtonvinh,nguoihienmau WHERE danhsachtonvinh.ID_NguoiHienMau = nguoihienmau.ID_NguoiHienMau and danhsachtonvinh.MucTonVinh = '" . $chonmuc . "' and danhsachtonvinh.MaTonVinh = '" . $row_dottonvinh['matonvinh'] . "' ";
                                                                $kq = mysqli_query($kn, $sql);
                                                                $stt = 0;

                                                                while ($row = mysqli_fetch_array($kq)) {

                                                                ?>
                                                                    <tr>
                                                                        <td style="text-align: center;vertical-align: inherit;">
                                                                            <p style="margin: 7px auto;"><?php echo $stt += 1; ?></p>
                                                                        </td>
                                                                        <td hidden style="text-align: center; vertical-align: inherit;">
                                                                            <p name="idnguoihienmau" id="idnguoihienmau" style="margin: 7px auto;"><?php echo $row['ID_NguoiHienMau']; ?></p>
                                                                        </td>
                                                                        <td style="text-align: center; vertical-align: inherit;">
                                                                            <p style="margin: 7px auto;"><?php echo $row['HoTen']; ?></p>
                                                                        </td>
                                                                        <td style="vertical-align: inherit;">
                                                                            <p style="margin: 7px auto;"><?php echo $row['NgaySinh']; ?></p>
                                                                        </td>
                                                                        <td style="text-align: center; vertical-align: inherit;">
                                                                            <p style="margin: 7px auto;"><?php echo $row['SDT']; ?></p>
                                                                        </td>
                                                                        <td style="text-align: center; vertical-align: inherit;">
                                                                            <p style="margin: 7px auto;"><?php echo $row['DiaChi']; ?></p>
                                                                        </td>
                                                                        <td style="text-align: center; vertical-align: inherit;">
                                                                            <p style="margin: 7px auto;"><?php echo $row['SoLanHienMau']; ?></p>
                                                                        </td>
                                                                        <td style="text-align: center; vertical-align: inherit;">
                                                                            <p style="margin: 7px auto;"><?php echo $row['NhomMau']; ?></p>
                                                                        </td>
                                                                        <td style="text-align: center; vertical-align: inherit;">
                                                                            <p style="margin: 7px auto;"><?php echo $row['NhomRH']; ?></p>
                                                                        </td>


                                                                        <td style="text-align: center;vertical-align: inherit;">
                                                                            <select id="cboMucTonVinh<?php echo $row['ID']; ?>" onchange="thaydoimuctonvinh<?php echo $row['ID']; ?>()" style="width:95px">
                                                                                <?php
                                                                                $sql2 = "select * from muctonvinh";
                                                                                $kq2 = mysqli_query($kn, $sql2) or die("Lỗi truy vấn");

                                                                                while ($row2 = mysqli_fetch_array($kq2)) {
                                                                                    global $muctonvinh;
                                                                                    if (($row['SoLanHienMau'] >= 5 && $row['SoLanHienMau'] < 10)) {
                                                                                        $muctonvinh = 5;
                                                                                    } elseif ($row['SoLanHienMau'] >= 10 && $row['SoLanHienMau'] < 15) {
                                                                                        $muctonvinh = 10;
                                                                                    } elseif ($row['SoLanHienMau'] >= 15 && $row['SoLanHienMau'] < 20) {
                                                                                        $muctonvinh = 15;
                                                                                    } elseif ($row['SoLanHienMau'] >= 20 && $row['SoLanHienMau'] < 30) {
                                                                                        $muctonvinh = 20;
                                                                                    } elseif ($row['SoLanHienMau'] >= 30 && $row['SoLanHienMau'] < 40) {
                                                                                        $muctonvinh = 30;
                                                                                    } elseif ($row['SoLanHienMau'] >= 40 && $row['SoLanHienMau'] < 50) {
                                                                                        $muctonvinh = 40;
                                                                                    } elseif ($row['SoLanHienMau'] >= 50 && $row['SoLanHienMau'] < 60) {
                                                                                        $muctonvinh = 50;
                                                                                    } elseif ($row['SoLanHienMau'] >= 60 && $row['SoLanHienMau'] < 70) {
                                                                                        $muctonvinh = 60;
                                                                                    } elseif ($row['SoLanHienMau'] >= 70 && $row['SoLanHienMau'] < 80) {
                                                                                        $muctonvinh = 70;
                                                                                    } elseif ($row['SoLanHienMau'] >= 80 && $row['SoLanHienMau'] < 90) {
                                                                                        $muctonvinh = 80;
                                                                                    } elseif ($row['SoLanHienMau'] >= 90 && $row['SoLanHienMau'] < 100) {
                                                                                        $muctonvinh = 90;
                                                                                    } elseif ($row['SoLanHienMau'] >= 100) {
                                                                                        $muctonvinh = 100;
                                                                                    } else {
                                                                                        $muctonvinh = 0;
                                                                                    }


                                                                                ?>

                                                                                    <option <?php if ($muctonvinh == $row2['ID']) {
                                                                                                echo "selected = 'selected'";
                                                                                            } ?> value="<?php echo $row2['ID'] ?>"><?php echo $row2['TenMuc'] ?></option>

                                                                                <?php } ?>
                                                                            </select>
                                                                        </td>

                                                                        <td style=" vertical-align: inherit">
                                                                            <div class="row">
                                                                                <?php
                                                                                $sql7 = "select * from danhsachtonvinh where ID_NguoiHienMau = '" . $row['ID_NguoiHienMau'] . "'";
                                                                                $kq7 = mysqli_query($kn, $sql7) or die("Lỗi truy vấn");
                                                                                while ($row7 = mysqli_fetch_array($kq7)) { ?>
                                                                                    <div class="col-sm-1">
                                                                                        <a class="button button1" data-toggle="tooltip" data-placement="top" title="<?php echo "Đã tôn vinh ở đợt " . $row7['MaTonVinh'] ?>"><?php echo $row7['MucTonVinh'] ?></a>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </td>


                                                                        <td hidden style="text-align: center; vertical-align: inherit;">
                                                                            <p style="width: 20px; height: 25px;background-color: #6666CC;">
                                                                                <a data-toggle="tooltip" data-placement="top" title="<?php echo $muctonvinh ?>"><?php echo $muctonvinh; ?></a>

                                                                            </p>
                                                                        </td>
                                                                        <td style="text-align: center; vertical-align: inherit;">
                                                                            <a id="btnCapNhat_1<?php echo $row['ID'] ?>" href="XuLyDuyetTonVinh.php?muctonvinh=<?php echo $muctonvinh ?>&id_tonvinh=<?php echo $row['ID']; ?>" class="btn btn-link CapNhat">
                                                                                <img src="image/updated.png" style="width:35px" />
                                                                            </a>

                                                                            <div id="btnCapNhat_2<?php echo $row['ID'] ?>"></div>
                                                                        </td>

                                                                    </tr>

                                                                    <?php
                                                                    $chuoidau = "<a class='btn btn-link CapNhat' href='XuLyDuyetTonVinh.php?id_tonvinh=";
                                                                    $chuoigiua_1 = "&muctonvinh=";
                                                                    $chuoicuoi = "'><img src='image/updated.png' style='width:35px' /></a>";
                                                                    echo '<script type="text/javascript">
                                                                                        function thaydoimuctonvinh' . $row['ID'] . '()
                                                                                        {
                                                                                            var muctonvinh' . $row['ID'] . ' = document.getElementById("cboMucTonVinh' . $row['ID'] . '");
                                                                                            var giatritonvinh' . $row['ID'] . ';
                                                                                            for (var i = 0; i <  muctonvinh' . $row['ID'] . '.length; i++){
                                                                                                if ( muctonvinh' . $row['ID'] . '[i].selected){
                                                                                                    giatritonvinh' . $row['ID'] . ' =  muctonvinh' . $row['ID'] . '[i].value;
                                                                                                }
                                                                                            }

                                                                                            document.getElementById("btnCapNhat_1' . $row['ID'] . '").style.display = "none";
                                                                                            document.getElementById("btnCapNhat_2' . $row['ID'] . '").innerHTML = "' . $chuoidau . '' . $row['ID'] . '' . $chuoigiua_1 . '" + giatritonvinh' . $row['ID'] . ' + "' . $chuoicuoi . '";
                                                                                        }
                                                                                        </script>';
                                                                    ?>

                                                                <?php } ?>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php
                                        } ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                        include "loadDangNhap.php";
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

        <!-- model cập nhập -->
        <div class="modal fade" id="CapNhatThongTin">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class=" modal-title">XÁC NHẬN</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="container-fluid">
                            <input hidden type="text" class="form-control" name="txtIdNguoiCapNhat" id="txtIdNguoiCapNhat" style="pointer-events: none">
                            <input hidden type="text" class="form-control" name="txtMucCapNhat" id="txtMucCapNhat" style="pointer-events: none">
                            <p>Bạn có muốn cập nhật ?</p>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>
                        <button type="submit" class="btn btn-secondary btnxn1" name="btncapnhat">cập nhật</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</body>

</html>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).ready(function() {
        $('.CapNhat').on('click', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);
            $('#txtMucCapNhat').val(data[11].trim());
            $('#txtIdNguoiCapNhat').val(data[1].trim());
        });
    });
</script>

<?php
//cập nhật
$txtIdNguoiCapNhat = array_key_exists('txtIdNguoiCapNhat', $_POST) ?  $_POST['txtIdNguoiCapNhat'] : null;
$txtMucCapNhat = array_key_exists('txtMucCapNhat', $_POST) ?  $_POST['txtMucCapNhat'] : null;

function capNhat($txtIdNguoiCapNhat, $txtMucCapNhat)
{
    include "bocuc/Connect.php";
    $sql = "update danhsachtonvinh SET MucTonVinh = '" . $txtMucCapNhat . "' WHERE ID_NguoiHienMau = '" . $txtIdNguoiCapNhat . "'";
    $kq = mysqli_query($kn, $sql) or die("lỗi truy vấn");

    if ($kq) {
        echo '<meta http-equiv="refresh" content="0">';
        echo "<script>alert('Cập nhật thành công');</script>";
    } else {
        echo "<script>alert('Không thể cập nhật thông tin. Vui lòng thử lại sau!!!');</script>";
    }
}

if ($_POST) {
    if (isset($_POST['btncapnhat']) and $_SERVER['REQUEST_METHOD'] == "POST") {
        capNhat($txtIdNguoiCapNhat, $txtMucCapNhat);
    }
}
?>