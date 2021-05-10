import {MessageSingle} from "./MessageSingle.js";

let MessageAll = function(id){
    this.id = id;
    this.parent = document.getElementById("showMessage");
    this.data = null;
    this.child = [];
}

//Debug
MessageAll.prototype.show = function(data){
    for(let message of data){
        this.child.push(new MessageSingle(message));
    }
    for(let child of this.child){
        child.setContent();
        this.parent.append(child.div);
    }
}

MessageAll.prototype.resetContent = function(user){
    this.parent.innerHTML = "";
}

MessageAll.prototype.setFirstContent = function(content){
    this.parent.innerHTML = content;
}

export {MessageAll};