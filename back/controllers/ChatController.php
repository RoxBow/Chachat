<?php

switch ($action) {
	case 'room_publique':
        $welcome_room_message = 'Tu es sur la page de room';

        break;
    
    case 'friends':
        $welcome_friends_message = 'Tu es sur la page d\'ami';
        break;

    default:
        error404('No '.$action.' in this controller: ChatController');
        # code...
        break;
}