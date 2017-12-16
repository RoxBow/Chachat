let express = require('express');
let app = express();
let http = require('http').Server(app);
let io = require('socket.io')(http);
let path = require('path');

// Load assets
app.use(express.static(path.join(__dirname, './dists')));

io.sockets.on('connection', function (socket) {
    let date = new Date();
    console.log(date);

    socket.on('getCurrentUser', function (user) {
        socket.username = user.username;
        socket.room = user.room;
        socket.broadcast.emit('sendMessage', { sender:'server', content: user.username+' a rejoin la room'});
    });

    socket.on('sendMessage', function (msg) {
        io.emit('sendMessage', { sender:'user', content: msg, username: socket.username});
    });

    socket.on('disconnect', function(){
        console.log(socket.username+" -> disconnect")
    });

});

http.listen(3000, function () {
    console.log('listening on *:3000');
});