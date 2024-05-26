document.querySelector(".associations").addEventListener("click", ()=>{
    window.location.href = "./index.php";
}); 

document.querySelector(".events").addEventListener("click", ()=>{
    window.location.href = "./Events.php";
}); 


document.querySelector(".user_management").addEventListener("click", ()=>{
    window.location.href = "./userManagement.php";
}); 

document.querySelector(".request").addEventListener("click", ()=>{
    window.location.href = "./Request.php";
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