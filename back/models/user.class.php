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
    
    public function start_session(){
	
        // on teste si nos variables sont définies
        if (isset($_POST['pseudo']) && isset($_POST['password'])) {
    
            // on vérifie les informations du formulaire, à savoir si le pseudo saisi est bien un pseudo autorisé, de même pour le mot de passe
            if( $this->pseudo == $_POST['pseudo'] && password_verify($_POST["password"] , $this->password )) {
                // dans ce cas, tout est ok, on peut démarrer notre session
    
                //On dit que l'user est connecté dans la BDD
                $this->login=true;
                $this->save();
                // on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
                $_SESSION['currentUser'] = $this;
                $_SESSION['pseudo'] = $this->pseudo;
    
                // on redirige notre visiteur vers une page de notre section membre
                header('Location: index.php?action=room_publique');
                exit;
            }
            else {
                $_SESSION['error'] = true;
                $_SESSION['contentError'] = 'Membre non reconnu, veuillez vous reconnecter';
                header ('location: index.php');
            }
        }
        else {
            $_SESSION['error'] = true;
            $_SESSION['contentError'] = 'Vous n\'avez pas transmis vos identifiants';
            header ('location: index.php');
        }
    }

    public function myFriends(){
        $query = "SELECT secondUser FROM friends WHERE firstUser='".$this->pseudo."'";
        $query2 = "SELECT firstUser FROM friends WHERE secondUser='".$this->pseudo."'";
        $entity = myFetchAllAssoc($query);
        $entity2 = myFetchAllAssoc($query2);
    
        $allFriends = array_merge($entity, $entity2);
    
        return $allFriends;
    }
}