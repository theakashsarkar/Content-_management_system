<?php
  
  $pages     = "";
  $title     = "";
  $file      = "";
  $errPages  = "";
  $errTitle  = "";
  $errFile   = "";
  if(isset($_POST['submit']))
  {
      $pages   = $_POST['pages'];
      $title   = $_POST['title'];
      $file    = $_FILES['file'];
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
      if($file['name'] == "")
      {
          $error++;
          $errFile='<span class="error">Required</span>';
      }
      else if($file['size'] > (2 * 1024 * 1024))
      {
         $error ++;
         $errFile = '<span class="error">File Must Less Then 2MB</span>';
      }
      else
      {
        $a = explode(".",$file['name']);
        if(is_array($a) && count($a) > 1)
        {
           $ext = strtolower($a[count($a)-1]);
           if(($ext == 'jpg' || $ext == 'png' || $ext == 'gif'))
           {
               $error ++;
               $errFile = '<span class="error">Only JPG,PNG,GIF</span>';
           }
        }
        else
        {
          $error ++;
          $errFile = '<span class="error">Form Invalid</span>';
        }
      }
      if($error == 0)
      {
          $sql = "INSERT INTO pageFile(pageId,title,file) VALUES ('".ms($pages)."','".ms($title)."','".ms($file['name'])."')";
          if(mysqli_query($dbConnect,$sql))
          {
              $sp = $file['tmp_name'];
              $dp = "upload/files/".mysqli_insert_id($dbConnect)."_".$file['name'];
              move_uploaded_file($sp,$dp);
              print '<span class="success">File Saved</span>';
              $pages     = "";
              $title     = "";
              $file      = array();
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
   <label for="">File</label><br>
   <input type="file" name="file"/><?php print $errFile?><br><br>

   <input type="submit" value="submit" name="submit"/>
</form>