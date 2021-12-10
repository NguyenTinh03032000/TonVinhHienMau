<?php
require 'site.php';
include "bocuc/Connect.php";
include "bocuc/KiemTraSession.php";
require_once 'vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhập xuất</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <link rel="stylesheet" href="style/reponsive.css">
</head>

<?php
$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if (isset($_FILES['fileBenhVien']['name']) && in_array($_FILES['fileBenhVien']['type'], $file_mimes)) {

    $arr_file = explode('.', $_FILES['fileBenhVien']['name']);
    $extension = end($arr_file);

    if ('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }

    $spreadsheet = $reader->load($_FILES['fileBenhVien']['tmp_name']);

    $sheetData = $spreadsheet->getActiveSheet()->toArray();

    $tenfile = $_FILES['fileBenhVien']['name'];

    echo $tenfile;

    // if (!empty($sheetData)) {
    //     for ($i = 1; $i < count($sheetData); $i++) {
    //         $name = $sheetData[$i][0];
    //         $email = $sheetData[$i][1];
    //         $sql = "INSERT INTO USERS(name, email) VALUES('$name', '$email')";

    //         if (mysqli_query($conn, $sql)) {
    //             echo "New record created successfully";
    //         } else {
    //             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    //         }
    //     }
    // }
}
?>

<body>
    <!-- top đầu trang -->
    <div>

        <?php load_top(); ?>

    </div>

    <!-- menu của trang / menu user 1 -->
    <?php load_menu(); ?>
    <?php
    if ($user) {
    ?>
        <h1 style="text-align: center;">QUẢN LÝ NHẬP XUẤT DỮ LIỆU CƠ SỞ</h1>
        <br>


        <div class="container-fluid bgnx">
            <div class="row bg-item">
                <div class="col-lg-1"></div>
                <div class="col-lg-10" style="margin-top:60px; margin-bottom:30px;">

                    <div class="item">
                        <h1 class="item-h1">Bệnh viện Đa khoa</h1>
                        <h1 class="item-h1">Tỉnh Bình Định</h1>
                        <br>
                        <button type="button" class="btn btn-danger btnimport" data-toggle="modal" data-target="#modalBenhVien">
                            <h4><b>IMPORT</b></h4>
                        </button>

                        <form action="" method="post">
                            <!-- The Modal bệnh viện-->
                            <div class="modal" id="modalBenhVien">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Nhập thông tin bệnh viện</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <input type="file" name="fileBenhVien" class="form-control-file border">
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" style="background:cadetblue" data-dismiss="modal">THOÁT</button>
                                            <button type="submit" class="btn btn-danger" name="btnThemBV">IMPORT</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                    <div style="display: flex; justify-content: center;">
                        <div class="row">
                            <?php
                            $sql1 = "select * from donvi";
                            $kq1 = mysqli_query($kn, $sql1);
                            while ($row = mysqli_fetch_array($kq1)) {
                            ?>

                                <div class="col-lg-3 col-md-6">
                                    <div class="donvi" style="height: 350px">
                                        <img src="image/logoDV.png">
                                        <p style="text-transform: uppercase; font-size: 20px;">
                                            <b><?php echo $row['tendonvi'] ?></b>
                                        </p>
                                        <div class="row" style="margin: 1px;">
                                            <div class="col-lg-6" style="margin-bottom: 25px;">
                                                <button type="button" class="btn btn-danger btn-block">
                                                    <b>IMPORT</b>
                                                </button>
                                            </div>
                                            <div class="col-lg-6" style="margin-bottom: 25px;">
                                                <button type=" button" class="btn btn-success btn-block">
                                                    <b>VIEW</b>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
    <?php
    } else {
        include "loadDangNhap.php";
    }
    ?>
    <!-- chân trang -->
    <div class="jumbotron text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>
</body>

</html>