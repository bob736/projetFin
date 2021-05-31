import {MessageAll} from "../classes/MessageAll.js";

let helps = document.getElementsByClassName("help");

for(let help of helps){
    help.addEventListener("click", (e) => {
        console.log("ok");
        e.preventDefault();
        callback();
    })
}

//Show help messages
function callback(){
    let convHelp = new MessageAll();
    convHelp.resetContent();
    convHelp.setFirstContent("<div id='sendTo'>Help</div>")
    convHelp.parent.className = "";
    convHelp.showSingle({"pseudo" : "server", "message": "message","date": ""});
}