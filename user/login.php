<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login'])) {
  $stuid = $_POST['stuid'];
  $password = md5($_POST['password']);
  $sql = "SELECT StuID,ID,StudentClass FROM tblstudent WHERE (UserName=:stuid || StuID=:stuid) and Password=:password";
  $query = $dbh->prepare($sql);
  $query->bindParam(':stuid', $stuid, PDO::PARAM_STR);
  $query->bindParam(':password', $password, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);

  if($query->rowCount() > 0) {
    foreach ($results as $result) {
      $_SESSION['sturecmsstuid'] = $result->StuID;
      $_SESSION['sturecmsuid'] = $result->ID;
      $_SESSION['stuclass'] = $result->StudentClass;
    }

    if(!empty($_POST["remember"])) {
      //COOKIES cho tên đăng nhập
      setcookie ("user_login", $_POST["stuid"], time() + (10 * 365 * 24 * 60 * 60));
      //COOKIES cho mật khẩu
      setcookie ("userpassword", $_POST["password"], time() + (10 * 365 * 24 * 60 * 60));
    } else {
      if(isset($_COOKIE["user_login"])) {
        setcookie ("user_login", "");
        if(isset($_COOKIE["userpassword"])) {
          setcookie ("userpassword", "");
        }
      }
    }
    $_SESSION['login'] = $_POST['stuid'];
    echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
  } else {
    echo "<script>alert('Thông tin không hợp lệ');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <title>Hệ thống Quản lý Sinh viên || Trang Đăng nhập Sinh viên</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="images/logo.svg"> SMS
              </div>
              <h4>Xin chào! Hãy bắt đầu</h4>
              <h6 class="font-weight-light">Đăng nhập để tiếp tục.</h6>
              <form class="pt-3" id="login" method="post" name="login">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" placeholder="Nhập mã số sinh viên hoặc tên đăng nhập của bạn" required="true" name="stuid" value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>" >
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" placeholder="Nhập mật khẩu của bạn" name="password" required="true" value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>">
                </div>
                <div class="mt-3">
                  <button class="btn btn-success btn-block loginbtn" name="login" type="submit">Đăng nhập</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" id="remember" class="form-check-input" name="remember" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?> /> Giữ tôi đăng nhập </label>
                  </div>
                  <a href="forgot-password.php" class="auth-link text-black">Quên mật khẩu?</a>
                </div>
                <div class="mb-2">
                  <a href="../index.php" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="icon-social-home mr-2"></i>Quay lại Trang chủ </a>
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
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
</body>
</html>
