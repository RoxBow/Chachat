<?php


require_once('akham.class.php');

Class User extends Akham {

    public function __construct(){
        $this->pk = 'pseudo';
        $this->table_name = 'users';
        $this->fields=['id','email', 'pseudo', 'password', 'login'];
    }
    
}