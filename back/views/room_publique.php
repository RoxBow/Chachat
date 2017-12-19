<main class="main-chat">
    <section class="wrapper-info-room">
        <div class="header-chat">
            <ul>
                <li><a href="./index.php?action=kill"><span role="button" class="fa fa-power-off" aria-label="Se déconnecter"></span></a></li>
                <li><span role="button" class="fa fa-bell" aria-label="Notification"></span></li>
                <li><span role="button" class="fa fa-user" aria-label="Paramètres profil"></span></li>
                <li class="pseudo-current-user">
                <?= $_SESSION['pseudo'] ?>
                </li>
            </ul>
        </div>
        <div>
            <h2>Salon</h2>
            <ul class="list-room">
                <?php
                    foreach (allEntities('rooms') as $key => $value) {
                        if($key === 0){
                            echo '<li class="selected" id="'.$value['nom'].'">'.$value['nom'].'</li>';
                        } else {
                            echo '<li id="'.$value['nom'].'">'.$value['nom'].'</li>';
                        }
                    }
                ?>
            </ul>
        </div>
        <div>
            <div class="wrapper-icone-room">
                <span role="button" class="fa fa-commenting-o fa-2x" aria-label="Bouton panel salon"></span>
            </div>
            <h2>En ligne</h2>
            <ul id="listUsers">
               <!-- Injected by Js -->
            </ul>
        </div>
    </section>

    <section class="wrapper-chat <?php if(!(isset($_SESSION['currentUser']))){ echo 'asGuest'; }?>">
        <div class="onglets-prives">
            <ul id="listConv">
                <li>Elmarino <span class="badge" aria-label="bulle de notification">1</span> <span role="button" class="fa fa-times" aria-label="Fermer onglet"></span></li>
                <li>Vince<span role="button" class="fa fa-times" aria-label="Fermer onglet"></span></li>
                <li>Dylan<span role="button" class="fa fa-times" aria-label="Fermer onglet"></span></li>
            </ul>
        </div>
        <h2 id="nameRoom">Ingrid Arnaud</h2>

        <div>
            <ul id="listMessage">
                <li class="current-user"><span aria-label="pseudo de l'utilisateur">Pseudo-user</span>Hello</li>
                <li><span aria-label="pseudo de l'utilisateur">Pseudo-user</span>Comment vas-tu ?</li>
                <li class="current-user"><span aria-label="pseudo de l'utilisateur">Pseudo-user</span>Très bien merci</li>
                <li><span aria-label="pseudo de l'utilisateur">Pseudo-user</span>Ok</li>
            </ul>

            <div class="wrapper-input-chat">
                <span class="tooltip" aria-label="Message d'erreur de saisie">Champs vide</span>
                <form action="">
                    <input type="text" name="" id="message" placeholder="Votre message">
                </form>

                <button class="fa fa-check" type="button" aria-label="Envoyer le message"></button>
                <button class="fa fa-pencil" type="button" aria-label="Ouvrir la zone de dessin"></button>
            </div>
            
        </div>
    </section>
    
    <?php 
        if(isset($_SESSION['currentUser'])){
    ?>

    <section class="wrapper-list-amis">
        <div class="wrapper-icone-amis">
            <span role="button" class="fa fa-smile-o fa-2x"  aria-label="Bouton affichage panel amis"></span>
        </div>
        <h2>Amis</h2>
        <ul id="listFriends">
            <li><span class="fa fa-times" aria-label="Supprimer l'amis"></span><span class="fa fa-check" aria-label="Accepter l'amis"></span>Elmarino</li>
            <li><span class="fa fa-times" aria-label="Supprimer l'amis"></span>Vince</li>
            <li><span class="fa fa-times" aria-label="Supprimer l'amis"></span>Vince</li>
            <li><span class="fa fa-times" aria-label="Supprimer l'amis"></span><span class="fa fa-check" aria-label="Accepter l'amis"></span>Dylan</li>
            <li><span class="fa fa-times" aria-label="Supprimer l'amis"></span>Malika Menard</li>
            <?php
                // display our friends
	
                foreach (myFriends($_SESSION['currentUser']) as $value) {
                    if(isset($value['secondUser'])){
                        echo '<li data-name="'.$value['secondUser'].'">'.$value['secondUser'].'
                                <span title="Supprimer" class="fa fa-times" data-action="delete" aria-label="Supprimer dans ma liste d\'amis"></span>
                            </li>';
                    } else{
                        echo '<li data-name="'.$value['firstUser'].'">'.$value['firstUser'].'
                                    <span title="Supprimer" class="fa fa-times" data-action="delete" aria-label="Supprimer dans ma liste d\'amis"></span>
                                </li>';
                    }
                    
                }

            ?>
        </ul>
        
        <form action="">
            <input type="text" placeholder="Rechercher">
        </form>
    </section>
    <?php
        }
    ?>
</main>

<?php
    $currentUser = $_SESSION['pseudo'];
    $initialRoom = allEntities('rooms')[0]['nom'];
?>

<script>

    var currentUser = {
        username: "<?= $currentUser ?>",
        room: "<?= $initialRoom ?>"
    };

    socket.emit('getCurrentUser', currentUser);

</script>