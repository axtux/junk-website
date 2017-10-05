<?php

session_start();

include('messages.php');

if(isset($_POST['name']) && isset($_FILES['file']))
{
  $_SESSION['name'] = $_POST['name'];
  $_SESSION['avatar'] = 'avatars/'.$_POST['name'].'.'.pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
  move_uploaded_file($_FILES['file']['tmp_name'], $_SESSION['avatar']);
}

if(isset($_GET['message']))
{
  save_message('<img height="10" width="10" src="'.$_SESSION['avatar'].'"/> '.$_SESSION['name'].' : '.$_GET['message']);
}

?>
<html>
  <head>
    <title>Shoutbox</title>
  </head>
  <body>
    <?php
    if(!isset($_SESSION['name']))
    {
      ?>
      <form method="POST" enctype="multipart/form-data">
        Enter your name :
        <input type="text" name="name"/><br>
        Choisissez un avatar :
        <input type="file" name="file"/><br>
      <button type="submit">Done !</button>
      </form>
      <?php
    }
    else
    {
      echo 'Hello '.$_SESSION['name'].'!<br>';
      $messages = get_messages();
      foreach($messages as $mess)
      {
        echo $mess.'<br>';
      }
      ?>
      <form>
        Votre message :
        <input name="message"/>
        <button type="submit">Send</button>
      </form>
      <?php
    }
    ?>
  </body>
</html>


