let selectedAssociation = JSON.parse(localStorage.getItem("selectedAssociationID"));

//documents >>
let HomePageNav = document.getElementById("HomePage");
let HomePage = document.getElementById("home");
let ListPageNav = document.getElementById("MembersPage");
let ListPage = document.getElementById("list");
let EditHome = document.getElementById("editHome");
let RemoveHome = document.getElementById("removeAssoc");
let editbuttonHeader = document.getElementById("editAssociation");
$("#deleteClub").css("display", "none");
//Giving function to navs in header
navigationFunction();

//For Home Tab
editAddFunctions();

//fetch associations list
fetch('http://localhost/COMS/LandingPage/Functions/GetAssociationDetails.php?action=getAssociationList')
    .then(response => response.json())
    .then(data => {
        renderSelectedGroup(data);
    })
    .catch(error => console.error('Error:', error));

//fetch members list
fetch('http://localhost/COMS/LandingPage/Functions/GetAssociationDetails.php?action=getUserPositions')
    .then(response => response.json())
    .then(data => {
        List(data);
        selectUser(data);
    })
    .catch(error => console.error('Error:', error));

window.onload = ()=>{
    let isActivated = localStorage.getItem("isActivated");
    let isDeactivated = localStorage.getItem("isDeactivated");

    if(isActivated){
        var notification = alertify.notify('Association Activated', 'success', 4);  
        localStorage.removeItem("isActivated");
    }
    if(isDeactivated){
        alertify.notify('Association Deactivated', 'custom', 4);
        localStorage.removeItem("isDeactivated");     
    }
}

function renderSelectedGroup(list){
    list.forEach((value) => {
        if(value.id == selectedAssociation){
            $("#associationName").text(value.association);   
            $("#associationType").text(value.type);  
            $("#home_about").text(value.description);  
            $("#home_mission").text(value.mission);  
            $("#home_vision").text(value.vision);  

            $("#kuninAssocName").val(value.association);
            $("#edit_about").html($("#home_about").text());
            $("#edit_mission").html($("#home_mission").text());
            $("#edit_vision").html($("#home_vision").text());

            if(value.isActive == 1){
                $("#activateAssoc").css("display", "none");
            }
            else{
                $("#removeAssoc").css("display", "none");
            }
        } 
    });
}

$("#removeAssoc").click(()=>{
    $("#deleteClub").css("display", "flex");
});

$("#N_Option").click(()=>{
    $("#deleteClub").css("display", "none");
});

$("#X_exit").click(()=>{
    $("#deleteClub").css("display", "none");
});


$("#activateAssoc").click(()=>{
    $("#Activate").css("display", "flex");
});

$("#N_OptionActive").click(()=>{
    $("#Activate").css("display", "none");
});

$("#X_exitActive").click(()=>{
    $("#Activate").css("display", "none");
});


$("#deleteAssociation").submit((e)=>{
    e.preventDefault();
    //console.log(selectedAssociation);
    $.ajax({
        type: "POST",
        url: "http://localhost/COMS/AdminPage/Functions/InfromationManagement.php?action=removeAssoc",
        data: {selectedAssoc: selectedAssociation},
        success: (s)=>{
            //window.location.href = "./associations.php";
            window.location.reload();
            localStorage.setItem("isDeactivated", true);
        }
    })
    
});

$("#ActivateAssociation").submit((e)=>{
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "http://localhost/COMS/AdminPage/Functions/InfromationManagement.php?action=activAssoc",
        data: {selectedAssoc: selectedAssociation},
        success: (s)=>{
            window.location.reload();
            localStorage.setItem("isActivated", true);
        }
    })
});

function navigationFunction(){
    //List Page
    ListPageNav.addEventListener("click", ()=>{
        HomePageNav.classList.remove("selectedNav");
        ListPageNav.classList.add("selectedNav");
        ListPage.style.display = "flex";
        HomePage.style.display = "none";
        EditHome.style.display = "none";
        editbuttonHeader.style.display = "none";
        RemoveHome.style.display = "none";
        
    });

    //Home Page
    HomePageNav.addEventListener("click", ()=>{
        ListPageNav.classList.remove("selectedNav");
        HomePageNav.classList.add("selectedNav");
        ListPage.style.display = "none";
        HomePage.style.display = "";
        editbuttonHeader.style.display = "";    
        RemoveHome.style.display = "";
    });

    document.getElementById("backbuttonView").addEventListener("click", ()=>{
        window.location.href="./associations.php";
    });
}

