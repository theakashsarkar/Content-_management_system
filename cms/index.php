<?php
 session_start();
 include("component/accountManger.php");
 $dbConnect = mysqli_connect("localhost","root","","Cms");
 function ms ( $value )
 { 
   global $dbConnect;
   return mysqli_real_escape_string( $dbConnect,$value);
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/table.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/css3menu.css" />
    <link rel="stylesheet" href="css/controll.css" />
    <link rel="stylesheet" href="css/article.css" />
    <title>Document</title>
</head>
<body>
    <div class="header">
      <h1>Header Heare</h1>
    </div>
    <div class="main">
      <div class="menu">
        <?php include('component/menu.php'); ?>
      </div>
      <div class="content">
        <?php
        //  include("component/controller.php");
           include("component/controller.php");
        ?>
      </div>
    </div>
    <div class="footer">
       footer
    </div>
</body>
</html>