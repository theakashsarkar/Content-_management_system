<form action="" method="post">
  <label for="">Name</label><br><br>
  <input type="text" name="name" value="<?php print $name?>"/><?php print $errName; ?><br>
  <label for="">Contact</label><br><br>
  <input type="text" name="contact" vlaue="<?php print $contact?>"/><?php print $errContact; ?><br>
  <label for="">Email</label><br><br>
  <input type="email" name="email" value="<?php print $email?>"/><?php print $errEmail; ?><br>
  <label for="">Password</label><br><br>
  <input type="password" name="password" vlaue=""/><?php print $errPassword;?><br>
  <label for="">ReTypePassword</label><br><br>
  <input type="password" name="passwordReType" vlaue=""/><?php print $errPasswordReType;?><br>
  <input type="submit" name="submit" value="submit">
</form>