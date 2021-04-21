import {Request} from "../classes/Request.js";

const privateMessageReq = new Request("privateMessage");

function timeOutRecurePrivateMessage(){
    setTimeout(function(){
        privateMessageReq.get();
        timeOutRecurePrivateMessage();
    },1000)
}

timeOutRecurePrivateMessage();