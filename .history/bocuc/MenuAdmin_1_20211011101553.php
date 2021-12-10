<?php
ob_start();
include "bocuc/Connect.php";
?>
<nav class="navbar navbar-expand-xl bg-primary navbar-dark sticky-top">
    <button class="navbar-toggler justify-content-end" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar" style="justify-content: center;">
        <ul class="navbar-nav justify-content-center">
            <li class="nav-item active">
                <a class="nav-link" href="TrangChuAdmin.php">Trang chủ</a>
            </li>
            <?php
            if (!(isset($_SESSION['Username']) && $_SESSION['Username'] != '')) {
                echo '
                    <li class="nav-item active">
                        <a class="nav-link" href="DangNhapAdmin.php">Quản lý điểm rèn luyện</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="DangNhapAdmin.php">Quản lý hoạt động sinh viên</a>
                    </li> 
                    <li class="nav-item active">
                        <a class="nav-link" href="DangNhapAdmin.php">Quản lý ĐTB sinh viên</a>
                    </li> 
                    <li class="nav-item active">
                        <a class="nav-link" href="DangNhapAdmin.php">Quản lý hòm thư góp ý</a>
                    </li>   
                    <li class="nav-item active">
                        <a class="nav-link" target="_blank" href="https://forms.gle/EfJABfGTRz4tUN7h6">Đánh giá</a>
                    </li> 
                    <li class="nav-item active">
                        <a class="nav-link" href="DangNhapAdmin.php">Đăng nhập</a>
                    </li>  
                    ';
            } else {
                $sql1 = "select * from giangvien where MaGiangVien='" . $_SESSION['Username'] . "'";
                $kq1 = mysqli_query($kn, $sql1);
                $row1 = mysqli_fetch_array($kq1);

                if ($row1['Quyen'] == 1) {
                    echo '
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="" id="navbardrop" data-toggle="dropdown">
                                    Quản lý điểm rèn luyện
                                </a>
                                <div class="dropdown-menu bg-light">
                                    <a class="dropdown-item" href="dangkychamdiemRLSV.php">Đăng ký chấm điểm rèn luyện</a>
                                    <a class="dropdown-item" href="QuanLyDiemRenLuyenAdmin.php">Điểm rèn luyện</a>
                                </div>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="HoatdongAD.php">Quản lý hoạt động</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="QLDTBSinhVien.php">Quản lý ĐTB sinh viên</a>
                            </li> 
                            <li class="nav-item active">
                                <a class="nav-link" href="QLHomThuGopY.php">Quản lý hòm thư góp ý</a>
                            </li> 
                            <li class="nav-item active">
                                <a class="nav-link" href="quanlydangnhap.php">Quản lý đăng nhập</a>
                            </li>   
                            <li class="nav-item active">
                                <a class="nav-link" target="_blank" href="https://forms.gle/EfJABfGTRz4tUN7h6">Đánh giá</a>
                            </li> 
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    ' . $row1['HoTen'] . ' [ ' . $_SESSION['Username'] . ' ]
                                </a>
                                <div class="dropdown-menu bg-light">
                                    <a class="dropdown-item" href="ThongTinTaiKhoanAdmin.php">Thông tin giảng viên</a>
                                    <a class="dropdown-item" href="DoiMatKhauAdmin.php">Đổi mật khẩu</a>
                                    <a class="dropdown-item" href="DangXuatAdmin.php">Đăng xuất</a>
                                </div>
                            </li>
                        ';
                } else if ($row1['Quyen'] == 0) {
                    echo '
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    Quản lý điểm rèn luyện
                                </a>
                                <div class="dropdown-menu bg-light">
                                    <a class="dropdown-item" href="QuanLyDiemRenLuyenAdmin.php">Điểm rèn luyện</a>
                                </div>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="HoatdongAD.php">Quản lý hoạt động</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="QLDTBSinhVien.php">Quản lý ĐTB sinh viên</a>
                            </li>   
                            <li class="nav-item active">
                                <a class="nav-link" target="_blank" href="https://forms.gle/EfJABfGTRz4tUN7h6">Đánh giá</a>
                            </li> 
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    ' . $row1['HoTen'] . ' [ ' . $_SESSION['Username'] . ' ]
                                </a>
                                <div class="dropdown-menu bg-light">
                                    <a class="dropdown-item" href="ThongTinTaiKhoanAdmin.php">Thông tin giảng viên</a>
                                    <a class="dropdown-item" href="DoiMatKhauAdmin.php">Đổi mật khẩu</a>
                                    <a class="dropdown-item" href="DangXuatAdmin.php">Đăng xuất</a>
                                </div>
                            </li>
                        ';
                } else {
                    echo '
                            <li class="nav-item active">
                                <a class="nav-link" href="HoatdongAD.php">Quản lý hoạt động</a>
                            </li>  
                            <li class="nav-item active">
                                <a class="nav-link" target="_blank" href="https://forms.gle/EfJABfGTRz4tUN7h6">Đánh giá</a>
                            </li> 
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    ' . $row1['HoTen'] . ' [ ' . $_SESSION['Username'] . ' ]
                                </a>
                                <div class="dropdown-menu bg-light">
                                    <a class="dropdown-item" href="ThongTinTaiKhoanAdmin.php">Thông tin giảng viên</a>
                                    <a class="dropdown-item" href="DoiMatKhauAdmin.php">Đổi mật khẩu</a>
                                    <a class="dropdown-item" href="DangXuatAdmin.php">Đăng xuất</a>
                                </div>
                            </li>
                        ';
                }
            }
            ?>

        </ul>
    </div>
</nav>