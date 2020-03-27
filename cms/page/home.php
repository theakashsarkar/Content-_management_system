 <link rel="stylesheet" href="style.css"/>
<?php
  $name = "";
  $email = "";
  $contact = "";
  $address = "";
  $city = "";
   
  $ename = "";
  $eemail = "";
  $econtact = "";
  $eaddress = "";
  $ecity = "";
  

  $err = 0;
   if(isset($_POST['submit']))
   {
    $name = $_POST['name'];
    $email = $_POST['contact'];
    $contact = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    if($name == "")
    {
      $err++;
      $ename = "<span class=\"error\"> Required</span><br>";
    }
    if($email == "")
    {
      $err++;
      $eemail = "<span class=\"error\">Required</span><br>";
    }
    if($contact == "")
    {
      $err++;
      $econtact = "<span class=\"error\">Required</span><br>";
    }
    if($address == "")
    {

    }
    else if(strlen($address) < 5)
    {
      $err++;
      $eaddress = "<span class=\"error\">contain must 5 chartier more</span><br>";
    }
    if($city == "0")
    {
      $err++;
      $ecity = "<span class=\"error\"> Required</span><br>";
    }
    if($err == 0)
    {

      $Csql = mysqli_connect("localhost","root","","validation");
      $sql = "INSERT INTO Student (Name,Contact,Email,address,Cityid) VALUES('$name','$contact','$email','$address',$city)";
      if(mysqli_query($Csql,$sql))
      {
       print "<span class=\"success\">Data Save</sapn><br>";
       $name = "";
       $email = "";
       $contact = "";
       $address = "";
       $city = "";
      }
      else{
        print '<span class="error">'.mysqli_error($Csql).'</span>';
      }
    }
    else{

    }
   }

?>
<form action="" method="post">
  <label for="" >Name</label><br>
  <input type="text" name="name" value="<?print $name?>"/><?php print $ename;?><br>
  <label for="">Contact</label><br>
  <input type="text" name="contact" value="<?print $contact?>" /><?php print $econtact;?><br>
  <label for="">Email</label><br>
  <input type="text" name="email" value="<?print $email?>"><?php print $eemail;?><br>
  <label>address</label><br>
  <textarea name="address" id="" cols="30" rows="10"><?php print $address?></textarea><?php print $eaddress;?><br>
  <label for="">City</label><br>
  <select name="city" id=""><br>
    <option value="0">select</option>
    <option value="1" selected>Dhaka</option>
    <option value="2">chandpur</option>

   <br>
   <br>
  </select><?php print $ecity;?><br><br>
  <input type="submit" value="submit" name="submit">

</form>



