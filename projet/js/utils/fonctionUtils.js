function resetDataDivZindex(parent){
    let dataDivChildren = document.getElementById(parent.toString()).children;
    for(let child of dataDivChildren){
        child.style.zIndex = "0";
    }
}

function setDivZindex(zindex, div){
    div.style.zIndex = zindex.toString();
}

function removeDiv(div){
    div.parentNode.removeChild(div);
}

export {resetDataDivZindex, setDivZindex, removeDiv};