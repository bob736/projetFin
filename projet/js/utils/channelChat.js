import {Request} from "../classes/Request.js";
import {MessageAll} from "../classes/MessageAll.js";

let channelLink = document.querySelectorAll("#projet li > a")
let channelReqGet = new Request("channel/get.php", callback);

//Show channel message when click on channel link
for(let link of channelLink){
    link.addEventListener("click", () =>{
        channelReqGet.resetLink();
        channelReqGet.link += "?action=see&channel=" + link.dataset.id;
        channelReqGet.get();
    })
}

function callback(data){
    let channel = new MessageAll(data);
    channel.resetContent();
    channel.setFirstContent("<div id='sendTo'>" +  + "</div>")
    channel.parent.className = "channelMessage";
    channel.show(data);
}