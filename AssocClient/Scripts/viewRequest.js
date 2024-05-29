let Users = [
    {
        id : 1,
        name: "Coco Melon",
        requestStatus: "Signed",
        recipientRole: "endorser"
    },
    {
        id : 2,
        name: "CoKo Martin",
        requestStatus: "Signed",
        recipientRole: "endorser"
    },
    {
        id : 3,
        name: "Koko Nut",
        requestStatus: "Signed",
        recipientRole: "noter"
    },
    {
        id : 4,
        name: "Koko Latte",
        requestStatus: "Signed",
        recipientRole: "endorser"
    },
    {
        id : 5,
        name: "Koko Sundae",
        requestStatus: "Pending",
        recipientRole: "approver"
    },
    {
        id : 6,
        name: "Coco Salad",
        requestStatus: "Signed",
        recipientRole: "endorser"
    }
];
// let Documents = [];


let selectedRequest = JSON.parse(localStorage.getItem("selectedRequest"));
console.log(selectedRequest);

$.ajax({
    type: "POST",
    url: "../AssocClient/Functions/GetDocument.php",
    data: {req: selectedRequest},
    success: (e)=>{
        console.log(e);
    }
});



// fetch('http://localhost/COMS/AssocClient/Functions/GetDocument.php?action=getDocumentDetails')
//     .then(response => response.json())
//     .then(data => {
//         Documents = data;
//         
//         //console.log(selectedRequest);

//         if(selectedRequest){

//         }  
//     })
//     .catch(error => console.error('Error:', error));

displayRecipient();
checkIfDownloadable();

$("#backButton").on("click", ()=>{
    window.location.href = "../AssocClient/Request.php";
});

$("#downloadButton").on("click", ()=>{
    console.log("Hello")
});


function displayRecipient(){
    let endorserElements = "";
    let noterElements = "";
    let approverElements = "";
    
    Users.forEach((e)=>{
        if(e.recipientRole == "endorser"){
            endorserElements += `
            <div id="recipientContainer">
                <div id="reciepientName">
                    <p>${e.name}</p>
                </div>
                <div id="reciepientStatus${e.requestStatus}">${e.requestStatus}</div>
            </div>   
            `;
        }
        else if(e.recipientRole == "noter"){
            noterElements += `
            <div id="recipientContainer">
                <div id="reciepientName">
                    <p>${e.name}</p>
                </div>
                <div id="reciepientStatus${e.requestStatus}">${e.requestStatus}</div>
            </div>   
            `;
        }
        else if(e.recipientRole == "approver"){
            approverElements += `
            <div id="recipientContainer">
                <div id="reciepientName">
                    <p>${e.name}</p>
                </div>
                <div id="reciepientStatus${e.requestStatus}">${e.requestStatus}</div>
            </div>   
            `;
        }
    });
    
    $("#endorsedList").html(endorserElements);
    $("#noteList").html(noterElements);
    $("#approvedList").html(approverElements);
}


function checkIfDownloadable(){
    let totalRecipient = Users.length;
    let totalSigned = 0;

    Users.forEach((e)=>{
        if(e.requestStatus == "Signed"){
            totalSigned++;
        }
    });

    console.log(totalRecipient + " - " + totalSigned);
    if(totalSigned === totalRecipient){
        $("#downloadButton").removeAttr("disabled", false);
    }
    else{
        $("#downloadButton").attr("disabled", true);
    }
}