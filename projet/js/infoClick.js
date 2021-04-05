let userList = document.getElementsByClassName("profile");

for(let user of userList){
    user.addEventListener("click", () => showOption(user));
}

function showOption(elem){
    let info = elem.getElementsByClassName("infoClick")[0];
    if(info.style.display === "none"){
        info.style.display = "block";
    }
    else{
        info.style.display = "none";
    }
}