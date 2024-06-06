export {assocID, assoc};

fetch('http://localhost/COMS/LandingPage/Functions/GetAssociationDetails.php?action=getAssociationList')
.then(response => response.json())
.then(data => {
    funktion(data);
})
.catch(error => console.error('Error:', error));
let assocID;
let assoc;

function funktion(Associations){
    Associations.forEach((association)=>{
        if(association.id == JSON.parse(sessionStorage.getItem("selectedId"))){
            assocID = association.id;
            assoc = association.association;
            $("#assocLogo").attr("src", `${association.image == undefined ? "../Images/COMS.png" : association.image}`)
            // document.querySelector(".associationTitle").innerHTML = association.association;
            $("#assocTitle").html(association.association);
            // document.querySelector(".adviser").innerHTML = association.adviser;
            $("#assocAdviser").html(association.adviser);
            // document.querySelector(".description").innerHTML = association.description;
            $("#assocDesc").html(`${association.description == "" ? "None" : association.description }`);
            // document.querySelector(".AscMission").innerHTML = association.mission;
            $("#assocMission").html(`${association.mission == "" ? "None" : association.mission }`);
            // document.querySelector(".AscVision").innerHTML = association.vision;
            $("#assocVision").html(`${association.vision == "" ? "None" : association.vision }`);
            // document.getElementById("association").value = association.id;
        }
    });

    $("#registerButton").click((e)=>{
        e.preventDefault();
        $("#registerButton").html("Redirecting...");
        setTimeout(()=>{
            $("#registerButton").html("Register");
            window.location.href = "../User_Registration/SetupAccount/index.php";
        }, 2000)
        
    });
}