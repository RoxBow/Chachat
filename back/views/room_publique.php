<?php
session_start ();

// On récupère nos variables de session
if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {
    
        // On teste pour voir si nos variables ont bien été enregistrées
        echo '<html>';
        echo '<head>';
        echo '<title>Page de notre section membre</title>';
        echo '</head>';
    
        echo '<body>';
        echo 'Votre login est '.$_SESSION['pseudo'].' et votre mot de passe est '.$_SESSION['password'].'.';
        echo '<br />';
    
        // On affiche un lien pour fermer notre sessionx
        echo '<a href="./index.php?action=kill">Déconnection</a>';
    }
    else {
        echo 'Les variables ne sont pas déclarées.';
    }
    
?>

<main class="wrapper-page-room">
    <section class="section-room-friends">
        <h1><?= $welcome_room_message ?></h1>
        <div class="wrapper-onglets">
            <ul>
                <li class="selected"><a href="#">Salons</a></li>
                <li><a href="#">Amis</i></a></li>
            </ul>
        </div>
    </section>

    <section class="section-chat">
        <div class="header-chat">
            <div class="wrapper-header-left">
                <p class="pseudo-user">Mon Pseudo</p>
                <p class="salon-user">Mon Salon</p>
                <p class="discussion-user">Ma discussion</p>
            </div>
            <div class="wrapper-header-right">
                    <span>
                        <i class="fa fa-cog" aria-hidden="true"></i>
                    </span>
                <input type="text" name="Rechercher" id="rechercher" placeholder="Rechercher"/>
                <i class="fa fa-search" aria-hidden="true"></i>
            </div>
        </div>

        <div class="wrapper-game">
            <ul>dfsdf</ul>
        </div>

        <div class="wrapper-chat">
            <ul id="message-chat">
            </ul>
        </div>

    </section>
</main>