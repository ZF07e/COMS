//Sample data below(remove when Using fetch)
let Users = [
    {
        id : 1,
        associationid: 111,
        associationIndex: 1,
        pfp: "../Images/Noimg.jpg",
        name: "Choco Melon",
        firstname: "Coco",
        lastname: "Melon",
        email: "[Sample Email 1 @outlook.com]",
        roleIndex: 2,  
        position: "President" 
    },
    {
        id : 2,
        associationid: 111,
        associationIndex: 1,
        pfp: "../Images/Noimg.jpg",
        name: "Choco Martin",
        firstname: "CoKo",
        lastname: "Martin",
        email: "[Sample Email 2 @outlook.com]",
        roleIndex: 1,
        position: "Adviser"
    },
    {
        id : 3,
        associationid: 122,
        associationIndex: 2,
        pfp: "../Images/Noimg.jpg",
        name: "Choco Nut",
        firstname: "Koko",
        lastname: "Nut",
        email: "[Sample Email 3 @outlook.com]",
        roleIndex: 1, 
        position: "Adviser",
    },
    {
        id : 4,
        associationid: 122,
        associationIndex: 2,
        pfp: "../Images/Noimg.jpg",
        name: "Choco Latte",
        firstname: "Koko",
        lastname: "Latte",
        email: "[Sample Email 4 @outlook.com]",
        roleIndex: 2,
        position: "President",
    }
];

//sample data 2
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

renderUserList(Users, AssociationLists);// use this function for rendering

function renderUserList(userList, association){//Function For Rendering
    
    let users = "";
    let associations = "";
    userList.forEach((UserProfile) => {
        users += `
                <div class="userItem">
                    <div class="item_left">
                        <img src="${UserProfile.pfp}" class="profilePicture">
                        <div class="userInfo">
                            <p id="user_adviser">${UserProfile.name}</p>
                            <p id="position">${UserProfile.position}</p>
                        </div>
                    </div>
                    <button id="editUser" class="editUserClass" data-User-id="${UserProfile.id}">Edit</button>
                </div>
                `;
    });

    association.forEach((asscList)=>{
        associations += `
        <option value="${asscList.name}">${asscList.name}</option>
        `
    });

    document.getElementById("EdithandlingAssociation").innerHTML += associations;
    document.getElementById("handlingAssociation").innerHTML += associations;
    
    document.querySelector(".userList").innerHTML = users;
    SearchTab(userList);
    editButtonFunction(userList, association);
    FormButtonsFunctions();
};


function SearchTab(userList){
    //When Searching User
    document.getElementById("searchUser").addEventListener("keyup", ()=>{
        //get input String and convert it to UpperCase
        let searchString = document.getElementById("searchUser").value.toUpperCase();
        let accountsFound = "";
        
        userList.forEach((value)=>{  
        if(value.name.toUpperCase().includes(searchString, 0)){
            accountsFound += `
                            <div class="userItem">
                                <div class="item_left">
                                    <img src="${value.pfp}" class="profilePicture">
                                    <div class="userInfo">
                                        <p id="user_adviser">${value.name}</p>
                                        <p id="clubName">${value.position}</p>
                                    </div>
                                </div>
                                <button id="editUser" class="editUserClass" data-User-id="${value.id}">Edit</button>
                            </div>
                            `;
        }
            document.querySelector(".userList").innerHTML = accountsFound; //render the accounts Searched
        });
        editButtonFunction(userList);
    });
}

function editButtonFunction(userList){
    //Form Editing Buttons Functions
    document.querySelectorAll(".editUserClass").forEach((item)=>{
        item.addEventListener("click", ()=>{
            //gets the button's stored id and display the floating form
            let userSelectedId = item.dataset.userId;
            let positionIndex = document.getElementById("EdithandlingAssociation");
            document.getElementById("pop-upUserEdit").style.display = "flex";
            
            userList.forEach((userListId)=>{//gets the current value of the users Information               
                if(userListId.id == userSelectedId){
                    document.getElementById("User_FirstName").value = userListId.firstname;
                    document.getElementById("User_LastName").value = userListId.lastname;
                    document.getElementById("User_Email").value = userListId.email;
                    document.querySelector(".roles").selectedIndex = userListId.roleIndex;
                    document.getElementById("EdithandlingAssociation").selectedIndex = userListId.associationIndex;
                }
            })
        }); 
    });
}

function FormButtonsFunctions(){
    //When x is click in User Edit
    document.getElementById("UserEdit_x_button").addEventListener("click" ,()=>{
        document.getElementById("pop-upUserEdit").style.display = "none";
    });

    //When cancel is click in User Edit
    document.getElementById("cancel_Edit").addEventListener("click" ,()=>{
        document.getElementById("pop-upUserEdit").style.display = "none";
    });

    //Form Inserting Buttons Functions
    document.getElementById("associationButton").addEventListener("click" ,()=>{
        document.getElementById("pop-upFormUser").style.display = "flex";
    });

    //When X Button is clicked in Adding account
    document.getElementById("User_x_button").addEventListener("click" ,()=>{
        document.getElementById("pop-upFormUser").style.display = "none";
    });

    //When Cancel Button is clicked in Adding account
    document.getElementById("User_cancel_Button").addEventListener("click" ,()=>{
        document.getElementById("pop-upFormUser").style.display = "none";
    });
}



