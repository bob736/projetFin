import {Request} from "../classes/Request.js";
import {MessageAll} from "../classes/MessageAll.js";

const privateMessageReqGet = new Request("privateMessage/get.php?", callback);
const privateMessageReqPost = new Request("privateMessage/post.php");
const userReqGet = new Request("user/get.php?", setUserPrivateMessageData)

const form = document.getElementById("sendMessageForm");
const submit = form.getElementsByTagName("input")[1];
const chat = document.getElementById("showMessage");

let scrollFlag = true;

let user2 = null;
let userSet = false;
let user2name = "";

let icon = null;

//Set a event on every private chat links
let links = document.getElementsByClassName("chatLink");
for(let link of links){
    link.addEventListener("click", function(e){
        e.preventDefault();

        //set user2 to selected user's id
        user2 = link.dataset.id;
        userReqGet.resetLink();
        userReqGet.link += "user=" + user2;
        userSet = false;
    })
}

function timeOutRecurePrivateMessage(){
    setTimeout(function(){
        if(user2 !== null){
            if(!userSet){
                //reset request link to base api url set when object is created line.3
                privateMessageReqGet.resetLink();
                //Add user2 variable that correspond to the user2 id in the link of the api
                //So I open the api with url's parameters
                privateMessageReqGet.link += "user=" + user2.toString();
                userSet = true;
                setCloseButton();
                sendMessage();

            }
            //get private chat between user2
            privateMessageReqGet.get();
            document.getElementById("data").dataset.state = "private";
        }
        timeOutRecurePrivateMessage();
    },1000)
}

//Set an icone to hide the private chat
function setCloseButton(){
    //remove existing close button
    try{
        icon.parentNode.removeChild(icon);
    }
    catch(e){}

    //Create the button
    icon = document.createElement("div");
    icon.innerHTML = "<i id='closeButton' class=\"far fa-window-close\"></i>";
    icon.addEventListener("click", function(){
        document.getElementById("showMessage").innerHTML = "";
        //Set user2 to null so the private chat is not showed
        user2 = null;
        userSet = false;
        document.getElementById("chat").removeChild(this);

        //Remove the event of the send button when the chat get closed
        submit.removeEventListener("click", send);
        })
    document.getElementById("chat").append(icon)
}

function sendMessage(){
    submit.addEventListener("click", send);
}

function send(e){
    let input = form.getElementsByTagName("input")[0];
    e.preventDefault();

    //Check if we are in the case of a private chat
    //Then if the message is not empty the message is send to the database
    if(document.getElementById("data").dataset.state === "private"){
        let message = input.value;
        if(message.length > 0){
            privateMessageReqPost.resetLink();
            privateMessageReqPost.setData({"user2": user2, "message": message});
            privateMessageReqPost.send();
            scrollFlag = false;
        }
    }
}

//Callback of get() methode
function callback(result){
    let privateChat = new MessageAll();
    privateChat.resetContent(user2name);
    privateChat.show(result);
    userReqGet.get();
    //When the scollFlag is set to false , private chat div with scroll to the last message send
    if(!scrollFlag){
        chat.scrollTop = chat.scrollHeight;
        scrollFlag = true;
    }
}

//Set placeholder of send message input to the selected user
function setUserPrivateMessageData(result){
    user2name = result.name;
    form.getElementsByTagName("input")[0].placeholder = "Envoyer un message a " + user2name;
}

timeOutRecurePrivateMessage();
