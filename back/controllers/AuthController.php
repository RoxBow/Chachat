<?php


switch ($action) {
    case 'login_form':
        
        $login_message = 'Connectez-vous';
        break;
    
    case 'login':
        echo '<script>console.log("log in")</script>';
        $pseudonyme = test_input($_POST["pseudo"]);

        $user = new User();
		$user->pseudo = $pseudonyme;
		$user->hydrate();      
        
        start_session($user);
        break;
        
    case 'register_form':
        # code...
        break;
    
    case 'register':
        echo '<script>console.log("sign in")</script>';
    
        $email = test_input($_POST["email"]);
        $pseudonyme = test_input($_POST["pseudo"]);
        $password = test_input($_POST["password"]);
        //Register a new user in database

        $newUser = new User();
        $newUser->pseudo = $pseudonyme;
        $newUser->password = $password;
        $newUser->email = $email;
        $newUser->login = true;
        $newUser->save();

        start_session($newUser);

        break;

    case 'kill':
        # code...
        break;
    
    default:
        error404('No '.$action.' in this controller: authcontroller');
        # code...
        break;
}