<main class="wrapper-page-room">
    <section class="section-room-friends">
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

            <form>
                <input type="text" id="m">
                <input type="submit" value="Envoyer">
            </form>
        </div>

    </section>
</main>

<?php
    $currentUser = 'vince';
    $currentRoom = 'general';
?>

<script>

    var user = {
        username: "<?= $currentUser ?>",
        room: "<?= $currentRoom ?>"
    };

    socket.emit('getCurrentUser', user);

</script>