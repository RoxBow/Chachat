
<?php

switch ($action) {
	case 'home':
	
        // utiliser les methodes issues de Modele

		// faire des traitements

		//preparer des valeur pour la vue
		$welcome_message = 'Mon premier FrameWork !!!';		
        break;

    default:
        Akham::error404('No '.$action.' in this controller: HomeController');
        # code...
        break;
}