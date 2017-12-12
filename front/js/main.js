
'use strict';

import User from './User/user.js';

$(function () {
    let socket = io('/');

    let user;

    socket.on('connect', function () {
        console.log("Connected");
    });

    /* ### USERNAME ### */
    $("#createUsername").on('click', () => {
        let username = prompt('Quel est le pseudo ?');
        socket.emit('createUsername', username);
    });

    socket.on('createUsername', (username, error) => {
        if (username) {
            user = new User(username);
            $('main').append('<h1>Username: ' + username + '</h1>');
            $('#listRoom').show();
            $("#createUsername").remove();
        }
        else {
            let otherUsername = prompt('Quel est le pseudo ? Erreur: ' + error);
            socket.emit('createUsername', otherUsername);
        }
    });

    /* ### ROOM ### */
    $("#createRoom").on('click', () => {
        if (user.canCreateRoom) {
            let roomName = prompt('Quel est le nom de la room ?');
            socket.emit('createRoom', roomName);
        }
    });

    socket.on('createRoom', (error) => {

        if (!error) {
            user.canCreateRoom = false;
            localStorage.setItem("user", JSON.stringify(user));
            $('table').show();
        } else {
            let otherRoomName = prompt('Quel est la room ? Erreur: ' + error);
            socket.emit('createRoom', otherRoomName);
        }
    });

    socket.on('updateListRoom', (listRoom) => {
        listRoom.map(room => {
            $('#listRoom').append('<li id="'+room.name+'"> ' + room.name + '</li>');
        });

        /* ### JOIN | ROOm ### */
        $('#listRoom').on('click', 'li', function() {
            console.log(this);
            var $room = $(this).attr('id');
            $('#currentRoom').text($room);
            socket.emit("joinRoom", $room);
        });
    });

    /* ### JOIN | PLAYER ### */
    $("#joinPlay").on('click', () => {

        if (user.inTeam === false) {
            socket.emit("joinPlay");
        } else {
            alert("You're already in a team");
        }
    });

    socket.on('joinPlay', (error, username, inTeam) => {
        if(!error){
            user.inTeam = inTeam;
            $('#listPlayer').append('<td>' + username + '</td>');
        } else {
            alert("You're already in a team");
        }
    });

    /* ### START | GAME ### */
    socket.on('completeRoom', (card) => {
        console.log(card);
    });


    /* ### GET INFO SERVER ### */
    $('main').on('click', '#infoUsers', function() { socket.emit("infoUsers"); });
    $('main').on('click', '#infoRooms', function() { socket.emit("infoRooms"); });

});