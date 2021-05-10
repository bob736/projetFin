import {MessageSingle} from "./MessageSingle.js";

let MessageAll = function(id){
    this.id = id;
    this.parent = document.getElementById("showMessage");
    this.parent.className = "channelMessage";
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
    this.parent.innerHTML = "<div id='sendTo'>" + user + "</div>";
}

export {MessageAll};