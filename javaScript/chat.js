const form = document.querySelector(".typing-area"),
    inputField = form.querySelector(".input-field"),
    sendbtn = form.querySelector("button"),
    chatBox = document.querySelector(".chat-box");

form.onsubmit = e=>{
    e.preventDefault(); //preventing form from submitting
}

sendbtn.onclick = () => {
    //let's start ajax
    let xhr = new XMLHttpRequest(); //creating XML Object
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = () => {
        inputField.value = ""; //once message inserted into database then leave blank the input field
        scrollToBottom();
    }
    let formData = new FormData(form);
    xhr.send(formData); 
}

chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
}

chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
}

setInterval(() => {
     let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = () => {
        let data = xhr.response;
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains("active")) {
            scrollToBottom();
        }
        console.log(data);
    }
    let formData = new FormData(form);
    xhr.send(formData); 
}, 500); //this function will run frequently after 500ms


const scrollToBottom = () => {
    chatBox.scrollTop = chatBox.scrollHeight;
}



