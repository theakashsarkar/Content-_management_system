<?php
  if(isset($_GET['id']))
  {
     $sql = "INSERT INTO usersActive(userId,ip) VALUES ('".$_GET['id']."','".$_SERVER['REMOTE_ADDR']."')";
     if (mysqli_query( $dbConnect,$sql ))
     {
        print 'you account have been acctived, you can login now';
     }
     else 
     {
         print 'You have activatd already';
     }
  } 

?>