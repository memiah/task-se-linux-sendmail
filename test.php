<?php

if (isset($_GET['email'])){
  mail ($_GET['email'], 'test message', 'hello!');
  echo 'Test message sent to '.$_GET['email'];
} else {
  echo 'Enter recipient email: <form><input type="text" name="email"><input type="submit" name="submit" value="SEND TEST EMAIL"></form>';
}

?>
