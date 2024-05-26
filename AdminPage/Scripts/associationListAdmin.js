let selectedAssociationID = JSON.parse(localStorage.getItem("selectedAssociationID")) || "";

//sample data code below. remove this when using fetch
fetch('http://localhost/COMS/LandingPage/Functions/GetAssociationDetails.php?action=getAssociationList')
.then(response => response.json())
.then(data => {
    renderList(data);
})
.catch(error => console.error('Error:', error));

fetch('http://localhost/COMS/LandingPage/Functions/GetAssociationDetails.php?action=getUserPositions')
    .then(response => response.json())
    .then(data => {
        renderAdviserOption(data)
    })
    .catch(error => console.error('Error:', error));

//render Function used for Rendering List
function renderList(AssociationLists){
    let list =  document.querySelector(".associationList")
    let orgs = "";
    let clubs = "";
    AssociationLists.forEach((association)=>{
        if(association.type === "Organization"){
            orgs += `
                <div class="associationItem" data-selected=${association.id}>
                    <img src="${association.image}" alt="" class="list--logo">
                    <div class="nameNtype">
                        <div class="tileNtypeContainer">
                            <h4 class="association--title">${association.association}</h4>
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
                    <img src="${association.image}" alt="" class="list--logo">
                    <div class="nameNtype">
                        <div class="tileNtypeContainer">
                            <h4 class="association--title">${association.association}</h4>
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
                        <img src="${value.image}" alt="" class="list--logo">
                        <div class="nameNtype">
                            <div class="tileNtypeContainer">
                                <h4 class="association--title">${value.association}</h4>
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
                        <img src="${value.image}" alt="" class="list--logo">
                        <div class="nameNtype">
                            <div class="tileNtypeContainer">
                                <h4 class="association--title">${value.association}</h4>
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
            console.log(selectedId);
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

function renderAdviserOption(users){
    let options;
    
    users.forEach((value)=>{
        if(value.position == "Adviser"){
            let fullName = value.firstName + " " + value.lastName;
            options += `
                <option value="${fullName}">${fullName}</option>    
            `;
        }
    });
    document.getElementById("advisers").innerHTML += options;
}