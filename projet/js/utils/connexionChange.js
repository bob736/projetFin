let formDivs = document.getElementsByClassName("formContent");
let chat = document.getElementById("showMessage");
let title = document.getElementById("connectTitle");

let changeSpans = document.getElementsByClassName("changeForm");

let topPos;
let index = 0;
let display = 0;


//Position connexion form
for(let formDiv of formDivs){
    formDiv.style.left = "calc(" + getComputedStyle(chat).width + "/2 - " + getComputedStyle(formDiv).width +"/2) ";
    formDiv.style.top = "calc(" + getComputedStyle(chat).height + "/2 - " + getComputedStyle(formDiv).height +"/2) ";
    topPos = getComputedStyle(formDiv).top;
    if(index === 1){
        formDiv.style.zIndex = "-1";
    }
    index++;
}

//Position title
title.style.position = "absolute";
title.style.left = "calc(" + getComputedStyle(chat).width + "/2 - " + getComputedStyle(title).width +"/2) ";
title.style.top = "calc(" + getComputedStyle(chat).height + "/2 - 28%)";

//Change from connexion to register
for(let span of changeSpans){
    span.addEventListener("click", () => {
        if(display === 0){
            display = 1;
            formDivs[display].style.zIndex = "10";
            formDivs[display - 1].style.zIndex = "-1";
        }
        else{
            display = 0;
            formDivs[display].style.zIndex = "10";
            formDivs[display + 1].style.zIndex = "-1";
        }
    })
}