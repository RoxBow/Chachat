<?php

require_once('models/user.class.php');

switch ($action) {
    case 'login_form':
        
        $login_message = 'Connectez-vous';
        break;
    
    case 'login':
        $pseudonyme = htmlspecialchars($_POST["pseudo"]);

        $user = new User();
		$user->pseudo = $pseudonyme;
		$user->hydrate();
        
        echo 'User: '.$user->pseudo.'<br>';
        echo 'Password: '.$user->password.'<br>';        
        
        start_session($user);
        break;
        
    case 'register_form':
        # code...
        break;
    
    case 'register':
        //Register a new user in database

        /* $a = new User();
        $a->pseudo = 'yeat';
        $a->password = 'yeatword2az2az25';
        $a->email = 'yeat@yeat.com';
        $a->login = false;
        $a->save(); */
        
        break;

    case 'kill':
        # code...
        break;
    
    default:
        error404('No '.$action.' in this controller: authcontroller');
        # code...
        break;
}

function start_session($a_user){

    // on teste si nos variables sont définies
    if (isset($_POST['pseudo']) && isset($_POST['password'])) {
        echo $_POST['pseudo'].'---'.$_POST['password'].'<br>';

        // on vérifie les informations du formulaire, à savoir si le pseudo saisi est bien un pseudo autorisé, de même pour le mot de passe
        if ($a_user->pseudo == $_POST['pseudo'] && $a_user->password == $_POST['password']) {
            // dans ce cas, tout est ok, on peut démarrer notre session

            // on la démarre :)
            session_start ();
            // on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
            $_SESSION['pseudo'] = $_POST['pseudo'];
            $_SESSION['password'] = $_POST['password'];

            // on redirige notre visiteur vers une page de notre section membre
            header ('location: index.php?action=room');
        }
        else {
            // Le visiteur n'a pas été reconnu comme étant membre de notre site. On utilise alors un petit javascript lui signalant ce fait
            echo '<body onLoad="alert(\'Membre non reconnu...\')">';
            // puis on le redirige vers la page d'accueil
            echo '<meta http-equiv="refresh" content="0;URL=index.php?action=home">';
        }
    }
    else {
        echo 'Les variables du formulaire ne sont pas déclarées.';
    }
}