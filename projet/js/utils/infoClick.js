let userList = document.getElementsByClassName("profile");

let infos = document.getElementsByClassName("infoClick");

function resetDisplay(){
    for (let info of infos){
        info.style.display = "none";
    }
}

resetDisplay();

for(let user of userList){
    user.addEventListener("click", () => showOption(user));
}

//display button at the right of user connected name
function showOption(elem){
    let info = elem.getElementsByClassName("infoClick")[0];
    resetDisplay();
    if(info.style.display === "none"){
        info.style.display = "block";
    }
    else{
        info.style.display = "none";
    }
}

