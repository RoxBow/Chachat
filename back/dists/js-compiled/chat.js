// Action lors du clique sur les onglets de la page de chat
$('.onglet-rooms, .onglet-friends').on('click', function () {
    $('.selected', '.wrapper-onglets ul').removeClass('selected');
    $(this).addClass('selected');

    if ($(this).hasClass('selected')) {
        $('.wrapper-section-rooms').show();
        $('.wrapper-friends').hide();
    } else {
        $('.wrapper-friends').show();
        $('.wrapper-section-rooms').hide();
    }
});

// Action lors du clique sur les titre de rooms sur la page de chat
$('.header-wrapper-rooms').on('click', function () {
    toggleList($(this), '.rooms');
});

// Action lors du clique sur les titre des amis connectés sur la page de chat
$('.header-wrapper-friends').on('click', function () {
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

$('form').submit(function (e) {
    e.preventDefault();
    socket.emit('sendMessage', $('#m').val());
    $('#m').val('');
    return false;
});

socket.on('sendMessage', function (msg) {

    let username = msg.username;

    if (msg.sender === 'server') {
        $('#message-chat').append($('<li style="color:#fff">').text(msg.content));
    } else if (msg.sender === 'user' && username === currentUser.username) {
        $('#message-chat').append($('<li class="user-connected">').text(msg.content));
    } else {
        $('#message-chat').append($('<li>').text(username + ' : ' + msg.content));
    }
});

// Receive all old message
socket.on('updateMessage', function (oldMsg) {

    oldMsg.forEach(function (msg) {
        $('#message-chat').append($('<li>').text(msg.sender + ' : ' + msg.content));
    });
});
