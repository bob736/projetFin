let ChannelAll = function(id){
    this.id = id;
    this.parent = document.getElementById("channels");
    this.childs = [];
}

ChannelAll.prototype.showAll = function(){
    this.parent.innerHTML = '';
    for(let child of this.childs){
        this.parent.appendChild(child.div);
    }
}

export {ChannelAll}