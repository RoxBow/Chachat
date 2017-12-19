<?php


switch ($action) {
    case 'login_form':
        
        $login_message = 'Connectez-vous';
        break;
    
    case 'login':
        $pseudonyme = test_input($_POST["pseudo"]);
        $password = $_POST["password"];

        $user = new User();
		$user->pseudo = $pseudonyme;
		$user->hydrate();  
        
        foreach (allEntities('users') as $value) {
            $pseudo_tab[] = $value['pseudo'];
        }

        if( in_array($pseudonyme, $pseudo_tab) && password_verify($password , $user->password) ){
            start_session($user);
        } else{
            echo 'Mauvais id ou mot de passe';
        }
        break;
        
    case 'register_form':
        # code...
        break;
    
    case 'register':

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

                start_session($newUser);
            } else{
                echo 'Pseudo déjà utilisé';
            }
        } else{
            //$popIn = file_get_contents('path/to/YOUR/FILE.php');
            //header('Location: index.php');
            echo 'Email déjà utilisé !';
        }

        break;

    case 'kill':
        # code...
        break;
    
    default:
        error404('No '.$action.' in this controller: authcontroller');
        # code...
        break;
}