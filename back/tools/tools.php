<?php
require_once('dbtools.php');

function error404($message = 'Page not Found')
{
	header("HTTP/1.0 404 Not Found");
	die($message);
}

function start_session($a_user){
	
	// on teste si nos variables sont définies
	if (isset($_POST['pseudo']) && isset($_POST['password'])) {

		// on vérifie les informations du formulaire, à savoir si le pseudo saisi est bien un pseudo autorisé, de même pour le mot de passe
		if( $a_user->pseudo == $_POST['pseudo'] && password_verify($_POST["password"] , $a_user->password)) {
			// dans ce cas, tout est ok, on peut démarrer notre session

			//On dit que l'user est connecté dans la BDD
			$a_user->login=true;
			$a_user->save();
			// on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
			$_SESSION['currentUser'] = $a_user;
			$_SESSION['pseudo'] = $a_user->pseudo;

			// on redirige notre visiteur vers une page de notre section membre
			header('Location: index.php?action=room_publique');
			exit;
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

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function __autoload($class_name) 
{
    require_once ("models/".$class_name.".class.php");
}

function currentUser(){
	$theCurrentUser = new User();
	$theCurrentUser->pseudo = $_SESSION['pseudo'];
	$theCurrentUser->hydrate();
	
	return $theCurrentUser;
}

function allEntities($tableName){
	$query = "SELECT * FROM ".$tableName;
	$entity = myFetchAllAssoc($query);
	return $entity;
}

function myFriends($aUser){
	$query = "SELECT secondUser FROM friends WHERE firstUser='".$aUser->pseudo."'";
	$query2 = "SELECT firstUser FROM friends WHERE secondUser='".$aUser->pseudo."'";
	$entity = myFetchAllAssoc($query);
	$entity2 = myFetchAllAssoc($query2);

	$allFriends = array_merge($entity, $entity2);

	return $allFriends;
}

function allOnline(){
	$query = "SELECT * FROM users WHERE login = true";
	$entity = myFetchAllAssoc($query);

	return $entity;
}
	
/* function friendRequestState(){
	$query = "SELECT * FROM users WHERE login = true";
	$entity = myFetchAllAssoc($query);
} */

/* function logOut($session_pseudo){
	$query_update = 'UPDATE '.$this->table_name.' SET '.$temp.' WHERE '.$this->pk.' = \''.$this->{$this->pk}.'\'';
	echo $query_update.'<br>';
	myQuery($query_update);
} */