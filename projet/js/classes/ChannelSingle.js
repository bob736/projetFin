let ChannelSingle = function (id) {
    this.div = document.createElement("div");
    this.div.className = "channelSingle";

}

ChannelSingle.prototype.setData = function(data){
    this.data = data;
    this.div.dataset.id = data["id"];
}

ChannelSingle.prototype.addToDom = function(){
    this.div.innerHTML = "";
    this.div.innerHTML = `
        <h1 class="channelName">${this.data.name}</h1>    
    `
}

export {ChannelSingle};