document.querySelector(".associations").addEventListener("click", ()=>{
    window.location.href = "./index.html";
}); 

document.querySelector(".events").addEventListener("click", ()=>{
    window.location.href = "./";
}); 


document.querySelector(".user_management").addEventListener("click", ()=>{
    window.location.href = "./";
}); 

document.querySelector(".request").addEventListener("click", ()=>{
    window.location.href = "./";
}); 

let isOn = false;
let profilePopUp = document.querySelector(".popUp");

document.querySelector(".profile").addEventListener("click", ()=>{
    if(isOn === false){
        profilePopUp.style.display = "flex";
        isOn = true;
    }
    else{
        profilePopUp.style.display = "none";
        isOn = false;
    }
}); 