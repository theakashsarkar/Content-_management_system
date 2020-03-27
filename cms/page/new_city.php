<?php
  $name ="";
  $ename = "";

  if(isset($_POST['submit'])){
    $name = $_POST['name']; 
    $error = 0;
    if($name == ''){
        $error ++;

        $ename = print "<span class=\"error\">Required</span>";

    }
    if($error == 0)
    {
        $city = mysqli_connect("localhost","root","","validation");
        $sql = "INSERT INTO city(name) values('".mysqli_real_escape_string($city,$name)."')";
        if(mysqli_query($city,$sql)){
            print "<span class=\"susscess\">City Insert</span>";
            $name = "";
        }
        else
        {
            print '<span class="error">'.mysqli_error($city).'</span>';
        }

    }
  }



?>


<form action="" method="post">
   <label for="">Name</label>
   <input type="text" name ="name" value="<?php print $name ?>"/><?php print  $ename?><br><br>
   
   <input type="submit" name="submit" value="submit">






</form>