import {Request} from "../classes/Request.js";
import {ChannelAll} from "../classes/ChannelAll.js";
import {ChannelSingle} from "../classes/ChannelSingle.js";

let projects = document.querySelectorAll(".projetCont h1");
let reqGet = new Request("channel/get.php", showChannel);

for(let project of projects){
    project.addEventListener("click", () => {
        console.log(project.innerText + " " + project.dataset.id);
        reqGet.resetLink();
        reqGet.link += "?action=channels&id=" + project.dataset.id;
        reqGet.get();
    })
}

function showChannel(datas){
    let Channels = new ChannelAll()
    for(let data of datas){
        let child = new ChannelSingle()
        child.setData(data);
        child.addToDom();
        Channels.childs.push(child);
    }
    Channels.showAll();
}