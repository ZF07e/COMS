let Documents = [];
let selectedRequest = JSON.parse(localStorage.getItem("selectedRequest"));
fetch(`http://localhost/COMS/AssocClient/Functions/GetDocument.php?action=getDocumentDetails`)
    .then(response => response.json())
    .then(data => {
        Documents = data;
        Documents.forEach((e) => {
            if (e.id == selectedRequest) {
                id = e.id;
                $("#headerTitleRequest").text(e.subject);
                $("#documentPrev").attr('src', `../PDF-FILES/${e.id}.pdf`);
            }
        });
    })
    .catch(error => console.error('Error:', error));

    $.ajax({
        url: "http://localhost/COMS/AssocClient/Functions/GetDocument.php",
        method: "POST",
        data: {selectedID: selectedRequest},
        success: function(response){
            console.log(response);
            displayRecipient(response);
            checkIfDownloadable(response);
        }
    })
    console.log(selectedRequest);
$("#backButton").on("click", ()=>{
    window.location.href = "../AssocClient/Request.php";
});

$("#downloadButton").on("click", ()=>{
    console.log("Hello")
});


function displayRecipient(Users){
    let endorserElements = "";
    let noterElements = "";
    let approverElements = "";
    
    Users.forEach((e)=>{
        if(e.role == "Endorser"){
            endorserElements += `
            <div id="recipientContainer">
                <div id="reciepientName">
                    <p>${e.name}</p>
                </div>
                <div id="reciepientStatus${e.status}">${e.status}</div>
            </div>   
            `;
        }
        else if(e.role == "Noter"){
            noterElements += `
            <div id="recipientContainer">
                <div id="reciepientName">
                    <p>${e.name}</p>
                </div>
                <div id="reciepientStatus${e.status}">${e.status}</div>
            </div>   
            `;
        }
        else if(e.role == "Approver"){
            approverElements += `
            <div id="recipientContainer">
                <div id="reciepientName">
                    <p>${e.name}</p>
                </div>
                <div id="reciepientStatus${e.status}">${e.status}</div>
            </div>   
            `;
        }
    });
    
    $("#endorsedList").html(endorserElements);
    $("#noteList").html(noterElements);
    $("#approvedList").html(approverElements);
}


function checkIfDownloadable(Users){
    let totalRecipient = Users.length;
    let totalSigned = 0;

    Users.forEach((e)=>{
        if(e.role == "Signed"){
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