let selectedAssociation = JSON.parse(localStorage.getItem("selectedAssociationID"));
//sample Data below (Clear this when using fetch)
let Users = [
    {
        id : 1,
        pfp: "../Images/Noimg.jpg",
        name: "Coco Melon",
        firstname: "Coco",
        lastname: "Melon",
        email: "[Sample Email 1 @outlook.com]",
        position: {position: "Adviser", index: 1},
        association: {
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
    },
    {
        id : 2,
        pfp: "../Images/Noimg.jpg",
        name: "CoKo Martin",
        firstname: "CoKo",
        lastname: "Martin",
        email: "[Sample Email 2 @outlook.com]",
        position: {position: "Adviser", index: 1},
        association: {
            "id": 111,
            "image": "../Images/AssosiationsPfp/CodersPfp.jpg",
            "name": "Coders Club",
            "type": "Club",
            "adviser": "---",
            "totalMembers": 15,
            "description": "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Adipisci, dolore temporibus enim saepe dolor veniam laborum quo reprehenderit quae eaque illum nemo eveniet tenetur quibusdam ipsum odit non a quis.",
            "mission": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Error quaerat nostrum consectetur vel ipsam sapiente odio itaque? Eius neque, quia quam veritatis eligendi maiores quod cum ab voluptate nulla excepturi.",
            "vision": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit exercitationem, iste eligendi placeat repudiandae odit facilis itaque nihil recusandae earum, necessitatibus doloremque nulla, commodi iusto fuga ratione est aliquid enim."
        }
    },
    {
        id : 3,
        pfp: "../Images/Noimg.jpg",
        name: "Koko Nut",
        firstname: "Koko",
        lastname: "Nut",
        email: "[Sample Email 3 @outlook.com]",
        position: {position: "Vice President", index: 3},
        association: {
            "id": 111,
            "image": "../Images/AssosiationsPfp/CodersPfp.jpg",
            "name": "Coders Club",
            "type": "Club",
            "adviser": "---",
            "totalMembers": 15,
            "description": "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Adipisci, dolore temporibus enim saepe dolor veniam laborum quo reprehenderit quae eaque illum nemo eveniet tenetur quibusdam ipsum odit non a quis.",
            "mission": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Error quaerat nostrum consectetur vel ipsam sapiente odio itaque? Eius neque, quia quam veritatis eligendi maiores quod cum ab voluptate nulla excepturi.",
            "vision": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit exercitationem, iste eligendi placeat repudiandae odit facilis itaque nihil recusandae earum, necessitatibus doloremque nulla, commodi iusto fuga ratione est aliquid enim."
        }
    },
    {
        id : 4,
        pfp: "../Images/Noimg.jpg",
        name: "Koko Latte",
        firstname: "Koko",
        lastname: "Latte",
        email: "[Sample Email 4 @outlook.com]",
        position: {position: "President", index: 2},
        association: {
            "id": 111,
            "image": "../Images/AssosiationsPfp/CodersPfp.jpg",
            "name": "Coders Club",
            "type": "Club",
            "adviser": "---",
            "totalMembers": 15,
            "description": "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Adipisci, dolore temporibus enim saepe dolor veniam laborum quo reprehenderit quae eaque illum nemo eveniet tenetur quibusdam ipsum odit non a quis.",
            "mission": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Error quaerat nostrum consectetur vel ipsam sapiente odio itaque? Eius neque, quia quam veritatis eligendi maiores quod cum ab voluptate nulla excepturi.",
            "vision": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit exercitationem, iste eligendi placeat repudiandae odit facilis itaque nihil recusandae earum, necessitatibus doloremque nulla, commodi iusto fuga ratione est aliquid enim."
        }
    },
    {
        id : 5,
        pfp: "../Images/Noimg.jpg",
        name: "Koko Sundae",
        firstname: "Koko",
        lastname: "Sundae",
        email: "[Sample Email 4 @outlook.com]",
        position: {position: "President", index: 2},
        association: {
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
    },
    {
        id : 6,
        pfp: "../Images/Noimg.jpg",
        name: "Coco Salad",
        firstname: "Koko",
        lastname: "Salad",
        email: "[Sample Email 4 @outlook.com]",
        position: {position: "Officer", index: 8},
        association: {
            "id": 111,
            "image": "../Images/AssosiationsPfp/CodersPfp.jpg",
            "name": "Coders Club",
            "type": "Club",
            "adviser": "---",
            "totalMembers": 15,
            "description": "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Adipisci, dolore temporibus enim saepe dolor veniam laborum quo reprehenderit quae eaque illum nemo eveniet tenetur quibusdam ipsum odit non a quis.",
            "mission": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Error quaerat nostrum consectetur vel ipsam sapiente odio itaque? Eius neque, quia quam veritatis eligendi maiores quod cum ab voluptate nulla excepturi.",
            "vision": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit exercitationem, iste eligendi placeat repudiandae odit facilis itaque nihil recusandae earum, necessitatibus doloremque nulla, commodi iusto fuga ratione est aliquid enim."
        }
    }
];

//documents >>
let HomePageNav = document.getElementById("HomePage");
let HomePage = document.getElementById("home");
let ListPageNav = document.getElementById("MembersPage");
let ListPage = document.getElementById("list");
let EditHome = document.getElementById("editHome");
let editbuttonHeader = document.getElementById("editAssociation");

//Giving function to navs in header
navigationFunction();

//For Home Tab
editAddFunctions();
renderSelectedGroup(Users);

//For Members Tab
List(Users);
selectUser(Users);

//Functions below >>

function renderSelectedGroup(list){
    list.forEach((value) => {
        if(value.association.id == selectedAssociation){
            document.getElementById("associationName").innerText = value.association.name;
            document.getElementById("associationType").innerText = value.association.type    ;
            document.getElementById("home_about").innerText = value.association.description;
            document.getElementById("home_mission").innerText = value.association.mission;
            document.getElementById("home_vision").innerText = value.association.vision;
        }
    });
}

function navigationFunction(){
    //List Page
    ListPageNav.addEventListener("click", ()=>{
        HomePageNav.classList.remove("selectedNav");
        ListPageNav.classList.add("selectedNav");
        ListPage.style.display = "flex";
        HomePage.style.display = "none";
        EditHome.style.display = "none";
        editbuttonHeader.style.display = "none";
        
    });

    //Home Page
    HomePageNav.addEventListener("click", ()=>{
        ListPageNav.classList.remove("selectedNav");
        HomePageNav.classList.add("selectedNav");
        ListPage.style.display = "none";
        HomePage.style.display = "";
        editbuttonHeader.style.display = "";    
    });

    document.getElementById("backbuttonView").addEventListener("click", ()=>{
        window.location.href="./associations.php";
    });
}

function editAddFunctions(){
    editbuttonHeader.addEventListener("click", ()=>{
        HomePageNav.classList.add("selectedNav");
        ListPage.style.display = "none";
        HomePage.style.display = "none";
        EditHome.style.display = "inline";
        ListPageNav.classList.remove("selectedNav");
    });

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
            if(itemVal.position.position == "Adviser" && itemVal.association.id == selectedAssociation)
            { 
                console.log(itemVal.position === "Adviser" && itemVal.association.id == selectedAssociation);
                adviserelement += `<div class="positionedUser" data-user-id="${itemVal.id}">${itemVal.name}</div>`;
            }
            else if(itemVal.position.position  == "President" && itemVal.association.id == selectedAssociation)
            { 
                presidentelement += `<div class="positionedUser" data-user-id="${itemVal.id}">${itemVal.name}</div>`;
            }
            else if(itemVal.position.position == "Vice President" && itemVal.association.id == selectedAssociation)
            { 
                viceelement += `<div class="positionedUser" data-user-id="${itemVal.id}">${itemVal.name}</div>`;
            }
            else if(itemVal.position.position == "Secretary" && itemVal.association.id == selectedAssociation)
            { 
                secretaryelement += `<div class="positionedUser" data-user-id="${itemVal.id}">${itemVal.name}</div>`;
            }
            else if(itemVal.position.position == "Auditor" && itemVal.association.id == selectedAssociation)
            { 
                auditorelement += `<div class="positionedUser" data-user-id="${itemVal.id}">${itemVal.name}</div>`;
            }
            else if(itemVal.position.position == "Treasurer" && itemVal.association.id == selectedAssociation)
            { 
                treasurerelement += `<div class="positionedUser" data-user-id="${itemVal.id}">${itemVal.name}</div>`;
            }
            else if(itemVal.position.position == "Head Officer" && itemVal.association.id == selectedAssociation)
            { 
                headOfficerelement += `<div class="positionedUser" data-user-id="${itemVal.id}">${itemVal.name}</div>`;
            }
            else if(itemVal.position.position == "Officer" && itemVal.association.id == selectedAssociation)
            { 
                officerelement += `<div class="positionedUser" data-user-id="${itemVal.id}">${itemVal.name}</div>`;
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
                if(value.id == userClickedId){
                    selectedName.innerText = value.name;
                    selectedPosition.innerText = value.position.position;
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

