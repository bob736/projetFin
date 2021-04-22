import {Request} from "../classes/Request.js";

const privateMessageReq = new Request("privateMessage");
let user2 = null;

let links = document.getElementsByClassName("infoClickLink");
for(let link of links){
    link.addEventListener("click", function(e){
        e.preventDefault();
        user2 = link.dataset.id;
    })
}

function timeOutRecurePrivateMessage(){
    setTimeout(function(){
        if(user2 !== null){
            privateMessageReq.get(user2);
        }
        timeOutRecurePrivateMessage();
    },1000)
}

timeOutRecurePrivateMessage();