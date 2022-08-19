const form = document.querySelector(".signup form");
const continueBtn = form.querySelector(".button input");
const errorText = form.querySelector(".error-txt");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/signup.php",true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
            let data = xhr.response;
            console.log(data);
            if(data == "success"){
                location.href = "users.php";
            }
            else{
                errorText.textContent = data;
                errorText.style.display = "block";
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}