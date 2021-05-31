let form = document.getElementById("sendMessage");
let chat = document.getElementById("showMessage");

form.style.display = "none"

//Catch class change on chat to display input only if its necessary
function callback(mutationsList) {
    mutationsList.forEach(mutation => {
        if (mutation.attributeName === 'class') {
            form.style.display = "flex";
        }
    })
}

const mutationObserver = new MutationObserver(callback)

mutationObserver.observe(chat, { attributes: true })