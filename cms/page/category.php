<a href="?p=category_new">New Category</a><br><hr>
<?php

  $dbConnect = mysqli_connect("localhost","root","","Cms");
  $sql = "SELECT c1.id,c1.name,c1.description, c2.name as category
  FROM category AS c1 
  LEFT JOIN category c2 ON c2.category_id = c1.id ";
  $table = mysqli_query($dbConnect,$sql);
  print '<table>';
  print '<tr><th>Id</th><th>Name</th><th>Description</th><th>Category</th><th>Page Count</th><th>#</th></tr>';
  while($row = mysqli_fetch_assoc($table))
  {
    $a = array();
    print '<tr>';
    print '<td>'.$row['id'].'</td>';
    print '<td>'.$row['name'].'</td>';
    print '<td>'.$row['description'].'</td>';
    print '<td>'.$row['category'].'</td>';
    findSubCategory($row['id'], $a);
    print '<td>';
   
    $sql = "SELECT count(id) as count from pages where category in (".implode(",",$a).") ";
    $table2 = mysqli_query($dbConnect,$sql);
    while($row2[] = mysqli_fetch_assoc($table2))
    {
      print $row2['count'];
    }

    print '</td>';
    print '<td>Edit || Delete</td>';
    print '</tr>';
  }
  function findSubCategory($cid, &$a)
  {
    global $dbConnect;
    $a[] = $cid;
    $sql = "SELECT id from pages where category = ".$cid;
    $table = mysqli_query($dbConnect,$sql);
    while($row = mysqli_fetch_assoc($table))
    {
      $a[] = $row['id'];
      findSubCategory($row['id'],$a); 
    }
  }

?>
