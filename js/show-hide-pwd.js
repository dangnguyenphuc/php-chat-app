const pwdField = document.querySelector(".form .field input[type='password']");
const toggleBtn = document.querySelector(".form .field i");

toggleBtn.onclick = ()=>{
    if(pwdField.type=="password"){
        pwdField.type ='text';
        toggleBtn.classList.add("active")
    }
    else {
        pwdField.type ='password';
        toggleBtn.classList.remove("active")
    }
}