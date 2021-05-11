import {Request} from "../classes/Request.js";
import {MessageAll} from "../classes/MessageAll.js";
import {sendMessageEvent} from "./sendMessageFunc.js"


let channelLink = document.querySelectorAll("#projet li > a")

let channelReqGet = new Request("channel/get.php", setChat);
let channelUserGet = new Request("channel/get.php",showUsers)

let chat = document.getElementById("showMessage");

const form = document.getElementById("sendMessageForm");
const submit = form.getElementsByTagName("input")[1];

let idFlag = 0

//Show channel message when click on channel link
for(let link of channelLink){
    link.addEventListener("click", () =>{
        interval(link.dataset.id);
        chat.className = "channelMessage";
        idFlag = link.dataset.id
    })
}

function interval(id){
    setTimeout(()=>{
        if(chat.className === "channelMessage" && idFlag === id){
            channelReqGet.resetLink();
            channelReqGet.link += "?action=see&channel=" + id;
            channelReqGet.get();
            sendMessageEvent("channelMessage","channel",id);
            interval(id);
        }
    },1000);
}


function setChat(data){
    let channel = new MessageAll();
    channel.resetContent();
    channel.show(data);
}

function showUsers(data){
}