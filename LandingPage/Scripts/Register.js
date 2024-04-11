import { selectedId } from "./utils/selectedAssociation.js";
import { Associations } from "../SampleData/AssociationList.js";

console.log(selectedId);

Associations.forEach((association)=>{
    if(association.id == selectedId){
        //console.log(association.image);
        document.querySelector(".leftSection").innerHTML = 
        `
        <img src="${association.image}" alt="Logo">
        <div class="textSection">
            <h3>${association.name}}</h3>
            <p>Adivser: ${association.adviser}</p>
            <p>Members: ${association.totalMembers}</p>
        </div>
        `;
    }

});