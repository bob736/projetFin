let form = document.getElementsByTagName("form")[0];
let input = form.querySelector("input[type=text]");

//Reset input value when messages are sent
input.addEventListener("change", () => {
    let submit = form.querySelector("input[type=submit]");
    submit.addEventListener("click", () => {
        input.value = "";
    })
})