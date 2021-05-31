import {Request} from "../classes/Request.js";
import {MessageAll} from "../classes/MessageAll.js";
import {getDate} from "./fonctionUtils.js";

let reqProjectName = new Request("project/get.php", setProjectName);

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
    console.log()
    let reqInfo = new Request("", callbackInfo);
    reqInfo.get("https://api.github.com/repos/" + data.link + "/events");
}

function callbackInfo(data){
    console.log(data)
}