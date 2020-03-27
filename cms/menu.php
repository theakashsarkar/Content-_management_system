<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul id="css3menul" class="topmenu">
        <li><a href="?p=home">Home</a></li>
        <?php
          $dbConnect = mysqli_connect("localhost","root","","Cms");
          $select = "SELECT id,name FROM category where category_id = 0";
          $table = mysqli_query($dbConnect,$select);
          while($row = mysqli_fetch_assoc($table))
          {
              print '<li><a href="?p='.$row["id"].'">'.$row["name"].'</a>';
              findChaild($row["id"]);
              
             print '</li>';
          }
          function findChaild($pid)
          {
            global $dbConnect;
            $select = "SELECT id,name FROM category where category_id = ".$pid;
          $table = mysqli_query($dbConnect,$select);
          while($row = mysqli_fetch_assoc($table))
          {
              print '<ul>';
              print '<li><a href="?p='.$row["id"].'">'.$row["name"].'</a>';
              findChaild($row["id"]);
              
             print '</li>';
             print '</ul>';
          }
          }
        
        
        ?>
    </ul>
</body>
</html>