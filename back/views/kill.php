<?php
// On démarre la session
//session_start ();

// On détruit les variables de notre  et on met à false l'attribut login dans la base de donnée

$currentUser = $_SESSION['currentUser'];
$currentUser->login = false;
$currentUser->save();

session_unset();

//On détruit notre session
session_destroy ();

// On redirige le visiteur vers la page d'accueil
header ('location: index.php');
?>