<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $newpassword = md5($_POST['newpassword']);
    $sql = "SELECT Email FROM tbladmin WHERE Email=:email AND MobileNumber=:mobile";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0) {
        $con = "UPDATE tbladmin SET Password=:newpassword WHERE Email=:email AND MobileNumber=:mobile";
        $chngpwd1 = $dbh->prepare($con);
        $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
        $chngpwd1->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        $chngpwd1->execute();
        echo "<script>alert('Mật khẩu của bạn đã được thay đổi thành công');</script>";
    } else {
        echo "<script>alert('Địa chỉ email hoặc số điện thoại di động không hợp lệ');</script>"; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hệ thống Quản lý Sinh viên || Quên mật khẩu</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript">
        function valid() {
            if(document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                alert("Mật khẩu mới và Xác nhận mật khẩu không khớp !!");
                document.chngpwd.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="images/logo.svg">
                            </div>
                            <h4>KHÔI PHỤC MẬT KHẨU</h4>
                            <h6 class="font-weight-light">Nhập địa chỉ email và số điện thoại di động của bạn để đặt lại mật khẩu!</h6>
                            <form class="pt-3" id="login" method="post" name="login">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" placeholder="Địa chỉ Email" required="true" name="email">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="mobile" placeholder="Số điện thoại di động" required="true" maxlength="10" pattern="[0-9]+">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-lg" type="password" name="newpassword" placeholder="Mật khẩu mới" required="true"/>
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-lg" type="password" name="confirmpassword" placeholder="Xác nhận mật khẩu" required="true" />
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-success btn-block loginbtn" name="submit" type="submit">Đặt lại</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <a href="login.php" class="auth-link text-black">đăng nhập</a>
                                </div>
                                <div class="mb-2">
                                    <a href="../index.php" class="btn btn-block btn-facebook auth-form-btn">
                                        <i class="icon-social-home mr-2"></i>Trở về Trang chủ </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
</body>
</html>
