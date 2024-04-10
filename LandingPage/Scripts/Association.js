//import {Club} from "../SampleData/ClubData.js";
import {selectedId} from "./utils/selectedAssociation.js";

//renderAssociations();

let ClubList = [];

fetch('/LandingPage/SampleData/ClubList.json')
.then(response => response.json())
.then((obj) => {
    ClubList = obj;
    renderAssociations(ClubList);
}).catch(function(error){
    console.error(error);
    
});

function renderAssociations(ClubList){
    let Listhtml = "";
    ClubList.forEach((assosiation, index) => {
        Listhtml += `
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
                        <span>Total Members: ${assosiation.totalMembers}</span>
                        <a href="Register.html"><button class="js-ApplyButton" data-association-id="${assosiation.id}">Apply</button></a>
                    </div>
                </div>
            </div>
        `;
    });
    document.querySelector(".orgList").innerHTML = Listhtml;
};



document.querySelectorAll(".js-ApplyButton").forEach((value) => {
    value.addEventListener('click', ()=>{
        const associationId = value.dataset.associationId;
        selectedId = localStorage.setItem("selectedId", JSON.stringify(associationId));
    });
});




