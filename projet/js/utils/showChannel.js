let projects = document.querySelectorAll(".projetCont h1");


for(let project of projects){
    project.addEventListener("click", () => {
        console.log(project.innerText + " " + project.dataset.id);
    })
}