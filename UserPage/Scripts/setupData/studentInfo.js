import {User} from "./data.js";

let studentNo = document.getElementById("StudentNo");
let eductlvl = document.getElementById("educlvl");
let mobileNo = document.getElementById("mobileNo");   

document.querySelector(".submit-studInfo").addEventListener("click", ()=>{
    removeAllError();
    let Student_No_pattern = /^02000\d{6}$/;
    let number_pattern = /^09\d{9}$/;

    if(studentNo.value.trim() != "" && Student_No_pattern.test(studentNo.value)){ 
        if(eductlvl.value.trim() != ""){
            if(mobileNo.value.trim() != "" && number_pattern.test(mobileNo.value)){
                saveData();
            }
            else{
                sendErrorToMobileNo();
            }
        }
        else{
            sendErrorToEduclvl();
        }
    }
    else{
        sendErrorToStudentNo();
    }
});


//Functions >>

function saveData(){
    User['student_Number'] = studentNo.value;
    User['education_level'] = eductlvl.value;
    User['mobileNo'] = mobileNo.value;
    localStorage.setItem(("User"), JSON.stringify(User));
    window.location.href = "address.php";
    console.log(User);
}

function removeAllError(){
    studentNo.classList.remove("ErrorInput");
    document.querySelector(".Emsg1").innerText = "";
    eductlvl.classList.remove("ErrorInput");
    document.querySelector(".Emsg2").innerText = "";
    mobileNo.classList.remove("ErrorInput");
    document.querySelector(".Emsg3").innerText = "";
}

function sendErrorToStudentNo(){
    studentNo.classList.remove("ErrorInput");
    document.querySelector(".Emsg1").innerText = "Please Enter A Valid Student Number";
}
function sendErrorToEduclvl(){
    eductlvl.classList.remove("ErrorInput");
    document.querySelector(".Emsg2").innerText = "Please Select An Education Level";
}
function sendErrorToMobileNo(){
    mobileNo.classList.remove("ErrorInput");
    document.querySelector(".Emsg3").innerText = "Please Enter A Valid Mobile Number";
}