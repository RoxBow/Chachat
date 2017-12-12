
class ListRoom {
    
    constructor() {
        this.list = [];
    }

    checkRoomName(roomName){
        let roomNameValid = true;

        this.list.forEach(room => {
            if(room.name.toLowerCase() === roomName.toLowerCase()){
                roomNameValid = false;
            }
        });

        return roomNameValid;
    }

    pushNewRoom(room) {
        this.list.push(room);
    }

    findRoom(roomName){
        let roomFind; 
        
        this.list.forEach(room => {
            if(roomName === room.name){
                roomFind = room;
            }
        });

        return roomFind;
    }

    removeUser(room){
        
    }

}

module.exports = ListRoom;


