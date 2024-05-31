localStorage.clear("selectedRequest");
let selectedRequest = JSON.parse(localStorage.getItem("selectedRequest")) || "";

let Documents = [];

fetch('http://localhost/COMS/AssocClient/Functions/GetDocument.php?action=getDocumentDetails')
    .then(response => response.json())
    .then(data => {
        Documents = data;
        displayRequest(Documents);
        document.querySelectorAll(".mailRequest").forEach((e)=>{
            e.addEventListener("click", ()=>{
                let selectedID = e.dataset.request;
                selectedRequest = localStorage.setItem("selectedRequest", JSON.stringify(selectedID));
                console.log(selectedID);
                window.location.href = "../AssocClient/viewRequest.php";
            });
        });
    })
    .catch(error => console.error('Error:', error));


fetch('http://localhost/COMS/LandingPage/Functions/getPosition.php')
.then(response => response.json())
.then(data => {
    if(data == "Adviser" || data == "President" || data == "Vice President" || data == "Secretary"){
        $("#CreateRequest").css("display", "inline");
    }
    else{
        $("#CreateRequest").css("display", "none");
    }
})
.catch(error => console.error('Error:', error));

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

document.getElementById("CreateRequest").addEventListener("click", ()=>{
    window.location.href = "./createRequest.php";
}); 


$("#deleteMail").click((ev)=>{
    ev.stopPropagation();
    console.log("remove to database");
});

$("#archiveMail").click((ev)=>{
    ev.stopPropagation();
    console.log("change request status to archived");
});


function displayRequest(documents){
    let inboxEL = "";
    let approEL = "";
    let rejecEL = "";
    let archiEL = "";

    documents.forEach((e)=>{
        if(e.status == "Inbox"){
            inboxEL += `
            <div class="mailRequest" data-Request="${e.id}">
                <div id="mailSender">${e.sender}</div>
                <div id="mailSubject">${e.subject}</div>
                <div id="rightMailRequest">
                <div id="deleteMail">Delete</div>
                <div id="archiveMail">Archive</div>
                <div id="mailDate">${e.date_only}</div>
                </div>
            </div>
            `;
        }
        else if(e.status == "Approved"){
            approEL += `
            <div class="mailRequest" data-Request="${e.id}">
                <div id="mailSender">${e.sender}</div>
                <div id="mailSubject">${e.subject}</div>
                <div id="rightMailRequest">
                <div id="deleteMail">Delete</div>
                <div id="archiveMail">Archive</div>
                <div id="mailDate">${e.date_only}</div>
            </div>
            `;    
        }
        else if(e.status == "Rejected"){
            rejecEL += `
            <div class="mailRequest" data-Request="${e.id}">
                <div id="mailSender">${e.sender}</div>
                <div id="rightMailRequest">
                <div id="deleteMail">Delete</div>
                <div id="archiveMail">Archive</div>
                <div id="mailSubject">${e.subject}</div>
                <div id="mailDate">${e.date_only}</div>
            </div>
            `;            
        }
        else if(e.status == "Archived"){
            archiEL += `
            <div class="mailRequest" data-Request="${e.id}">
                <div id="mailSender">${e.sender}</div>
                <div id="rightMailRequest">
                <div id="deleteMail">Delete</div>
                <div id="archiveMail">Archive</div>
                <div id="mailSubject">${e.subject}</div>
                <div id="mailDate">${e.date_only}</div>
            </div>
            `;            
        }
    });

    $("#containerBody").html(inboxEL);
    $("#containerBodyApproved").html(approEL);
    $("#containerBodyRejected").html(rejecEL);
    $("#containerBodyArchived").html(archiEL);
}






