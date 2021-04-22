import {PrivateMessageAll} from "./PrivateMessageAll.js";

let Request = function (link){
    this.data = null;
    this.folder = link;
    this.link = document.location.toString() + "api/" + this.folder;
    this.xhr = new XMLHttpRequest();
}

Request.prototype.toJson = function(data){
    return JSON.stringify(data);
}

Request.prototype.send = function (){
    this.xhr.open('POST', this.link);
    this.xhr.setRequestHeader('Content-Type', 'application/json');
    this.xhr.send(this.toJson(this.data));
}

Request.prototype.get = function () {
    this.xhr.open("GET", this.link);
    this.xhr.setRequestHeader('Content-Type', 'application/json');
    this.xhr.send();
    this.xhr.onload = () => {
        let result = JSON.parse(this.xhr.responseText);
        if(this.folder === "privateMessage"){
            let privateMessageObj = new PrivateMessageAll();
            privateMessageObj.resetContent();
            privateMessageObj.appendToDOM(result);
        }
    };
}

Request.prototype.setData = function(data){
    this.data = data;
}

Request.prototype.resetData = function(){
    this.data = null;
}


export {Request};