localStorage.clear("selectedRequest");
let selectedRequest = JSON.parse(localStorage.getItem("selectedRequest")) || "";

let Documents = [];

fetch('http://localhost/COMS/AdminPage/Functions/GetDocuments.php?action=getDocumentDetails')
    .then(response => response.json())
    .then(data => {
        Documents = data;
        displayRequest(Documents);
        SearchTab(Documents);
        document.querySelectorAll(".mailRequest").forEach((e)=>{
            e.addEventListener("click", ()=>{
                let selectedID = e.dataset.request;
                selectedRequest = localStorage.setItem("selectedRequest", JSON.stringify(selectedID));
                console.log(selectedID);
                window.location.href = "../AdminPage/viewRequest.php";
            });
        });
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

//When User select a Request

// document.querySelectorAll(".mailRequest").forEach((e)=>{
//     e.addEventListener("click", ()=>{
//         let selectedID = e.dataset.request;
//         selectedRequest = localStorage.setItem("selectedRequest", JSON.stringify(selectedID));
//         window.location.href = "../AdminPage/viewRequest.php";
//     });
// });

$("#archiveMail").click((ev)=>{
    ev.stopPropagation();
    console.log("change request status to archived");
});

$("#deleteMail").click((ev)=>{
    ev.stopPropagation();
    console.log("remove to database");
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
                <div id="mailDate">${e.date_only}</div>
            </div>
            `;    
        }
        else if(e.status == "Rejected"){
            rejecEL += `
            <div class="mailRequest" data-Request="${e.id}">
                <div id="mailSender">${e.sender}</div>
                <div id="mailSubject">${e.subject}</div>
                <div id="mailDate">${e.date_only}</div>
            </div>
            `;            
        }
        else if(e.status == "Archived"){
            archiEL += `
            <div class="mailRequest" data-Request="${e.id}">
                <div id="mailSender">${e.sender}</div>
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

function SearchTab(documents){
    //When Searching User
    document.getElementById("searchRequest").addEventListener("keyup", ()=>{
        //get input String and convert it to UpperCase
        let searchString = document.getElementById("searchRequest").value.toUpperCase();
        let documentsFound = "";
        console.log(searchString)
        documents.forEach((e)=>{
        // let fullName = value.firstName +" "+ value.lastName;  
        if(e.subject.toUpperCase().includes(searchString, 0) && searchString.length > 0){      
            documentsFound += `
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
            document.getElementById("containerBody").innerHTML = documentsFound; //render the accounts Searched
            document.getElementById("containerBodyApproved").innerHTML = documentsFound; 
            document.getElementById("containerBodyRejected").innerHTML = documentsFound; 
            document.getElementById("containerBodyArchived").innerHTML = documentsFound; 
            }
            else{
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
                            <div id="mailDate">${e.date_only}</div>
                        </div>
                        `;    
                    }
                    else if(e.status == "Rejected"){
                        rejecEL += `
                        <div class="mailRequest" data-Request="${e.id}">
                            <div id="mailSender">${e.sender}</div>
                            <div id="mailSubject">${e.subject}</div>
                            <div id="mailDate">${e.date_only}</div>
                        </div>
                        `;            
                    }
                    else if(e.status == "Archived"){
                        archiEL += `
                        <div class="mailRequest" data-Request="${e.id}">
                            <div id="mailSender">${e.sender}</div>
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
        }); 

        document.querySelectorAll(".mailRequest").forEach((e)=>{
            e.addEventListener("click", ()=>{
                let selectedID = e.dataset.request;
                selectedRequest = localStorage.setItem("selectedRequest", JSON.stringify(selectedID));
                console.log(selectedID);
                window.location.href = "../AdminPage/viewRequest.php";
            });
        });
    });

}