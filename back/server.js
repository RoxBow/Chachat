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

let Room;

http.listen(3000, () => {
    console.log('listening on *:3000');

    db.query("SELECT pseudo FROM users", function (err, result) {
        if (err) throw err;
        Room = { name:"general", users: result, msg: []}
    });

});

// Load assets
app.use(express.static(path.join(__dirname, './dists')));

io.sockets.on('connection', (socket) => {

    // Send all old message to new connection user
    socket.emit('updateMessage', Room.msg);

    socket.on('getCurrentUser', (user) => {
        socket.username = user.username;
        socket.room = user.room;
        socket.broadcast.emit('sendMessage', { sender:'server', content: user.username+' a rejoin la room'});
    });

    socket.on('sendMessage', (msg) => {
        io.emit('sendMessage', { sender:'user', content: msg, username: socket.username});
        Room.msg.push({ sender: socket.username, content: msg, date: new Date() });
    });

    socket.on('disconnect', () => {
        console.log(socket.username+" -> disconnect")
    });

});

