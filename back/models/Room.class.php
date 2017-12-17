<?php

Class Room extends Akham {

    public function __construct(){
        $this->pk = 'nom';
        $this->table_name = 'rooms';
        $this->fields=['id','nom','type'];
    }
    
}