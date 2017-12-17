<main class="main-chat">
    <section class="wrapper-info-room">
        <div>
            <h2>Salon</h2>
            <ul>
                <li>Général</li>
                <li>ECV Digital</li>
                <li>Team Soudée</li>
                <li>Bendo na Bendo</li>
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
        <h2>Ingrid Arnaud</h2>

        <div>
            <ul>
                <li class="current-user"><span>Pseudo-user</span>Hello</li>
                <li><span>Pseudo-user</span>Comment vas-tu ?</li>
                <li class="current-user"><span>Pseudo-user</span>Très bien merci</li>
                <li><span>Pseudo-user</span>Ok</li>
            </ul>

            <div class="wrapper-input-chat">
                <form action="">
                    <input type="text" name="" id="" placeholder="Votre message">
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
    $currentUser = 'vince';
    $currentRoom = 'general';
?>

<script>

    var currentUser = {
        username: "<?= $currentUser ?>",
        room: "<?= $currentRoom ?>"
    };

    socket.emit('getCurrentUser', currentUser);

</script>