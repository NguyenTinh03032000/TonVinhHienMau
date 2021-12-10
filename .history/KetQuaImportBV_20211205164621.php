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
    <title>demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <link rel="stylesheet" href="style/style-ketquaimportbenhvien.css">
    <style>
        .btn {
            margin: 15px 15px;
        }

        .form-control {
            margin: 15px 0;
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

    <form action="CapNhatImportBV.php" method="POST">
        <div class="container-fluid" style="margin-top:30px; margin-bottom:30px;">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <?php
                    if ($user) {
                        $sql = "select COUNT(*) as dem from excel_benhvien";
                        $kq = mysqli_query($kn, $sql);
                        $row = mysqli_fetch_array($kq);
                    ?>
                        <h2 style="margin-bottom: 25px;">KẾT QUẢ IMPORT BỆNH VIỆN </h2>
                        <h5>Số lượng người được thêm mới: <?php echo $_GET['soluongnguoi_excel']; ?></h5>
                        <h5>Số lượng người được cập nhật: <?php echo $_GET['soluongnguoi_capnhat']; ?></h5>
                        <h5>Số người cần xử lý: <?php echo $row['dem'] ?></h5>
                        <br>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th hidden>Mã người dùng</th>
                                        <th>Họ tên</th>
                                        <th>Ngày sinh</th>
                                        <th>Nghề nghiệp</th>
                                        <th>Nơi làm việc</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th style="width: 100px;">Số lần hiến máu</th>
                                        <th style="width: 65px;">Nhóm ABO</th>
                                        <th>Nhóm Rh</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $sql = "select * from excel_benhvien";
                                    $kq = mysqli_query($kn, $sql);

                                    $stt = 0;
                                    while ($row = mysqli_fetch_array($kq)) {
                                        if (!$row) {
                                            echo '<tr><td colspan="6" style="text-align: center; font-size: 20px">CHƯA CÓ DỮ LIỆU</td></tr>';
                                        } else {
                                            $stt += 1;

                                    ?>
                                            <tr>
                                                <td style="vertical-align: inherit;">
                                                    <div class="stt">
                                                        <p><?php echo $stt ?></p>
                                                        <img src="image/excel.png" alt="" class="img_table">
                                                    </div>
                                                </td>
                                                <td hidden style="vertical-align: inherit;">
                                                    <p><?php echo $row['ID'] ?></p>
                                                </td>
                                                <td style="vertical-align: inherit;">
                                                    <p><?php echo $row['HoTen'] ?></p>
                                                </td>
                                                <td style="vertical-align: inherit;">
                                                    <p><?php echo htmlspecialchars(date_format(date_create($row['NgaySinh']), "d/m/Y")); ?></p>
                                                </td>
                                                <td style="vertical-align: inherit;">
                                                    <p><?php echo $row['NgheNghiep'] ?></p>
                                                </td>
                                                <td style="vertical-align: inherit;">
                                                    <p><?php echo $row['NoiLamViec'] ?></p>
                                                </td>
                                                <td style="vertical-align: inherit;">
                                                    <p><?php echo $row['SDT'] ?></p>
                                                </td>
                                                <td style="vertical-align: inherit;">
                                                    <p><?php echo $row['DiaChi'] ?></p>
                                                </td>
                                                <td style="vertical-align: inherit;">
                                                    <p><?php echo $row['SoLanHienMau'] ?></p>
                                                </td>
                                                <td style="vertical-align: inherit;">
                                                    <p><?php echo $row['NhomMau'] ?></p>
                                                </td>
                                                <td style="vertical-align: inherit;">
                                                    <p><?php echo $row['Nhom_RH'] ?></p>
                                                </td>
                                                <td></td>
                                                <td style="vertical-align: inherit;">
                                                    <?php
                                                    $nguoihienmau = array(
                                                        "id_excel" => $row['ID'],
                                                        "hoten" => $row['HoTen'],
                                                        "ngaysinh" => $row['NgaySinh'],
                                                        "nghenghiep" => $row['NgheNghiep'],
                                                        "noilamviec" => $row['NoiLamViec'],
                                                        "sdt" => $row['SDT'],
                                                        "diachi" => $row['DiaChi'],
                                                        "solanhienmau" => $row['SoLanHienMau'],
                                                        "nhommau" => $row['NhomMau'],
                                                        "nhomRH" => $row['Nhom_RH'],
                                                        "soluongnguoi_excel" => $_GET['soluongnguoi_excel'],
                                                        "soluongnguoi_capnhat" => $_GET['soluongnguoi_capnhat']
                                                    );
                                                    ?>
                                                    <a href="ThemImportBV.php?nguoihienmau=<?php echo urlencode(serialize($nguoihienmau)) ?>" class="btn btn-danger btnXuLy" style="margin: 0px;">THÊM</a>
                                                </td>
                                            </tr>

                                            <?php
                                            $sqlSoSanh = "select * from nguoihienmau WHERE HoTen LIKE '%" . $row['HoTen'] . "%' and NgaySinh LIKE '%" . $row['NgaySinh'] . "%' 
                                                                            and NhomMau LIKE '%" . $row['NhomMau'] . "%' and NhomRH LIKE '%" . $row['Nhom_RH'] . "%'";
                                            $kqSoSanh = mysqli_query($kn, $sqlSoSanh);

                                            while ($rowSoSanh = mysqli_fetch_array($kqSoSanh)) {
                                            ?>
                                                <tr>
                                                    <td style="vertical-align: inherit;">
                                                        <div class="stt">
                                                            <p><?php echo $stt ?></p>
                                                            <img src="image/database.png" alt="" class="img_table">
                                                        </div>
                                                    </td>
                                                    <td hidden style="vertical-align: inherit;">
                                                        <p><?php echo $rowSoSanh['ID_NguoiHienMau'] ?></p>
                                                    </td>
                                                    <td style="vertical-align: inherit;">
                                                        <p><?php echo $rowSoSanh['HoTen'] ?></p>
                                                    </td>
                                                    <td style="vertical-align: inherit;">
                                                        <p><?php echo htmlspecialchars(date_format(date_create($rowSoSanh['NgaySinh']), "d/m/Y")); ?></p>
                                                    </td>
                                                    <td style="vertical-align: inherit;">
                                                        <p><?php echo $rowSoSanh['NgheNghiep'] ?></p>
                                                    </td>
                                                    <td style="vertical-align: inherit;">
                                                        <p><?php echo $rowSoSanh['NoiLamViec'] ?></p>
                                                    </td>
                                                    <td style="vertical-align: inherit;">
                                                        <p><?php echo $rowSoSanh['SDT'] ?></p>
                                                    </td>
                                                    <td style="vertical-align: inherit;">
                                                        <p><?php echo $rowSoSanh['DiaChi'] ?></p>
                                                    </td>
                                                    <td style="vertical-align: inherit;">
                                                        <p><?php echo $rowSoSanh['SoLanHienMau'] ?></p>
                                                    </td>
                                                    <td style="vertical-align: inherit;">
                                                        <p><?php echo $rowSoSanh['NhomMau'] ?></p>
                                                    </td>
                                                    <td style="vertical-align: inherit;">
                                                        <p><?php echo $rowSoSanh['NhomRH'] ?></p>
                                                    </td>
                                                    <td style="vertical-align: inherit;">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label">
                                                                <?php
                                                                $thongtin_update = array(
                                                                    "id_nguoihienmau" => $rowSoSanh['ID_NguoiHienMau'],
                                                                    "id_excel" => $row['ID'],
                                                                    "hoten" => $row['HoTen'],
                                                                    "ngaysinh" => $row['NgaySinh'],
                                                                    "nghenghiep" => $row['NgheNghiep'],
                                                                    "noilamviec" => $row['NoiLamViec'],
                                                                    "sdt" => $row['SDT'],
                                                                    "diachi" => $row['DiaChi'],
                                                                    "solanhienmau" => $row['SoLanHienMau'],
                                                                    "nhommau" => $row['NhomMau'],
                                                                    "nhomRH" => $row['Nhom_RH'],
                                                                    "soluongnguoi_excel" => $_GET['soluongnguoi_excel'],
                                                                    "soluongnguoi_capnhat" => $_GET['soluongnguoi_capnhat']
                                                                );
                                                                ?>
                                                                <input type="radio" class="form-check-input" name="rbMa" checked value="<?php echo urlencode(serialize($thongtin_update)) ?>">
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: inherit;">
                                                        <?php
                                                        $thongtin_Xoa = array(
                                                            "id_Xoa" => $rowSoSanh['ID_NguoiHienMau'],
                                                            "soluongnguoi_excel" => $_GET['soluongnguoi_excel'],
                                                            "soluongnguoi_capnhat" => $_GET['soluongnguoi_capnhat']
                                                        );
                                                        ?>
                                                        <a href="XoaImportBV.php?thongtin_Xoa=<?php echo urlencode(serialize($thongtin_Xoa)) ?>" class="btn btn-danger btnXuLy" style="margin: 0px;">XÓA</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                            <tr>
                                                <td colspan="12">
                                                    <div class="nav justify-content-end">
                                                        <button type="submit" style="margin: 0;" name="btnImport" class="btn btn-danger justify-content-end ">CẬP NHẬT</button>
                                                    </div>
                                                </td>
                                            </tr>

                                    <?php }
                                    } ?>
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
                <div class="col-sm-1"></div>
            </div>
        </div>
    </form>

    <!-- chân trang -->
    <div class="jumbotron text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>
</body>

</html>