let Req = function (link){
    this.data = null;
    this.link = link;
    this.xhr = new XMLHttpRequest();
    this.callback = null;
}

Req.prototype.toJson = function(data){
    return JSON.stringify(data);
}

Req.prototype.send = function (){
    this.xhr.open('POST', this.link);
    this.xhr.setRequestHeader('Content-Type', 'application/json');
    this.xhr.send(this.toJson(this.data));
}

Req.prototype.get = function () {
    if(!this.alreadyReq){
        this.alreadyReq = true;
        this.xhr.open("GET", this.link);
        this.xhr.setRequestHeader('Content-Type', 'application/json');
        this.xhr.send();
        this.xhr.onload = this.callback(this.xhr.responseText);
    }

}

Req.prototype.setData = function(data){
    this.data = data;
}

Req.prototype.setCallback = function(callback){
    this.callback = callback;
}


export {Req};