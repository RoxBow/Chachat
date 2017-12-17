<main class="wrapper-page-room">
    <section class="section-room-friends">
        <div class="wrapper-onglets">
            <ul>
                <li class="onglet-rooms selected"><a href="#">Salons</a></li>
                <li class="onglet-friends"><a href="#">Amis</i></a></li>
            </ul>
        </div>

        <div class="wrapper-section-rooms">
            <div class="wrapper-rooms">
                <div class="header-wrapper-rooms selected">
                    <h2 class="title-room">Room public</h2>
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </div>
                
                <ul class="rooms public-room">
                    <li><a href="#">Despacito</a></li>
                    <li><a href="#">Despacito</a></li>
                    <li><a href="#">Despacito</a></li>
                    <li><a href="#">Despacito</a></li>
                </ul>
            </div>
            

            <div class="wrapper-rooms">
                <div class="header-wrapper-rooms selected">
                    <h2 class="title-room">Room private</h2>
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </div>
                <ul class="rooms private-room"> 
                    <li><a href="#">Despacito</a></li>
                    <li><a href="#">Despacito</a></li>
                    <li><a href="#">Despacito</a></li>
                    <li><a href="#">Despacito</a></li>
                </ul>
            </div>

            <div class="wrapper-rooms">
                <div class="header-wrapper-rooms selected">
                    <h2 class="title-room">Room private message</h2>
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </div>
                <ul class="rooms private-message-room">
                    <li><a href="#">Despacito</a></li>
                    <li><a href="#">Despacito</a></li>
                    <li><a href="#">Despacito</a></li>
                    <li><a href="#">Despacito</a></li>
                </ul>
            </div>
        </div>

        <div class="wrapper-friends">
            <div class="wrapper-online-friends">
                <div class="header-wrapper-friends selected">
                    <h2 class="title-online">Amis en ligne</h2>
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </div>
                <ul class="list-friends list-online-friends">
                    <li><a href="#">Despacito</a></li>
                    <li><a href="#">Despacito</a></li>
                    <li><a href="#">Despacito</a></li>
                    <li><a href="#">Despacito</a></li>
                </ul>
            </div>

            <div class="wrapper-offline-friends">
                <div class="header-wrapper-friends selected">
                    <h2 class="title-offline">Amis hors-ligne</h2>
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </div>
                <ul class="list-friends list-offline-friends">
                    <li><a href="#">Despacito</a></li>
                    <li><a href="#">Despacito</a></li>
                    <li><a href="#">Despacito</a></li>
                    <li><a href="#">Despacito</a></li>
                </ul>
            </div>
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

        <div class="wrapper-chat">
            <div class="wrapper-area-chat">
                <ul id="message-chat">
                    <li class='user-connected'>Hello</li>
                    <li>Ca va ?</li>
                    <li class='user-connected'>Très bien et toi ?</li>
                    <li class='user-connected'>Très bien et toi ?</li>
                    <li>Excellent !</li>
                </ul>

                <form>
                    <input type="text" id="m">
                    <input type="submit" value="Envoyer">
                </form>
            </div>

            <div class="wrapper-game">
                <h2>SECTION JEUX SECTION JEUX SECTION JEUX SECTION JEUX SECTION JEUX</h2>
            </div>
        </div>

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