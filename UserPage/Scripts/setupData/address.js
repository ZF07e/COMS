import {User} from "./data.js";

let streetNo = document.getElementById("streetNo");
let street = document.getElementById("street");
let subVilBldg = document.getElementById("subVilBldg");
let city_municipality = document.getElementById("city_municipality");
let province = document.getElementById("province");

let formattedstreetNo;
let formattedstreet;
let formattedsubVilBldg;
let formattedcity_municipality;
let formattedprovince;

document.querySelector(".submit-address").addEventListener("click", () => {
    formattedstreetNo = streetNo.value.replace(/\s+/g, ' ').trim();
    formattedstreet =  street.value.replace(/\s+/g, ' ').trim();
    formattedsubVilBldg =  subVilBldg.value.replace(/\s+/g, ' ').trim();
    formattedcity_municipality =  city_municipality.value.replace(/\s+/g, ' ').trim();
    formattedprovince =  province.value.replace(/\s+/g, ' ').trim();
    remomveAllError();
    if(streetNo.value.trim() != ""){
        if(street.value.trim() != ""){
            if(subVilBldg.value.trim() != ""){
                if(city_municipality.value.trim() != ""){
                    if(province.value.trim() != ""){
                        saveData();
                    }
                    else{
                        sendErrorToprovince();
                    }
                }
                else{
                    sendErrorTocity_municipality();
                }
            }
            else{
                sendErrorTosubVilBldg();
            }
        }
        else{
            sendErrorTostreet();
        }
    }
    else{
        sendErrorTostreetNo();
    }
});


//Function >>

function saveData(){
    User['Address'] = formattedstreetNo + " " + 
    formattedstreet + " " + 
    formattedsubVilBldg + " " + 
    formattedcity_municipality + " " + 
    formattedprovince;
    
    streetNo.value = formattedstreetNo;
    street.value = formattedstreet;
    subVilBldg.value = formattedsubVilBldg;
    city_municipality.value = formattedcity_municipality;
    province.value = formattedprovince;
    
    console.log(User);
}

function remomveAllError(){
    streetNo.classList.remove("ErrorInput");
    document.querySelector(".Emsg1").innerText = "";
    street.classList.remove("ErrorInput");
    document.querySelector(".Emsg2").innerText = "";
    subVilBldg.classList.remove("ErrorInput");
    document.querySelector(".Emsg3").innerText = "";
    city_municipality.classList.remove("ErrorInput");
    document.querySelector(".Emsg4").innerText = "";
    province.classList.remove("ErrorInput");
    document.querySelector(".Emsg5").innerText = "";
}

function sendErrorTostreetNo(){
    streetNo.classList.add("ErrorInput");
    document.querySelector(".Emsg1").innerText = "Please Fill Up this Form";
}
function sendErrorTostreet(){
    street.classList.add("ErrorInput");
    document.querySelector(".Emsg2").innerText = "Please Fill Up this Form";
}
function sendErrorTosubVilBldg(){
    subVilBldg.classList.add("ErrorInput");
    document.querySelector(".Emsg3").innerText = "Please Fill Up this Form";
}
function sendErrorTocity_municipality(){
    city_municipality.classList.add("ErrorInput");
    document.querySelector(".Emsg4").innerText = "Please Fill Up this Form";
}
function sendErrorToprovince(){
    province.classList.add("ErrorInput");
    document.querySelector(".Emsg5").innerText = "Please Fill Up this Form";
}