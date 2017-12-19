<main class="main-chat">
    <section class="wrapper-info-room">
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
                <span class="fa fa-commenting-o fa-2x"></span>
            </div>
            <h2>En ligne</h2>
            <ul id="listUsers">
               <!-- Injected by Js -->
            </ul>
        </div>
    </section>

    <section class="wrapper-chat">
        <div class="onglets-prives">
            <ul>
                <li>Elmarino <span class="fa fa-times" aria-label="Fermer onglet"></span></li>
                <li>Vince<span class="fa fa-times" aria-label="Fermer onglet"></span></li>
                <li>Dylan<span class="fa fa-times" aria-label="Fermer onglet"></span></li>
            </ul>
        </div>
        <h2 id="nameRoom">Ingrid Arnaud</h2>

        <div>
            <ul id="listMessage">
                <li class="current-user"><span>Pseudo-user</span>Hello</li>
                <li><span>Pseudo-user</span>Comment vas-tu ?</li>
                <li class="current-user"><span>Pseudo-user</span>Très bien merci</li>
                <li><span>Pseudo-user</span>Ok</li>
            </ul>

            <div class="wrapper-input-chat">
                <form action="">
                    <input type="text" name="" id="message" placeholder="Votre message">
                </form>

                <button class="fa fa-pencil"></button>
            </div>
            
        </div>
    </section>

    <section class="wrapper-list-amis">
        <div class="wrapper-icone-amis">
            <span class="fa fa-smile-o fa-2x"></span>
        </div>
        <h2>Amis</h2>
        <ul  id="listFriends">
            <?php
                // display our friends
	
                foreach (myFriends($_SESSION['currentUser']) as $value) {
                    echo '<li data-name="'.$value['secondUser'].'">'.$value['secondUser'].'
                             <span title="Supprimer" class="fa fa-times" data-action="delete" aria-label="Supprimer dans ma liste d\'amis"></span>
                            </li>';
                }

            ?>
        </ul>
        <a href="./index.php?action=kill">Déconnection</a>
        
        <form action="">
            <input type="text" placeholder="Rechercher">
        </form>
    </section>
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