const encrypt = (data)=> (btoa(unescape(encodeURIComponent(JSON.stringify(data)))));
let firstname = document.getElementById("user-firstname");
let lastname = document.getElementById("user-lastname");
let gender = document.getElementById("gender");
let formatted_firstname, formatted_lastname;
document.querySelector(".submit-name").addEventListener("click", (e)=>{
    e.preventDefault();
    remomveAllError();

    let isNotSymbolic = /^[A-Za-z\s]*$/;
    if(firstname.value.trim() !="" && firstname.value.match(isNotSymbolic)){ 
        if(lastname.value.trim() != "" && lastname.value.match(isNotSymbolic)){
            if(gender.value.trim() != ""){
                saveData();
            }
            else{
                sendErrorToGender();
            }
        }
        else{
            sendErrorToLastname();
        }
    }
    else{
        sendErrorToFirstname();
    }
});

//Functions below >>

function saveData(){
    formatted_firstname = firstname.value.replace(/\s+/g, ' ').trim();
    formatted_lastname = lastname.value.replace(/\s+/g, '').trim(); 

    sessionStorage.setItem('userInfo', encrypt({
        firstName: formatted_firstname,
        lastName: formatted_lastname,
        gender: gender.value
    }));

    firstname.value = formatted_firstname;
    lastname.value = formatted_lastname;

    window.location.href = "birthdate.php";
}

function sendErrorToFirstname(){
    firstname.classList.add("ErrorInput");
    document.querySelector(".Emsg1").innerText = "Enter A Proper First Name";
}

function sendErrorToLastname(){
    lastname.classList.add("ErrorInput");
    document.querySelector(".Emsg2").innerText = "Enter A Proper Last Name";
}

function sendErrorToGender(){
    gender.classList.add("ErrorInput");
    document.querySelector(".Emsg3").innerText = "Please Select Your Gender";
}

function remomveAllError(){
    firstname.classList.remove("ErrorInput");
    document.querySelector(".Emsg1").innerText = "";
    firstname.classList.remove("ErrorInput");
    document.querySelector(".Emsg2").innerText = "";
    gender.classList.remove("ErrorInput");
    document.querySelector(".Emsg3").innerText = "";
}