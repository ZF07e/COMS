window.onload = ()=>{
    let useradded = localStorage.getItem("userResponse");
    let userDeact = localStorage.getItem("userDeact");
    let userActvt = localStorage.getItem("userActvt");

    if(useradded){
        var notification = alertify.notify('User Added', 'success', 4);  
        localStorage.removeItem("userResponse");
    }
    if(userDeact){
        var notification = alertify.notify('User Deactivated', 'custom', 4);  
        localStorage.removeItem("userDeact");
    }
    if(userActvt){
        var notification = alertify.notify('User Activated', 'success', 4);  
        localStorage.removeItem("userActvt");
    }
}

fetch('http://localhost/COMS/LandingPage/Functions/GetAssociationDetails.php?action=getUserListPositions')
    .then(response => response.json())
    .then(data => {
        renderUserList(data);
        SearchTab(data);
    })
    .catch(error => console.error('Error:', error));

fetch('http://localhost/COMS/LandingPage/Functions/GetAssociationDetails.php?action=getAssociationList')
    .then(response => response.json())
    .then(data => {
        getAssociationList(data);
    })
    .catch(error => console.error('Error:', error));

$("#pop-upFormUser").submit((e)=>{
    localStorage.setItem("userResponse", true);
    $("#forPopUpUser").css("display", "none"); 
});

$("#confirmation").submit((e)=>{
    localStorage.setItem("userDeact", true);
    //window.location.reload();
});

$("#activateBtn").click(()=>{
    localStorage.setItem("userActvt", true);
    window.location.reload();
});

function renderUserList(userList){//Function For Rendering 
    let users = "";
    
    userList.forEach((userprofile) => {
        //                        <img src="${userprofile.pfp}" class="profilePicture" alt="">
        console.log(userprofile.userStatus);
        if(userprofile.userStatus == 1){
            users += `
            <div class="userItem" data-User-id="${userprofile.userID}">
                <div class="item_left">
                    <div class="userInfo">
                        <p id="user_adviser">${userprofile.firstName} ${userprofile.lastName}</p>
                        <p id="position">${userprofile.position} (${userprofile.affiliation == "" ? "Unassigned" : userprofile.affiliation})</p>
                    </div>
                </div>
            </div>
            `;
            console.log(users);
        }
        else{
            users += `
            <div class="userItem DeactuserItem" data-User-id="${userprofile.userID}">
                <div class="item_left">
                    <div class="userInfo">
                        <p id="user_adviser">${userprofile.firstName} ${userprofile.lastName}</p>
                        <p id="position">${userprofile.position} (${userprofile.affiliation == "" ? "Unassigned" : userprofile.affiliation})</p>
                    </div>
                </div>
            </div>
            `;
            console.log(users);
        }

    });
    
    console.log(users);
    document.querySelector(".userList").innerHTML = users;
    SearchTab(userList);
    editButtonFunction(userList);
    FormButtonsFunctions();
}

function getAssociationList(list){
    let associations = "";

    list.forEach((asscList)=>{
        if(!associations.includes(asscList.association)){
            //console.log(associations);
            associations += `<option value="${asscList.association}"> ${asscList.association}</option>`
        }
    });

    document.getElementById("EdithandlingAssociation").innerHTML += associations;
}

function SearchTab(userList){
    //When Searching User
    document.getElementById("searchUser").addEventListener("keyup", ()=>{
        //get input String and convert it to UpperCase
        let searchString = document.getElementById("searchUser").value.toUpperCase();
        let accountsFound = "";
        userList.forEach((value)=>{
        let fullName = value.firstName +" "+ value.lastName;  
        if(fullName.toUpperCase().includes(searchString, 0)){
            accountsFound += `
                            <div class="userItem" data-User-id="${value.userID}">
                                <div class="item_left">
                                    <div class="userInfo">
                                        <p id="user_adviser">${fullName}</p>
                                        <p id="position">${value.position} (${value.affiliation == "" ? "Unassigned" : value.affiliation})</p>
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
                if(userListId.userID == userSelectedId){
                    for(let i = 0; i < selectOptions.length; i++){
                        if(selectOptions[i].text == userListId.firstName){
                            selectIndex = selectOptions[i].index;
                            //console.log(selectIndex);
                        }
                    }
                    
                    if(userListId.userStatus == 0){
                        $("#activateBtn").css("display", "inline");
                        $("#removeUser").css("display", "none");
                    }
                    else{
                        $("#activateBtn").css("display", "none");
                        $("#removeUser").css("display", "inline");
                    }

                    document.getElementById("selectedName").innerText = userListId.firstName + " " + userListId.lastName;   
                    document.getElementById("selectedPosition").innerText = userListId.position;

                    document.getElementById("selectedEmail").innerText = userListId.email;
                    document.getElementById("selectedEmail").value = userListId.email;
                    //console.log(userList.email);
                       
                    document.getElementById("User_FirstName").value = userListId.firstName;
                    document.getElementById("User_LastName").value = userListId.lastName;
                    document.getElementById("User_Email").value = userListId.email;

                    document.getElementById("EditselectedPosition").selectedIndex = userListId.position.index;
                    document.getElementById("EdithandlingAssociation").selectedIndex = selectIndex;
                    document.getElementById("ID").value = userSelectedId;
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
            //doc.preventDefault();
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
            //event.preventDefault();
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
        document.getElementById("forPopUpUser").style.display = "flex";
    });

    //When X Button is clicked in Adding account
    document.getElementById("User_x_button").addEventListener("click" ,()=>{
        document.getElementById("forPopUpUser").style.display = "none";
    });

    //When Cancel Button is clicked in Adding account
    document.getElementById("User_cancel_Button").addEventListener("click" ,()=>{
        document.getElementById("forPopUpUser").style.display = "none";
    });
}
