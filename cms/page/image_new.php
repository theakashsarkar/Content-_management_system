<?php
  
  $pages     = "";
  $title     = "";
  $image     = "";
  $errPages  = "";
  $errTitle  = "";
  $errImages = "";
  if(isset($_POST['submit']))
  {
      $pages   = $_POST['pages'];
      $title   = $_POST['title'];
      $image  = $_FILES['image'];
      $error   = 0;

      if($pages == "0")
      {
          $error++;
          $errPages = '<span class="error">Requird</span>';
      }
      if($title == "")
      {
          $error++;
          $errTitle = '<span class="error">Required</span>';
      }
      if($image['name'] == "")
      {
          $error++;
          $errImages='<span class="error">Required</span>';
      }
      else if($image['size'] > (2 * 1024 * 1024))
      {
         $error ++;
         $errImages = '<span class="error">File Must Less Then 2MB</span>';
      }
      else
      {
        $a = explode(".",$image['name']);
        if(is_array($a) && count($a) > 1)
        {
           $ext = strtolower($a[count($a)-1]);
           if(($ext == 'jpg' || $ext == 'png' || $ext == 'gif'))
           {
               $error ++;
               $errImages = '<span class="error">Only JPG,PNG,GIF</span>';
           }
        }
        else
        {
          $error ++;
          $errImages = '<span class="error">Form Invalid</span>';
        }
      }
      if($error == 0)
      {
          $sql = "INSERT INTO pageImages(pageId,title,images) VALUES ('".ms($pages)."','".ms($title)."','".ms($images['name'])."')";
          if(mysqli_query($dbConnect,$sql))
          {
              $sp = $image['tmp_name'];
              $dp = "upload/images/".mysqli_insert_id($dbConnect)."_".$image['name'];
              move_uploaded_file($sp,$dp);
              print '<span class="success">Images Saved</span>';
              $pages     = "";
              $title     = "";
              $image    = array();
          }
          else
          {
             print '<span class="error">'.mysqli_error($dbConnect).'</span>';
          }
      }
  }


?>
<form action="" method="post" enctype="maltipart/form-data" >
   <label for="">Pages</label><br>
   <select name="pages" id="">
     <option value="0">Select</option>
     <?php
      $sql = "SELECT id,title FROM pages";
      $table = mysqli_query($dbConnect,$sql);
      while($row = mysqli_fetch_assoc($table))
      {
          if($pages == $row['id'])
          {
              print '<option value="'.$row["id"].'" selected>'.$row['title'].'</option>';
          }
          else
          {
             print '<option value="'.$row["id"].'">'.$row["title"].'</option>';
          }
      }
     
     ?>
   </select><?php print $errPages?><br><br>
   <label for="">Title</label><br>
   <input type="text" name="title" value="<?php print $title?>"/><?php print $errTitle?><br><br>
   <label for="">image</label><br>
   <input type="file" name="image"/><?php print $errImages?><br><br>

   <input type="submit" value="submit" name="submit"/>

</form>