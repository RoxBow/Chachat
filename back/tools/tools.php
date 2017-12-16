<?php

function error404($message = 'Page not Found')
{
	header("HTTP/1.0 404 Not Found");
	die($message);
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
			//On dit que l'user est connecté dans la BDD
			$a_user->login=true;
			$a_user->save();
			// on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
			$_SESSION['currentUser'] = $a_user;
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

function currentUser(){
	$theCurrentUser = new User();
	$theCurrentUser->pseudo = $_SESSION['pseudo'];
	$theCurrentUser->hydrate();
	
	return $theCurrentUser;
}

/* function logOut($session_pseudo){
	$query_update = 'UPDATE '.$this->table_name.' SET '.$temp.' WHERE '.$this->pk.' = \''.$this->{$this->pk}.'\'';
	echo $query_update.'<br>';
	myQuery($query_update);
} */