let express = require('express');
let app = express();
let http = require('http').Server(app);
let io = require('socket.io')(http);
let path = require('path');
let mysql = require('mysql');


let db = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "root",
    database : "chat",
    port: "8889" // port mysql
});

db.connect( (err) => {
    if (err) throw err;
    console.log("Database::connected");
});

let listRooms, listUsers;

http.listen(3000, () => {
    console.log('listening on *:3000');

    db.query("SELECT pseudo FROM users", function (err, result) {
        if (err) throw err;
    });

    // reset history on connect server
    listRooms = [];
    listUsers = [];

});

// Load assets
app.use(express.static(path.join(__dirname, './dists')));

io.sockets.on('connection', (socket) => {

    socket.on('getCurrentUser', (user) => {
        let historyMsg = getHistoryMsg(user.room);

        socket.username = user.username;
        socket.room = user.room;
        socket.join(user.room);
        socket.emit('cleanRoom', user.room);

        let User = { id: socket.id ,username: user.username };
        listUsers.push(User);

        // Send all old message to new connection user
        // if room got message
        if(historyMsg){
            console.log(historyMsg);
            socket.emit('updateMessage', historyMsg);
        }
    });

    socket.on('sendMessage', (msg) => {
        //io.emit('sendMessage', { sender:'user', content: msg, username: socket.username});
        //Room.msg.push({ sender: socket.username, content: msg, date: new Date() });

        io.sockets.in(socket.room).emit('sendMessage', { sender:'user', content: msg, username: socket.username});
        registerMsg(socket, socket.room, msg);
    });

    socket.on('joinRoom', (room) => {
        socket.room = room;
        socket.join(room);
        socket.emit('cleanRoom', room);
    });

    socket.on('addFriend', (userAdded) => {
        let query = `INSERT INTO friends (firstUser, secondUser) VALUES (${socket.username}, ${userAdded})`;
        let userAddedId = findUser(userAdded);

        db.query(query, (err) => {
            if (err) throw err;
            console.log(socket.username +" add "+userAdded +" as friend");
        });

        socket.emit('addFriend', { type:'pending', username: userAdded });
        io.sockets.socket(userAddedId).emit('addFriend', { type:'ask', username: socket.username } );
    });


    socket.on('disconnect', () => {
        console.log(socket.username+" -> disconnect");
    });

});

function registerMsg(socket, roomUser, msg) {
    let finded = false;

    listRooms.forEach( (room) => {
        // get current room of socket
        if(roomUser === room.name){
            finded = true;
            room.msg.push( { sender: socket.username, content: msg, date: new Date() } );
        }
    });

    // If room doesn't exist in listRoom
    if(!finded){
        let newRoom = { name: roomUser, msg: [] };
        newRoom.msg.push({ sender: socket.username, content: msg, date: new Date() });
        listRooms.push(newRoom);
    }
}

function getHistoryMsg(roomUser) {
    let allMsg = null;

    listRooms.forEach( (room) => {
        if(roomUser === room.name){
            allMsg = room.msg;
            return false;
        }
    });

    return allMsg;
}


function findUser(username) {
    let socketIdFind = null;

    listUsers.forEach(function(user) {
        if(user.username === username){
            socketIdFind = user.id;
        }
    });

    return socketIdFind;
}