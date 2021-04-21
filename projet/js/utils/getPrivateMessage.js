import {Req} from "../classes/ajax.js";

const privateMessage = new Req("../../api/privateMessage/get.php");

function log(data){
    console.log("ok")
    console.log(data);
}

privateMessage.setCallback(log);

privateMessage.get();