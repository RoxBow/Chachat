
class User {

	constructor(id, room, username) {
		this.id = id;
		this.room = room;
		this.username = username;
		this.inTeam = false;
	}

	joinRoom(socket, room) {
		this.room = room;
		socket.join(room);
	}

	getCurrentRoom() {
		
		//return Object.keys(socket.rooms)[1];
		return this.room;
	}

}

module.exports = User;