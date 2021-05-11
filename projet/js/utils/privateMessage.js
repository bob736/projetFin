import {Request} from "../classes/Request.js";
import {MessageAll} from "../classes/MessageAll.js";
import {sendMessageEvent} from "./sendMessageFunc.js";

const privateMessageReqGet = new Request("privateMessage/get.php?", callback);
const userReqGet = new Request("user/get.php?", setUserPrivateMessageData)

const form = document.getElementById("sendMessageForm");
const submit = form.getElementsByTagName("input")[1];
let chat = document.getElementById("showMessage");

let scrollFlag = true;
let scrollPostion;

let user2 = null;
let userSet = false;
let user2name = "";

let icon = null;

//Set a event on every private chat links
let links = document.getElementsByClassName("chatLink");
for(let link of links){
    link.addEventListener("click", function(e){
        e.preventDefault();

        //set user2 to selected user's id
        user2 = link.dataset.id;
        userReqGet.resetLink();
        userReqGet.link += "user=" + user2;
        chat.className = "privateChat";
        userSet = false;
    })
}


//Time out to show private message between 2 users
function timeOutRecurePrivateMessage(){
    setTimeout(function(){
        if(user2 !== null && chat.className === "privateChat" ){
            if(!userSet){
                //reset request link to base api url set when object is created line.3
                privateMessageReqGet.resetLink();
                //Add user2 variable that correspond to the user2 id in the link of the api
                //So I open the api with url's parameters
                privateMessageReqGet.link += "user=" + user2.toString();
                userSet = true;
                setCloseButton();

            }

            //get private chat between user2
            privateMessageReqGet.get();

            //set a send message event on the input submit
            sendMessageEvent("privateChat","privateMessage", user2);
        }
        timeOutRecurePrivateMessage();
    },1000)
}

//Set an icon to hide the private chat
function setCloseButton(){
    //remove existing close button
    try{
        icon.parentNode.removeChild(icon);
    }
    catch(e){}

    //Create the button
    icon = document.createElement("div");
    icon.innerHTML = "<i id='closeButton' class=\"far fa-window-close\"></i>";
    icon.addEventListener("click", function(){
        document.getElementById("showMessage").innerHTML = "";
        //Set user2 to null so the private chat is not showed
        user2 = null;
        userSet = false;
        document.getElementById("chat").removeChild(this);

        //Remove the event of the send button when the chat get closed
        submit.removeEventListener("click", send);
        })
    document.getElementById("chat").append(icon)
}



//Callback of get() methode
function callback(result){
    try{
        scrollPostion = chat.scrollTop;
    }
    catch(e){}
    let privateChat = new MessageAll();
    privateChat.setFirstContent("<div id='sendTo'>" + user2name + "</div>");
    privateChat.show(result);
    userReqGet.get();
    //When the scollFlag is set to false , private chat div with scroll to the last message send
    chat.scrollTop = scrollPostion;

}

//Set placeholder of send message input to the selected user
function setUserPrivateMessageData(result){
    user2name = result.name;
    form.getElementsByTagName("input")[0].placeholder = "Envoyer un message a " + user2name;
}

timeOutRecurePrivateMessage();
