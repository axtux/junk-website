<?php

function get_messages()
{
  $json = file_get_contents('messages.json');
  if($json === false)
  {
    return array();
  }
  return json_decode($json);
}

function save_message($mess)
{
  $messages = get_messages();
  $messages[] = $mess;
  file_put_contents('messages.json', json_encode($messages));
}

