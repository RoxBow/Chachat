var socket = io('http://localhost:3000');

$('form').submit(function () {
    socket.emit('sendMessage', $('#m').val());
    $('#m').val('');
    return false;
});

socket.on('sendMessage', function (msg) {
    $('#messages').append($('<li>').text(msg));
});