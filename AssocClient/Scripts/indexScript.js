//fetch associations list
// const data = fetch('http://localhost/COMS/LandingPage/Functions/GetAssociationDetails.php?action=getAssociation')
// .then(response => response.json())
// .then(data => {
//     console.log(data);
//     renderDashboard(data);
//     return fetch('http://localhost/COMS/LandingPage/Functions/GetAssociationDetails.php?action=getUserPositions');
// })
// .then(response => response.json())
// .catch(error => console.error('Error:', error));

// data.then(d =>{
//     //console.log(d)
//     //members(d);
// })



function members(arr){
    let ttlMembers = 0
    ttlRequest = 0;
    ttlEvents = 0;
    arr.forEach((e)=>{
        if(e.associationCode == "CLB1"){
            ttlMembers++
        }
    })
    $("#total1").text(`Members: ${ttlMembers}`);
    $("#total2").text(`Request: ${ttlRequest}`);
    $("#total3").text(`Events: ${ttlEvents}`);
}


function renderDashboard(Arr){

    Arr.forEach((e)=>{
        $("#EditOptions").css("display", "none");

        $("#assocProfile").attr("src", "../Images/COMS.png")
        $("#assocName").text(e.association);
        $("#kuninAssocName").val(e.association);
        $("#assocType").text(e.type);
                
        //display 
        $("#dashboardAbout").text(e.description);
        $("#dashboardMission").text(e.mission);
        $("#dashboardVision").text(e.vision);
        
        //edit
        $("#edit_about").html($("#dashboardAbout").text());
        $("#edit_mission").html($("#dashboardMission").text());
        $("#edit_vision").html($("#dashboardVision").text());
    });
    
    
    hideTextArea();
    
    let OptionsIsOpen = false;
    let EditIsOpen = false;
    
    //IF "..." is clicked
    $("#headerOptions").click(()=>{
        if(OptionsIsOpen){
            $("#EditOptions").css("display", "none");
            OptionsIsOpen = false;
        }
        else{
            $("#EditOptions").css("display", "flex");
            OptionsIsOpen = true;
        }    
    });
    
    //IF Edit is clicked
    $("#edtMissionVision").click(()=>{
        if(EditIsOpen){
            showTextDisplay();
            hideTextArea();
            EditIsOpen = false;
        }
        else{
            hideTextDisplay();
            showTextArea();
            EditIsOpen = true;
        }    
    });
    
    $("#resetInfoChanges").click(()=>{
        window.location.reload();
    });
    
    function hideTextDisplay(){
        $("#dashboardMission").css("display", "none");
        $("#dashboardVision").css("display", "none");
        $("#dashboardAbout").css("display", "none");
    }
    
    function showTextDisplay(){
        $("#dashboardMission").css("display", "flex");
        $("#dashboardVision").css("display", "flex");
        $("#dashboardAbout").css("display", "flex");
    }
    
    function hideTextArea(){
        $("#edit_about").css("display", "none");
        $("#edit_mission").css("display", "none");
        $("#edit_vision").css("display", "none");
        $("#optionResult").css("display", "none");
    }
    
    function showTextArea(){
        $("#edit_about").css("display", "flex");
        $("#edit_mission").css("display", "flex");
        $("#edit_vision").css("display", "flex");
        $("#optionResult").css("display", "flex");
    }
}

