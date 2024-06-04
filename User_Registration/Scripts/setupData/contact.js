const encrypt = (data)=> (btoa(unescape(encodeURIComponent(JSON.stringify(data)))));
let decode = (data) => JSON.parse(decodeURIComponent(escape(atob(data))));

let email = document.getElementById("email");
let mobileNo = document.getElementById("mobileNo");   

document.querySelector(".submit-studInfo").addEventListener("click", (e)=>{
    e.preventDefault();
    removeAllError();
    let email_Pattert = /^[a-zA-Z]+\.[0-9]{6}@alabang\.sti\.edu\.ph$/;
    let number_pattern = /^09\d{9}$/;

    if(email.value.trim() != "" && email_Pattert.test(email.value)){ 
        if(mobileNo.value.trim() != "" && number_pattern.test(mobileNo.value)){
            saveData();
        }
        else{
            sendErrorToMobileNo();
        }
    }
    else{
        sendErrorToemail();
    }
});


//Functions >>

function saveData(){
    let prevData = decode(sessionStorage.getItem('userInfo'));
    let combineData = Object.assign({}, prevData, {email: email.value, mobileNo: mobileNo.value});
    sessionStorage.setItem('userInfo', encrypt(combineData));
    window.location.href = "student_description.php";
}

function removeAllError(){
    email.classList.remove("ErrorInput");
    document.querySelector(".Emsg1").innerText = "";
    mobileNo.classList.remove("ErrorInput");
    document.querySelector(".Emsg3").innerText = "";
}

function sendErrorToemail(){
    email.classList.remove("ErrorInput");
    document.querySelector(".Emsg1").innerText = "Please Enter A Valid Outlook Email";
}
function sendErrorToMobileNo(){
    mobileNo.classList.remove("ErrorInput");
    document.querySelector(".Emsg3").innerText = "Please Enter A Valid Mobile Number";
}