<nav>
<ul class="main-menu">
        <li><a href="?p=home">Home</a></li>
        <?php
          $dbConnect = mysqli_connect("localhost","root","","Cms");
          $select = "SELECT id,name FROM category where category_id = 0";
          $table = mysqli_query( $dbConnect,$select );
          while($row = mysqli_fetch_assoc( $table ))
          {
              print '<li><a href="?c=article&ctg='.$row["id"].'">'.$row["name"].'</a>';
              findChaild( $row["id"] );
              
             print '</li>';
          }

          function findChaild( $pid )
          {
            global $dbConnect;
            $select = "SELECT id,name FROM category where category_id = ".$pid;
            $table = mysqli_query( $dbConnect,$select );
            print '<ul class="sub-menu">';
            
            while( $row = mysqli_fetch_assoc( $table ))
            {
              print '<li><a href="?c=article&ctg='.$row["id"].'">'.$row["name"].'</a>';
              findChaild( $row["id"] );
              print '</li>';
            }
            print '</ul>';
          }

          if(isset( $_SESSION['type'] ))
          {
            print '
            <li><a href="?p=user">Ueser</a></li>
            <li><a href="?p=category">Category</a></li>
            <li><a href="?p=Pages">Pages</a></li>
            <li><a href="?p=images">Images</a></li>
            <li><a href="?p=file">FILE</a></li>
            <li><a href="?p=myAcount">'.$_SESSION['name'].'</a></li>
            <li><a href="?c=logout">LogOut</a></li>';
          }
          else
          {
            print '  
            <li><a href="?c=register">Register</a></li>
            <li><a href="?c=login">Login</a></li>';
          }
        ?>
  </ul>
</nav>