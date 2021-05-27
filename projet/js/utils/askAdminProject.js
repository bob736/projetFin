let icons = document.getElementsByClassName("askForAdmin");

for(let icon of icons){
    icon.addEventListener("click", () => {
        console.log(icon.dataset.id);
    })
}