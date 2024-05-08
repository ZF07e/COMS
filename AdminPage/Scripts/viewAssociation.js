let selectedAssociation = JSON.parse(localStorage.getItem("selectedAssociationID"));
//sample Data below (Clear this when using fetch)
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
//sample Data 2
let Users = [
    {
        id : 1,
        associationid: 111,
        pfp: "../Images/Noimg.jpg",
        name: "Coco Melon",
        firstname: "Coco",
        lastname: "Melon",
        email: "[Sample Email 1 @outlook.com]",
        role: "Adviser (sample)",
        roleIndex: 1, //index 2 = adviser
        position: "Adviser",
        positionIndex: 1
    },
    {
        id : 2,
        associationid: 111,
        pfp: "../Images/Noimg.jpg",
        name: "CoKo Martin",
        firstname: "CoKo",
        lastname: "Martin",
        email: "[Sample Email 2 @outlook.com]",
        role: "Student (sample)",
        roleIndex: 1,
        position: "President",
        positionIndex: 2
    },
    {
        id : 3,
        associationid: 111,
        pfp: "../Images/Noimg.jpg",
        name: "Koko Nut",
        firstname: "Koko",
        lastname: "Nut",
        email: "[Sample Email 3 @outlook.com]",
        role: "Student (sample)",
        roleIndex: 2, //index 2 = student
        position: "Vice President",
        positionIndex: 3
    },
    {
        id : 4,
        associationid: 111,
        pfp: "../Images/Noimg.jpg",
        name: "Koko Latte",
        firstname: "Koko",
        lastname: "Latte",
        email: "[Sample Email 4 @outlook.com]",
        role: "Student (sample)",
        roleIndex: 2,
        position: "Secretary",
        positionIndex: 4
    },
    {
        id : 5,
        associationid: 122,
        pfp: "../Images/Noimg.jpg",
        name: "Koko Sundae",
        firstname: "Koko",
        lastname: "Sundae",
        email: "[Sample Email 4 @outlook.com]",
        role: "Student (sample)",
        roleIndex: 2,
        position: "Officer",
        positionIndex: 8
    },
    {
        id : 6,
        associationid: 111,
        pfp: "../Images/Noimg.jpg",
        name: "Coco Salad",
        firstname: "Koko",
        lastname: "Salad",
        email: "[Sample Email 4 @outlook.com]",
        role: "Student (sample)",
        roleIndex: 2,
        position: "Officer",
        positionIndex: 8
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
renderSelectedGroup(AssociationLists);

//For Members Tab
List(Users);
selectUser(Users);

//Functions below >>

function renderSelectedGroup(list){
    list.forEach((value) => {
        if(value.id == selectedAssociation){
            document.getElementById("associationName").innerText = value.name;
            document.getElementById("associationType").innerText = value.type    ;
            document.getElementById("home_about").innerText = value.description;
            document.getElementById("home_mission").innerText = value.mission;
            document.getElementById("home_vision").innerText = value.vision;
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
            if(itemVal.position == "Adviser" && itemVal.associationid == selectedAssociation)
            { 
                console.log(itemVal.position === "Adviser" && itemVal.associationid == selectedAssociation);
                adviserelement += `<div class="positionedUser" data-user-id="${itemVal.id}">${itemVal.name}</div>`;
            }
            else if(itemVal.position == "President" && itemVal.associationid == selectedAssociation)
            { 
                presidentelement += `<div class="positionedUser" data-user-id="${itemVal.id}">${itemVal.name}</div>`;
            }
            else if(itemVal.position == "Vice President" && itemVal.associationid == selectedAssociation)
            { 
                viceelement += `<div class="positionedUser" data-user-id="${itemVal.id}">${itemVal.name}</div>`;
            }
            else if(itemVal.position == "Secretary" && itemVal.associationid == selectedAssociation)
            { 
                secretaryelement += `<div class="positionedUser" data-user-id="${itemVal.id}">${itemVal.name}</div>`;
            }
            else if(itemVal.position == "Auditor" && itemVal.associationid == selectedAssociation)
            { 
                auditorelement += `<div class="positionedUser" data-user-id="${itemVal.id}">${itemVal.name}</div>`;
            }
            else if(itemVal.position == "Treasurer" && itemVal.associationid == selectedAssociation)
            { 
                treasurerelement += `<div class="positionedUser" data-user-id="${itemVal.id}">${itemVal.name}</div>`;
            }
            else if(itemVal.position == "Head Officer" && itemVal.associationid == selectedAssociation)
            { 
                headOfficerelement += `<div class="positionedUser" data-user-id="${itemVal.id}">${itemVal.name}</div>`;
            }
            else if(itemVal.position == "Officer" && itemVal.associationid == selectedAssociation)
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
            //for selecting documents
            let viewAccount = document.getElementById("viewUser");
            let selectedName = document.getElementById("selectedName");
            let selectedPosition = document.getElementById("selectedPosition");
            let selectedEmail = document.getElementById("selectedEmail");

            //for editing documents
            let EditselectedName = document.getElementById("EditselectedName");
            let EditselectedPosition = document.getElementById("EditselectedPosition");
            let EditselectedEmail = document.getElementById("EditselectedEmail");

            viewAccount.style.display = "flex";
            user.forEach((value)=>{
                if(value.id == userClickedId){
                    selectedName.innerText = value.name;
                    selectedPosition.innerText = value.position;
                    selectedEmail.innerText = value.email;
                    EditselectedName.value = value.name;
                    EditselectedPosition.value = value.position;
                    EditselectedEmail.value = value.email;
                }
            });


            //upperlayer2
            let upperlayer2 = document.querySelector(".upperlayer2");
            //switch to edit mode
            let editbutton = document.getElementById("editInfo");
            let editmode = document.querySelector(".edit_infos");
            let viewmode = document.querySelector(".infos");


            editbutton.addEventListener("click", ()=>{
                viewmode.style.display = "none";
                editmode.style.display = "flex";

            });

            //Return/back/cancel document
            let xbuttonView = document.getElementById("xbuttonView");
            let backView = document.getElementById("back");
            let cancelEdit = document.getElementById("cancelEdit");
            let saveChanges = document.getElementById("saveChanges");

            //add events to documents
            Close_and_switchtoView(xbuttonView);
            Close_and_switchtoView(backView);
            switchtoView(cancelEdit);  

            //confirmation
            let removeUser = document.getElementById("removeUser");
            let yesbtn = document.getElementById("yesbtn");
            let nobtn = document.getElementById("nobtn");

            removeUser.addEventListener("click", ()=>{
                upperlayer2.style.display = "flex";
            });

            closeAllPopUp(yesbtn);
            closeConf(nobtn);

            saveChanges.addEventListener("click", (event)=>{
                event.preventDefault();
                viewmode.style.display = "flex";
                editmode.style.display = "none";
            });

            //Functions >>
            function closeAllPopUp(document){
                document.addEventListener("click", (doc)=>{
                    doc.preventDefault();
                    upperlayer2.style.display = "none";
                    viewAccount.style.display = "none";
                });
            }

            function Close_and_switchtoView(document){
                    document.addEventListener("click", ()=>{
                    viewAccount.style.display = "none";
                    viewmode.style.display = "flex";
                    editmode.style.display = "none";
                });
            }

            function switchtoView(document){
                document.addEventListener("click", ()=>{
                viewmode.style.display = "flex";
                editmode.style.display = "none";
                });
            }

            function closeConf(document){
                document.addEventListener("click", ()=>{
                upperlayer2.style.display = "none";
                });
            }
        });
    })  
}

