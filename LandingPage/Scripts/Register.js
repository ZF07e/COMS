import { selectedId } from "./utils/selectedAssociation.js";
import { Associations } from "../SampleData/AssociationList.js";

console.log(selectedId);

Associations.forEach((association)=>{
    if(association.id == selectedId){
        //console.log(association.image);
        document.querySelector(".formHeader").innerHTML = 
        `
        <img src="${association.image}" alt="Logo">
        <h4><span>${association.name}</span> Registration</h4>
        `;

        document.querySelector(".associationsMissionVision").innerHTML =
        `
            <section>
                <h3>-Description-</h3>
                <p class="js-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, consequatur tempora dolorem at officia sed placeat saepe fugit maiores ea earum quos dolores quia corporis optio vitae nam incidunt dolor.</p>
            </section>
            
            <section>
                <h3>~Mission~</h3>
                <p class="js-mission">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste magni quos illum non quibusdam excepturi cupiditate laborum mollitia veniam ipsum quasi repellat ipsa reprehenderit sequi voluptatem aut, consequuntur dignissimos minus!</p>

            </section>
            <section>
                <h3>~Vision~</h3>
                <p class="js-vision">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde molestiae deleniti nulla inventore. Tempore at quo, culpa tempora distinctio molestiae, a et autem dolores libero corporis cupiditate vitae suscipit.</p>    
            </section>    
        `;
    }

});