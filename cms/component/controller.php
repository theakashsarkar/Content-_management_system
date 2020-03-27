<?php
  
  if(isset($_GET['p']))
  {
      if(file_exists("page/".$_GET['p'].".php")){
          print '<span class="title">'.ucwords(str_replace("_"," ",$_GET['p'])).'</span>';
          if(isset($_SESSION['type']))
          {
            include("page/".$_GET['p'].".php");
          }
          else{
            print '<span class="error">YOU HAVE TO LOGIN WITH ADMIN ACCOUNT TO VIEW THIS CONTENT</span><br>';
            include('client/login.php');
          }
        
      }
      else
      {
        include("warning.php");
      }
  }
  else if(isset($_GET['c']))
  {
    
     if($_GET['c'] == "login")
     {
      print '<span class="title">login</span>';
       if(isset($_POST['btnLogin']))
       {
         if(isset( $_SESSION['active'] ))
         {
           print "<span class=\"error\">You have active account,Please check your mail</sapn>";
           include("client/resend.php");
         }
         else if(isset($_SESSION['type']))
         {
          print '<span class="title">login was successfull</span>';  

         }
         else
         {
           print '<span class="error">Invalid Login,try agin</span>';
           include("client/login.php");
         }
       }
       else
      {
       
        include("client/login.php");
        
      }
     }
     else if(file_exists("client/".$_GET['c'].".php")){
          print '<span class="title">'.ucwords(str_replace("_"," ",$_GET['c'])).'</span>';
          include("client/".$_GET['c'].".php");
      }
      else
      {
        include("warning.php");
      }
  }
  else
  {
      include("page/home.php");
  }




?>