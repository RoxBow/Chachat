<?php


switch ($action) {
    case 'login':
        $_SESSION['error'] = false;
        $pseudonyme = test_input($_POST["pseudo"]);
        $password = $_POST["password"];

        $user = new User();
		$user->pseudo = $pseudonyme;
		$user->hydrate();  
        
        foreach (allEntities('users') as $value) {
            $pseudo_tab[] = $value['pseudo'];
        }

        if( in_array($pseudonyme, $pseudo_tab) && password_verify($password , $user->password) ){
            $user->start_session();
        } else{
            $_SESSION['error'] = true;
            $_SESSION['contentError'] = 'Mauvais identifiant ou votre mot de passe ne correspond pas';
            header ('location: index.php');
        }
        break;

    case 'register':
        $_SESSION['error'] = false;
        $email = test_input($_POST["email"]);
        $pseudonyme = test_input($_POST["pseudo"]);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        //Register a new user in database if its a new pseudo & new email
        foreach (allEntities('users') as $value) {
            $pseudo_tab[] = $value['pseudo'];
            $email_tab[] = $value['email'];
        }

        if ( !in_array($email, $email_tab) ) {
            if( !in_array($pseudonyme, $pseudo_tab) ){
                $newUser = new User();
                $newUser->pseudo = $pseudonyme;
                $newUser->password = $password;
                $newUser->email = $email;
                $newUser->login = false;
                $newUser->save();

                $newUser->start_session();
            } else{
                $_SESSION['error'] = true;
                $_SESSION['contentError'] = 'Pseudo déjà utilisé';
                header ('location: index.php');
            }
        } else{
            $_SESSION['error'] = true;
            $_SESSION['contentError'] = 'Email déjà utilisé';
            header ('location: index.php');
        }

        break;
    case 'guest':
        
        $_SESSION['pseudo'] = uniqid('Guest');

        // on redirige notre visiteur vers une page de notre section membre
        header('Location: index.php?action=room_publique');
        break;
    case 'kill':

        // On détruit les variables de notre  et on met à false l'attribut login dans la base de donnée
        if( isset( $_SESSION['currentUser'] ) ){
            $currentUser = $_SESSION['currentUser'];
            $currentUser->login = false;
            $currentUser->save();
        }

        session_unset();

        //On détruit notre session
        session_destroy ();

        // On redirige le visiteur vers la page d'accueil
        header ('location: index.php');

        break;
    
    default:
        Akham::error404('No '.$action.' in this controller: authcontroller');
        # code...
        break;
}