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
                                                    <select class="form-control" name="cboQuyen" id="cboQuyen">
                                                        <option value="" selected="selected">-- Chọn mức tôn vinh --</option>
                                                        <option value="0">Quyền quản lý thông tin</option>
                                                        <option value="1">Quyền người dùng</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>
                                            <button type="submit" class="btn btn-danger btnThem1" name="btnThem">Lưu</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal -->
                        </div>
                    </div>

                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" style="width:100%">
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
                            <tbody id="myTable">
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
                                            <button type="button" class="btn btn-link ChiTiet" data-toggle="modal" data-target="#ChiTietThongTin">
                                                <img src="image/eye.png" style="width:35px" />
                                            </button>
                                        </td>
                                        <td style="text-align: center; vertical-align: inherit;">
                                            <button type="button" class="btn btn-link CapNhat" data-toggle="modal" data-target="#CapNhatThongTin">
                                                <img src="image/updated.png" style="width:35px" />
                                            </button>
                                        </td>
                                        <td style="text-align: center; vertical-align: inherit;">
                                            <button type="button" class="btn btn-link Xoa" data-toggle="modal" data-target="#XoaThongTin">
                                                <img src="image/delete.png" style="width:35px" />
                                            </button>
                                        </td>

                                    <?php } ?>
                            </tbody>
                        </table>

                        <!-- The Modal chi tiết -->
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
                                                <input type="text" class="form-control" name="txtUsername_chitiet" id="txtUsername_chitiet" style="pointer-events: none">
                                            </div>
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Họ và tên:</p>
                                                <input type="text" class="form-control" name="txtTen_chitiet" id="txtTen_chitiet" style="pointer-events: none">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Ngày sinh:</p>
                                                <input type="date" class="form-control" name="dateNgaysinh_chitiet" id="dateNgaysinh_chitiet">
                                            </div>
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Địa chỉ:</p>
                                                <input type="text" class="form-control" name="txtDiaChi_chitiet" id="txtDiaChi_chitiet" style="pointer-events: none">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Số điện thoại:</p>
                                                <input type="text" class="form-control" name="txtSDT_chitiet" id="txtSDT_chitiet" style="pointer-events: none">
                                            </div>
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Email:</p>
                                                <input type="email" class="form-control" name="txtEmail_chitiet" id="txtEmail_chitiet" placeholder="name@example.com" style="pointer-events: none">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12" style="justify-content: center;display: block;">
                                                <p>Quyền đăng nhập:</p>
                                                <select class="form-control" name="cboQuyen_chitiet" id="cboQuyen_chitiet">
                                                    <option value="" selected="selected">-- Chọn mức tôn vinh --</option>
                                                    <option value="0">Quyền quản lý thông tin</option>
                                                    <option value="1">Quyền người dùng</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>
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
                                                <input type="text" class="form-control" name="txtUsername_update" id="txtUsername_update" style="pointer-events: none">
                                            </div>
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Họ và tên:</p>
                                                <input type="text" class="form-control" name="txtTen_update" id="txtTen_update">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Ngày sinh:</p>
                                                <input type="date" class="form-control" name="dateNgaysinh_update" id="dateNgaysinh_update">
                                            </div>
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Địa chỉ:</p>
                                                <input type="text" class="form-control" name="txtDiaChi_update" id="txtDiaChi_update">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Số điện thoại:</p>
                                                <input type="text" class="form-control" name="txtSDT_update" id="txtSDT_update">
                                            </div>
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Email:</p>
                                                <input type="email" class="form-control" name="txtEmail_update" id="txtEmail_update" placeholder="name@example.com">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Mật khẩu:</p>
                                                <input type="password" class="form-control" name="txtPass_update" id="txtPass_update" placeholder="name@example.com">
                                            </div>
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <p>Quyền đăng nhập:</p>
                                                <select class="form-control" name="cboQuyen_update" id="cboQuyen_update">
                                                    <option value="" selected="selected">-- Chọn mức tôn vinh --</option>
                                                    <option value="0">Quyền quản lý thông tin</option>
                                                    <option value="1">Quyền người dùng</option>
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
                                        <input type="text" class="form-control" name="txtusername_delete" id="txtusername_delete" style="pointer-events: none">
                                        <h5>Bạn có chắc chắn muốn xóa thông tin này?</h5>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>
                                        <button type="submit" class="btn btn-danger btnDelete" name="btnXoa">Xóa thông tin</button>
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

    // Gọi modal chi tiết
    $(document).ready(function() {
        $('.ChiTiet').on('click', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#txtUsername_chitiet').val(data[1].trim());
            $('#txtTen_chitiet').val(data[2].trim());
            $('#dateNgaysinh_chitiet').val(data[3].trim());
            $('#txtSDT_chitiet').val(data[4].trim());
            $('#txtEmail_chitiet').val(data[5].trim());
            $('#txtDiaChi_chitiet').val(data[6].trim());
            $('#cboQuyen_chitiet').val(data[8].trim());
        });
    });

    // Gọi modal cập nhật
    $(document).ready(function() {
        $('.CapNhat').on('click', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#txtUsername_update').val(data[1].trim());
            $('#txtTen_update').val(data[2].trim());
            $('#dateNgaysinh_update').val(data[3].trim());
            $('#txtSDT_update').val(data[4].trim());
            $('#txtEmail_update').val(data[5].trim());
            $('#txtDiaChi_update').val(data[6].trim());
            $('#txtPass_update').val(data[6].trim());
            $('#cboQuyen_update').val(data[8].trim());

        });
    });

    //Gọi modal xóa
    $(document).ready(function() {
        $('.Xoa').on('click', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);
            $('#txtusername_delete').val(data[1].trim());
        });
    });
</script>

<?php

function themTaiKhoan()
{
}

function capNhatTaiKhoan()
{
}

function xoaTaiKhoan()
{
}

if ($_POST) {
    if (isset($_POST['btnThem']) and $_SERVER['REQUEST_METHOD'] == "POST") {
        themTaiKhoan();
    }
    if (isset($_POST['btnCapNhat']) and $_SERVER['REQUEST_METHOD'] == "POST") {
        capNhatTaiKhoan();
    }
    if (isset($_POST['btnXoa']) and $_SERVER['REQUEST_METHOD'] == "POST") {
        xoaTaiKhoan();
    }
}

?>