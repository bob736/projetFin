import {PrivateMessageSingle} from "./PrivateMessageSingle.js";

let PrivateMessageAll = function(){
    this.div = document.createElement("div");
    this.div.className = "privateMessage";
    this.parent = document.getElementById("showMessage");
    //childs are PrivateMessageSingle Object
    this.child = [];
}

//Append to parent div to be showed it the page
PrivateMessageAll.prototype.appendToDOM = function(data){
    for(let message of data){
        this.child.push(new PrivateMessageSingle(message));
    }
    for(let child of this.child){
        child.setContent();
        this.parent.append(child.div);
    }
}

PrivateMessageAll.prototype.resetContent = function(user){
    this.parent.innerHTML = "<div id='sendTo'>" + user + "</div>";
}

export {PrivateMessageAll};