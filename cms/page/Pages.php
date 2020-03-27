<a href="?p=pages_new">New pages</a><br><hr><br>
<?php
  $dbConnect = mysqli_connect("localhost","root","","Cms");
  $sql = "SELECT  p.id, p.title, p.tags, p.createDate, p.userId, p.hitCount,
  c.name as category from pages p
  left join category as c on p.category = c.id";
  $table = mysqli_query($dbConnect,$sql);
  print '<table>';
  print '<tr><th>Basice Info</th><th>Content</th><th>#</th></tr>';
  while($row = mysqli_fetch_assoc($table))
  {
    print '<tr>';
    print '<td><p>'.$row['title'].'</p><br><b>'.$row["tags"].'</b>';
    print  $row['createDate'].', By : ';
    print  $row['userId'].'<br>';
    print '<b> Hit : </b>'.$row['hitCount'].', IN : ';
    print  $row['category'].'</td>';
    print '<td>';
    $fileName = "airtel/".str_replace(" ","_", trim($row['title'])).".html";
    $file = fopen($fileName,"r");
    $content = fread($file, filesize($fileName));
    print substr(strip_tags($content), 0, 300);
    print '<br>... .. . <a href="#">Read More</a>';

    print '</td>';
    print '<td>Edit || Delete</td>';
    print '</tr>';
  }


?>