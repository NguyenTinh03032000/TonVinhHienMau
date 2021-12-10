<?php
ob_start();
include "bocuc/Connect.php";
?>
<nav class="navbar navbar-expand-xl bg-white navbar-light sticky-top">
    <button class="navbar-toggler justify-content-end" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar" style="justify-content: center;">
        <ul class="navbar-nav justify-content-center">
            <?php
            if (!(isset($_SESSION['Username']) && $_SESSION['Username'] != '')) {
                echo '
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">TÔN VINH</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">NGUỒN MÁU</a>
                    </li> 
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">NHẬP XUẤT</a>
                    </li> 
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">TÌM KIẾM</a>
                    </li>
                     
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">TÀI KHOẢN</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">ĐĂNG NHẬP</a>
                    </li>  
                    ';
            } else {
                $sql1 = "select * from tk_canbo where username = '" . $_SESSION['Username'] . "'";
                $kq1 = mysqli_query($kn, $sql1);
                $row1 = mysqli_fetch_array($kq1);

                if ($row1['quyen'] == 0) {
                    echo '
                    <li class="nav-item active">
                    <a class="nav-link" href="TonVinh.php">TÔN VINH</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="NguonMau.php">NGUỒN MÁU</a>
                    </li> 
                    <li class="nav-item active">
                        <a class="nav-link" href="QuanLyNhapXuat.php">NHẬP XUẤT</a>
                    </li> 
                    <li class="nav-item active">
                        <a class="nav-link" href="TimKiemThongTin.php">TÌM KIẾM</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="LichSuTonVinh.php">LỊCH SỬ TÔN VINH</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="QuanLyTaiKhoan.php">TÀI KHOẢN</a>
                    </li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            ' . $row1['hoten'] . ' [ ' . $_SESSION['Username'] . ' ]
                        </a>
                        <div class="dropdown-menu bg-light">
                            <a class="dropdown-item" href="ThongTinTaiKhoan.php">Thông tin cán bộ</a>
                            <a class="dropdown-item" href="DoiMatKhau.php">Đổi mật khẩu</a>
                            <a class="dropdown-item" href="DangXuat.php">Đăng xuất</a>
                        </div>
                    </li>';
                } else {
                    echo '
                    <li class="nav-item active">
                    <a class="nav-link" href="TonVinh.php">TÔN VINH</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="NguonMau.php">NGUỒN MÁU</a>
                    </li> 
                    <li class="nav-item active">
                        <a class="nav-link" href="QuanLyNhapXuat.php">NHẬP XUẤT</a>
                    </li> 
                    <li class="nav-item active">
                        <a class="nav-link" href="TimKiemThongTin.php">TÌM KIẾM</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="LichSuTonVinh.php">LỊCH SỬ TÔN VINH</a>
                    </li>
                    <li class="nav-item dropdown active">
                        <div style="display: flex;">
                            <img src="image/anh-nam.jpg" alt="" class="rounded-circle border border-primary" style="width:5%">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                ' . $row1['hoten'] . ' [ ' . $_SESSION['Username'] . ' ]
                            </a>
                            <div class="dropdown-menu bg-light">
                                <a class="dropdown-item" href="ThongTinTaiKhoan.php">Thông tin cán bộ</a>
                                <a class="dropdown-item" href="DoiMatKhau.php">Đổi mật khẩu</a>
                                <a class="dropdown-item" href="DangXuat.php">Đăng xuất</a>
                            </div>
                        </div>
                    </li>';
                }
            }
            ?>

        </ul>
    </div>
</nav>