function editAddFunctions(){
    // editbuttonHeader.addEventListener("click", ()=>{
    //     HomePageNav.classList.add("selectedNav");
    //     ListPage.style.display = "none";
    //     HomePage.style.display = "none";
    //     EditHome.style.display = "inline";
    //     ListPageNav.classList.remove("selectedNav");
    // });

    document.getElementById("cancelChanges").addEventListener("click", ()=>{
        HomePageNav.classList.add("selectedNav");
        ListPage.style.display = "none";
        HomePage.style.display = "";
        EditHome.style.display = "none";
        ListPageNav.classList.remove("selectedNav");
    });
}

function List(users){
    let adviserelement = "", presidentelement = "", viceelement = "", 
    secretaryelement = "", auditorelement = "", treasurerelement = "", 
    headOfficerelement = "", officerelement = "";

    users.forEach((itemVal)=>{
            if(itemVal.position == "Adviser" && itemVal.associationCode == selectedAssociation)
            { 
                //console.log(itemVal.position === "Adviser" && itemVal.associationCode == selectedAssociation);
                adviserelement += `<div class="positionedUser" data-user-id="${itemVal.userID}">${itemVal.firstName} ${itemVal.lastName}</div>`;
            }
            else if(itemVal.position  == "President" && itemVal.associationCode == selectedAssociation)
            { 
                presidentelement += `<div class="positionedUser" data-user-id="${itemVal.userID}">${itemVal.firstName} ${itemVal.lastName}</div>`;
            }
            else if(itemVal.position == "Vice President" && itemVal.associationCode == selectedAssociation)
            { 
                viceelement += `<div class="positionedUser" data-user-id="${itemVal.userID}">${itemVal.firstName} ${itemVal.lastName}</div>`;
            }
            else if(itemVal.position == "Secretary" && itemVal.associationCode == selectedAssociation)
            { 
                secretaryelement += `<div class="positionedUser" data-user-id="${itemVal.userID}">${itemVal.firstName} ${itemVal.lastName}</div>`;
            }
            else if(itemVal.position == "Auditor" && itemVal.associationCode == selectedAssociation)
            { 
                auditorelement += `<div class="positionedUser" data-user-id="${itemVal.userID}">${itemVal.firstName} ${itemVal.lastName}</div>`;
            }
            else if(itemVal.position == "Treasurer" && itemVal.associationCode == selectedAssociation)
            { 
                treasurerelement += `<div class="positionedUser" data-user-id="${itemVal.userID}">${itemVal.firstName} ${itemVal.lastName}</div>`;
            }
            else if(itemVal.position == "Head Officer" && itemVal.associationCode == selectedAssociation)
            { 
                headOfficerelement += `<div class="positionedUser" data-user-id="${itemVal.userID}">${itemVal.firstName} ${itemVal.lastName}</div>`;
            }
            else if(itemVal.position == "Officer" && itemVal.associationCode == selectedAssociation)
            { 
                officerelement += `<div class="positionedUser" data-user-id="${itemVal.userID}">${itemVal.firstName} ${itemVal.lastName}</div>`;
            }
    });
    document.getElementById("adviser").innerHTML = adviserelement;
    document.getElementById("president").innerHTML = presidentelement;
    document.getElementById("vice_president").innerHTML = viceelement;
    document.getElementById("secretary").innerHTML = secretaryelement;
    document.getElementById("auditor").innerHTML = auditorelement;
    document.getElementById("treasurer").innerHTML = treasurerelement;
    document.getElementById("head_officer").innerHTML = headOfficerelement;
    document.getElementById("Officers").innerHTML = officerelement;
}

function selectUser(user){
    document.querySelectorAll(".positionedUser").forEach((item)=>{
        item.addEventListener("click", ()=>{
            let userClickedId = item.dataset.userId;
            let viewmode = document.querySelector(".infos");
            //for selecting documents
            let viewAccount = document.getElementById("viewUser");
            let selectedName = document.getElementById("selectedName");
            let selectedPosition = document.getElementById("selectedPosition");
            let selectedEmail = document.getElementById("selectedEmail");
            let xButton = document.getElementById("xbuttonView");
            let back = document.getElementById("back");

            viewAccount.style.display = "flex";
            user.forEach((value)=>{
                if(value.userID == userClickedId){
                    selectedName.innerText = value.firstName + ' ' + value.lastName;
                    selectedPosition.innerText = value.position;
                    selectedEmail.innerText = value.email;
                }
            });

            xButton.addEventListener("click", ()=>{
                viewAccount.style.display = "none";
            });

            back.addEventListener("click", ()=>{
                viewAccount.style.display = "none";
            });
        });
    })  
}