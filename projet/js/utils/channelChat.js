import {Request} from "../classes/Request.js";
import {MessageAll} from "../classes/MessageAll.js";
import {Users} from "../classes/Users.js";
import {sendMessageEvent} from "./sendMessageFunc.js"


let channelLink = document.querySelectorAll("#projet li > a")

let channelReqGet = new Request("channel/get.php", setChat);
let channelUserGet = new Request("channel/get.php",showUsers)

let chat = document.getElementById("showMessage");

const form = document.getElementById("sendMessageForm");
const submit = form.getElementsByTagName("input")[1];

let channelName = "loading";
let projectName = "loading";

let idFlag = 0
let scrollPostion;

//Show channel message when click on channel link
for(let link of channelLink){
    link.addEventListener("click", () =>{
        idFlag = link.dataset.id
        interval(idFlag);
        channelUserGet.resetLink();
        channelUserGet.link += "?action=users&id=" + idFlag;
        channelUserGet.get();
        chat.className = "channelMessage";

        let parent = link.parentNode.parentNode.parentNode.getElementsByTagName("h1")[0].innerText;
        channelName = parent + " => " + link.innerHTML;
    })
}

function interval(id){
    setTimeout(()=>{
        if(chat.className === "channelMessage" && idFlag === id){
            channelReqGet.resetLink();
            channelReqGet.link += "?action=see&channel=" + id;
            scrollPostion = chat.scrollTop;
            channelReqGet.get();
            sendMessageEvent("channelMessage","channel",id);
            interval(id);
        }
    },1000);
}


function setChat(data){
    let channel = new MessageAll();
    channel.resetContent();
    channel.setFirstContent("<div id='sendTo'>" + channelName + "</div>");
    channel.show(data);
    chat.scrollTop = scrollPostion;
}


function showUsers(data){
    let users = new Users();
    users.setData(data);
    users.show();
}