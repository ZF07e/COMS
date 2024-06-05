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


fetch('http://localhost/COMS/AssocClient/Functions/Querries/userName.php')
.then(response => response.json())
.then(data => {
    let UserName = data[0].split("(")[0];
    document.getElementById("userNameHdr").innerHTML = UserName + " " + "(" + data[1] + ")";
})
.catch(error => console.error('Error:', error));