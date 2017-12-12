let express = require('express');
let app = express();
let http = require('http').Server(app);
let io = require('socket.io')(http);
let path = require('path');

let pathFile = 'front/';

app.use(express.static(path.join(__dirname, '../front')));

io.of('/').on('connection', function (socket) {
    
    socket.on('sendMessage', function (msg) {
        io.emit('sendMessage', msg);
    });
    
});

http.listen(3000, function () {
    console.log('listening on *:3000');
});