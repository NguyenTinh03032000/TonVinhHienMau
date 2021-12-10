<?php
ob_start();
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
                $kn = mysqli_connect("localhost", "root", "", "sotay") or die("chưa kết nối");
                $sql1 = "select * from quantri where MaGiangVien='" . $_SESSION['Username'] . "'";
                $kq1 = mysqli_query($kn, $sql1);
                $row1 = mysqli_fetch_array($kq1);

                echo '
                    <li class="nav-item active">
                        <a class="nav-link" href="HoatdongAD.php">Quản lý khoa</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="QLDTBSinhVien.php">Quản lý ngành học</a>
                    </li> 
                    <li class="nav-item active">
                        <a class="nav-link" href="QLHomThuGopY.php">Quản lý khóa học</a>
                    </li> 
                    <li class="nav-item active">
                        <a class="nav-link" href="quanlydangnhap.php">Quản lý lớp học</a>
                    </li>   
                    <li class="nav-item active">
                        <a class="nav-link" target="_blank" href="https://forms.gle/EfJABfGTRz4tUN7h6">Đánh giá</a>
                    </li> 
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            ' . $row1['HoTen'] . ' [ ' . $_SESSION['Username'] . ' ]
                        </a>
                        <div class="dropdown-menu bg-light">
                            <a class="dropdown-item" href="ThongTinTaiKhoanAdmin.php">Thông tin tài khoản</a>
                            <a class="dropdown-item" href="DoiMatKhauAdmin.php">Đổi mật khẩu</a>
                            <a class="dropdown-item" href="DangXuatAdmin.php">Đăng xuất</a>
                        </div>
                    </li>
                ';
            }
            ?>

        </ul>
    </div>
</nav>