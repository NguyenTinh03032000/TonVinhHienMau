<div class="container-fluid nen" style="margin-top:30px; margin-bottom:30px;">
    <div class="row">
        <div class="col-xl-3"></div>
        <div class="col-xl-4" style=" margin-bottom:30px;margin-top: 150px;">
            <h2 style="text-align: center; color:red ">ĐĂNG NHẬP</h2>
            <br>
            <form action="" method="POST" class="needs-validation" novalidate>
                <div class="form-group">
                    <input type="text" class="form-control border-danger" name="txtusername" style=" margin: auto; font-size: 25px; border-radius: 20px;" placeholder="Nhập tên đăng nhập" required>
                    <div class="valid-feedback">Hợp lệ.</div>
                    <div class="invalid-feedback">Vui lòng không được bỏ trống thông tin!</div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control border-danger" name="txtpassword" style="margin: auto; font-size: 25px; border-radius: 20px;" placeholder="Nhập mật khẩu" placeholder="Nhập mật khẩu" required></input>
                    <div class="valid-feedback">Hợp lệ.</div>
                    <div class="invalid-feedback">Vui lòng không được bỏ trống thông tin!</div>
                </div>
                <br>
                <br>
                <div class="form-group">
                    <button class="btn btn-danger btn-block" type="submit" name="btnDangNhap" style="margin: auto; display: block; font-size: 25px;  border-radius: 7px; ">ĐĂNG NHẬP</button>
                </div>
            </form>
            <br>
        </div>
        <div class="col-sm-5"></div>
    </div>
</div>

<script>
    // Disable form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<?php
if (isset($_POST["btnDangNhap"])) {
    $_POST["txtusername"];
    $pass = array_key_exists('txtpassword', $_POST) ? $_POST["txtpassword"] : null;

    $sql1 = "select * from tk_canbo where username='" . $_SESSION['Username'] . "'";
    $kq1 = mysqli_query($kn, $sql1);

    if (!($row1 = mysqli_fetch_array($kq1))) {
        echo '<script>alert("Tên đăng nhập không tồn tại");</script>';
    } else {
        if ($pass != $row1['password']) {
            echo '<script>alert("Sai mật khẩu");</script>';
        } else {
            $_SESSION['Username'] = $_POST["txtusername"];
            echo '<meta http-equiv="refresh" content="0">';
        }
    }
}
?>