
let id = 0;

class Room {

    constructor(name, type, creator) {
        this.id = id++;
        this.name = name;
        this.type = type;
        this.creator = creator;
        this.state = "waiting";
        this.users = [creator];

        this.createTeam(type);
    }

    createTeam(type) {
        switch (type) {
            case '1v1':
                this.players = [];
                break;

            default:
                break;
        }
    }

    addPlayer(username){
        this.players.push(username);
        let complete = this.checkComplete();
        
        return complete;
    }

    getPlayers(){
        return this.players;
    }

    checkComplete(){
        if(this.players.length === 2){
            this.state = "complete";
            return true;
        }

        return false;
    }

    addUser(user){
        this.users.push(user);
    }

    getUsers(){
        return this.users;
    }

}

module.exports = Room;