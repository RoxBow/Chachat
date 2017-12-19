<?php

require_once('./tools/dbtools.php');

Class Akham{

    protected $pk = null;
    protected $table_name = null;
    protected $fields = [];

    public function __get($attr_name){
        if(in_array($attr_name, $this->fields)){
            return $this->$attr_name;
        } else{
            die('illegal field: '.$attr_name);
        }
    }

    public function __set($attr_name, $attr_value){ 
        if(in_array($attr_name, $this->fields)){
            $this ->$attr_name = $attr_value;
        } else{
            die('illegal field: '.$attr_name);
        }
    }

    public function hydrate(){

        if($this->{$this->pk} ==null){
            die('fatal error: cannot hydrate without PK value');
        }

        $query = "SELECT * FROM ".$this->table_name." WHERE ".$this->pk." = '".$this->{$this->pk}."'";
        $entity = myFetchAssoc($query);
        var_dump($entity);
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
                    if ($value === end($this->fields)) {
                        $temp.=$value.'="'.$this->$value.'"';
                    } else{
                        $temp.=$value.'="'.$this->$value.'", ';
                    }
                }
                
            }
            
            $query_update = 'UPDATE '.$this->table_name.' SET '.$temp.' WHERE '.$this->pk.' = \''.$this->{$this->pk}.'\'';
            myQuery($query_update);
        
        // si on a une valeur pour la pk on UPDATE
        } else{
            $temp_columns = '';
            $temp_values = '';
            
            foreach ($this->fields as $value) {

                if ($value === end($this->fields)) {
                    $temp_columns.=$value.'';
                    $temp_values.='\''.$this->$value.'\'';
                } else{
                    $temp_columns.=$value.',';                        
                    $temp_values.='\''.$this->$value.'\', ';
                }

            }

            $query_insert = 'INSERT INTO '.$this->table_name.' ('.$temp_columns.') VALUES ('.$temp_values.');';
            
            myQuery($query_insert);
            
        }
        // si on a pas de valeur pour la pk on INSERT
    }

    public function thisUser(){
        
    }
}

