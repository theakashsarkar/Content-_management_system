<?php
   $name        = "";
   $contact     = "";
   $email       = "";
   $password    = "";
   $passwordReType = "";
   $errName     = "";
   $errContact  = "";
   $errEmail    = "";
   $errPassword = "";
   $errPasswordReType = "";
   


   if(isset($_POST['submit']))
   {
       $name     =$_POST['name'];
       $contact  = $_POST['contact'];
       $email    = $_POST['email'];
       $password = $_POST['password'];
       $passwordReType = $_POST['passwordReType'];  
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

       if( $passwordReType == "")
       {
           $error ++;
           $errPasswordReType = '<span class="error">Required</span>';
       }
       elseif ( $passwordReType != $password )
       {
           # code...
           $error ++;
           $errPasswordReType = '<span class="error">Password missMatch</span>';

       }
       if( $error == 0 )
       {
         $sql = " INSERT INTO users(name,contact,email,password,createIP,type) 
                  VALUE ('".ms( $name )."','".ms( $contact )."','".ms( $email)."',password('".ms( $password )."'),'".$_SERVER['REMOTE_ADDR']."','U')";
            if(mysqli_query( $dbConnect,$sql ))
            {
                print '<span class="success">Registration Was Completed Susscessfully</span>';
                $message  = "Dear"." ".$name."\n<br>";
                $message .= "You have recently register system. Please click the follwing link to active your account"."\n<br>";
                $message .= '<a href="http://localhost/cms/?c=activate&id='.mysqli_insert_id( $dbConnect).'">Actived My Account</a>'."\n<br>";
                $message .= "If you not register.Please click the follwing link"."\n<br>";
                $message .= '<a href="http://localhost/cms/?c=deactivate&id='.mysqli_insert_id( $dbConnect ).'">Deactive My account</a>'."\n<br>";
                print $message;
                //mail($email,"Account Active akash.com",$message);
            }

            else
            {
               print '<span class="error">'.mysqli_error( $dbConnect ).'</span>';
               include("client/registonForm.php");
            }
        }
    }
    else 
    {
        include("client/registonForm.php");
    }
?>
