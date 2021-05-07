let PrivateMessageSingle = function(data){
    this.div = document.createElement("div");
    this.div.className = "singleMessageDiv";
    this.data = data;
    this.classe = "receive";
}

PrivateMessageSingle.prototype.setClasse = function(){
    if(this.data.sent){
        this.classe = "sent";
    }
}

//set Content of single private message
PrivateMessageSingle.prototype.setContent = function(){
    this.setClasse();
    this.div.innerHTML = `
    <div class="privateMessageContent ${this.classe}">
        <div class="data">
            <div class="pseudo">${this.data.pseudo}</div>
            <div class="date">${this.data.date}</div>
        </div>
        <div class="text">${this.data.message}</div>
    </div>
    `;
}

export {PrivateMessageSingle};