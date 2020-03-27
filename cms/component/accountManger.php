<?php
  unset($_SESSION['active']);
  if(!isset($_SESSION['type']) and isset($_COOKIE['type']))
  {
    
    $_SESSION['id']    = $_COOKIE["id"];
    $_SESSION['name']  = $_COOKIE["name"];
    $_SESSION['email'] = $_COOKIE["email"];
    $_SESSION['type']  = $_COOKIE["type"];
  }
  $email    = "";
  $password = "";

  $errEmail;
  $errPassword;
   if(isset($_POST['btnLogin']))
  {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $error = 0;
    if($email == "")
    {
        $error ++;
        $errEmail = '<span class="error">Required</span>';
    }
    if($password == "")
    {
        $error ++;
        $errPassword = '<span class="error">Required</span>';
    }
    if($error == 0)
    {
        $dbConnect = mysqli_connect("localhost","root","","Cms");
        $sql = "SELECT id, name, email, type FROM users WHERE email = '".$email."' and 
        password = PASSWORD('".$password."') ";
        $table = mysqli_query($dbConnect,$sql);
        if(mysqli_num_rows($table) > 0)
        {
          while($row = mysqli_fetch_assoc($table))
          {
            $sql    = "SELECT ip,dateTime FROM usersActive WHERE userId =".$row['id'];
            $table2 = mysqli_query($dbConnect,$sql);
            if(mysqli_num_rows($table2) > 0)
            {
              $_SESSION['id'] = $row["id"];
              $_SESSION['name'] = $row["name"];
              $_SESSION['email'] = $row["email"];
              $_SESSION['type'] = $row["type"];
              if(isset($_POST['remember']))
              {
                // setcookie("id",$row['id'], 60*24*60*60);
              }
            }
            else
            {
              $_SESSION['active'] = 1;
            } 
             
          }  
        } 
    }
  }
  if(isset($_GET['c']) && $_GET['c'] == "logout")
  {
    unset($_SESSION["id"]);
    unset($_SESSION["name"]);
    unset($_SESSION["email"]);
    unset($_SESSION["type"]);
  
  }

?>
