<?php
require_once('models/user.class.php');

switch ($action) {
	case 'room':
    $welcome_room_message = 'Tu es sur la page de room';
    break;

  default:
      error404('No '.$action.' in this controller: ChatController');
      # code...
      break;
}