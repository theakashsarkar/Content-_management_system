<?php
//  $email    = '';
//  $errEmail = '';
 
//  if(isset( $_POST['submit'] ))
//  {
//      $email = $_POST['email'];
//      $error = 0;
     
//      if( $email == '' )
//      {
//        $error++;
//        $errEmail = '<span class="error">Required</span>';
//      }

//      if( $error == 0 )
//        {
        //  $sql = "INSERT INTO users(email) VALUE ('".ms( $email )."';
        //     if(mysqli_query( $dbConnect,$sql ))
        //     {
        //         print '<span class="success">Registration Was Completed Susscessfully</span>';
        //         $message  = 'Dear'.' '.$name.'\n<br>';
        //         $message .= 'You have recently register system. Please click the follwing link to active your account'.'\n<br>';
        //         $message .= '<a href="http://localhost/cms/?c=activate&id='.mysqli_insert_id( $dbConnect).'">Actived My Account</a>'."\n<br>";
        //         $message .= "If you not register.Please click the follwing link"."\n<br>";
        //         $message .= '<a href="http://localhost/cms/?c=deactivate&id='.mysqli_insert_id( $dbConnect ).'">Deactive My account</a>'."\n<br>";
        //         print $message;
        //         //mail($email,"Account Active akash.com",$message);
        //     }

        //     else
        //     {
        //        print '<span class="error">'.mysqli_error( $dbConnect ).'</span>';
        //        include("client/registonForm.php");
        //     }
//           $sql = "SELECT id, name, email, type FROM users WHERE email = '".$email."'";
//           $table = mysqli_query($dbConnect,$sql);
//           if($( $table))
//           {
//             print '<span class="success">Registration Was Completed Susscessfully</span>';
//                     $message  = 'Dear'.' '.$name.'\n<br>';
//                     $message .= 'You have recently register system. Please click the follwing link to active your account'.'\n<br>';
//                     $message .= '<a href="http://localhost/cms/?c=activate&id='.mysqli_insert_id( $dbConnect).'">Actived My Account</a>'."\n<br>";
//                     $message .= "If you not register.Please click the follwing link"."\n<br>";
//                     $message .= '<a href="http://localhost/cms/?c=deactivate&id='.mysqli_insert_id( $dbConnect ).'">Deactive My account</a>'."\n<br>";
//                     print $message;
//           }
//           else
//          {
//              print '<span class="error">'.mysqli_error( $dbConnect ).'</span>';
//              include("client/registonForm.php");
//          }
//         }
//  }


?>
<form action="" method="post">
<label for="">Email</label>
<input type="text" name="email" value=""/><br>
<input type="submit" name="submit" value="Resend Mail"/>

</form>