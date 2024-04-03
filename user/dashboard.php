<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsstuid']==0)) {
  header('location:logout.php');
} else{
   
?>

<!DOCTYPE html>
<html lang="vi">
  <head>
   
    <title>Hệ thống Quản lý Sinh viên ||| Bảng điều khiển</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css cho trang này -->
    <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">
    <!-- Kết thúc plugin css cho trang này -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Styles bố cục -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- Kết thúc styles bố cục -->
   
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
            <div class="row purchace-popup">
              <div class="col-12 stretch-card grid-margin">
                <div class="card card-secondary">
                  <span class="card-body d-lg-flex align-items-center">
                    <p class="mb-lg-0">Thông báo từ trường vui lòng kiểm tra!</p>
                    <a href="view-notice.php" target="_blank" class="btn btn-warning purchase-button btn-sm my-1 my-sm-0 ml-auto">Xem Thông báo</a>
                  
                  </span>
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
    <script src="./vendors/chart.js/Chart.min.js"></script>
    <script src="./vendors/moment/moment.min.js"></script>
    <script src="./vendors/daterangepicker/daterangepicker.js"></script>
    <script src="./vendors/chartist/chartist.min.js"></script>
    <!-- Kết thúc plugin js cho trang này -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Tùy chỉnh js cho trang này -->
    <script src="./js/dashboard.js"></script>
    <!-- Kết thúc tùy chỉnh js cho trang này -->
  </body>
</html>
<?php } ?>
