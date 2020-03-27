<a href="?p=new_user">New User</a><br>
<?php
  $sql = "SELECT u.id, u.name, u.contact, u.email, u.createDate, u.createIP, u.type FROM users AS u";
  $table = mysqli_query( $dbConnect,$sql );
  print '<table>';
  print '<tr><th>NAME</th><th>EMAIL</th><th>CREATEDATE</th><th>CREATEIP</th><th>TYPE</th><th>#</th></tr>';
  while( $row = mysqli_fetch_assoc( $table ) )
  {
      print '<tr>';
      print '<td>'.$row["name"].'</td>';
      print '<td>'.$row["contact"].'</td>';
      print '<td>'.$row["email"].'</td>';
      print '<td>'.$row["createDate"].'</td>';
      print '<td>'.$row["createIP"].'</td>';
      print '<td>'.$row["type"].'</td>';
      print '<td>Edit || Delete</td>';
      print '</tr>';
  }
  print '</table>';
?>