<?php
require 'site.php';
include "bocuc/Connect.php";
include "bocuc/KiemTraSession.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <style>
        .fakeimg {
            height: 200px;
            background: #aaa;
        }
    </style>
</head>

<body>
    <?php
    $sqlThongTin = "select * from giangvien INNER JOIN khoa ON giangvien.MaKhoa = khoa.MaKhoa where MaGiangVien = '" . $_SESSION['Username'] . "'";
    $kqThongTin = mysqli_query($kn, $sqlThongTin) or die("Lỗi truy vấn");
    $rowThongTin = mysqli_fetch_array($kqThongTin);

    $MaKhoa = $rowThongTin['MaKhoa'];

    $malop = array_key_exists('cboLop_1', $_POST) ? $_POST['cboLop_1'] : null;
    $malop1 = array_key_exists('cboLop_2', $_POST) ? $_POST['cboLop_2'] : null;


    if (isset($_POST['btnThemSV'])) {
        $file = $_FILES['txtThemSV']['tmp_name'];

        $objReader = PHPExcel_IOFactory::createReaderForFile($file);
        $objReader->setLoadSheetsOnly('Table1');

        $objExcel = $objReader->load($file);
        $sheetData = $objExcel->getActiveSheet()->toArray('null', true, true, true);

        $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();

        for ($row = 2; $row <= $highestRow; $row++) {
            $masv = $sheetData[$row]['A'];
            $hoten = $sheetData[$row]['B'];
            $ngaysinh = $sheetData[$row]['C'];
            $gioitinh = $sheetData[$row]['D'];
            $sdt = $sheetData[$row]['E'];
            $email = $sheetData[$row]['F'];
            $chucvu = $sheetData[$row]['G'];
            $tinhtranghoc = $sheetData[$row]['H'];
            $matkhau = $sheetData[$row]['I'];
            $quyen = $sheetData[$row]['J'];

            $sqlThem = "insert into sinhvien (MaSinhVien, HoTen, NgaySinh, GioiTinh, SDT, Email, MaLop, ChucVu, TinhTrangHoc, MatKhau, Quyen)
                        values ('$masv', '$hoten', '$ngaysinh', '$gioitinh', '$sdt', '$email', '$malop', '$chucvu', '$tinhtranghoc', '$matkhau', '$quyen')";
            $kq2 = mysqli_query($kn, $sqlThem) or die("lỗi truy vấn");
        }
        echo "<script>alert('Thêm thành công');</script>";
    }

    if (isset($_POST['btnCapNhatSV'])) {
        $file = $_FILES['txtCapNhatSV']['tmp_name'];

        $objReader = PHPExcel_IOFactory::createReaderForFile($file);
        // $objReader->setLoadSheetsOnly('sinhvien');

        $objExcel = $objReader->load($file);
        $sheetData = $objExcel->getActiveSheet()->toArray('null', true, true, true);

        $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();

        for ($row = 2; $row <= $highestRow; $row++) {
            $masv = $sheetData[$row]['A'];
            $hoten = $sheetData[$row]['B'];
            $ngaysinh = $sheetData[$row]['C'];
            $gioitinh = $sheetData[$row]['D'];
            $sdt = $sheetData[$row]['E'];
            $email = $sheetData[$row]['F'];
            $chucvu = $sheetData[$row]['G'];
            $tinhtranghoc = $sheetData[$row]['H'];
            $matkhau = $sheetData[$row]['I'];
            $quyen = $sheetData[$row]['J'];

            $sqlCapNhat = "update sinhvien set HoTen = '$hoten', 
                                            NgaySinh = '$ngaysinh', 
                                            GioiTinh = '$gioitinh', 
                                            SDT = '$sdt', 
                                            Email = '$email', 
                                            ChucVu = '$chucvu', 
                                            TinhTrangHoc = '$tinhtranghoc', 
                                            MatKhau = '$matkhau', 
                                            Quyen = '$quyen'
                        where MaSinhVien = '$masv' and MaLop = '$malop1'";
            $kq2 = mysqli_query($kn, $sqlCapNhat) or die("lỗi truy vấn");
        }
        echo "<script>alert('Cập nhật thành công');</script>";
    }

    if (isset($_POST['btnThemGV'])) {
        $file = $_FILES['txtThemGV']['tmp_name'];

        $objReader = PHPExcel_IOFactory::createReaderForFile($file);
        // $objReader->setLoadSheetsOnly('giangvien');

        $objExcel = $objReader->load($file);
        $sheetData = $objExcel->getActiveSheet()->toArray('null', true, true, true);

        $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();

        for ($row = 2; $row <= $highestRow; $row++) {
            $magv = $sheetData[$row]['A'];
            $hoten = $sheetData[$row]['B'];
            $ngaysinh = $sheetData[$row]['C'];
            $gioitinh = $sheetData[$row]['D'];
            $sdt = $sheetData[$row]['E'];
            $email = $sheetData[$row]['F'];
            $matkhau = $sheetData[$row]['G'];
            $quyen = $sheetData[$row]['H'];

            $sqlThem = "insert into giangvien (MaSinhVien, HoTen, NgaySinh, GioiTinh, SDT, Email, MatKhau, MaKhoa, Quyen)
                        values ('$magv', '$hoten', '$ngaysinh', '$gioitinh', '$sdt', '$email', '$matkhau', '$MaKhoa','$quyen')";
            $kq2 = mysqli_query($kn, $sqlThem) or die("lỗi truy vấn");
        }
        echo "<script>alert('Thêm thành công');</script>";
    }

    if (isset($_POST['btnCapNhatGV'])) {
        $file = $_FILES['txtCapNhatGV']['tmp_name'];

        $objReader = PHPExcel_IOFactory::createReaderForFile($file);
        // $objReader->setLoadSheetsOnly('giangvien');

        $objExcel = $objReader->load($file);
        $sheetData = $objExcel->getActiveSheet()->toArray('null', true, true, true);

        $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();

        for ($row = 2; $row <= $highestRow; $row++) {
            $magv = $sheetData[$row]['A'];
            $hoten = $sheetData[$row]['B'];
            $ngaysinh = $sheetData[$row]['C'];
            $gioitinh = $sheetData[$row]['D'];
            $sdt = $sheetData[$row]['E'];
            $email = $sheetData[$row]['F'];
            $matkhau = $sheetData[$row]['G'];
            $quyen = $sheetData[$row]['H'];

            $sqlCapNhat = "update giangvien set HoTen = '$hoten', 
                                            NgaySinh = '$ngaysinh', 
                                            GioiTinh = '$gioitinh', 
                                            SDT = '$sdt', 
                                            Email = '$email', 
                                            MatKhau = '$matkhau', 
                                            Quyen = '$quyen'
                        where MaGiangVien = '$magv'";
            $kq2 = mysqli_query($kn, $sqlCapNhat) or die("lỗi truy vấn");
        }
        echo "<script>alert('Cập nhật thành công');</script>";
    }

    if (isset($_POST['btnXoaSV'])) {
        $masv = $_POST['txtMaSV'];

        $sql1 = "delete from sinhvien where MaSinhVien = '" . $masv . "'";
        $kq1 = mysqli_query($kn, $sql1);
        echo "<script>alert('Xóa thành công');</script>";
    }

    if (isset($_POST['btnXoaGV'])) {
        $magv = $_POST['txtMaGV'];

        $sql1 = "delete from giangvien where MaGiangVien = '" . $magv . "'";
        $kq1 = mysqli_query($kn, $sql1);
        echo "<script>alert('Xóa thành công');</script>";
    }

    if (isset($_POST['btnCapNhatThongTinSV'])) {
        $masv1 = $_POST['txtmasv1'];
        $txtchucvu1 = array_key_exists('txtchucvu1', $_POST) ? $_POST["txtchucvu1"] : null;
        $txtquyentruycap1 = array_key_exists('txtquyentruycap1', $_POST) ? $_POST["txtquyentruycap1"] : null;
        $txtmatkhau1 = $_POST['txtmatkhau1'];
        $tinhtranghoc1 = array_key_exists('tinhtranghoc1', $_POST) ? $_POST["tinhtranghoc1"] : null;

        if ($txtchucvu1 == "" or $txtquyentruycap1 == "") {
            echo "<script>alert('Vui lòng chọn thông tin chức vụ hoặc quyền truy cập');</script>";
        } else {
            $sql1 = "update sinhvien set ChucVu = '$txtchucvu1', 
                                        MatKhau = '$txtmatkhau1', 
                                        Quyen = '$txtquyentruycap1',
                                        TinhTrangHoc='$tinhtranghoc1'
                                        where MaSinhVien = '$masv1'";
            $kq1 = mysqli_query($kn, $sql1);
            echo "<script>alert('Cập nhật thông tin thành công');</script>";
        }
    }

    if (isset($_POST['btnCapNhatThongTinGV'])) {
        $magv2 = $_POST['txtmagv2'];
        $txtquyentruycap2 = array_key_exists('txtquyentruycap2', $_POST) ? $_POST["txtquyentruycap2"] : null;
        $txtmatkhau2 = $_POST['txtmatkhau2'];

        if ($txtquyentruycap2 == "") {
            echo "<script>alert('Vui lòng chọn thông tin chức vụ hoặc quyền truy cập');</script>";
        } else {
            $sql1 = "update giangvien set MatKhau = '$txtmatkhau2', 
                                        Quyen = '$txtquyentruycap2'
                                        where MaGiangVien = '$magv2'";
            $kq1 = mysqli_query($kn, $sql1);
            echo "<script>alert('Cập nhật thông tin thành công');</script>";
        }
    }

    if (isset($_POST['btnLuuSV'])) {
        $txtMSV = array_key_exists('txtMSV', $_POST) ? $_POST["txtMSV"] : null;
        $txtTen = array_key_exists('txtTen', $_POST) ? $_POST["txtTen"] : null;
        $dateNgaysinh = array_key_exists('dateNgaysinh', $_POST) ? $_POST["dateNgaysinh"] : null;
        $rdgioitinh = array_key_exists('rdgioitinh', $_POST) ? $_POST["rdgioitinh"] : null;
        $txtSDT = array_key_exists('txtSDT', $_POST) ? $_POST["txtSDT"] : null;
        $txtEmail = array_key_exists('txtEmail', $_POST) ? $_POST["txtEmail"] : null;
        $cboKhoa = array_key_exists('cboKhoa', $_POST) ? $_POST["cboKhoa"] : null;
        $cboLop = array_key_exists('cboLop', $_POST) ? $_POST["cboLop"] : null;
        $cbochuyennganh = array_key_exists('cbochuyennganh', $_POST) ? $_POST["cbochuyennganh"] : null;
        $cboChucvu = array_key_exists('cboChucvu', $_POST) ? $_POST["cboChucvu"] : null;
        $cbotinhtrang = array_key_exists('cbotinhtrang', $_POST) ? $_POST["cbotinhtrang"] : null;
        $txtMK = array_key_exists('txtMK', $_POST) ? $_POST["txtMK"] : null;
        $cboQuyen = array_key_exists('cboQuyen', $_POST) ? $_POST["cboQuyen"] : null;

        $sqlLuu = "insert into sinhvien (MaSinhVien, HoTen, NgaySinh, GioiTinh, SDT, Email, MaLop, MaChuyenNganh, ChucVu, TinhTrangHoc, MatKhau, Quyen)
                    values ('$txtMSV', '$txtTen', '$dateNgaysinh', '$rdgioitinh', '$txtSDT', '$txtEmail', '$cboLop', '$cbochuyennganh', '$cboChucvu', '$cbotinhtrang', '$txtMK', '$cboQuyen')";
        $kq10 = mysqli_query($kn, $sqlLuu);
        echo "<script>alert('Thêm sinh viên thành công');</script>";
    }

    if (isset($_POST['btnLuuGV'])) {
        $txtMSVGV = array_key_exists('txtMSVGV', $_POST) ? $_POST["txtMSVGV"] : null;
        $txtTenGV = array_key_exists('txtTenGV', $_POST) ? $_POST["txtTenGV"] : null;
        $dateNgaysinhGV = array_key_exists('dateNgaysinhGV', $_POST) ? $_POST["dateNgaysinhGV"] : null;
        $rdgioitinhGV = array_key_exists('rdgioitinhGV', $_POST) ? $_POST["rdgioitinhGV"] : null;
        $txtSDTGV = array_key_exists('txtSDTGV', $_POST) ? $_POST["txtSDTGV"] : null;
        $txtEmailGV = array_key_exists('txtEmailGV', $_POST) ? $_POST["txtEmailGV"] : null;
        $txtMKGV = array_key_exists('txtMKGV', $_POST) ? $_POST["txtMKGV"] : null;
        $cboQuyenGV = array_key_exists('cboQuyenGV', $_POST) ? $_POST["cboQuyenGV"] : null;

        $sqlLuuGV = "insert into giangvien (MaGiangVien, HoTen, NgaySinh, GioiTinh, SDT, Email, MatKhau, Quyen)
                    values ('$txtMSVGV', '$txtTenGV', '$dateNgaysinhGV', '$rdgioitinhGV', '$txtSDTGV', '$txtEmailGV', '$txtMKGV', '$cboQuyenGV')";
        $kq11 = mysqli_query($kn, $sqlLuuGV);
        echo "<script>alert('Thêm giáo viên thành công');</script>";
    }
    ?>

    <!-- top đầu trang -->
    <div class="jumbotron text-center" style="margin-bottom:0;  padding: 20px;">

        <?php load_top(); ?>

    </div>

    <!-- menu của trang / menu user 1 -->
    <?php load_MenuQuanTri(); ?>

    <!-- thân của trang -->
    <div class="container-fluid" style="margin-top:30px;">
        <div class="row">
            <div class="col-sm-1"></div>

            <div class="col-sm-10">
                <div class="container">
                    <?php
                    if ($user) {
                    ?>
                        <!-- Nội dung  -->
                </div>
            <?php
                    } else {
                        include "loadDangNhapQuanTri.php";
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
​