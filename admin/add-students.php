<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']) == 0) {
  header('location:logout.php');
} else {
  if(isset($_POST['submit'])) {
    $stuname = $_POST['stuname'];
    $stuemail = $_POST['stuemail'];
    $stuclass = $_POST['stuclass'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $stuid = $_POST['stuid'];
    $uname = $_POST['uname'];
    $password = md5($_POST['password']);
    $ret = "select UserName from tblstudent where UserName=:uname || StuID=:stuid";
    $query = $dbh->prepare($ret);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':stuid', $stuid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() == 0) {
      $sql = "insert into tblstudent(StudentName, StudentEmail, StudentClass, Gender, DOB, StuID, UserName, Password) values(:stuname, :stuemail, :stuclass, :gender, :dob, :stuid, :uname, :password)";
      $query = $dbh->prepare($sql);
      $query->bindParam(':stuname', $stuname, PDO::PARAM_STR);
      $query->bindParam(':stuemail', $stuemail, PDO::PARAM_STR);
      $query->bindParam(':stuclass', $stuclass, PDO::PARAM_STR);
      $query->bindParam(':gender', $gender, PDO::PARAM_STR);
      $query->bindParam(':dob', $dob, PDO::PARAM_STR);
      $query->bindParam(':stuid', $stuid, PDO::PARAM_STR);
      $query->bindParam(':uname', $uname, PDO::PARAM_STR);
      $query->bindParam(':password', $password, PDO::PARAM_STR);
      $query->execute();
      $LastInsertId = $dbh->lastInsertId();
      if ($LastInsertId > 0) {
        echo '<script>alert("Student has been added.")</script>';
        echo "<script>window.location.href ='add-students.php'</script>";
      } else {
        echo '<script>alert("An error occurred. Please try again.")</script>';
      }
    } else {
      echo "<script>alert('Username or Student ID already exists. Please try again');</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Student Management System || Add Students</title>
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
      <?php include_once('includes/header.php');?>
      <div class="container-fluid page-body-wrapper">
        <?php include_once('includes/sidebar.php');?>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Add Students</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">Add Students</li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Add Students</h4>
                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="exampleInputName1">Student Name</label>
                        <input type="text" name="stuname" value="" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Student Email</label>
                        <input type="text" name="stuemail" value="" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Class</label>
                        <select name="stuclass" class="form-control" required='true'>
                          <option value="">Select Class</option>
                          <?php 
                          $sql2 = "SELECT * from tblclass";
                          $query2 = $dbh->prepare($sql2);
                          $query2->execute();
                          $result2=$query2->fetchAll(PDO::FETCH_OBJ);
                          foreach($result2 as $row1) { ?>  
                            <option value="<?php echo htmlentities($row1->ID);?>"><?php echo htmlentities($row1->ClassName);?> <?php echo htmlentities($row1->Section);?></option>
                          <?php } ?> 
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Gender</label>
                        <select name="gender" class="form-control" required='true'>
                          <option value="">Select Gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          <option value="Other">Other</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Date of Birth</label>
                        <input type="date" name="dob" value="" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Student ID</label>
                        <input type="text" name="stuid" value="" class="form-control" required='true'>
                      </div>
                      <h3>Login Information</h3>
                      <div class="form-group">
                        <label for="exampleInputName1">Username</label>
                        <input type="text" name="uname" value="" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Password</label>
                        <input type="password" name="password" value="" class="form-control" required='true'>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2" name="submit">Add</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php include_once('includes/footer.php');?>
        </div>
      </div>
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
