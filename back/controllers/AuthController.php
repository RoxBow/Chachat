<?php

require_once('models/user.class.php');

switch ($action) {
    case 'login_form':
        
        $login_message = 'Connectez-vous';
        break;
    
    case 'login':
        # code...
        break;
        
    case 'register_form':
        # code...
        break;
    
    case 'register':
        # code...
        break;
        
    default:
        error404('No '.$action.' in this controller: authcontroller');
        # code...
        break;
}