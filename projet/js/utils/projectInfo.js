import {Request} from "../classes/Request.js";
import {MessageAll} from "../classes/MessageAll.js";
import {getDate} from "./fonctionUtils.js";
import {ChannelAll} from "../classes/ChannelAll.js";
import {ChannelSingle} from "../classes/ChannelSingle.js";

let reqProjectName = new Request("project/get.php", setProjectName);

let events = [];
let morePage = true
let page = 1;
let next = true;

let infos = document.getElementsByClassName("infoServe");

for(let info of infos){
    info.addEventListener("click", () => {
        reqProjectName.resetLink();
        reqProjectName.link += "?action=name&id=" + info.dataset.id;
        reqProjectName.get();
    })
}

function setProjectName(data){
    console.log(data);
    morePage = true;
    next = true;
    while(morePage && next){
        let reqInfo = new Request("", callbackInfo);
        reqInfo.get("https://api.github.com/repos/" + data.link + "/events?page=" + page);
        page ++;
        next = false;
    }

}

function callbackInfo(data){
    console.log(data);
    if(data === []){
        morePage = false;
    }
    else{
        next = true;
    }
}