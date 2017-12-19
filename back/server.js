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

    // reset history on connect server
    listRooms = [];
    listUsers = [];

    let query = `UPDATE users SET login = '0'`;
    db.query(query, function (err) {
        if (err) throw err;
    });


    db.query("SELECT nom FROM rooms", function (err, result) {
        if (err) throw err;
        result.forEach(function(room) {
            listRooms.push({ name: room.nom, msg: [] })
        });
    });

});

// Load assets
app.use( express.static(path.join(__dirname, './dists')) );

io.sockets.on('connection', (socket) => {

    socket.on('getCurrentUser', (user) => {

        let historyMsg = getHistoryMsg(user.room);

        socket.username = user.username;
        socket.room = user.room;
        socket.type = user.type;
        socket.join(user.room);
        socket.emit('cleanRoom', user.room);

        // Create a user
        findOrCreateUser(socket.id, user.username, socket.type);

        // Send new list user to client
        io.emit('updateUser', listUsers);

        // Send all old message to new connection user
        // if room got message
        if(historyMsg){
            socket.emit('updateMessage', historyMsg);
        }
    });

    socket.on('sendMessage', (msg, receiver) => {

        if(receiver){
            let lengthConv = 0;
            let idReceiver = findUser(receiver);

            listUsers.forEach(function(user) {
                if(user.username === socket.username && user.username === receiver){
                    user.conversation.push({ sender: socket.username, content: msg, date: new Date() });
                    lengthConv = user.conversation.length;
                }
            });

            socket.emit('sendMessage', { sender:'user', content: msg, username: socket.username});
            socket.broadcast.to(idReceiver).emit('sendNotif', { username: socket.username, number: lengthConv });

        } else {
            io.sockets.in(socket.room).emit('sendMessage', { sender:'user', content: msg, username: socket.username});
            registerMsg(socket, socket.room, msg);
        }

    });

    socket.on('joinRoom', (room) => {

        let historyMsg = getHistoryMsg(room);
        socket.room = room;
        socket.join(room);
        socket.emit('cleanRoom', room);

        if(historyMsg){
            socket.emit('updateMessage', historyMsg);
        }
    });

    /* ### Friend ### */
    socket.on('askFriend', (friendAdded) => {
        let query = `INSERT INTO friends (firstUser, secondUser) VALUES ('${socket.username}', '${friendAdded}')`;
        let friendId = findUser(friendAdded);

        db.query(query, (err) => {
            if (err) throw err;

            socket.emit('askFriend', { type:'pending', username: friendAdded });
            socket.broadcast.to(friendId).emit('askFriend', { type:'answer', username: socket.username } );
        });

    });

    // Answer accept friend
    socket.on('friendAccept', (friend) => {
        let query = `UPDATE friends SET state = 'accepted' WHERE firstUser = '${friend}' AND secondUser = '${socket.username}' `;

        let idFriend = findUser(friend);

        db.query(query, (err) => {
            if (err) throw err;
            socket.emit('updateAskFriend', { type:'accept', username: friend });
            socket.broadcast.to(idFriend).emit('updateAskFriend', { type:'accept', username: socket.username } );
        });
    });

    // Answer refuse friend
    socket.on('friendDelete', (friend) => {
        let query = ` DELETE FROM friends WHERE firstUser = '${friend}' OR firstUser = '${socket.username}' `;
        let idFriend = findUser(friend);

        db.query(query, (err) => {
            if (err) throw err;

            socket.emit('updateAskFriend', { type:'delete', username: friend });
            socket.broadcast.to(idFriend).emit('updateAskFriend', { type:'delete', username: socket.username } );
        });
    });

    /* ### CONVERSATION ### */

    socket.on('open-conv', () => {

        let conversation = null;

        listUsers.forEach(function(user) {
            if(user.username === socket.username){
                if(user.conversation){
                    conversation = user.conversation;
                }
            }
        });

        socket.emit('updateMessage', conversation);
        console.log("conversation: ",conversation);
    });

    socket.on('disconnect', () => {
        console.log(socket.username+" -> disconnect");
        let query = `UPDATE users SET login = '0' WHERE pseudo = '${socket.username}' `;

        // Send new list user
        io.emit('updateUser', listUsers);

        db.query(query, function (err) {
            if (err) throw err;
        });
    });

});

function registerMsg(socket, roomUser, msg) {
    let finded = false;

    listRooms.forEach( (room) => {
        // get current room of socket
        if(roomUser === room.name){
            finded = true;
            room.msg.push({ sender: socket.username, content: msg, date: new Date() });
        }
    });

    // If room doesn't exist in listRoom
    if(!finded){
        let newRoom = { name: roomUser, msg: [] };
        newRoom.msg.push({ sender: socket.username, content: msg, date: new Date() });
        listRooms.push(newRoom);
    }
}

// Return old message depends of room
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

// Return socket.id with parameter username
function findUser(username) {
    let socketIdFind = null;

    listUsers.forEach(function(user) {
        if(user.username === username){
            socketIdFind = user.id;
        }
    });

    return socketIdFind;
}

function findOrCreateUser(socketId, username, socketType) {
    let userFinded = null;

    listUsers.forEach(function(user) {
        if(user.username === username){
            userFinded = true;
        }
    });

    // If user doesn't exist then create it
    if(!userFinded){
        let User = { id: socketId, username: username, conversation: [], type: socketType };
        listUsers.push(User);
    }
}