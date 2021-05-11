import {Request} from "./Request.js";
import {removeDiv} from "../utils/fonctionUtils.js";

let Profile = function(){
    this.div = document.createElement("div");
    this.div.id = "profilePage";
    this.data = null
    this.parent = document.getElementById("data");
    this.requestFollowGet = new Request("user/get.php?",this.createFollowButton, this);
    this.userModifFlag = false;
}

//Show the profile page
Profile.prototype.show = function(){
    this.parent.appendChild(this.div);
    if(this.data.lien.length < 1){
        this.data.lien = "Non renseigné";
    }
    this.div.innerHTML = `
        <div id="userProfileTop" data-id="${this.data.id}">
            <div id="userIcone"><img src="../../images/icone/${this.data.icon}"  alt=""></div>
            <div id="userName">${this.data.name}</div>
            <hr class="profileSeparation">
            <h2>Bio</h2>
            <div id="userBio">${this.data.bio}</div>
            <hr class="profileSeparation">
            <div id="userLink">Lien Github : ${this.data.lien}</div>
            
        </div>
        <div id="userProfileBot">
            
        </div>
    `

    //If the Profile is the connected user's one then we can edit the profile page
    //I replace all parts that can be modified to an input to modifie it in Ajax
    if(this.data.editable === "true"){
        this.div.innerHTML += "<div id='userModif'><i class=\"fas fa-cogs\"></i></div>";
        let userModif = document.getElementById("userModif");
        userModif.addEventListener("click", () => {
            if(!this.userModifFlag){
                this.userModifFlag = true;
                let arrayOfDiv = [];
                arrayOfDiv.push(document.getElementById("userName"));
                arrayOfDiv.push(document.getElementById("userBio"));
                for(let div of arrayOfDiv){
                    let input = document.createElement("input");
                    input.value = div.innerHTML;
                    input.name = div.id;
                    div.replaceWith(input);
                }
                let submit = document.createElement("div");
            }

            //When user click a second time to the modifie icon , then i send a requete to
            //my api that will Update user's information
            else{
                this.userModifFlag = false;
                console.log("ok");
                let arrayOfInput = document.querySelectorAll("#userProfileTop input");
                for(let input of arrayOfInput){
                    let div = document.createElement("div");
                    div.id = input.name;
                    div.innerHTML = input.value;
                    input.replaceWith(div);
                }

                let reqModifProfile = new Request("user/post.php");
                reqModifProfile.resetLink();
                reqModifProfile.link += "?action=modif";

                let name = document.getElementById("userName").innerHTML;
                let bio = document.getElementById("userBio").innerHTML;
                reqModifProfile.setData({"name" : name, "bio" : bio, "id": this.data.id});
                reqModifProfile.send();
            }

        })
    }
    else{
        this.requestFollowButton(this.data.id);
    }

    //set Close button event
    let close = document.createElement("i");
    close.className = "far fa-window-close closeProfile";
    this.div.prepend(close);
    close.addEventListener("click", closeFunc);
}

//Request to change the followButton stats (follow/unfollow)
Profile.prototype.requestFollowButton = function(id){
    this.requestFollowGet.resetLink();
    this.requestFollowGet.link += "user=" + id + "&action=follow";
    this.requestFollowGet.get();
}

//Create the follow button
Profile.prototype.createFollowButton = function(data){
    let div = document.getElementById("userProfileTop");
    if(document.getElementById("userFollow")){
        document.getElementById("userFollow").parentNode.removeChild(document.getElementById("userFollow"));
    }
    let follow = document.createElement("div");
    let input = document.createElement("input");
    input.hidden = true;
    input.value = data["id"];
    follow.id = "userFollow";
    //If the connected user already follow this user
    if(data["follow"] !== true){
        follow.innerHTML = "Follow";
    }
    else{
        follow.innerHTML = "Unfollow";
    }
    this.followDiv = follow;

    follow.appendChild(input);
    div.appendChild(follow);

    //Trigger follow button change state when user click on it
    follow.addEventListener("click",() => {
        changeFollow(data["id"]);
        this.parentObject.requestFollowButton(data["id"]);
    })
}

//Update follow or unfollow user in database
function changeFollow(id){
    let request = new Request("user/post.php");
    request.resetLink();
    request.setData({"user" : id});
    request.send();
}


//Try to remove profilePage if it exist
function closeFunc(){
    try{
        removeDiv(document.getElementById("profilePage"));
    }
    catch(e){}
}

export {Profile};