let ChannelSingle = function (id) {
    this.div = document.createElement("div");
    this.div.className = "channelSingle";
    this.div.dataset.id = id;
}

ChannelSingle.prototype.setData = function(data){
    this.data = data;
}

ChannelSingle.prototype.addToDom = function(){
    this.div.innerHTML = "";
    this.div.innerHTML = `
        <h1 class="channelName">${this.data.name}</h1>    
    `
}

export {ChannelSingle};