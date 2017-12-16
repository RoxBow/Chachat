
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