let express = require('express');
let app = express();
let http = require('http').Server(app);
let io = require('socket.io')(http);
let path = require('path');

let pathFile = 'front/';

app.use(express.static(path.join(__dirname, '../front')));

/* Modules imported */
const Room = require('./Room/room');
const Cards = require('./Cards/cards');
const ListUser = require('./ListUser/listUser');
const ListRoom = require('./ListRoom/listRoom');

app.get('/', function (req, res) {
    res.sendFile('index.html', { root: pathFile });
});

let allUser, allRoom;

http.listen(3000, function () {
    console.log('listening on *:3000');
    
    allUser = new ListUser();
    allRoom = new ListRoom();
});

io.of('/').on('connection', function (socket) {
    let user, room, cards;
    socket.join('Waiting room');

    /* ### REGISTER USERNAME ### */
    socket.on('createUsername', (username) => {

        // if it's first user don't check
        let usernameValidate = allUser.list.length === 0 ? true : allUser.checkUsername(username);

        if (usernameValidate) {
            user = new User(socket.id, Object.keys(socket.rooms)[1], username);
            allUser.pushNewUser(user);
            socket.emit('createUsername', username);
            socket.emit('updateListRoom', allRoom.list);
        } else {
            socket.emit('createUsername', false, 'Already used');
        }
    });

    /* ### CREATE ROOM ### */
    socket.on('createRoom', (roomName) => {
        
    });

    /* ### JOIN ROOM ### */
    socket.on('joinRoom', (roomName) => {
    
    });

});