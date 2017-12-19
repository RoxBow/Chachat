<?php
require_once('dbtools.php');

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

/* function Akham::allEntities($tableName){
	$query = "SELECT * FROM ".$tableName;
	$entity = myFetchAllAssoc($query);
	return $entity;
} */