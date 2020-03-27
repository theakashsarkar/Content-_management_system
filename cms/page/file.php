<a href="?p=new_file">New File</a><br><hr><br>
<?php
   $sql = "SELECT id,pageId,title,dateTime,images FROM pageImages as pi 
   left join pages as p on pi.pageId = p.id ";
   $table = mysqli_query($dbConnect,$sql);
   print '<table>';
   print '<tr><th>Title</th><th>Pages</th><th>DateTime</th><th>images</th><th>#</th></tr>';
   while($row = mysqli_fetch_assoc($table))
   {
       print '<tr>';
       print '<td>'.$row['title'].'</td>';
       print '<td>'.$row['pages'].'</td>';
       print '<td>'.$row['dateTime'].'</td>';
       print '<td><img src="upload/files'.$row["id"].'_'.$row['file'].'" height="100px"/> </td>';
       print '<td> Edit | Delete </td>';
       print '</tr>';
   }
?>