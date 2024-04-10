import { selectedId } from "./utils/selectedAssociation.js";
import { Club } from "../SampleData/ClubData.js";

Club.forEach((club)=>{
    if(club.id == selectedId){
        console.log(club.image);
        document.querySelector(".leftSection").innerHTML = 
        `
        <img src="${club.image}" alt="Logo">
        <div class="textSection">
            <h3>${club.name}}</h3>
            <p>Adivser: ${club.adviser}</p>
            <p>Members: ${club.totalMembers}</p>
        </div>
        `;
    }

});