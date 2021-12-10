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
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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
        $maqt1 = $_POST['txtmaqt1'];
        $sdt1 = $_POST['sdt1'];
        $email1 = $_POST['email1'];
        $txtmatkhau1 = $_POST['txtmatkhau1'];

        if ($sdt1 == "" or $email1 == "") {
            echo "<script>alert('Vui lòng nhập số điện thoại hoặc Email');</script>";
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
        $txtMQT = array_key_exists('txtMSV', $_POST) ? $_POST["txtMSV"] : null;
        $txtTen = array_key_exists('txtTen', $_POST) ? $_POST["txtTen"] : null;
        $dateNgaysinh = array_key_exists('dateNgaysinh', $_POST) ? $_POST["dateNgaysinh"] : null;
        $rdgioitinh = array_key_exists('rdgioitinh', $_POST) ? $_POST["rdgioitinh"] : null;
        $txtSDT = array_key_exists('txtSDT', $_POST) ? $_POST["txtSDT"] : null;
        $txtEmail = array_key_exists('txtEmail', $_POST) ? $_POST["txtEmail"] : null;
        $txtMK = array_key_exists('txtMK', $_POST) ? $_POST["txtMK"] : null;

        $sqlLuu = "insert into quantri (MaQuanTri, HoTen, NgaySinh, GioiTinh, SDT, Email, MatKhau)
                    values ('$txtMQT', '$txtTen', '$dateNgaysinh', '$rdgioitinh', '$txtSDT', '$txtEmail', '$txtMK')";
        $kq10 = mysqli_query($kn, $sqlLuu);
        echo "<script>alert('Thêm tài khoảng quản trị thành công');</script>";
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
                        <form action="" method="POST" enctype="multipart/form-data">
                            <h2 style="text-align: center">QUẢN LÝ TÀI KHOẢN ĐĂNG NHẬP</h2>
                            <hr>
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills" role="tablist" style="justify-content: center;">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#menu1">Tài khoản đăng nhập quản trị</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu2">Tài khoản đăng nhập giảng viên</a>
                                </li>
                            </ul>
                            <br>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div id="menu1" class="container-fluid tab-pane active border border-primary"><br>
                                    <div>
                                        <input style="display: inline;float:left; width: 55%; left:100px" class="form-control" id="tim1" type="text" placeholder="Tìm kiếm...">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ThemQT">
                                            Thêm tài khoản đăng nhập
                                        </button>

                                        <!-- The Modal thêm quản trị -->
                                        <div class="modal fade" id="ThemQT">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Thêm tài khoản đăng nhập quản trị</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Nav tabs -->
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#nhap1">Thêm thông tin</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#exel1">Nhập file exel</a>
                                                        </li>
                                                    </ul>

                                                    <!-- Tab panes -->
                                                    <div class="tab-content">
                                                        <!-- Tab Nhập thủ công -->
                                                        <div id="nhap1" class="container tab-pane active"><br>
                                                            <h3>Thêm thông tin</h3>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                        <p>Mã quản trị:</p>
                                                                        <input type="text" class="form-control" name="txtMQT" style="font-size: 18px;">
                                                                    </div>
                                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                        <p>Họ và tên:</p>
                                                                        <input type="text" class="form-control" name="txtTen" style="font-size: 18px;">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                        <p>Ngày sinh:</p>
                                                                        <input type="date" class="form-control" name="dateNgaysinh">
                                                                    </div>
                                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                        <p>Giới tính:</p>
                                                                        <input type="radio" name="rdgioitinh" id="rdgioitinhnu" value="Nam" style="font-size: 18px;"> Nam
                                                                        <input type="radio" name="rdgioitinh" id="rdgioitinhnam" value="Nữ" style="font-size: 18px;"> Nữ
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                        <p>Số điện thoại:</p>
                                                                        <input type="text" class="form-control" name="txtSDT" style="font-size: 18px;">
                                                                    </div>
                                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                        <p>Email:</p>
                                                                        <input type="email" class="form-control" name="txtEmail" placeholder="name@example.com" style="font-size: 18px;">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-12" style="justify-content: center;display: block;">
                                                                        <p>Mật khẩu:</p>
                                                                        <input type="password" class="form-control" name="txtMK" style="font-size: 18px;">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary" name="btnLuuSV">Lưu</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                                            </div>
                                                        </div>
                                                        <!-- Tab Nhập exel -->
                                                        <!-- Sửa -->
                                                        <div id="exel1" class="container tab-pane fade"><br>
                                                            <h3>Nhập file exel</h3>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                        <p>Khóa học:</p>
                                                                        <select class="form-control drop cboKhoa_1" name="cboKhoa_1" id="cboKhoa_1">
                                                                            <option value="" selected="selected">--Chọn khóa học--</option>
                                                                            <?php
                                                                            $date = getdate();
                                                                            $nam = $date['year'];
                                                                            $sql1 = "SELECT * from khoahoc where NamKetThuc>='" . $nam . "'limit 6";
                                                                            $kq1 = mysqli_query($kn, $sql1);
                                                                            while ($row1 = mysqli_fetch_array($kq1)) :
                                                                            ?>
                                                                                <option value="<?php echo htmlspecialchars($row1['MaKhoaHoc']) ?>"><?php echo htmlspecialchars($row1['MaKhoaHoc']) ?></option>
                                                                            <?php endwhile; ?>
                                                                        </select>
                                                                        <script type='text/javascript'>
                                                                            document.getElementById('cboKhoa_1').value = "<?php echo $_POST['cboKhoa_1']; ?>";
                                                                        </script>
                                                                    </div>
                                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                        <p>Lớp:</p>
                                                                        <select class="form-control drop cboLop_1" name="cboLop_1" id="cboLop_1">
                                                                            <option value="" selected="selected">--Chọn lớp học--</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <p>Vui lòng chọn tệp excel:</p>
                                                                <input type="file" name="txtThemSV">
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary" name="btnThemSV">Thêm</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal -->

                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CapNhatQT">
                                            Cập nhật tài khoản đăng nhập
                                        </button>

                                        <!-- The Modal cập nhật quản trị exel -->
                                        <!-- Sửa -->
                                        <div class="modal fade" id="CapNhatQT">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Cập nhật tài khoản đăng nhập sinh viên</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                <p>Khóa học:</p>
                                                                <select class="form-control drop cboKhoa_2" name="cboKhoa_2" id="cboKhoa_2">
                                                                    <option value="" selected="selected">--Chọn khóa học--</option>
                                                                    <?php
                                                                    $date = getdate();
                                                                    $nam = $date['year'];
                                                                    $sql1 = "SELECT * from khoahoc where NamKetThuc>='" . $nam . "'limit 6";
                                                                    $kq1 = mysqli_query($kn, $sql1);
                                                                    while ($row1 = mysqli_fetch_array($kq1)) :
                                                                    ?>
                                                                        <option value="<?php echo htmlspecialchars($row1['MaKhoaHoc']) ?>"><?php echo htmlspecialchars($row1['MaKhoaHoc']) ?></option>
                                                                    <?php endwhile; ?>
                                                                </select>
                                                                <script type='text/javascript'>
                                                                    document.getElementById('cboKhoa_2').value = "<?php echo $_POST['cboKhoa_2']; ?>";
                                                                </script>
                                                            </div>
                                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                <p>Lớp:</p>
                                                                <select class="form-control drop cboLop_2" name="cboLop_2" id="cboLop_2">
                                                                    <option value="" selected="selected">--Chọn lớp học--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <p>Vui lòng chọn tệp excel:</p>
                                                        <input type="file" name="txtCapNhatSV">
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" name="btnCapNhatSV">Cập nhật</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal -->
                                    </div>
                                    <hr>
                                    <div style="overflow: scroll;height: 1000px;" class="table-responsive">
                                        <!-- Bảng quản trị -->
                                        <table id="tbtaikhoanSV" class="table table-bordered table-hover" style="width:100%">
                                            <thead>
                                                <tr style="text-align: center">
                                                    <th style="text-align: center; vertical-align: inherit;">Mã quản trị</th>
                                                    <th style="text-align: center; vertical-align: inherit;">Họ tên</th>
                                                    <th style="text-align: center; vertical-align: inherit;">Ngày sinh</th>
                                                    <th style="text-align: center; vertical-align: inherit;">Giới tính</th>
                                                    <th style="text-align: center; vertical-align: inherit;" hidden>SĐT</th>
                                                    <th style="text-align: center; vertical-align: inherit;" hidden>Email</th>
                                                    <th style="text-align: center; vertical-align: inherit;" hidden>Mật khẩu</th>
                                                    <th style="text-align: center; vertical-align: inherit;">Chi tiết</th>
                                                    <th style="text-align: center; vertical-align: inherit;">Cập nhật</th>
                                                    <th style="text-align: center; vertical-align: inherit;">Xóa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql1 = "select * from quantri";
                                                $kq1 = mysqli_query($kn, $sql1);
                                                $stt = 0;
                                                while ($row = mysqli_fetch_array($kq1)) {
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center; vertical-align: inherit;">
                                                            <p style="margin: 7px auto;"><?php echo $row['MaQuanTri']; ?></p>
                                                        </td>
                                                        <td style="vertical-align: inherit;">
                                                            <p style="margin: 7px auto;  width: 150px;"><?php echo $row['HoTen']; ?></p>
                                                        </td>
                                                        <td style="text-align: center; vertical-align: inherit;">
                                                            <p style="margin: 7px auto; width: 100px;"><?php echo $row['NgaySinh']; ?></p>
                                                        </td>
                                                        <td style="text-align: center; vertical-align: inherit;">
                                                            <p style="margin: 7px auto;"><?php echo $row['GioiTinh']; ?></p>
                                                        </td>
                                                        <td hidden style="text-align: center; vertical-align: inherit;">
                                                            <p style="margin: 7px auto;"><?php echo $row['SDT']; ?></p>
                                                        </td>
                                                        <td hidden style="text-align: center; vertical-align: inherit;">
                                                            <p style="margin: 7px auto;"><?php echo $row['Email']; ?></p>
                                                        </td>
                                                        <td hidden style="text-align: center; vertical-align: inherit;">
                                                            <p style="margin: 7px auto; width: 80px;"><?php echo $row['MatKhau']; ?></p>
                                                        </td>
                                                        <td style="text-align: center; vertical-align: inherit;">
                                                            <button type="button" class="btn btn-link ThongTinQT" data-toggle="modal" data-target="#ThongTinQT<?php echo $row['MaQuanTri']; ?>">
                                                                <i class="fas fa-info"></i>
                                                            </button>
                                                        </td>
                                                        <td style="text-align: center; vertical-align: inherit;">
                                                            <button type="button" class="btn btn-link CapNhatThongTinQT" data-bs-toggle="modal" data-bs-target="#CapNhatThongTinQT">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </td>
                                                        <td style="text-align: center; vertical-align: inherit;">
                                                            <button type="button" class="btn btn-link XoaQT" data-toggle="modal" data-target="#XoaQT">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>

                                                        <!-- The Modal Chi tiết sinh viên -->
                                                        <div class="modal fade" id="ThongTinQT<?php echo $row['MaQuanTri']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Thông tin chi tiết quản trị</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                                <h5>Mã quản trị: <?php echo $row['MaQuanTri']; ?></h5>
                                                                                <hr>
                                                                            </div>
                                                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                                <h5>Họ và tên: <?php echo $row['HoTen']; ?></h5>
                                                                                <hr>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                                <h5>Ngày sinh: <?php echo $row['NgaySinh']; ?></h5>
                                                                                <hr>
                                                                            </div>
                                                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                                <h5>Giới tính: <?php echo $row['GioiTinh']; ?></h5>
                                                                                <hr>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                                <h5>Số điện thoại: <?php echo $row['SDT']; ?></h5>
                                                                                <hr>
                                                                            </div>
                                                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                                <h5>Email: <?php echo $row['Email']; ?></h5>
                                                                                <hr>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-12" style="justify-content: center;display: block;">
                                                                                <h5>Mật khẩu: <?php echo $row['MatKhau']; ?></h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end modal -->

                                                    <?php } ?>
                                            </tbody>
                                        </table>

                                        <!-- The Modal cập nhật quản trị -->
                                        <div class="modal fade" id="CapNhatThongTinQT">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Cập nhật thông tin quản trị</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <p>Mã quản trị:</p>
                                                                <input type="text" class="form-control" name="txtmasv1" id="maqt1" placeholder="Mã quản trị" style="pointer-events: none">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <p>Họ tên:</p>
                                                                <input type="text" class="form-control" name="txthoten1" id="hoten1" placeholder="Họ tên quản trị" style="pointer-events: none">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <p>Số điện thoại:</p>
                                                                <input type="text" class="form-control" name="sdt1" id="sdt1">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <p>Email:</p>
                                                                <input type="text" class="form-control" name="email1" id="email1">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <p>Mật khẩu:</p>
                                                                <input type="text" class="form-control" name="txtmatkhau1" id="matkhau1" placeholder="Mật khẩu">
                                                            </div>
                                                        </div>

                                                        <h5>Bạn có chắc chắn muốn cập nhật thông tin này?</h5>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" name="btnCapNhatThongTinQT">Cập nhật thông tin</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal -->

                                        <!-- The Modal xóa sinh viên -->
                                        <div class="modal fade" id="XoaSV">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Xóa thông tin sinh viên</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <p>Mã đăng nhập</p>
                                                        <input type="text" class="form-control" name="txtMaSV" id="masv" style="pointer-events: none">
                                                        <p>Tên đăng nhập</p>
                                                        <input type="text" class="form-control" id="hotensv" style="pointer-events: none">
                                                        <br>
                                                        <h5>Bạn có chắc chắn muốn xóa thông tin này?</h5>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" name="btnXoaSV">Xóa thông tin</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal -->

                                    </div>
                                    <br>
                                </div>

                                <div id="menu2" class="container-fluid tab-pane fade border border-primary"><br>
                                    <div>
                                        <input style="display: inline;float:left; width: 55%; left:100px" class="form-control" id="tim2" type="text" placeholder="Tìm kiếm...">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ThemGV">
                                            Thêm tài khoản đăng nhập
                                        </button>

                                        <!-- The Modal thêm giảng viên -->
                                        <div class="modal fade" id="ThemGV">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Thêm tài khoản đăng nhập giảng viên</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!-- Nav tabs -->
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#nhap2">Thêm thông tin</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#exel2">Nhập file exel</a>
                                                        </li>
                                                    </ul>

                                                    <!-- Tab panes -->
                                                    <div class="tab-content">
                                                        <!-- Tab Nhập thủ công -->
                                                        <div id="nhap2" class="container tab-pane active"><br>
                                                            <h3>Thêm thông tin</h3>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                        <p>Mã giảng viên:</p>
                                                                        <input type="text" class="form-control" name="txtMSVGV" style="font-size: 18px;">
                                                                    </div>
                                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                        <p>Họ và tên:</p>
                                                                        <input type="text" class="form-control" name="txtTenGV" style="font-size: 18px;">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                        <p>Ngày sinh:</p>
                                                                        <input type="date" class="form-control" name="dateNgaysinhGV">
                                                                    </div>
                                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                        <p>Giới tính:</p>
                                                                        <input type="radio" name="rdgioitinhGV" id="rdgioitinhnu" value="Nam" style="font-size: 18px;"> Nam
                                                                        <input type="radio" name="rdgioitinhGV" id="rdgioitinhnam" value="Nữ" style="font-size: 18px;"> Nữ
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                        <p>Số điện thoại:</p>
                                                                        <input type="text" class="form-control" name="txtSDTGV" style="font-size: 18px;">
                                                                    </div>
                                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                        <p>Email:</p>
                                                                        <input type="email" class="form-control" name="txtEmailGV" placeholder="name@example.com" style="font-size: 18px;">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                        <p>Mật khẩu:</p>
                                                                        <input type="text" class="form-control" name="txtMKGV" style="font-size: 18px;">
                                                                    </div>
                                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                        <p>Quyền:</p>
                                                                        <select class="form-control drop cboQuyen" name="cboQuyenGV" id="cboQuyen">
                                                                            <option value="" selected="selected">--Chọn quyền--</option>
                                                                            <option value="1">Quyền quản lí thông tin</option>
                                                                            <option value="2">Quyền quản lí hoạt động</option>
                                                                            <option value="0">Người dùng</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary" name="btnLuuGV">Lưu</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                                            </div>
                                                        </div>
                                                        <!-- Tab Nhập exel -->
                                                        <div id="exel2" class="container tab-pane fade"><br>
                                                            <h3>Nhập file exel</h3>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <p>Vui lòng chọn tệp excel:</p>
                                                                <input type="file" name="txtThemGV">
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary" name="btnThemGV">Thêm</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal -->

                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CapNhatGV">
                                            Cập nhật tài khoản đăng nhập
                                        </button>

                                        <!-- The Modal cập nhật giảng viên -->
                                        <div class="modal fade" id="CapNhatGV">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Cập nhật tài khoản đăng nhập giảng viên</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <p>Vui lòng chọn tệp excel:</p>
                                                        <input type="file" name="txtCapNhatGV">
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" name="btnCapNhatGV">Cập nhật</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal -->

                                    </div>
                                    <hr>
                                    <div style="overflow: scroll;height: 600px;" class="table-responsive">
                                        <!-- Bảng giảng viên -->
                                        <table id="tbtaikhoanGV" class="table table-bordered table-hover" style="width:100%">
                                            <thead>
                                                <tr style="text-align: center">
                                                    <th style="text-align: center; vertical-align: inherit;">Mã giảng viên</th>
                                                    <th style="text-align: center; vertical-align: inherit;">Họ tên</th>
                                                    <th style="text-align: center; vertical-align: inherit;">Ngày sinh</th>
                                                    <th style="text-align: center; vertical-align: inherit;">Giới tính</th>
                                                    <th style="text-align: center; vertical-align: inherit;">SĐT</th>
                                                    <th style="text-align: center; vertical-align: inherit;">Email</th>
                                                    <th style="text-align: center; vertical-align: inherit;">Mật khẩu</th>
                                                    <th style="text-align: center; vertical-align: inherit;">Quyền</th>
                                                    <th style="text-align: center; vertical-align: inherit;">Cập nhật</th>
                                                    <th style="text-align: center; vertical-align: inherit;">Xóa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql1 = "select * from giangvien where MaGiangVien like '%105%'";
                                                $kq1 = mysqli_query($kn, $sql1);
                                                $stt = 0;
                                                while ($row = mysqli_fetch_array($kq1)) {
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center; vertical-align: inherit;">
                                                            <p style="margin: 7px auto;"><?php echo $row['MaGiangVien']; ?></p>
                                                        </td>
                                                        <td style="vertical-align: inherit;">
                                                            <p style="margin: 7px auto;  width: 200px;"><?php echo $row['HoTen']; ?></p>
                                                        </td>
                                                        <td style="text-align: center; vertical-align: inherit;">
                                                            <p style="margin: 7px auto; width: 100px;"><?php echo $row['NgaySinh']; ?></p>
                                                        </td>
                                                        <td style="text-align: center; vertical-align: inherit;">
                                                            <p style="margin: 7px auto;"><?php echo $row['GioiTinh']; ?></p>
                                                        </td>
                                                        <td style="text-align: center; vertical-align: inherit;">
                                                            <p style="margin: 7px auto;"><?php echo $row['SDT']; ?></p>
                                                        </td>
                                                        <td style="text-align: center; vertical-align: inherit;">
                                                            <p style="margin: 7px auto;"><?php echo $row['Email']; ?></p>
                                                        </td>
                                                        <td style="text-align: center; vertical-align: inherit;">
                                                            <p style="margin: 7px auto; width: 80px;"><?php echo $row['MatKhau']; ?></p>
                                                        </td>
                                                        <td style="text-align: center; vertical-align: inherit;">
                                                            <p style="margin: 7px auto;"><?php echo $row['Quyen']; ?></p>
                                                        </td>
                                                        <td style="text-align: center; vertical-align: inherit;">
                                                            <button type="button" class="btn btn-link CapNhatThongTinGV" data-bs-toggle="modal" data-bs-target="#CapNhatThongTinGV">
                                                                <img src="image/system-update.png" style="width:35px" />
                                                            </button>
                                                        </td>
                                                        <td style="text-align: center; vertical-align: inherit;">
                                                            <button type="button" class="btn btn-link XoaGV" data-toggle="modal" data-target="#XoaGV">
                                                                <img src="image/delete.png" style="width:35px" />
                                                            </button>
                                                        </td>
                                                    <?php } ?>
                                            </tbody>
                                        </table>

                                        <!-- The Modal cập nhật giảng viên -->
                                        <div class="modal fade" id="CapNhatThongTinGV">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Cập nhật thông tin giảng viên</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <p>Mã giảng viên:</p>
                                                                <input type="text" class="form-control" name="txtmagv2" id="magv2" placeholder="Mã sinh viên" style="pointer-events: none">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <p>Họ tên:</p>
                                                                <input type="text" class="form-control" name="txthoten2" id="hoten2" placeholder="Họ tên sinh viên" style="pointer-events: none">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <p>Mật khẩu:</p>
                                                                <input type="text" class="form-control" name="txtmatkhau2" id="matkhau2" placeholder="Mật khẩu">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <p>Quyền truy cập:</p>
                                                                <select class="form-control" name="txtquyentruycap2" id="txtquyentruycap2">
                                                                    <option value="" selected="selected">--Chọn quyền--</option>
                                                                    <option value="0">Quyền quản lí thông tin</option>
                                                                    <option value="2">Quyền quản lí hoạt động</option>
                                                                    <option value="1">Người dùng</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <h5>Bạn có chắc chắn muốn cập nhật thông tin này?</h5>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" name="btnCapNhatThongTinGV">Cập nhật thông tin</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal -->

                                        <!-- The Modal xóa giảng viên -->
                                        <div class="modal fade" id="XoaGV">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Xóa thông tin giảng viên</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <p>Mã đăng nhập</p>
                                                        <input type="text" class="form-control" name="txtMaGV" id="magv" style="pointer-events: none">
                                                        <p>Tên đăng nhập</p>
                                                        <input type="text" class="form-control" id="hotengv" style="pointer-events: none">
                                                        <br>
                                                        <h5>Bạn có chắc chắn muốn xóa thông tin này?</h5>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" id="btnXoaGV" name="btnXoaGV">Xóa thông tin</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal -->


                                    </div>
                                    <br>
                                </div>
                            </div>
                            <br>
                        </form>
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
​<script>
    $(document).ready(function() {
        $('#tbtaikhoanSV').DataTable();
    });
    $(document).ready(function() {
        $('#tbtaikhoanGV').DataTable();
    });
</script>

<script>
    // Gọi modal xóa sinh viên 
    $(document).ready(function() {
        $('.XoaSV').on('click', function() {
            $('#XoaSV').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#masv').val(data[0].trim());
            $('#hotensv').val(data[1].trim());
        });
    });

    // Gọi modal xóa giảng viên 
    $(document).ready(function() {
        $('.XoaGV').on('click', function() {
            $('#XoaGV').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#magv').val(data[0].trim());
            $('#hotengv').val(data[1].trim());
        });
    });

    // Gọi modal cập nhật quản trị 
    $(document).ready(function() {
        $('.CapNhatThongTinQT').on('click', function() {
            $('#CapNhatThongTinQT').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#maqt1').val(data[0].trim());
            $('#hoten1').val(data[1].trim());
            $('#sdt1').val(data[4].trim());
            $('#email1').val(data[5].trim());
            $('#matkhau1').val(data[6].trim());
        });
    });

    // Gọi modal cập nhật giảng viên 
    $(document).ready(function() {
        $('.CapNhatThongTinGV').on('click', function() {
            $('#CapNhatThongTinGV').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#magv2').val(data[0].trim());
            $('#hoten2').val(data[1].trim());
            $('#matkhau2').val(data[6].trim());
            $('#txtquyentruycap2').val(data[7].trim());
        });
    });

    //Tìm kiếm Sinh viên
    $(document).ready(function() {
        $("#tim1").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tbtaikhoanSV tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    //Tìm kiếm giảng viên
    $(document).ready(function() {
        $("#tim2").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tbtaikhoanGV tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>