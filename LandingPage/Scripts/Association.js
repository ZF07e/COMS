import {selectedId} from "./utils/selectedAssociation.js";
import {Associations} from "../../SampleData/AssociationList.js";

export let AssociationList = [];
AddtoArray(Associations);
renderAssociations();

function renderAssociations(){
    let Organization = "";
    let Clubs = "";   
    AssociationList.forEach((assosiation, index) => {
        if(assosiation.type === "Organization"){
            Organization += `
            <div class="itemList"> 
                <div class="pictureFrame">
                    <img src="${assosiation.image}">
                </div>
                
                <div class="title-description">
                    <div class="topSection">
                        <h2>${assosiation.name}</h2>
                    </div>
                    <div class="details">
                        <p>Adviser: ${assosiation.adviser}</p>
                        <span>Type: ${assosiation.type}</span>
                        <a href="Register.php"><button class="js-ApplyButton" data-association-id="${assosiation.id}">Apply</button></a>
                    </div>
                </div>
            </div>
            `;
        }

        else if(assosiation.type === "Club"){
        Clubs += `
            <div class="itemList"> 
                <div class="pictureFrame">
                    <img src="${assosiation.image}">
                </div>
                
                <div class="title-description">
                    <div class="topSection">
                        <h2>${assosiation.name}</h2>
                    </div>
                    <div class="details">
                        <p>Adviser: ${assosiation.adviser}</p>
                        <span>Type: ${assosiation.type}</span>
                        <a href="Register.php"><button class="js-ApplyButton" data-association-id="${assosiation.id}">Apply</button></a>
                    </div>
                </div>
            </div>
            `;
        }
    });
    document.querySelector(".orgList").innerHTML = Organization;
    document.querySelector(".orgList").innerHTML += Clubs;
};

function AddtoArray(array){
    for(let i = 0; i < array.length; i++){
        AssociationList.push(array[i]);
    }
}

document.querySelectorAll(".js-ApplyButton").forEach((value) => {
    value.addEventListener('click', ()=>{ 
        let associationId = value.dataset.associationId;
        console.log(associationId);
        selectedId = localStorage.setItem("selectedId", JSON.stringify(associationId));
    });
});






