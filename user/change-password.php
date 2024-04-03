<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsstuid']==0)) {
  header('location:logout.php');
} else {
  if(isset($_POST['submit'])) {
    $sid = $_SESSION['sturecmsstuid'];
    $cpassword = md5($_POST['currentpassword']);
    $newpassword = md5($_POST['newpassword']);
    $sql = "SELECT StuID FROM tblstudent WHERE StuID=:sid and Password=:cpassword";
    $query = $dbh->prepare($sql);
    $query->bindParam(':sid', $sid, PDO::PARAM_STR);
    $query->bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() > 0) {
      $con = "UPDATE tblstudent SET Password=:newpassword WHERE StuID=:sid";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1->bindParam(':sid', $sid, PDO::PARAM_STR);
      $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd1->execute();

      echo '<script>alert("Mật khẩu của bạn đã được thay đổi thành công")</script>';
    } else {
      echo '<script>alert("Mật khẩu hiện tại của bạn không đúng")</script>';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <title>Hệ thống Quản lý Sinh viên || Thay đổi Mật khẩu</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css cho trang này -->
  <link rel="stylesheet" href="vendors/select2/select2.min.css">
  <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <!-- End plugin css cho trang này -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Styles bố cục -->
  <link rel="stylesheet" href="css/style.css" />
  <script type="text/javascript">
    function checkpass() {
      if(document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
        alert('Mật khẩu mới và Xác nhận mật khẩu không khớp');
        document.changepassword.confirmpassword.focus();
        return false;
      }
      return true;
    }   
  </script>
</head>
<body>
  <div class="container-scroller">
    <!-- phần:partials/_navbar.html -->
    <?php include_once('includes/header.php');?>
    <!-- phần -->
    <div class="container-fluid page-body-wrapper">
      <!-- phần:partials/_sidebar.html -->
      <?php include_once('includes/sidebar.php');?>
      <!-- phần -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title"> Thay đổi Mật khẩu </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thay đổi Mật khẩu</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title" style="text-align: center;">Thay đổi Mật khẩu</h4>
                  <form class="forms-sample" name="changepassword" method="post" onsubmit="return checkpass();">
                    <div class="form-group">
                      <label for="exampleInputName1">Mật khẩu hiện tại</label>
                      <input type="password" name="currentpassword" id="currentpassword" class="form-control" required="true">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Mật khẩu mới</label>
                      <input type="password" name="newpassword" class="form-control" required="true">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Xác nhận Mật khẩu</label>
                      <input type="password" name="confirmpassword" id="confirmpassword" value="" class="form-control" required="true">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Thay đổi</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Kết thúc phần nội dung -->
        <!-- phần:partials/_footer.html -->
        <?php include_once('includes/footer.php');?>
        <!-- phần -->
      </div>
      <!-- Kết thúc main-panel -->
    </div>
    <!-- Kết thúc page-body-wrapper -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js cho trang này -->
  <script src="vendors/select2/select2.min.js"></script>
  <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <!-- Kết thúc plugin js cho trang này -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js cho trang này -->
  <script src="js/typeahead.js"></script>
  <script src="js/select2.js"></script>
  <!-- End custom js cho trang này -->
</body>
</html>

