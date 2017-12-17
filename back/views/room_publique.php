<div class="site-pusher">
        <header class="header">
            <a href="#" class="header__icon"></a>
            <div class="wrapper-header">
                <div class="wrapper-header-input">
                    <input type="text" name="Rechercher" id="rechercher" placeholder="Rechercher"/>
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
                <i class="fa fa-cog" aria-hidden="true"></i>
            </div>
            <nav class="menu">
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
                                <li><a href="#">Général</a></li>
                                <li><a href="#">Discussion</a></li>
                                <li><a href="#">Actu</a></li>
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
                                <li><a href="#">Elmarino</a></li>
                                <li><a href="#">Vince</a></li>
                                <li><a href="#">Bendo</a></li>
                                <li><a href="#">Dylan</a></li>
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
            </nav>
        </header>

        <div class="site-content">
            <div class="container">
                <div class="wrapper-chat">
                     <div class="wrapper-area-chat">
                        <ul id="message-chat">
                            <li class="user-connected">Hello</li>
                            <li>Ca va ?</li>
                            <li class="message-connection">Pseudo vient de se connecter</li>
                            <li class="user-connected">Très bien et toi ?</li>
                            <li class="user-connected">Très bien et toi ?</li>
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
            </div>
        </div>
    </div>

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