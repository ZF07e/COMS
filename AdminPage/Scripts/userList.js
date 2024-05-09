//Sample data below(remove when Using fetch)
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

renderUserList(Users);// use this function for rendering

function renderUserList(userList){//Function For Rendering 
    let users = "";
    let associations = "";
    userList.forEach((userprofile) => {
        users += `
                <div class="userItem" data-User-id="${userprofile.id}">
                    <div class="item_left">
                        <img src="${userprofile.pfp}" class="profilePicture">
                        <div class="userInfo">
                            <p id="user_adviser">${userprofile.name}</p>
                            <p id="position">${userprofile.position.position} (${userprofile.association.name})</p>
                        </div>
                    </div>
                </div>
                `;
    });

    userList.forEach((asscList)=>{
        if(!associations.includes(asscList.association.name)){
            console.log("yes");
            associations += `
            <option value="${asscList.association.name}"> ${asscList.association.name}</option>
            `
        }

    });

    document.getElementById("EdithandlingAssociation").innerHTML += associations;
    document.getElementById("handlingAssociation").innerHTML += associations;
    document.querySelector(".userList").innerHTML = users;
    SearchTab(userList);
    editButtonFunction(userList);
    FormButtonsFunctions();
}

function SearchTab(userList){
    //When Searching User
    document.getElementById("searchUser").addEventListener("keyup", ()=>{
        //get input String and convert it to UpperCase
        let searchString = document.getElementById("searchUser").value.toUpperCase();
        let accountsFound = "";

        userList.forEach((value)=>{  
        if(value.name.toUpperCase().includes(searchString, 0)){
            accountsFound += `
                            <div class="userItem" data-User-id="${value.id}">
                                <div class="item_left">
                                    <img src="${value.pfp}" class="profilePicture">
                                    <div class="userInfo">
                                        <p id="user_adviser">${value.name}</p>
                                        <p id="position">${value.position.position} (${value.association.name})</p>
                                    </div>
                                </div>
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
    document.querySelectorAll(".userItem").forEach((item)=>{
        item.addEventListener("click", ()=>{
            //gets the button's stored id and display the floating form
            let userSelectedId = item.dataset.userId;


            document.querySelector(".upperlayer").style.display = "flex";
            let selectIndex;
            let selectOptions = document.getElementById("EdithandlingAssociation");
            userList.forEach((userListId)=>{//gets the current value of the users Information               
                if(userListId.id == userSelectedId){
                    for(let i = 0; i < selectOptions.length; i++){
                        if(selectOptions[i].text == userListId.association.name){
                            selectIndex = selectOptions[i].index;
                            console.log(selectIndex);
                            
                        }
                    }
                    document.getElementById("selectedName").innerText = userListId.name;   
                    document.getElementById("selectedPosition").innerText = userListId.position.position;   
                    document.getElementById("selectedEmail").innerText = userListId.email;   
                    document.getElementById("User_FirstName").value = userListId.firstname;
                    document.getElementById("User_LastName").value = userListId.lastname;
                    document.getElementById("User_Email").value = userListId.email;
                    document.getElementById("EditselectedPosition").selectedIndex = userListId.position.index;
                    document.getElementById("EdithandlingAssociation").selectedIndex = selectIndex;


                }
            })
        }); 
        PopUpFormFunction();
    });
}

function PopUpFormFunction(){
        let viewAccount = document.getElementById("viewUser"); //Upper Layer        
        let upperlayer2 = document.querySelector(".upperlayer2"); //Upperlayer2

        //switch to edit mode
        let editbutton = document.getElementById("editInfo");
        let editmode = document.querySelector(".edit_infos"); //editView
        let viewmode = document.querySelector(".infos"); //Classic View

        //Return/back/cancel document
        let xbuttonView = document.getElementById("xbuttonView");
        let backView = document.getElementById("back");
        let cancelEdit = document.getElementById("cancelEdit");
        let saveChanges = document.getElementById("saveChanges");

        //confirmation
        let removeUser = document.getElementById("removeUser");
        let yesbtn = document.getElementById("yesbtn");
        let nobtn = document.getElementById("nobtn");

        editbutton.addEventListener("click", ()=>{
            viewmode.style.display = "none";
            editmode.style.display = "flex";
        });

        //Return Functions
        switchtoView(cancelEdit);  
        Close_and_switchtoView(xbuttonView);
        Close_and_switchtoView(backView);

        //On Confirmation Functions
        yesbtn.addEventListener("click", (doc)=>{
            doc.preventDefault();
            upperlayer2.style.display = "none";
            viewAccount.style.display = "none";
        });

        nobtn.addEventListener("click", ()=>{
            upperlayer2.style.display = "none";
        });

        //Remove User 
        removeUser.addEventListener("click", ()=>{
            upperlayer2.style.display = "flex";
        });


        saveChanges.addEventListener("click", (event)=>{
            event.preventDefault();
            viewmode.style.display = "flex";
            editmode.style.display = "none";
        });

        //Functions >>
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
}

function FormButtonsFunctions(){
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



