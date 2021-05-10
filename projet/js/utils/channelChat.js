import {Request} from "../classes/Request.js";
import {MessageAll} from "../classes/MessageAll.js";
import {sendMessageEvent} from "./sendMessageFunc.js"


let channelLink = document.querySelectorAll("#projet li > a")
let channelReqGet = new Request("channel/get.php", callback);
let chat = document.getElementById("showMessage");

const form = document.getElementById("sendMessageForm");
const submit = form.getElementsByTagName("input")[1];

//Show channel message when click on channel link
for(let link of channelLink){
    link.addEventListener("click", () =>{
        interval(link.dataset.id);
        chat.className = "channelMessage";
    })
}

function interval(id){
    setTimeout(()=>{
        if(chat.className === "channelMessage"){
            channelReqGet.resetLink();
            channelReqGet.link += "?action=see&channel=" + id;
            channelReqGet.get();
            sendMessageEvent("channelMessage");
            interval(id);
        }
    },1000);
}


function callback(data){
    let channel = new MessageAll(data);
    channel.resetContent();
    channel.setFirstContent("<div id='sendTo'>" +  + "</div>")
    channel.show(data);
}