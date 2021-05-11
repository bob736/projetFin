import {SendMessage} from "../classes/sendMessage.js";

//Create an event on submit form element
function sendMessageEvent(chatClasse,api, data = null,){
    let submit = document.querySelector("#sendMessageForm input[type=submit]");
    let chat = document.getElementById("showMessage");

    //Remove all event on the submit button
    let submitClone = submit.cloneNode(true);
    submit.parentNode.replaceChild(submitClone,submit);
    if(chat.className === chatClasse) {
        submitClone.addEventListener("click",  sendMessageFunction.bind(event,data,api));
    }
}
//Create a sendMessage object that will send the value of the form input element
function sendMessageFunction(data,api){
    let form = document.querySelector("#sendMessageForm form");
    let input = form.getElementsByTagName("input")[0];
    let message = input.value;

    //Check if the message isn't empty
    if (message.length > 0) {
        let send = new SendMessage(api);
        let obj = {"message" : message};

        //If a user is specified (case of private message) then i set a new property to the data object
        if(data !== null){
            obj["data"] = data;
        }
        send.setData(obj);
        send.send();
    }
}

export {sendMessageEvent, sendMessageFunction};