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
                <a class="nav-link" href="TrangChuUser.php">Trang chủ</a>
            </li>
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Giới thiệu
                </a>
                <div class="dropdown-menu bg-light">
                    <a class="dropdown-item" href="BoMayNhaTruong.php">Bộ máy tổ chức quản lý nhà trường</a>
                    <a class="dropdown-item" href="GioiThieuKCNTT.php">Khoa Công nghệ thông tin</a>
                </div>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="BieuMau.php">Biểu mẫu</a>
            </li>
            <?php 
                if(!(isset($_SESSION['Username']) && $_SESSION['Username'] != '')){
                    echo'
                    <li class="nav-item active">
                        <a class="nav-link" href="DangNhapUser.php">Điểm rèn luyện</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="DangNhapUser.php">Đăng ký hoạt động</a>
                    </li> 
                    <li class="nav-item active">
                        <a class="nav-link" href="DangNhapUser.php">Nhật ký học tập</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="DangNhapUser.php">Hòm thư góp ý</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="DangNhapUser.php">Phòng chat</a>
                    </li>  
                    <li class="nav-item active">
                        <a class="nav-link" target="_blank" href="https://forms.gle/EfJABfGTRz4tUN7h6">Đánh giá</a>
                    </li> 
                    <li class="nav-item active">
                        <a class="nav-link" href="DangNhapUser.php">Đăng nhập</a>
                    </li>  
                    ';
                }
                else
                {
                    $kn = mysqli_connect("localhost", "root", "", "sotay")or die("chưa kết nối");
                    $sql1 = "select * from sinhvien where MaSinhVien='".$_SESSION['Username']."'";
                    $kq1 = mysqli_query($kn,$sql1);
                    $row1 = mysqli_fetch_array($kq1);

                    if($row1['Quyen'] == 1)
                    {
                        echo'
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    Điểm rèn luyện
                                </a>
                                <div class="dropdown-menu bg-light">
                                    <a class="dropdown-item" href="chamdiemRLSV.php">Chấm điểm rèn luyện</a>
                                    <a class="dropdown-item" href="xemdiemRLSV.php">Xem điểm rèn luyện</a>
                                    <a class="dropdown-item" href="quanlydiemrenluyenlop.php">Quản lý điểm rèn luyện lớp</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    Hoạt động
                                </a>
                                <div class="dropdown-menu bg-light">
                                    <a class="dropdown-item" href="DKHoatDong.php">Đăng ký hoạt động</a>
                                    <a class="dropdown-item" href="DSDKHoatDong.php">Danh sách hoạt động</a>
                                    <a class="dropdown-item" href="QuanLyHoatDongLop.php">Quản lý hoạt động lớp</a>
                                </div>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="NhatKyHocTap.php">Nhật ký học tập</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="HomThuGopY.php">Hòm thư góp ý</a>
                            </li>   
                            <li class="nav-item active">
                                <a class="nav-link" href="PhongChatUser.php">Phòng chat</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" target="_blank" href="https://forms.gle/EfJABfGTRz4tUN7h6">Đánh giá</a>
                            </li> 
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    '.$row1['HoTen'] .' [ '.$_SESSION['Username'].' ]
                                </a>
                                <div class="dropdown-menu bg-light">
                                    <a class="dropdown-item" href="ThongTinTaiKhoanUser.php">Thông tin sinh viên</a>
                                    <a class="dropdown-item" href="DoiMatKhauUser.php">Đổi mật khẩu</a>
                                    <a class="dropdown-item" href="DangXuatUser.php">Đăng xuất</a>
                                </div>
                            </li>
                        ';
                    }
                    else
                    {
                        echo'
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    Điểm rèn luyện
                                </a>
                                <div class="dropdown-menu bg-light">
                                    <a class="dropdown-item" href="chamdiemRLSV.php">Chấm điểm rèn luyện</a>
                                    <a class="dropdown-item" href="xemdiemRLSV.php">Xem điểm rèn luyện</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    Hoạt động
                                </a>
                                <div class="dropdown-menu bg-light">
                                    <a class="dropdown-item" href="DKHoatDong.php">Đăng ký hoạt động</a>
                                    <a class="dropdown-item" href="DSDKHoatDong.php">Danh sách hoạt động</a>
                                </div>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="NhatKyHocTap.php">Nhật ký học tập</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="HomThuGopY.php">Hòm thư góp ý</a>
                            </li>   
                            <li class="nav-item active">
                                <a class="nav-link" href="PhongChatUser.php">Phòng chat</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" target="_blank" href="https://forms.gle/EfJABfGTRz4tUN7h6">Đánh giá</a>
                            </li> 
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    '.$row1['HoTen'] .' [ '.$_SESSION['Username'].' ]
                                </a>
                                <div class="dropdown-menu bg-light">
                                    <a class="dropdown-item" href="ThongTinTaiKhoanUser.php">Thông tin sinh viên</a>
                                    <a class="dropdown-item" href="DoiMatKhauUser.php">Đổi mật khẩu</a>
                                    <a class="dropdown-item" href="DangXuatUser.php">Đăng xuất</a>
                                </div>
                            </li>
                        ';
                    }
                }
            ?>
            
        </ul>
    </div>  
</nav>
