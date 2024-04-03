<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="profile-image">
          <img class="img-xs rounded-circle" src="images/faces/face8.jpg" alt="profile image">
          <div class="dot-indicator bg-success"></div>
        </div>
        <div class="text-wrapper">
          <?php
          $aid= $_SESSION['sturecmsaid'];
          $sql="SELECT * from tbladmin where ID=:aid";

          $query = $dbh -> prepare($sql);
          $query->bindParam(':aid',$aid,PDO::PARAM_STR);
          $query->execute();
          $results=$query->fetchAll(PDO::FETCH_OBJ);

          $cnt=1;
          if($query->rowCount() > 0) {
            foreach($results as $row) { ?>
              <p class="profile-name"><?php echo htmlentities($row->AdminName); ?></p>
              <p class="designation"><?php echo htmlentities($row->Email); ?></p>
          <?php $cnt=$cnt+1; }} ?>
        </div>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-title">Lớp Học</span>
        <!-- <i class="icon-layers menu-icon"></i> -->
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="add-class.php">Thêm Lớp Học</a></li>
          <li class="nav-item"> <a class="nav-link" href="manage-class.php">Quản Lý Lớp Học</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
        <span class="menu-title">Sinh Viên</span>
        <!-- <i class="icon-people menu-icon"></i> -->
      </a>
      <div class="collapse" id="ui-basic1">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="add-students.php">Thêm Sinh Viên</a></li>
          <li class="nav-item"> <a class="nav-link" href="manage-students.php">Quản Lý Sinh Viên</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <span class="menu-title">Thông Báo</span>
        <!-- <i class="icon-doc menu-icon"></i> -->
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="add-notice.php"> Thêm Thông Báo </a></li>
          <li class="nav-item"> <a class="nav-link" href="manage-notice.php"> Quản Lý Thông Báo </a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="search.php">
        <span class="menu-title">Tìm Kiếm Sinh Viên</span>
        <!-- <i class="icon-magnifier menu-icon"></i> -->
      </a>
    </li>
  </ul>
</nav>
