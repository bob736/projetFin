import {Request} from "../classes/Request.js";
import {ChannelAll} from "../classes/ChannelAll.js";
import {ChannelSingle} from "../classes/ChannelSingle.js";
import {MessageAll} from "../classes/MessageAll.js";
import {sendMessageEvent} from "./sendMessageFunc.js";

let reqGet = new Request("channel/get.php", showChannel);
let channelReqGet = new Request("channel/get.php", setChat);

let projects = document.querySelectorAll(".projetCont h1");
let chat = document.getElementById("showMessage");

let scrollPosition;
let idFlag = -1;

for(let project of projects){
    project.addEventListener("click", () => {
        reqGet.resetLink();
        reqGet.link += "?action=channels&id=" + project.dataset.id;
        reqGet.get();
    })
}

function showChannel(datas){
    let Channels = new ChannelAll()
    for(let data of datas){
        let child = new ChannelSingle(data["project_id"]);
        child.setData(data[0]);
        child.addToDom();
        Channels.childs.push(child);
    }
    Channels.showAll();
    for(let channel of Channels.childs){
        channel.div.addEventListener("click", () => {
            idFlag = channel.div.dataset.id;
            chat.className = "channelMessage";
            console.log(idFlag);
            interval(idFlag);
        })
    }
}

function setChat(data){
    let channel = new MessageAll();
    channel.resetContent();
    channel.setFirstContent("<div id='sendTo'>" + 1 + "</div>");
    channel.show(data);
    chat.scrollTop = scrollPosition;
}

function interval(id){
    setTimeout(()=>{
        if(chat.className === "channelMessage" && idFlag === id){
            channelReqGet.resetLink();
            channelReqGet.link += "?action=see&id=" + id;
            scrollPosition = chat.scrollTop;
            channelReqGet.get();
            sendMessageEvent("channelMessage","channel",id);
            interval(id);
        }
    },1000);
}