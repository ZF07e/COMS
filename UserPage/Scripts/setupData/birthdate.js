import {User} from "./data.js";

let month = document.getElementById("month");
let day = document.getElementById("day");
let year = document.getElementById("year");

document.querySelector(".submit-birthdate").addEventListener("click", () =>{
    removeErrors();
    let onlyNumeric = /^[0-9]*$/;
    if(month.value.trim() != ""){
        if(day.value.trim() != "" && day.value.match(onlyNumeric)){
            if(year.value.trim() != "" && year.value.match(onlyNumeric)){
                saveData();
            }
            else{
                sendErrorToYear();
            }
        }
        else{
            sendErrorToDay();
        }
    }
    else{
        sendErrorToMonth();
    }
});


//Functions >>

function saveData(){
    User['birthdate'] = month.value + " " + day.value + " " + year.value;
    localStorage.setItem("User", JSON.stringify(User));
    window.location.href = "studentInfo.php";
    console.log(User);
}

function removeErrors(){
    month.classList.remove("ErrorInput");
    document.querySelector(".Emsg1").innerText = "";
    day.classList.remove("ErrorInput");
    document.querySelector(".Emsg2").innerText = "";
    year.classList.remove("ErrorInput");
    document.querySelector(".Emsg3").innerText = "";
}

function sendErrorToMonth(){
    month.classList.add("ErrorInput");
    document.querySelector(".Emsg1").innerText = "Please Select A Month";
}
function sendErrorToDay(){
    day.classList.add("ErrorInput");
    document.querySelector(".Emsg2").innerText = "Please Enter A Proper Day";
}
function sendErrorToYear(){
    year.classList.add("ErrorInput");
    document.querySelector(".Emsg3").innerText = "Please Enter A Proper Year";
}


