import {SendMessage} from "../classes/sendMessage.js";

function sendMessageEvent(chatClasse,user = null){
    let submit = document.querySelector("#sendMessageForm input[type=submit]");
    let chat = document.getElementById("showMessage");
    submit.removeEventListener("click", sendMessageFunction);
    if(chat.className === chatClasse) {
        submit.addEventListener("click",  sendMessageFunction);
    }
}

function sendMessageFunction(){
    let form = document.querySelector("#sendMessageForm form");
    let input = form.getElementsByTagName("input")[0];
    let message = input.value;
    if (message.length > 0) {
        let send = new SendMessage("channel");
        let data = {"message" : message}
        if(user !== null){
            data["user"] = user;
        }
        send.setData(data);
        send.send();
    }
}

export {sendMessageEvent};