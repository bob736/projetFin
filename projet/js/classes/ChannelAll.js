let ChannelAll = function(id){
    this.parent = document.getElementById("channels");
    this.parent.dataset.id = id;
    this.childs = [];
}

ChannelAll.prototype.showAll = function(){
    this.parent.innerHTML = '';
    for(let child of this.childs){
        this.parent.appendChild(child.div);
    }
}

export {ChannelAll}