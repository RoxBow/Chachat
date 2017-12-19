<?php

require_once('./tools/dbtools.php');

Class Akham{

    protected $pk = null;
    protected $table_name = null;
    protected $fields = [];

    public function __get($attrName){
        if(in_array($attrName, $this->fields)){
            return $this->$attrName;
        } else{
            die('illegal field: '.$attrName);
        }
    }

    public function __set($attrName, $attrValue){ 
        if(in_array($attrName, $this->fields)){
            $this ->$attrName = $attrValue;
        } else{
            die('illegal field: '.$attrName);
        }
    }

    public function hydrate(){

        if($this->{$this->pk} ==null){
            die('fatal error: cannot hydrate without PK value');
        }

        $query = "SELECT * FROM ".$this->table_name." WHERE ".$this->pk." = '".$this->{$this->pk}."'";
        $entity = myFetchAssoc($query);

        foreach($entity as $field => $value){
            if($field != $this->pk && $field != 'id'){
                $this->$field = $value;
            }
        }
    }

    public function save(){
        $allPseudoQuery = "SELECT `pseudo` FROM ".$this->table_name;
        $allPseudoAssoc = myFetchAllAssoc($allPseudoQuery);

        foreach ($allPseudoAssoc as $value) {
            $allPseudo[] = $value['pseudo'];
        }

        if ( in_array($this->{$this->pk}, $allPseudo) ) {
            $temp = '';

            foreach ($this->fields as $value) {
                if ($value != $this->pk && $value != 'id') {
                    if($value == 'login'){
                        if ($value === end($this->fields)) {
                            $temp.=$value.'='.($this->$value ? 'true' : 'false').'';
                        } else{
                            $temp.=$value.'='.($this->$value ? 'true' : 'false').', ';
                        }
                    } else{
                        if ($value === end($this->fields)) {
                            $temp.=$value.'="'.$this->$value.'"';
                        } else{
                            $temp.=$value.'="'.$this->$value.'", ';
                        }
                    }
                }
                
            }
            
            $queryUpdate = 'UPDATE '.$this->table_name.' SET '.$temp.' WHERE '.$this->pk.' = \''.$this->{$this->pk}.'\'';
            myQuery($queryUpdate);
        
        // si on a une valeur pour la pk on UPDATE
        } else{
            $tempColumns = '';
            $tempValues = '';
            
            foreach ($this->fields as $value) {

                if ($value != 'id') {
                    if($value == 'login'){
                        if ($value === end($this->fields)) {
                            $tempColumns.=$value.'';
                            $tempValues.= $this->$value ? 'true' : 'false';
                        } else{
                            $tempColumns.=$value.',';
                            $tempValues.= ($this->$value ? 'true' : 'false').', ';
                        }
                    } else{
                        if ($value === end($this->fields)) {
                            $tempColumns.=$value.'';
                            $tempValues.='\''.$this->$value.'\'';
                        } else{
                            $tempColumns.=$value.',';
                            $tempValues.='\''.$this->$value.'\', ';
                        }
                    }
                }

            }

            $queryInsert = 'INSERT INTO '.$this->table_name.' ('.$tempColumns.') VALUES ('.$tempValues.');';
            myQuery($queryInsert);
            
        }
        // si on a pas de valeur pour la pk on INSERT
    }

    public static function allEntities($tableName){
        $query = "SELECT * FROM ".$tableName;
        $entity = myFetchAllAssoc($query);
        return $entity;
    }

    public static function error404($message = 'Page not Found'){
        header("HTTP/1.0 404 Not Found");
        die($message);
    }

    public static function currentUser(){
        $theCurrentUser;

        if ( isset($_SESSION['currentUser']) ) {
            $theCurrentUser = $_SESSION['currentUser'];
        }
        
        return $theCurrentUser;
    }

    public static function allOnline(){
        $query = "SELECT * FROM users WHERE login = true";
        $entity = myFetchAllAssoc($query);
    
        return $entity;
    }
    
}

