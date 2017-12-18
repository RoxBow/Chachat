<main class="main-chat">
    <section class="wrapper-info-room">
        <div>
            <h2>Salon</h2>
            <ul class="list-room">
                <?php
                    foreach (allEntities('rooms') as $key => $value) {
                        echo '<li id="'.$value['nom'].'">'.$value['nom'].'</li>';
                    }
                ?>
            </ul>
        </div>
        <div>
            <h2>En ligne</h2>
            <ul>
                <li>Soline Rasmus</li>
                <li>Ingrid Arnaud</li>
                <li>Vincent Deplais</li>
            </ul>
        </div>
    </section>

    <section class="wrapper-chat">
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
        <h2>Amis</h2>
        <ul>
            <li>Soline Rasmus</li>
            <li>Ingrid Arnaud</li>
        </ul>

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
        username: <?= $currentUser ?>,
        room: "<?= $initialRoom ?>"
    };

    socket.emit('getCurrentUser', currentUser);

</script>