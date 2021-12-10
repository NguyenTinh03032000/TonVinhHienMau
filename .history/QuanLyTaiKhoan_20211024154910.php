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
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <link rel="stylesheet" href="style/style-quanlytaikhoan.css">
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
                        <div class="col-xl-9">
                            <input class="form-control" id="myInput" type="text" placeholder="Tìm kiếm...">
                        </div>
                        <div class="col-xl-3">
                            <button type="button" class="btn btn-danger btn-block form-control btnThem" data-toggle="modal" data-target="#ThemSV">
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
                                                    <input type="text" class="form-control" name="txtUsername">
                                                </div>
                                                <div class="col-sm-6" style="justify-content: center;display: block;">
                                                    <p>Họ và tên:</p>
                                                    <input type="text" class="form-control" name="txtTen">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6" style="justify-content: center;display: block;">
                                                    <p>Ngày sinh:</p>
                                                    <input type="date" class="form-control" name="dateNgaysinh">
                                                </div>
                                                <div class="col-sm-6" style="justify-content: center;display: block;">
                                                    <p>Địa chỉ:</p>
                                                    <input type="text" class="form-control" name="txtDiaChi">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6" style="justify-content: center;display: block;">
                                                    <p>Số điện thoại:</p>
                                                    <input type="text" class="form-control" name="txtSDT">
                                                </div>
                                                <div class="col-sm-6" style="justify-content: center;display: block;">
                                                    <p>Email:</p>
                                                    <input type="email" class="form-control" name="txtEmail" placeholder="name@example.com">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12" style="justify-content: center;display: block;">
                                                    <p>Quyền đăng nhập:</p>
                                                    <select class="form-control" name="cboMucTonVinh" id="cboMucTonVinh">
                                                        <option value="" selected="selected">-- Chọn mức tôn vinh --</option>
                                                        <option value="0" selected="selected">Quyền quản lý thông tin</option>
                                                        <option value="1" selected="selected">Quyền người dùng</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>
                                            <button type="submit" class="btn btn-danger btnThem1" name="btnLuuSV">Lưu</button>
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
                                    <th style="text-align: center; vertical-align: inherit;">STT</th>
                                    <th style="text-align: center; vertical-align: inherit;" hidden>Mã đăng nhập</th>
                                    <th style="text-align: center; vertical-align: inherit;">Họ tên</th>
                                    <th style="text-align: center; vertical-align: inherit;">Ngày sinh</th>
                                    <th style="text-align: center; vertical-align: inherit;">Số điện thoại</th>
                                    <th style="text-align: center; vertical-align: inherit;">Email</th>
                                    <th style="text-align: center; vertical-align: inherit;" hidden>Địa chỉ</th>
                                    <th style="text-align: center; vertical-align: inherit;" hidden>Mật khẩu</th>
                                    <th style="text-align: center; vertical-align: inherit;" hidden>Quyền</th>
                                    <th style="text-align: center; vertical-align: inherit;">Chi tiết</th>
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
                                        <td style="text-align: center;vertical-align: inherit;">
                                            <p style="margin: 7px auto;"><?php echo $stt += 1; ?></p>
                                        </td>
                                        <td hidden style="text-align: center; vertical-align: inherit;">
                                            <p style="margin: 7px auto;"><?php echo $row['username']; ?></p>
                                        </td>
                                        <td style="vertical-align: inherit;">
                                            <p style="margin: 7px auto;"><?php echo $row['hoten']; ?></p>
                                        </td>
                                        <td style="text-align: center; vertical-align: inherit;">
                                            <p style="margin: 7px auto;"><?php echo $row['ngaysinh']; ?></p>
                                        </td>
                                        <td style="text-align: center; vertical-align: inherit;">
                                            <p style="margin: 7px auto;"><?php echo $row['sdt']; ?></p>
                                        </td>
                                        <td style="text-align: center; vertical-align: inherit;">
                                            <p style="margin: 7px auto;"><?php echo $row['email']; ?></p>
                                        </td>
                                        <td hidden style="text-align: center; vertical-align: inherit;">
                                            <p style="margin: 7px auto;"><?php echo $row['diachi']; ?></p>
                                        </td>
                                        <td hidden style="text-align: center; vertical-align: inherit;">
                                            <p style="margin: 7px auto;"><?php echo $row['password']; ?></p>
                                        </td>
                                        <td hidden style="text-align: center; vertical-align: inherit;">
                                            <p style="margin: 7px auto;"><?php echo $row['quyen']; ?></p>
                                        </td>
                                        <td style="text-align: center; vertical-align: inherit;">
                                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#ChiTietThongTin">
                                                <img src="image/system-update.png" style="width:35px" />
                                            </button>
                                        </td>
                                        <td style="text-align: center; vertical-align: inherit;">
                                            <button type="button" class="btn btn-link CapNhatThongTinSV" data-toggle="modal" data-target="#CapNhatThongTin">
                                                <img src="image/updated.png" style="width:35px" />
                                            </button>
                                        </td>
                                        <td style="text-align: center; vertical-align: inherit;">
                                            <button type="button" class="btn btn-link XoaSV" data-toggle="modal" data-target="#XoaThongTin">
                                                <img src="image/delete.png" style="width:35px" />
                                            </button>
                                        </td>

                                    <?php } ?>
                            </tbody>
                        </table>

                        <!-- The Modal thêm sinh viên -->
                        <div class="modal fade" id="ChiTietThongTin">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Chi tiết tài khoản đăng nhập</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Mã đăng nhập:</p>
                                                <input type="text" class="form-control" name="txtUsername" style="pointer-events: none">
                                            </div>
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Họ và tên:</p>
                                                <input type="text" class="form-control" name="txtTen" style="pointer-events: none">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Ngày sinh:</p>
                                                <input type="date" class="form-control" name="dateNgaysinh">
                                            </div>
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Địa chỉ:</p>
                                                <input type="text" class="form-control" name="txtDiaChi" style="pointer-events: none">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Số điện thoại:</p>
                                                <input type="text" class="form-control" name="txtSDT" style="pointer-events: none">
                                            </div>
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Email:</p>
                                                <input type="email" class="form-control" name="txtEmail" placeholder="name@example.com" style="pointer-events: none">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12" style="justify-content: center;display: block;">
                                                <p>Quyền đăng nhập:</p>
                                                <select class="form-control" name="cboMucTonVinh" id="cboMucTonVinh">
                                                    <option value="" selected="selected">-- Chọn mức tôn vinh --</option>
                                                    <option value="0" selected="selected">Quyền quản lý thông tin</option>
                                                    <option value="1" selected="selected">Quyền người dùng</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>
                                        <button type="submit" class="btn btn-danger btnThem2" name="btnLuuSV">Lưu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal -->

                        <!-- The Modal cập nhật sinh viên -->
                        <div class="modal fade" id="CapNhatThongTin">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Cập nhật thông tin</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Mã đăng nhập:</p>
                                                <input type="text" class="form-control" name="txtUsername_update">
                                            </div>
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Họ và tên:</p>
                                                <input type="text" class="form-control" name="txtTen_update">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Ngày sinh:</p>
                                                <input type="date" class="form-control" name="dateNgaysinh_update">
                                            </div>
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Địa chỉ:</p>
                                                <input type="text" class="form-control" name="txtDiaChi_update">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Số điện thoại:</p>
                                                <input type="text" class="form-control" name="txtSDT_update">
                                            </div>
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Email:</p>
                                                <input type="email" class="form-control" name="txtEmail_update" placeholder="name@example.com">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12" style="justify-content: center;display: block;">
                                                <p>Mật khẩu:</p>
                                                <input type="password" class="form-control" name="txtPass_update" placeholder="name@example.com">
                                            </div>
                                            <div class="col-sm-12" style="justify-content: center;display: block;">
                                                <p>Quyền đăng nhập:</p>
                                                <select class="form-control" name="cboMucTonVinh_update" id="cboMucTonVinh">
                                                    <option value="" selected="selected">-- Chọn mức tôn vinh --</option>
                                                    <option value="0" selected="selected">Quyền quản lý thông tin</option>
                                                    <option value="1" selected="selected">Quyền người dùng</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <h5>Bạn có chắc chắn muốn cập nhật thông tin này?</h5>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>
                                        <button type="submit" class="btn btn-danger btnUpdate" name="btnCapNhat">Cập nhật</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end modal -->

                        <!-- The Modal xóa -->
                        <div class="modal fade" id="XoaThongTin">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Xóa thông tin</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <input type="text" class="form-control" name="txtusername_delete" style="pointer-events: none">
                                        <h5>Bạn có chắc chắn muốn xóa thông tin này?</h5>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>
                                        <button type="submit" class="btn btn-danger btnDelete" name="btnXoaSV">Xóa thông tin</button>
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

<!-- Tìm kiếm thông tin khi nhập vào ô tìm kiếm -->
<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>