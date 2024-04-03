<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsstuid'] == 0)) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Hệ thống Quản lý Sinh viên || Xem Hồ sơ Sinh viên</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include_once('includes/header.php');?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include_once('includes/sidebar.php');?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> Xem Hồ sơ Sinh viên </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Xem Hồ sơ Sinh viên</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <table border="1" class="table table-bordered mg-b-0">
                                    <?php
                                    $sid = $_SESSION['sturecmsstuid'];
                                    $sql = "SELECT tblstudent.StudentName,tblstudent.StudentEmail,tblstudent.StudentClass,tblstudent.Gender,tblstudent.DOB,tblstudent.StuID,tblstudent.FatherName,tblstudent.MotherName,tblstudent.ContactNumber,tblstudent.AltenateNumber,tblstudent.Address,tblstudent.UserName,tblstudent.Password,tblstudent.Image,tblstudent.DateofAdmission,tblclass.ClassName,tblclass.Section from tblstudent join tblclass on tblclass.ID=tblstudent.StudentClass where tblstudent.StuID=:sid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) {
                                            ?>
                                            <tr align="center" class="table-warning">
                                                <td colspan="4" style="font-size:20px;color:blue">
                                                    Chi tiết Sinh viên</td></tr>

                                            <tr class="table-info">
                                                <th>Tên Sinh viên</th>
                                                <td><?php echo $row->StudentName; ?></td>
                                                <th>Email Sinh viên</th>
                                                <td><?php echo $row->StudentEmail; ?></td>
                                            </tr>
                                            <tr class="table-warning">
                                                <th>Lớp học</th>
                                                <td><?php echo $row->ClassName; ?> <?php echo $row->Section; ?></td>
                                                <th>Giới tính</th>
                                                <td><?php echo $row->Gender; ?></td>
                                            </tr>
                                            <tr class="table-danger">
                                                <th>Ngày sinh</th>
                                                <td><?php echo $row->DOB; ?></td>
                                                <th>Mã số Sinh viên</th>
                                                <td><?php echo $row->StuID; ?></td>
                                            </tr>
                                            <tr class="table-success">
                                                <th>Họ tên Cha</th>
                                                <td><?php echo $row->FatherName; ?></td>
                                                <th>Họ tên Mẹ</th>
                                                <td><?php echo $row->MotherName; ?></td>
                                            </tr>
                                            <tr class="table-primary">
                                                <th>Số điện thoại liên hệ</th>
                                                <td><?php echo $row->ContactNumber; ?></td>
                                                <th>Số điện thoại phụ</th>
                                                <td><?php echo $row->AltenateNumber; ?></td>
                                            </tr>
                                            <tr class="table-progress">
                                                <th>Địa chỉ</th>
                                                <td><?php echo $row->Address; ?></td>
                                                <th>Tên đăng nhập</th>
                                                <td><?php echo $row->UserName; ?></td>
                                            </tr>
                                            <tr class="table-info">
                                                <th>Ảnh đại diện</th>
                                                <td><img src="../admin/images/<?php echo $row->Image; ?>"></td>
                                                <th>Ngày nhập học</th>
                                                <td><?php echo $row->DateofAdmission; ?></td>
                                            </tr>
                                            <?php $cnt = $cnt + 1;
                                        }
                                    } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <?php include_once('includes/footer.php');?>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="vendors/select2/select2.min.js"></script>
<script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="js/off-canvas.js"></script>
<script src="js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="js/typeahead.js"></script>
<script src="js/select2.js"></script>
<!-- End custom js for this page -->
</body>
</html>
<?php }  ?>
