<?php

Class User extends Akham {

    public function __construct(){
        $this->pk = 'pseudo';
        $this->table_name = 'users';
        $this->fields=['id','email', 'pseudo', 'password', 'login'];
    }

    
    public function sendFriendRequest($theFriend){
        $query = 'INSERT INTO friends (firstUser, secondUser) VALUES ('.$this->{$this->pk}.', '.$theFriend.')';
        myQuery($query);
    }
    
}