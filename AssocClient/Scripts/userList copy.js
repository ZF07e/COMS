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

/*


    SAMPLE DATA BELOW
    Clear it when using "fetch"


*/


//SampleData  
let applicants = [
    {
        id: 1,
        name: "Firstname Lastname",
        email: "Sample@123456@alabang.sti.edu.ph",
        gender: "Male",
        course: "Bachelor In Science In Information In Technology",
        desc: "Good At Cook'in"
    },
    {
        id: 2,
        name: "Firstname2 Lastname2",
        email: "Sample@123456@alabang.sti.edu.ph2",
        gender: "Female",
        course: "Bachelor In Science In Information In Technology2",
        desc: "Good At Cook'in2"
    }
]


//do not remove this (Used for selecting an applicant)
let selectedApp; 

fetch('http://localhost/COMS/AssocClient/Functions/Querries/getUsers.php')
    .then(response => response.json())
    .then(data => {
        renderUserList(data);
        SearchTab(data);
        renderApplicantList(applicants)
    })
    .catch(error => console.error('Error:', error));

fetch('http://localhost/COMS/AssocClient/Functions/Querries/InfromationManagement.php?action=getPosition')
    .then(response => response.json())
    .then(data => {
        if(data == "President" || data == "Adviser" || data == "Vice President"){
            $("#associationButton").css("display", "inline");
        }
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

$("#Members").click((e)=>{
    e.preventDefault();
    $("#Members").addClass("navSelected");
    $("#Applicants").removeClass("navSelected");
    $(".userList").css("display", "flex");
    $(".ap_item").css("display", "none");
    $("#associationButton").css("display", "inline");
});

$("#Applicants").click((e)=>{
    e.preventDefault();
    $("#Applicants").addClass("navSelected");
    $("#Members").removeClass("navSelected");
    $(".ap_item").css("display", "flex");
    $(".userList").css("display", "none");
    $(".ap_item").css("display", "flex");
    $("#associationButton").css("display", "none");
});

$("#applicantPopUpCon").click((e)=>{
    e.preventDefault();
    e.stopPropagation();
    $("#applicantPopUpCon").css("display", "none");
});


function renderUserList(userList){//Function For Rendering 
    let users = "";
    
    userList.forEach((userprofile) => {
        //<img src="${userprofile.pfp}" class="profilePicture" alt="">
        if(userprofile.userStatus == 1){
            users += `
            <div class="userItem">
                <div class="item_left">
                    <div class="userInfo">
                        <p id="user_adviser">${userprofile.firstName} ${userprofile.lastName}</p>
                        <p id="position">${userprofile.position} (${userprofile.affiliation == "" ? "Unassigned" : userprofile.affiliation})</p>
                    </div>
                </div>

                <button class="viewDetailsEL"  data-User-id="${userprofile.userID}">View Details</button>
            </div>
            `;
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
                <button class="viewDetailsEL"  data-User-id="${userprofile.userID}">View Details</button>
            </div>
            `;
        }

    });
    document.querySelector(".userList").innerHTML = users;
    SearchTab(userList);
    editButtonFunction(userList);
    FormButtonsFunctions();
}

function renderApplicantList(applicantList){
    let applicants = "";
    
    applicantList.forEach((app) => {
        console.log(app.id)
        applicants += `
            <div class="ap_item" data-Applicant="${app.id}">
                <div class="item_left">
                    <div class="userInfo">
                        <p id="applicant">${app.name}</p>
                        <p id="applicantEmail">${app.email}</p>
                    </div>
                </div>
                <div>
                    <button id="ap_accept2" class="ap_accept2C" data-Applicant="${app.id}">Accept</button>
                    <button id="ap_reject2" class="ap_reject2C" data-Applicant="${app.id}">Reject</button>
                </div>
            </div>
            `;
        });
    

    $(".ap_list").html(applicants);

    $("#applicantPopUp").click((e)=>{
        e.stopPropagation();
        e.preventDefault();
    });

    document.querySelectorAll(".ap_accept2C").forEach((e)=>{
        e.addEventListener("click", (ev)=>{
            ev.stopPropagation();
            ev.preventDefault();
            selectedApp = e.dataset.applicant;
            $("#applicantPopUpCon").css("display", "flex");
            displaySelectedAp(applicantList);
        });
    });

    document.querySelectorAll(".ap_reject2C").forEach((e)=>{
        e.addEventListener("click", (ev)=>{
            ev.stopPropagation();
            ev.preventDefault();
            selectedApp = e.dataset.applicant;
            $("#applicantPopUpCon").css("display", "flex");
            displaySelectedAp(applicantList);
        });
    });

    // document.querySelectorAll(".ap_item").forEach((e)=>{
    //     e.addEventListener("click", (ev)=>{
    //         ev.stopPropagation();
    //         ev.preventDefault();
    //         selectedApp = e.dataset.applicant;
    //         $("#applicantPopUpCon").css("display", "flex");
    //         displaySelectedAp(applicantList);
    //     });
    // });
}

function displaySelectedAp(applicantList){
    let sl_gender;
    let getApp = applicantList;
    getApp.forEach((values)=>{
        //console.log(values.id + " - " + selectedApp);
        if(values.id == selectedApp){
            sl_gender = values.gender;
            $("#sl_name").html(values.name);
            $("#ap_name").html(values.name);
            $("#ap_email").html(values.email);
            $("#ap_cour").html(values.course);
            $("#ap_desc").html(values.desc);
        }
    });

    $("#ap_exit").click((e)=>{
        e.preventDefault();
        e.stopPropagation();
        $("#applicantPopUpCon").css("display", "none");
    });

    $("#sl_exit").click((e)=>{
        e.preventDefault();
        e.stopPropagation();
        $("#selectPositionCon").css("display", "none");
        $("#sl_position")[0].selectedIndex = 0;
    });
    
    $("#ap_acc").click((e)=>{
        e.preventDefault();
        e.stopPropagation();
        $("#applicantPopUpCon").css("display", "none");
        $("#selectPositionCon").css("display", "flex");
    });
    
    $("#ap_rej").click((e)=>{
        e.preventDefault();
        e.stopPropagation();
        //$("#applicantPopUpCon").css("display", "none");
        alertify.confirm('Reject Applicant', 'Are you sure to reject this applicant?', 
        function(){ //IF REJECT USER
            
            
            
            
            //CODE HERE 



            $("#applicantPopUpCon").css("display", "none");
            window.location.reload();
        },
        function(){
            $("#applicantPopUpCon").css("display", "none");
            window.location.reload();
        });
    });

    $("#sl_acc").click((e)=>{ // IF USER ACCEPTED 
        //CODE HERE
        e.preventDefault();
        if($("#sl_position").val() != ""){
            let name = $("#sl_name").text();
            let email = $("#ap_email").text();
            let position = $("#sl_position").val();
            let course = $("#ap_cour").text();
            let gender = sl_gender;

            $.ajax({
                type: "POST",
                url: "",
                data: {name, email, position, course, gender}, //Short hand to for (name: name, email: email, etc...)
                success: (res)=>{
                    $("#selectPositionCon").css("display", "none");
                    window.location.reload();
                }
            });
        }
    }); 
}

function getAssociationList(list){
    let associations = "";

    list.forEach((asscList)=>{
        if(!associations.includes(asscList.association)){
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
                                <button class="viewDetailsEL"  data-User-id="${value.userID}">View Details</button>
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
    document.querySelectorAll(".viewDetailsEL").forEach((item)=>{
        item.addEventListener("click", ()=>{
            //gets the button's stored id and display the floating form
            let userSelectedId = item.dataset.userId;

            document.querySelector(".upperlayer").style.display = "flex";
            let selectIndex;
            let selectOptions = document.getElementById("EdithandlingAssociation");
            
            userList.forEach((userListId)=>{//gets the current value of the users Information               
                if(userListId.userID == userSelectedId){
                    // for(let i = 0; i < selectOptions.length; i++){
                    //     if(selectOptions[i].text == userListId.firstName){
                    //         selectIndex = selectOptions[i].index;
                    //         //console.log(selectIndex);
                    //     }
                    // }
                    
 
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
                    //document.getElementById("EdithandlingAssociation").selectedIndex = selectIndex;
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
