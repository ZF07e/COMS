fetch('http://localhost/COMS/LandingPage/Functions/GetAssociationDetails.php?action=displayActiveAssociation')
    .then(response => response.json())
    .then(data => {
        sessionStorage.clear();
        renderAssociations(data);
    })
    .catch(error => console.error('Error:', error));

function renderAssociations(AssociationList){
    let Associations = "";
    
    AssociationList.forEach((assosiation, index) => {   
        let pic = assosiation.image == undefined ? "../Images/COMS.png" : assosiation.image;
        Associations += `
        <div class="itemList" style="animation-delay: ${index * 0.1}s" data-association-id="${assosiation.id}"> 
            <div class="pictureFrame">
                <img src="${pic}">
            </div>
            
            <div class="title-description">
                <div class="topSection">
                    <h2>${assosiation.association}</h2>
                </div>
                <div class="details">
                    <p>Adviser: ${assosiation.adviser}</p>
                    <span>Type: ${assosiation.type}</span>
                    <a><button class="js-ApplyButton" data-association-id="${assosiation.id}">Apply</button></a>
                </div>
            </div>
        </div>
        `;
        
    });
    document.querySelector(".orgList").innerHTML = Associations;
    
    document.querySelectorAll(".js-ApplyButton").forEach((value) => {
        value.addEventListener('click', (e)=>{ 
            e.preventDefault();
            let associationId = value.dataset.associationId;
            //console.log(associationId);
            window.location.href = "Register.php";
            sessionStorage.setItem("selectedId", JSON.stringify(associationId));
        });
    });

    document.querySelectorAll(".itemList").forEach((value)=>{
        value.addEventListener('click', (e)=>{ 
            e.preventDefault();
            let associationId = value.dataset.associationId;
            //console.log(associationId);
            window.location.href = "Register.php";
            sessionStorage.setItem("selectedId", JSON.stringify(associationId));
        });
    })
};

function AddtoArray(array){
    for(let i = 0; i < array.length; i++){
        AssociationList.push(array[i]);
    }
}

