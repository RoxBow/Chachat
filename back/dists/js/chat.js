// Action lors du clique sur les onglets de la page de chat
$('.onglet-rooms, .onglet-friends').on('click', function () {
    $('.wrapper-onglets ul li.selected').removeClass('selected');
    $(this).addClass('selected');

    if ($(this).attr('class') == "onglet-rooms selected") {
        $('.wrapper-section-rooms').show();
        $('.wrapper-friends').hide();
    }
    else {
        $('.wrapper-friends').show();
        $('.wrapper-section-rooms').hide();
    }
});

// Action lors du clique sur les titre de rooms sur la page de chat
$('.header-wrapper-rooms').on('click', function () {
    if ($(this).attr('class') == "header-wrapper-rooms selected") {
        $(this).removeClass('selected');
        $(this).children().removeClass('fa-chevron-down').addClass('fa-chevron-up');
        $(this).next('.rooms').hide();
    } else {
        $(this).addClass('selected');
        $(this).children().removeClass('fa-chevron-up').addClass('fa-chevron-down');
        $(this).next('.rooms').show();
    }
});

// Action lors du clique sur les titre des amis connectés sur la page de chat
$('.header-wrapper-friends').on('click', function () {
    if ($(this).attr('class') == "header-wrapper-friends selected") {
        $(this).removeClass('selected');
        $(this).children().removeClass('fa-chevron-down').addClass('fa-chevron-up');
        $(this).next('.list-friends').hide();
    } else {
        $(this).addClass('selected');
        $(this).children().removeClass('fa-chevron-up').addClass('fa-chevron-down');
        $(this).next('.list-friends').show();
    }
});

$('form').submit(function (e) {
    e.preventDefault();
    socket.emit('sendMessage', $('#m').val());
    $('#m').val('');
    return false;
});

socket.on('sendMessage', function (msg) {
    var username = msg.username;

    if(msg.sender === 'server'){
        $('#message-chat').append($('<li style="color:red">').text(msg.content));
    } else if(msg.sender === 'user'){
        $('#message-chat').append($('<li style="color:white">').text(username+' : '+msg.content));
    }
});