<script src="js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({selector:'.editor'});</script>


<?
  $title = '';
  $tag = '';
  $content = '';
  $category = '';

  $etitle = '';
  $etag = '';
  $econtent = '';
  $ecategory = '';

  if(isset ($_POST['submit']))
  {
    $title = $_POST['title'];
    $tag = $_POST['tag'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $err = 0;

    if($title == "")
    {
        $err ++;
        $etitle = '<span class="error">Required</span>';
    }
    if($tag == "")
    {
        $err ++;
        $etag = '<span class="error">Required</span>';
    }
    if($content == "")
    {
        $err ++;
        $econtent = '<span class="error">Required</span>';
    }
    if($category == "0")
    {
        $err ++;
        $ecategory = '<span class="error">Required</span>';
    }
    if($err == 0)
    {
        $dbConnect = mysqli_connect("localhost","root","","Cms");
        $dbInsert = "INSERT INTO pages(title,tags,createDate,userId ,hitCount,category) VALUES(
          '".mysqli_real_escape_string($dbConnect,$title)."',
          '".mysqli_real_escape_string($dbConnect,$tag)."',
          '".date("Ymd")."',
          1,
          0,
          '".mysqli_real_escape_string($dbConnect,$category)."'
        )" ;
        if( mysqli_query($dbConnect,$dbInsert))
        {
          $file = fopen("airtel/".str_replace(" ","_",trim($title)).".html","w");  
          fwrite($file,$content);
          print '<span class="success">Data Save</span>';
          $title = '';
          $tag = '';
          $content = '';
          $category = '';
        }
        else{
            print '<span class="error">'.mysqli_error($dbConnect).'</span>';
        }
    }
    
  

  }




?>



<form action="" method="post">
  <label for="">title</label><br>
  <input type="text" name="title" value="<?print $title?>"><? print $etitle?><br><br>
  <label for="">tag</label><br>
  <input type="text" name="tag" value="<?print $tag?>"><?print $etag?><br><br>
  <label for="">content</label><br>
  <textarea name="content" id="" cols="30" rows="10"class="editor"><?print $content?></textarea><?print $econtent?><br><br>
  <label for="">Category</label><br>
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
 </select><?print $ecategory?><br><br>
  <input type="submit" value="submit" name="submit">




</form>