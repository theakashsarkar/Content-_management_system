<?php
 $name = "";
 $description = "";
 $category = "";

 $errName = "";


  if(isset($_POST['submit']))
  {
      $name =$_POST['name'];
      $description = $_POST['description'];
      $category = $_POST['category'];

      $error = 0;
      if($name == "")
      {
        $error++;
        $errName = "<span class=\"error\">Required</span>";
      }
      if($error == 0)
      {
          $dbConnect = mysqli_connect("localhost","root","","Cms");
          $dbInsert = "INSERT INTO category (name,description,category_id)
           VALUES ('".mysqli_real_escape_string($dbConnect,strip_tags($name))."','".mysqli_real_escape_string($dbConnect,strip_tags($description))."',".mysqli_real_escape_string($dbConnect,strip_tags($category)).")";
          if(mysqli_query($dbConnect,$dbInsert))
          {
              print '<span class="success">Category Inserted</span>';
              $name = "";
              $description = "";
              $category = "";
          }
          else{
            print '<span class="error">'.mysqli_error($dbConnect).'</span>';      
            }
      }

  }


?>


<form action="" method="post">
 <label for="">Name</label><br><br>
 <input type="text" name="name" value="<?php print $name?>"/><?php print $errName;?><br><br>
 <label for="">Description</label><br><br>
 <textarea name="description" id="" cols="30" rows="10"><?php print $description;?></textarea> <br><br>
 <label for="">Category Id</label><br>
 <select name="category" id="">
     <option value="0">select</option>
     <?php
      $dbConnect = mysqli_connect("localhost","root","","Cms");
      $sql = "SELECT id,name FROM category";
      $table = mysqli_query($dbConnect,$sql);
      while($row = mysqli_fetch_assoc($table))
      {
          if( $category  == $row['id'])
          {
            print '<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
          }
          else
          {
            print '<option value="'.$row['id'].'">'.$row['name'].'</option>';

          }
      }
     
     ?>
 </select><br><br>
 <input type="submit" name="submit" value="submit">

</form>