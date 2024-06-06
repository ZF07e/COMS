const encrypt = (data)=> (btoa(unescape(encodeURIComponent(JSON.stringify(data)))));
let decode = (data) => JSON.parse(decodeURIComponent(escape(atob(data))));
let month = document.getElementById("month");
let day = document.getElementById("day");
let year = document.getElementById("year");

document.querySelector(".submit-birthdate").addEventListener("click", (e) =>{
    e.preventDefault();
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
    let prevData = decode(sessionStorage.getItem('userInfo'));
    let birthday = month.value + " " + day.value + ", " + year.value;
    let combineData = Object.assign({}, prevData, {birthday})
    sessionStorage.setItem('userInfo', encrypt(combineData));
    window.location.href = "contact.php";
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


