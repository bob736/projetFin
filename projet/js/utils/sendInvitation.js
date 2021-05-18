import {Request} from "../classes/Request.js";
import {MessageAll} from "../classes/MessageAll.js";

let links = document.getElementsByClassName("inviteToServer");

for(let link of links){
    link.addEventListener("click", () => {
        let req = new Request("project/get.php", callback);
        req.resetLink();
        req.link += "?action=link&id=" + link.dataset.id;
        req.get();
    })
}

function callback(data){
    let conv = new MessageAll();
    conv.parent.className = "convLink";
    conv.resetContent();
    conv.showSingle({"pseudo": "server", "message": "Token d'invitation au serveur : " + data});
}