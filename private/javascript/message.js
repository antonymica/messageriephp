const formu = document.querySelector(".typing-area");
const inputField = document.querySelector(".input-field");
const fic = document.querySelector(".fic");
const sendBtn = document.querySelector(".button");
const chatBox = document.querySelector(".chat-box");


formu.onsubmit = (e)=>{
    e.preventDefault(); //preventing form submitting
}


sendBtn.onclick = ()=>{
    //let's start AJAX
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "php/insert-message.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = ""; // Fafana izay eo amin'ny input rhf lasa @ DB ny message
                fic.value = null;
                scrollToBottom();
            }
        }
    }
    //we have to send the form data throught ajax to php
    let formData = new FormData(formu); // creating new formData Object
    xhr.send(formData); // sending the form data to php
    if(xhr.send(formData)){
        inputField.value = ""; // Fafana izay eo amin'ny input rhf lasa @ DB ny message
        fic.value = null;
    }
}


chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}
chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(()=>{

    //let's start AJAX
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "php/get-message.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){ // if active class not contains in chatbox the scroll to bottom
                    scrollToBottom();
                }
            }
        }
    }
    //we have to send the form data throught ajax to php
    let formData = new FormData(formu); // creating new formData Object
    xhr.send(formData); // sending the form data to php
}, 500);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}


