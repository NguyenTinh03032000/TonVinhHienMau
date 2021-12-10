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
    <title>Quản lý tài khoản đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- <script src="js/chonkhoa.js"></script>
    <script src="js/chonkhoa1.js"></script>
    <script src="js/chonkhoa2.js"></script>
    <script src="js/chonnamhoc.js"></script> -->
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <!-- <link rel="stylesheet" href="style/style-DangNhap.css"> -->
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

    <div class="container-fluid" style="margin-top:30px; margin-bottom:30px;">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?php
                if ($user) {
                ?>

                    <div class="row">
                        <div class="col-xl-8">
                            <input style="display: inline;float:left; width: 55%; left:100px" class="form-control" id="tim1" type="text" placeholder="Tìm kiếm...">
                        </div>
                        <div class="col-xl-4">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ThemSV">
                                Thêm tài khoản đăng nhập
                            </button>

                            <!-- The Modal thêm sinh viên -->
                            <div class="modal fade" id="ThemSV">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Thêm tài khoản đăng nhập sinh viên</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-6" style="justify-content: center;display: block;">
                                                    <p>Mã đăng nhập:</p>
                                                    <input type="text" class="form-control" name="txtUsername" style="font-size: 18px;">
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
                                                    <p>Địa chỉ:</p>
                                                    <input type="text" class="form-control" name="txtDiaChi" style="font-size: 18px;">
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
                                                    <p>Khóa học:</p>
                                                    <select class="form-control" name="cboMucTonVinh" id="cboMucTonVinh">
                                                        <option value="" selected="selected">-- Chọn mức tôn vinh --</option>
                                                        <?php
                                                        $muctonvinh = 0;
                                                        for ($i = 0; $i <= 20; $i++) {
                                                            $muctonvinh += 5;
                                                            echo '<option value="' . $muctonvinh . '">Mức ' . $muctonvinh . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" name="btnLuuSV">Lưu</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal -->
                        </div>
                    </div>

                    <hr>
                    <div class="table-responsive">
                        <table id="tbtaikhoan" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr style="text-align: center">
                                    <th style="text-align: center; vertical-align: inherit;">Mã đăng nhập</th>
                                    <th style="text-align: center; vertical-align: inherit;">Họ tên</th>
                                    <th style="text-align: center; vertical-align: inherit;">Ngày sinh</th>
                                    <th style="text-align: center; vertical-align: inherit;">Địa chỉ</th>
                                    <th style="text-align: center; vertical-align: inherit;">SĐT</th>
                                    <th style="text-align: center; vertical-align: inherit;">Email</th>
                                    <th style="text-align: center; vertical-align: inherit;" hidden>Mật khẩu</th>
                                    <th style="text-align: center; vertical-align: inherit;">Quyền</th>
                                    <th style="text-align: center; vertical-align: inherit;">Cập nhật</th>
                                    <th style="text-align: center; vertical-align: inherit;">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql1 = "select * from tk_canbo";
                                $kq1 = mysqli_query($kn, $sql1);
                                $stt = 0;
                                while ($row = mysqli_fetch_array($kq1)) {
                                ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: inherit;">
                                            <p style="margin: 7px auto;"><?php echo $row['username']; ?></p>
                                        </td>
                                        <td style="vertical-align: inherit;">
                                            <p style="margin: 7px auto;  width: 150px;"><?php echo $row['hoten']; ?></p>
                                        </td>
                                        <td style="text-align: center; vertical-align: inherit;">
                                            <p style="margin: 7px auto; width: 100px;"><?php echo $row['ngaysinh']; ?></p>
                                        </td>
                                        <td style="text-align: center; vertical-align: inherit;">
                                            <p style="margin: 7px auto;"><?php echo $row['diachi']; ?></p>
                                        </td>
                                        <td style="text-align: center; vertical-align: inherit;">
                                            <p style="margin: 7px auto;"><?php echo $row['sdt']; ?></p>
                                        </td>
                                        <td style="text-align: center; vertical-align: inherit;">
                                            <p style="margin: 7px auto;"><?php echo $row['email']; ?></p>
                                        </td>
                                        <td hidden style="text-align: center; vertical-align: inherit;">
                                            <p style="margin: 7px auto; width: 80px;"><?php echo $row['password']; ?></p>
                                        </td>
                                        <td style="text-align: center; vertical-align: inherit;">
                                            <p style="margin: 7px auto;"><?php echo $row['quyen']; ?></p>
                                        </td>
                                        <td style="text-align: center; vertical-align: inherit;">
                                            <button type="button" class="btn btn-link CapNhatThongTinSV" data-bs-toggle="modal" data-bs-target="#CapNhatThongTinSV">
                                                <img src="image/system-update.png" style="width:35px" />
                                            </button>
                                        </td>
                                        <td style="text-align: center; vertical-align: inherit;">
                                            <button type="button" class="btn btn-link XoaSV" data-toggle="modal" data-target="#XoaSV">
                                                <img src="image/delete.png" style="width:35px" />
                                            </button>
                                        </td>

                                    <?php } ?>
                            </tbody>
                        </table>

                        <!-- The Modal cập nhật sinh viên -->
                        <div class="modal fade" id="CapNhatThongTinSV">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Cập nhật thông tin sinh viên</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p>Mã sinh viên:</p>
                                                <input type="text" class="form-control" name="txtmasv1" id="masv1" placeholder="Mã sinh viên" style="pointer-events: none">
                                            </div>
                                            <div class="col-sm-6">
                                                <p>Họ tên:</p>
                                                <input type="text" class="form-control" name="txthoten1" id="hoten1" placeholder="Họ tên sinh viên" style="pointer-events: none">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p>Chức vụ:</p>
                                                <select class="form-control" id="txtchucvu1" name="txtchucvu1">
                                                    <option value="" selected="selected">--Chọn chức vụ--</option>
                                                    <option value="Không có">Không có chức vụ</option>
                                                    <option value="Lớp trưởng">Lớp trưởng</option>
                                                    <option value="Lớp phó học tập">Lớp phó học tập</option>
                                                    <option value="Lớp phó văn thể mỹ">Lớp phó văn thể mỹ</option>
                                                    <option value="Bí thư">Bí thư</option>
                                                    <option value="Phó bí thư">Phó bí thư</option>
                                                    <option value="Ủy viên chi đoàn">Ủy viên chi đoàn</option>
                                                    <option value="Chi hội trưởng">Chi hội trưởng</option>
                                                    <option value="Phó chi hội">Phó chi hội</option>
                                                    <option value="Ủy viên chi hội">Ủy viên chi hội</option>
                                                    <option value="Ủy viên chi hội">Thư kí</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>Quyền truy cập:</p>
                                                <select class="form-control" name="txtquyentruycap1" id="txtquyentruycap1">
                                                    <option value="" selected="selected">--Chọn quyền truy cập--</option>
                                                    <option value="0">Người dùng hệ thống</option>
                                                    <option value="1">Người quản lý thông tin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p>Mật khẩu:</p>
                                                <input type="text" class="form-control" name="txtmatkhau1" id="matkhau1" placeholder="Mật khẩu">
                                            </div>
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Tình trạng học:</p>
                                                <select class="form-control drop tinhtranghoc1" name="tinhtranghoc1" id="tinhtranghoc1">
                                                    <option value="Còn học" selected="selected">Còn học</option>
                                                    <option value="Cảnh báo">Cảnh báo</option>
                                                    <option value="Buộc thôi học">Buộc thôi học</option>
                                                    <option value="Thôi học">Thôi học</option>
                                                </select>
                                            </div>
                                        </div>

                                        <h5>Bạn có chắc chắn muốn cập nhật thông tin này?</h5>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="btnCapNhatThongTinSV">Cập nhật thông tin</button>
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
</body>

</html>