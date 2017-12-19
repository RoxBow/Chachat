// Ajout la classe 'selected' lorsque l'on clique sur un des salon
$('.list-room li').on('click', function () {
    $('.list-room li.selected').removeClass('selected');
    $(this).addClass('selected');
});

// Ajoute la classe 'selected' quand on clique sur un onglet privé
$('.onglets-prives ul li').on('click', function () {
    $('.onglets-prives ul li').removeClass('selected');
    $(this).addClass('selected');
});

// Supprime l'onglet privé quand on clique sur la croix
$('.onglets-prives ul li span').on('click', function () {
    $(this).parent().remove();
});

// Action lors du clique sur les onglets de la page de chat
$('.onglet-rooms, .onglet-friends').on('click', () => {
    $('.selected', '.wrapper-onglets ul').removeClass('selected');
    $(this).addClass('selected');

    if ($(this).hasClass('selected')) {
        $('.wrapper-section-rooms').show();
        $('.wrapper-friends').hide();
    }
    else {
        $('.wrapper-section-rooms').hide();
        $('.wrapper-friends').show();
    }
});

// Action lors du clique sur les titre de rooms sur la page de chat
$('.header-wrapper-rooms').on('click', () => {
    toggleList($(this), '.rooms');
});

// Action lors du clique sur les titre des amis connectés sur la page de chat
$('.header-wrapper-friends').on('click', () => {
    toggleList($(this), '.list-friends');
});

function toggleList($el, $list) {
    if ($el.hasClass('selected')) {
        $el.removeClass('selected');
        $el.find('.fa').removeClass('fa-chevron-down').addClass('fa-chevron-up');
        $el.next($list).hide();
    } else {
        $el.addClass('selected');
        $el.find('.fa').removeClass('fa-chevron-up').addClass('fa-chevron-down');
        $el.next($list).show();
    }
}

/* # Chat message # */

$('form').submit((e) => {
    e.preventDefault();
    socket.emit('sendMessage', $('#message').val());
    $('#message').val('');
    return false;
});

socket.on('sendMessage', (msg) => {

    let username = msg.username;

    if (msg.sender === 'user' && username === currentUser.username) {
        $('#listMessage').append($('<li class="current-user">').text(msg.content));
    } else {
        $('#listMessage').append($('<li>').text(username + ' : ' + msg.content));
    }
});

// Receive history messages
socket.on('updateMessage', (oldMsg) => {

    oldMsg.forEach(function (msg) {
        if (msg.sender === currentUser.username) {
            $('#listMessage').append($('<li class="current-user">').text(msg.content));
        } else {
            $('#listMessage').append($('<li>').text(msg.sender + ' : ' + msg.content));
        }
    });
});

socket.on('cleanRoom', (nameRoom) => {
    $('#listMessage').empty();
    $('#nameRoom').text(nameRoom);
});

/* ### FRIEND ### */

// Listener click - Add friend
$("#listUsers").on("click", "li span", function(){
    let nameFriendAdded = $(this).parent().attr('data-name');
    console.log($(this));
    socket.emit('askFriend', nameFriendAdded);
});

// Update list friend
socket.on('askFriend', (ask) => {

    if(ask.type === "pending"){
        $('#listFriends').append('<li class="pending" data-name="'+ask.username+'">'+ask.username+' <span data-action="delete">Supprimer</span></li>');
    } else if (ask.type === "answer"){
        $('#listFriends').append('<li class="pending" data-name="'+ask.username+'">'+ask.username+' <span data-action="accept">Accepter</span><span data-action="delete">Supprimer</span></li>');
    }
});

$("#listFriends").on("click", "li span", function(){
    let nameUserAsk = $(this).parent().attr('data-name');

    if($(this).attr('data-action') === "accept"){
        socket.emit('friendAccept', nameUserAsk);
    } else if($(this).attr('data-action') === "delete"){
        socket.emit('friendDelete', nameUserAsk);
    }
});


// Update list friend
socket.on('updateAskFriend', (response) => {

    if(response.type === "accept"){
        $('#listFriends').find(`[data-name='${response.username}']`).removeClass('pending').addClass('friend-in');
        $('#listFriends').find(`[data-name='${response.username}']`).find("[data-action='accept']").remove();
    } else if (response.type === "delete"){
        $('#listFriends').find(`[data-name='${response.username}']`).remove();
    }
});

/* ### ROOM ### */


// Lister click - Join room
$(".list-room").on("click", "li", function(){
    let roomSelected = $(this).attr('id');
    socket.emit('joinRoom', roomSelected);
});

// Update list user
socket.on('updateUser', (listUser) => {
    console.log(listUser);
    $('#listUsers').empty(); // clean list

    listUser.forEach(function(user) {
        if(user.username === currentUser.username){
            $('#listUsers').append('<li class="current-user" data-name="'+user.username+'">' +
                '<span class="icon-user fa fa-user-circle-o" aria-label="Avatar de l\'utilisateur"></span>'
                + user.username +'</li>');
        } else {
            $('#listUsers').append('<li class="current-user" data-name="'+user.username+'">' +
                '<span title="Ajouter" class="fa fa-plus-circle" data-action="add" aria-label="Ajouter dans ma liste d\'amis"></span>' +
                '<span class="icon-user fa fa-user-circle-o" aria-label="Avatar de l\'utilisateur"></span>' + user.username +'</li>');
        }
    });
});
