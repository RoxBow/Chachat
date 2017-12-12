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

        $query = "SELECT * FROM ".$this->table_name." WHERE ".$this->pk." = ".$this->{$this->pk};
        $entity = myFetchAssoc($query);

        foreach($entity as $field => $value){
            if($field != $this->pk){
                $this->$field = $value;
            }
        }
    }

    public function save(){
        if ( $this->{$this->pk} != null ) {
            $temp = '';

            foreach ($this->fields as $value) {
                if ($value != $this->pk) {
                    if ($value === end($this->fields)) {
                        $temp.=$value.'="'.$this->$value.'"';
                    } else{
                        $temp.=$value.'="'.$this->$value.'", ';
                    }
                }
                
            }

            $query_update = 'UPDATE '.$this->table_name.' SET '.$temp.' WHERE '.$this->pk.' = '.$this->{$this->pk};

            myQuery($query_update);
        
        // si on a une valeur pour la pk on UPDATE
        } else{

        }
        // si on a pas de valeur pour la pk on INSERT
    }
}

