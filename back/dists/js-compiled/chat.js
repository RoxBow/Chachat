var _this = this;

$('.header__icon').on('click', e => {
    e.preventDefault();
    $('body').toggleClass('with--sidebar');
});

$('.list-room li').on('click', function () {
    $('.list-room li.selected').removeClass('selected');
    $(this).addClass('selected');
});

// Action lors du clique sur les onglets de la page de chat
$('.onglet-rooms, .onglet-friends').on('click', () => {
    $('.selected', '.wrapper-onglets ul').removeClass('selected');
    $(_this).addClass('selected');

    if ($(_this).hasClass('selected')) {
        $('.wrapper-section-rooms').show();
        $('.wrapper-friends').hide();
    } else {
        $('.wrapper-friends').show();
        $('.wrapper-section-rooms').hide();
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

/* # Chat message # */

$('form').submit(e => {
    e.preventDefault();
    socket.emit('sendMessage', $('#message').val());
    $('#message').val('');
    return false;
});

$('li', '.list-room').on('click', function () {
    let roomSelected = $(this).attr('id');
    socket.emit('joinRoom', roomSelected);
});

socket.on('sendMessage', msg => {

    let username = msg.username;

    if (msg.sender === 'user' && username === currentUser.username) {
        $('#listMessage').append($('<li class="current-user">').text(msg.content));
    } else {
        $('#listMessage').append($('<li>').text(username + ' : ' + msg.content));
    }
});

// Receive all old messages
socket.on('updateMessage', oldMsg => {

    oldMsg.forEach(function (msg) {
        if (msg.sender === currentUser.username) {
            $('#listMessage').append($('<li class="current-user">').text(msg.content));
        } else {
            $('#listMessage').append($('<li>').text(msg.sender + ' : ' + msg.content));
        }
    });
});

socket.on('cleanRoom', nameRoom => {
    $('#listMessage').empty();
    $('#nameRoom').text(nameRoom);
});

// Add friend
$('li span', '#listUsers').on('click', function () {
    let nameFriendAdded = $(this).parent().attr('data-name');
    socket.emit('addFriend', nameFriendAdded);
});

socket.on('addFriend', ask => {
    if (ask.type === "pending") {
        $('#listFriends').append('<li data-name="' + ask.username + '">' + ask.username + ' <span data-actio="delete">Supprimer</span></li>');
    } else if (ask.type === "ask") {
        $('#listFriends').append('<li data-name="' + ask.username + '">' + ask.username + ' <span data-action="accept">Accepter</span><span data-action="delete">Supprimer</span></li>');
    }
});

socket.on('updateUser', listUser => {
    $('#listUsers').empty();

    listUser.forEach(function (user) {
        $('#listUsers').append('<li>' + user + '</li>');
    });
});
