const form = document.querySelector(".typing-area");
const inputField = form.querySelector(".input-field");
const sendBtn = form.querySelector("button");
const chatbox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault();
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/insert_chat.php",true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
            inputField.value="";
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

chatbox.onmouseenter = ()=>{
    chatbox.classList.add("active");
}
chatbox.onmouseleave = ()=>{
    chatbox.classList.remove("active");
}

setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/get_chat.php",true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
            let data = xhr.response;
            chatbox.innerHTML = data;
            if(!chatbox.classList.contains("active")){
                sroll();
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}, 500);

function sroll(){
    chatbox.scrollTop = chatbox.scrollHeight;
}