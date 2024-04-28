import { selectedId } from "./utils/selectedAssociation.js";
import { Associations } from "../../SampleData/AssociationList.js";

console.log(selectedId);

Associations.forEach((association)=>{
    if(association.id == selectedId){
        document.querySelector(".imageContainer").innerHTML += `<img src="${association.image}" alt="Profile" class="associationProfile">`;
        document.querySelector(".associationTitle").innerHTML = association.name;
        document.querySelector(".adviser").innerHTML = association.adviser;
        document.querySelector(".description").innerHTML = association.description;

        document.querySelector(".AscMission").innerHTML = association.mission;
        document.querySelector(".AscVision").innerHTML = association.vision;
    }

});