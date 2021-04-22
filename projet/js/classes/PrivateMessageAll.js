import {PrivateMessageSingle} from "./PrivateMessageSingle.js";

let PrivateMessageAll = function(){
    this.div = document.createElement("div");
    this.div.className = "privateMessage";
    this.parent = document.getElementById("showMessage");
    this.child = [];
}

PrivateMessageAll.prototype.appendToDOM = function(data){
    console.log(data);
    for(let message of data){
        this.child.push(new PrivateMessageSingle(message));
    }
    for(let child of this.child){
        child.setContent();
        this.parent.append(child.div);
    }
}

PrivateMessageAll.prototype.resetContent = function(){
    this.parent.innerHTML = "";
}

export {PrivateMessageAll};