
class ListUser {
    
    constructor() {
        this.list = [];
    }

    checkUsername(username){
        let usernameValid = true;

        this.list.forEach(user => {
            if(user.username.toLowerCase() === username.toLowerCase()){
                usernameValid = false;
            }
        });

        return usernameValid;
    }

    pushNewUser(user) {
        this.list.push(user);
    }

    findUser(id){
        this.list.forEach(user => {
            if(id === user.id){
                userFind = user;
            }
        });

        return userFind;
    }

    removeUser(user){
        
    }

}

module.exports = ListUser;


