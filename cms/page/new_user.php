<?php
   $name     = "";
   $contact  = "";
   $email    = "";
   $password = "";
   $type     = "";
   
   $errName     = "";
   $errContact  = "";
   $errEmail    = "";
   $errPassword = "";
   $errType;

   if(isset($_POST['submit']))
   {
       $name     =$_POST['name'];
       $contact  = $_POST['contact'];
       $email    = $_POST['email'];
       $password = $_POST['password'];

       if(isset( $_POST['type']) )
       {
          $type = $_POST['type'];
       }  
       $error    = 0;

       if( $name == "" )
       { 
           $error++;
           $errName = "<span class='error'>Required</span>";
       }

       if( $contact == "" )
       {
           $error++;
           $errContact = '<span class="error">Required</span>';
       }

       if( $email == "" )
       {
           $error ++;
           $errEmail = '<span class="error">Required<span>';
       }

       if( $password == "" )
       {
           $error ++;
           $errPassword ='<span class="error">Required</span>';
       }
       
       if ( $type == "" )
       {
           $error ++;
           $errType = '<span class="error">Required<span>';
       }

       if( $error )
       {
         $sql = " INSERT INTO users(name,contact,email,password,createIP,type) 
                  VALUE ('".ms( $name )."','".ms( $contact )."','".ms( $email)."',password('".ms( $password )."'),'".$_SERVER['REMOTE_ADDR']."','".ms( $type )."')";
            if(mysqli_query( $dbConnect,$sql ))
            {
                print '<span class="success">Data Save</span>';
                $name     = "";
                $contact  = "";
                $email    = "";
                $password = "";
                $type     = "";
            }

            else
            {
               print '<span class="error">'.mysqli_error( $dbConnect ).'</span>';
            }
        }
   }
?>
<form action="" method="post">
  <label for="">Name</label><br><br>
  <input type="text" name="name" value="<?php print $name?>"/><?php print $errName; ?><br>
  <label for="">Contact</label><br><br>
  <input type="text" name="contact" vlaue="<?php print $contact?>"/><?php print $errContact; ?><br>
  <label for="">Email</label><br><br>
  <input type="email" name="email" value="<?php print $email?>"/><?php print $errEmail; ?><br>
  <label for="">Password</label><br><br>
  <input type="password" name="password" vlaue=""/><?php print $errPassword;?><br>
  <label for="">Type</label><br><br>
  <input type="radio" name="type" value="A"/>Admin
  <input type="radio" name="type" value="U"/>Users <?php print $errType; ?> <br><br>
  <input type="submit" name="submit" value="submit">
</form>