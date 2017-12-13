
<?php

require_once('models/user.class.php');

switch ($action) {
	case 'home':
	
        // utiliser les methodes issues de Modele

		// faire des traitements

		//preparer des valeur pour la vue
		$welcome_message = 'Mon premier FrameWork !!!';

		

		$user = new User();
		$user->id = 1;
		$user->hydrate();
		
		//var_dump($user);
        break;

    default:
        error404('No '.$action.' in this controller: HomeController');
        # code...
        break;
}