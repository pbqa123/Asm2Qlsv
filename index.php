<?php

include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Student Management System || Home</title>
<script type="application/x-javascript"> 
    addEventListener("load", function() { 
        setTimeout(hideURLbar, 0); 
    }, false); 
    function hideURLbar(){ 
        window.scrollTo(0,1); 
    } 
</script>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/bootstrap.js"></script>
<link href='//fonts.googleapis.com/css?family=Open+Sans:300,300italic,400italic,400,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/default.css" />
<link rel="stylesheet" type="text/css" href="css/component.css" />
<script src="js/modernizr.custom.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){		
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
        });
    });
</script>
</head>
<body>
<?php include_once('includes/header.php');?>
<div class="banner">
  <div class="container">
    <script src="js/responsiveslides.min.js"></script>
    <script>
        $(function () {
          $("#slider").responsiveSlides({
            auto: true,
            nav: true,
            speed: 500,
            namespace: "callbacks",
            pager: true,
          });
        });
    </script>
    <div class="slider">
       <div class="callbacks_container">
        <ul class="rslides" id="slider">
         <li>     
          <h3>Student Management System</h3>      
           <p>Registered students can login here</p>             
          <div class="readmore">
          <a href="user/login.php">Student Login</a>
          </div>
         </li>
        </ul>
      </div>
    </div>
  </div>
</div>      
<?php include_once('includes/footer.php');?>
</body>
</html>
