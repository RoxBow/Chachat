let express = require('express');
let app = express();
let http = require('http').Server(app);
let io = require('socket.io')(http);
let path = require('path');

// Load assets
app.use(express.static(path.join(__dirname, './dists')));

io.of('/').on('connection', function (socket) {

    socket.on('getCurrentUser', function (username) {
        socket.username = username;
        socket.broadcast.emit('sendMessage', { sender:'server', content: username+' a rejoin la room'});
    });

    socket.on('sendMessage', function (msg) {
        io.emit('sendMessage', { sender:'user', content: msg, username: socket.username});
    });

});

http.listen(3000, function () {
    console.log('listening on *:3000');
});