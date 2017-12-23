var _this = this;

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
    $(_this).addClass('selected');

    if ($(_this).hasClass('selected')) {
        $('.wrapper-section-rooms').show();
        $('.wrapper-friends').hide();
    } else {
        $('.wrapper-section-rooms').hide();
        $('.wrapper-friends').show();
    }
});

// Action lors du clique sur les titre de rooms sur la page de chat
$('.header-wrapper-rooms').on('click', () => {
    toggleList($(_this), '.rooms');
});

// Action lors du clique sur les titre des amis connectés sur la page de chat
$('.header-wrapper-friends').on('click', () => {
    toggleList($(_this), '.list-friends');
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

// Declare global variable selector

let $listConv = $('#listConv');
let $listFriend = $('#listFriends');
let $listMessage = $('#listMessage');
let $inputMessage = $('#message');

/* # Chat message # */

$('form').submit(e => {
    e.preventDefault();

    if ($inputMessage.hasClass('erreur-input')) {
        $('.tooltip').hide();
        $inputMessage.removeClass('erreur-input');
    }

    // error when empty input
    if ($inputMessage.val() === "") {
        $inputMessage.addClass('erreur-input');
        $('.tooltip').show();
    } else {
        if ($(_this).find('input[type="text"]').attr('data-name')) {
            socket.emit('sendMessage', $inputMessage.val(), $(_this).find('input[type="text"]').attr('data-name'));
        } else {
            socket.emit('sendMessage', $inputMessage.val());
        }
    }

    $inputMessage.val('');
    return false;
});

socket.on('sendMessage', msg => {

    let username = msg.username;

    if (msg.sender === 'user' && username === currentUser.username) {
        $listMessage.append($('<li class="current-user">').text(msg.content));
    } else {
        $listMessage.append($('<li><span aria-label="pseudo de l\'utilisateur">' + username + '</span>' + msg.content + '</li>'));
    }
});

// Receive history messages
socket.on('updateMessage', oldMsg => {

    oldMsg.forEach(function (msg) {
        if (msg.sender === currentUser.username) {
            $listMessage.append($('<li class="current-user">').text(msg.content));
        } else {
            $listMessage.append($('<li>').text(msg.sender + ' : ' + msg.content));
        }
    });
});

socket.on('cleanRoom', nameRoom => {
    $listMessage.empty();
    $('#nameRoom').text(nameRoom);
});

/* ### FRIEND ### */

// Listener click - Add friend
$("#listUsers").on("click", "li span", function () {
    let nameFriendAdded = $(this).parent().attr('data-name');
    socket.emit('askFriend', nameFriendAdded);
    console.log(nameFriendAdded);
});

// Update list friend
socket.on('askFriend', ask => {

    if (ask.type === "pending") {
        $listFriend.append('<li class="pending" data-name="' + ask.username + '">' + ask.username + '<span class="fa fa-times" data-action="delete" aria-label="Supprimer l\'amis"></span></li>');
    } else if (ask.type === "answer") {
        $listFriend.append('<li class="pending" data-name="' + ask.username + '">' + ask.username + '<span class="fa fa-check" data-action="accept" aria-label="Accepter l\'amis"></span><span class="fa fa-times" data-action="delete" aria-label="Supprimer l\'amis"></span></li>');
    }
});

$listFriend.on("click", "li span", function () {
    let nameUserAsk = $(this).parent().attr('data-name');

    if ($(this).attr('data-action') === "accept") {
        socket.emit('friendAccept', nameUserAsk);
    } else if ($(this).attr('data-action') === "delete") {
        socket.emit('friendDelete', nameUserAsk);
    }
});

// Update list friend
socket.on('updateAskFriend', response => {

    if (response.type === "accept") {
        $listFriend.find(`[data-name='${response.username}']`).removeClass('pending').addClass('friend-in');
        $listFriend.find(`[data-name='${response.username}']`).find("[data-action='accept']").remove();
        $listFriend.find(`[data-name='${response.username}']`).append('<span class="fa fa-envelope begin-conv">Conv</span>');
    } else if (response.type === "delete") {
        $listFriend.find(`[data-name='${response.username}']`).remove();
    }
});

/* ### ROOM ### */

// Lister click - Join room
$(".list-room").on("click", "li", function () {
    let roomSelected = $(this).attr('id');
    socket.emit('joinRoom', roomSelected);
});

// Update list user
socket.on('updateUser', listUser => {
    console.log(listUser);
    $('#listUsers').empty(); // clean list

    listUser.forEach(function (user) {
        console.log(user);
        if (user.username === currentUser.username) {
            $('#listUsers').append('<li class="current-user" data-name="' + user.username + '">' + '<span class="icon-user fa fa-user-circle-o" aria-label="Avatar de l\'utilisateur"></span>' + user.username + '</li>');
        } else if (user.type === "guest") {
            $('#listUsers').append('<li class="current-user" data-name="' + user.username + '">' + user.username + '</li>');
        } else {
            $('#listUsers').append('<li class="current-user" data-name="' + user.username + '">' + '<span title="Ajouter" class="fa fa-plus-circle" data-action="add" aria-label="Ajouter dans ma liste d\'amis"></span>' + '<span class="icon-user fa fa-user-circle-o" aria-label="Avatar de l\'utilisateur"></span>' + user.username + '</li>');
        }
    });
});

/* ### CHAT CONVERSATION ### */

$listFriend.on("click", "li .begin-conv", e => {

    let nameFriend = $(e.target).parent().attr('data-name');

    $listMessage.empty();
    $('#nameRoom').text(nameFriend);

    // Create tab only if it not exist
    if (!$listConv.find(`[data-name='${nameFriend}']`)) {
        $listConv.append('<li>' + nameFriend + '</li>');
    } else if ($listConv.find(`[data-name='${nameFriend}']`)) {
        $listConv.find(`[data-name='${nameFriend}']`).addClass('selected');
        $listConv.find(`[data-name='${nameFriend}']`).find('.badge').remove();
        socket.emit('open-conv', nameFriend);
    }

    $('form').find('input[type="text"]').attr('data-name', nameFriend);
});

socket.on('sendNotif', notif => {
    $listConv.append('<li>' + notif.username + '<span class="badge">' + notif.number + '</span></li>');
});
