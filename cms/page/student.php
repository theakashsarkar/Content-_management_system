<a href="?p=student_new">Stuent heare</a>
Student Info;

<?php
    $city = mysqli_connect("localhost","root","","validation");
    $sql = "select id,name,contact,email,address,cityId from Student";
    $table = mysqli_query($city,$sql);
    print '<table>';
    print '<tr><th>Id</th><th>Name</th><th>contact</th><th>Email</th><th>address</th><th>cityId</th><th>#</th></tr>';
    while($row = mysqli_fetch_assoc($table))
    {   
        print "<tr>";
        print '<td>'.$row['id'].'</td>';
        print '<td>'.htmlentities($row['name']).'</td>';
        print '<td>'.$row['contact'].'</td>';
        print '<td>'.$row['email'].'</td>';
        print '<td>'.htmlentities($row['address']).'</td>';
        print '<td>'.$row['cityId'].'</td>';
        print '<td> Edit || Delete</td>';
        print "</tr>";
    }
    print '</table>';
  




?>