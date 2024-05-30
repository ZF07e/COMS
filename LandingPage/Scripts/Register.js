import { selectedId } from "./utils/selectedAssociation.js";

fetch('http://localhost/COMS/LandingPage/Functions/GetAssociationDetails.php?action=getAssociationList')
.then(response => response.json())
.then(data => {
    funktion(data);
})
.catch(error => console.error('Error:', error));

function funktion(Associations){
    Associations.forEach((association)=>{
        if(association.id == selectedId){
            document.querySelector(".imageContainer").innerHTML += `<img src="${association.image ?? "../Images/COMS.png"}" alt="Profile" class="associationProfile">`;
            document.querySelector(".associationTitle").innerHTML = association.association;
            document.querySelector(".adviser").innerHTML = association.adviser;
            document.querySelector(".description").innerHTML = association.description;
    
            document.querySelector(".AscMission").innerHTML = association.mission;
            document.querySelector(".AscVision").innerHTML = association.vision;
            document.getElementById("association").value = association.id;
        }
    });
}
