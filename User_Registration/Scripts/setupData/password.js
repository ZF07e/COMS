const encrypt = (data)=> (btoa(unescape(encodeURIComponent(JSON.stringify(data)))));
let decode = (data) => JSON.parse(decodeURIComponent(escape(atob(data))));

let password = document.getElementById("Password");
let confirmPassword = document.getElementById("confirmPassword");

document.querySelector(".submit-password").addEventListener("click", (e) => {
    e.preventDefault();
    if(password.value.trim() == ""){
        sendErrorTopassword();
    }   
    if(confirmPassword.value.trim() == "" || password.value.trim() != password.value.trim()){
        sendErrorToConfPassword()
    }   
    else{
        let prevData = decode(sessionStorage.getItem('userInfo'));
        let combineData = Object.assign({}, prevData, {password: password.value});
        sessionStorage.setItem('userInfo', encrypt(combineData));
        console.log(decode(sessionStorage.getItem('userInfo')));  
        $.ajax({
            type: "POST",
            url: "../Functions/UserRegisteredData.php",
            data : combineData,
            success: (res)=>{
                console.log(res);
                console.log(combineData);
                sessionStorage.clear();
                window.location.href = "message.php";
            }
        });
    }
});


password.addEventListener("keypress", ()=>{
    clearErrorTopassword();
});

confirmPassword.addEventListener("keypress", ()=>{
    clearErrorToConfPassword();
});

//Function >>

function sendErrorTopassword(){
    password.classList.add("ErrorInput");
    document.querySelector(".Emsg1").innerText = "Invalid Password";
}

function sendErrorToConfPassword(){
    confirmPassword.classList.add("ErrorInput");
    document.querySelector(".Emsg2").innerText = "Didn't Matched The Password";
}


function clearErrorTopassword(){
    password.classList.remove("ErrorInput");
    document.querySelector(".Emsg1").innerText = "";
}

function clearErrorToConfPassword(){
    confirmPassword.classList.remove("ErrorInput");
    document.querySelector(".Emsg2").innerText = "";
}