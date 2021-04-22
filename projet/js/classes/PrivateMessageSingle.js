let PrivateMessageSingle = function(data){
    this.div = document.createElement("div");
    this.div.className = "singleMessageDiv";
    this.data = data;
}

PrivateMessageSingle.prototype.setContent = function(){
    this.div.innerHTML = `
        <div class="privateMessageContent">${this.data.message}</div>
    `;

}

//
export {PrivateMessageSingle};