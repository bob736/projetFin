let Request = function (link, callback, parentObject = null){
    this.data = null;
    this.folder = link;
    this.link = null;
    this.xhr = new XMLHttpRequest();
    this.folderCorrect = false;
    this.onload = callback;
    this.parentObject = parentObject;
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
        if(!this.folderCorrect){
            this.folderCorrected = this.folder.split("/");
            this.folderCorrected  = this.folderCorrected [this.folderCorrected .length - 2];
            this.folderCorrect = true;
        }
        this.onload(result);
    };
}

Request.prototype.setData = function(data){
    this.data = data;
}

Request.prototype.resetData = function(){
    this.data = null;
}


Request.prototype.resetLink = function(){
    this.link =  "/api/";
    this.link += this.folder;
}

export {Request};