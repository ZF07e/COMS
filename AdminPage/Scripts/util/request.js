localStorage.clear("selectedRequest");
let selectedRequest = JSON.parse(localStorage.getItem("selectedRequest")) || "";

let Documents = [
    {
        requestID: 0,
        requestSender: "Mr Lorem Ipsum",
        requestStatus: "inbox",
        requestSubject: "Sample Subject",
        requestDate: "May 21 2024"
    },
    {
        requestID: 1,
        requestSender: "IRB",
        requestStatus: "archived",
        requestSubject: "Sample Session Invitation",
        requestDate: "May 29 2024"
    }
];

displayRequest();

let inboxbod = document.getElementById("containerBody");
let apprvbod = document.getElementById("containerBodyApproved");
let rejecbod = document.getElementById("containerBodyRejected");
let archvbod = document.getElementById("containerBodyArchived");

let inbox = document.getElementById("inbox");
let apprv = document.getElementById("approved");
let rejec = document.getElementById("rejected");
let archv = document.getElementById("archives");


inbox.addEventListener("click", (e)=>{
    switchTo(inboxbod, inbox);
});

apprv.addEventListener("click", (e)=>{
    switchTo(apprvbod, apprv);
});

rejec.addEventListener("click", (e)=>{
    switchTo(rejecbod, rejec);
});

archv.addEventListener("click", (e)=>{
    switchTo(archvbod, archv);
});

function switchTo(document, tab){
    console.log("clicked " + document);
    inboxbod.style.display = "none";
    apprvbod.style.display = "none";
    rejecbod.style.display = "none";
    archvbod.style.display = "none";

    inbox.classList.remove("selected");
    apprv.classList.remove("selected");
    rejec.classList.remove("selected");
    archv.classList.remove("selected");

    tab.classList.add("selected");
    document.style.display = "flex";
}

//When User select a Request

document.querySelectorAll(".mailRequest").forEach((e)=>{
    e.addEventListener("click", ()=>{
        let selectedID = e.dataset.request;
        selectedRequest = localStorage.setItem("selectedRequest", JSON.stringify(selectedID));
        window.location.href = "../AdminPage/viewRequest.php";
    });
});

document.getElementById("CreateRequest").addEventListener("click", ()=>{
    window.location.href = "../AdminPage/createRequest.php";
}); 

$("#deleteMail").click((ev)=>{
    ev.stopPropagation();
    console.log("remove to database");
});

$("#archiveMail").click((ev)=>{
    ev.stopPropagation();
    console.log("change request status to archived");
});


function displayRequest(){
    let inboxEL = "";
    let approEL = "";
    let rejecEL = "";
    let archiEL = "";

    Documents.forEach((e)=>{
        if(e.requestStatus == "inbox"){
            inboxEL += `
            <div class="mailRequest" data-Request="${e.requestID}">
                <div id="mailSender">${e.requestSender}</div>
                <div id="mailSubject">${e.requestSubject}</div>
                <div id="rightMailRequest">
                <div id="deleteMail">Delete</div>
                <div id="archiveMail">Archive</div>
                <div id="mailDate">${e.requestDate}</div>
                </div>
            </div>
            `;
        }
        else if(e.requestStatus == "approved"){
            approEL += `
            <div class="mailRequest" data-Request="${e.requestID}">
                <div id="mailSender">${e.requestSender}</div>
                <div id="mailSubject">${e.requestSubject}</div>
                <div id="mailDate">${e.requestDate}</div>
            </div>
            `;    
        }
        else if(e.requestStatus == "rejected"){
            rejecEL += `
            <div class="mailRequest" data-Request="${e.requestID}">
                <div id="mailSender">${e.requestSender}</div>
                <div id="mailSubject">${e.requestSubject}</div>
                <div id="mailDate">${e.requestDate}</div>
            </div>
            `;            
        }
        else if(e.requestStatus == "archived"){
            archiEL += `
            <div class="mailRequest" data-Request="${e.requestID}">
                <div id="mailSender">${e.requestSender}</div>
                <div id="mailSubject">${e.requestSubject}</div>
                <div id="mailDate">${e.requestDate}</div>
            </div>
            `;            
        }
    });

    $("#containerBody").html(inboxEL);
    $("#containerBodyApproved").html(approEL);
    $("#containerBodyRejected").html(rejecEL);
    $("#containerBodyArchived").html(archiEL);
}






