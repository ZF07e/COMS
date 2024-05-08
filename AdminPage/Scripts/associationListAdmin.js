let selectedAssociationID = JSON.parse(localStorage.getItem("selectedAssociationID")) || "";

//sample data code below. remove this when using fetch
let AssociationLists = [
    {
        "id": 111,
        "image": "../Images/AssosiationsPfp/CodersPfp.jpg",
        "name": "Coders Club",
        "type": "Club",
        "adviser": "---",
        "totalMembers": 15,
        "description": "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Adipisci, dolore temporibus enim saepe dolor veniam laborum quo reprehenderit quae eaque illum nemo eveniet tenetur quibusdam ipsum odit non a quis.",
        "mission": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Error quaerat nostrum consectetur vel ipsam sapiente odio itaque? Eius neque, quia quam veritatis eligendi maiores quod cum ab voluptate nulla excepturi.",
        "vision": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit exercitationem, iste eligendi placeat repudiandae odit facilis itaque nihil recusandae earum, necessitatibus doloremque nulla, commodi iusto fuga ratione est aliquid enim."
    },
    {
        "id": 122,
        "image": "../Images/AssosiationsPfp/CS.jpg",
        "name": "STICA - Computer Society",
        "type": "Organization",
        "adviser": "---",
        "totalMembers": 20,
        "description": "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Adipisci, dolore temporibus enim saepe dolor veniam laborum quo reprehenderit quae eaque illum nemo eveniet tenetur quibusdam ipsum odit non a quis.",
        "mission": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Error quaerat nostrum consectetur vel ipsam sapiente odio itaque? Eius neque, quia quam veritatis eligendi maiores quod cum ab voluptate nulla excepturi.",
        "vision": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit exercitationem, iste eligendi placeat repudiandae odit facilis itaque nihil recusandae earum, necessitatibus doloremque nulla, commodi iusto fuga ratione est aliquid enim."
    }
];
renderList(AssociationLists);

//render Function used for Rendering List
function renderList(AssociationLists){
    let list =  document.querySelector(".associationList")
    let orgs = "";
    let clubs = "";
    AssociationLists.forEach((association)=>{
        if(association.type === "Organization"){
            orgs += `
                <div class="associationItem" data-selected=${association.id}>
                    <img src="${association.image}" alt="AssociationProfile" class="list--logo">
                    <div class="nameNtype">
                        <div class="tileNtypeContainer">
                            <h4 class="association--title">${association.name}</h4>
                            <p class="association--type --${association.type}">${association.type}</p>
                        </div>       
                        <p class="association--adviser">${association.adviser}</p>          
                    </div>
                </div>        
            `;
        }

        else if(association.type === "Club"){
            clubs += `
                <div class="associationItem" data-selected=${association.id}>
                    <img src="${association.image}" alt="AssociationProfile" class="list--logo">
                    <div class="nameNtype">
                        <div class="tileNtypeContainer">
                            <h4 class="association--title">${association.name}</h4>
                            <p class="association--type --${association.type}">${association.type}</p>
                        </div>       
                        <p class="association--adviser">${association.adviser}</p>          
                    </div>
                </div>          
            `;
        }
    });
    list.innerHTML += orgs;
    list.innerHTML += clubs;   
    searchAssociation(AssociationLists); 
    viewAssociationFunction(document.querySelectorAll(".associationItem"));
    formButtonFunction();   
}

function searchAssociation(AssociationLists){
    document.getElementById("searchAssociation").addEventListener("keyup", ()=>{
        //get input String and convert it to UpperCase
        let searchString = document.getElementById("searchAssociation").value.toUpperCase();
        let OrganizationFound = "";
        let clubFound = "";
        
        AssociationLists.forEach((value)=>{  
        if(value.name.toUpperCase().includes(searchString, 0)){
            if(value.type === "Organization"){
                OrganizationFound += `
                    <div class="associationItem" data-selected=${value.id}>
                        <img src="${value.image}" alt="AssociationProfile" class="list--logo">
                        <div class="nameNtype">
                            <div class="tileNtypeContainer">
                                <h4 class="association--title">${value.name}</h4>
                                <p class="association--type --${value.type}">${value.type}</p>
                            </div>       
                            <p class="association--adviser">${value.adviser}</p>          
                        </div>
                    </div>        
                `;
            }
    
            else if(value.type === "Club"){
                clubFound += `
                    <div class="associationItem" data-selected=${value.id}>
                        <img src="${value.image}" alt="AssociationProfile" class="list--logo">
                        <div class="nameNtype">
                            <div class="tileNtypeContainer">
                                <h4 class="association--title">${value.name}</h4>
                                <p class="association--type --${value.type}">${value.type}</p>
                            </div>       
                            <p class="association--adviser">${value.adviser}</p>          
                        </div>
                    </div>          
                `;
            }
        }
            document.querySelector(".associationList").innerHTML = OrganizationFound; //render the Association Searched
            document.querySelector(".associationList").innerHTML += clubFound;
        });
        viewAssociationFunction(document.querySelectorAll(".associationItem"));
    });
}

function viewAssociationFunction(document){
    document.forEach((item)=>{
        item.addEventListener("click", ()=>{
            let selectedId = item.dataset.selected;
            selectedAssociationID = localStorage.setItem("selectedAssociationID", JSON.stringify(selectedId));
            window.location.href = "./viewAssociation.php";
        });
    });
}

function formButtonFunction(){
    //button functions (Don't Remove this)
    document.getElementById("associationButton").addEventListener("click", ()=>{
        let formElement = document.getElementById("pop-upForm");
        formElement.style.display = "flex";  
    });

    document.getElementById("x_button").addEventListener("click", ()=>{
        let formElement = document.getElementById("pop-upForm");
        formElement.style.display = "none"; 
    });

    document.getElementById("cancel_Button").addEventListener("click", ()=>{
        let formElement = document.getElementById("pop-upForm");
        formElement.style.display = "none"; 
    });
}