This City page;

<a href="?p=new_city">New City</a><br><hr><br>

<?php
  $sql = mysqli_connect("localhost","root","","validation");
  $sel = "select id, name from city";
  $table = mysqli_query($sql,$sel);
  print '<table>';
  print '<tr><th>Id</th><th>Name</th><th>#</th></tr>';
  while($row = mysqli_fetch_assoc($table))
  {   
      print "<tr>";
      print '<td>'.$row['id'].'</td>';
      print '<td>'.$row['name'].'</td>';
      print '<td> Edit || Delete</td>';
      print "</tr>";
  }
  print '</table>';




?>