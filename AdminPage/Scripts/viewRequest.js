let Documents = [];
let selectedRequest = JSON.parse(localStorage.getItem("selectedRequest"));
let resp;

window.onload = ()=>{ 
  let rejected = localStorage.getItem("rejected");
  let approved = localStorage.getItem("approved");
  let cancelled = localStorage.getItem("cancelled");


  if(rejected){
    var notification = alertify.notify('Rejected', 'custom', 4);  
    localStorage.removeItem("rejected");
  }

  if(cancelled){
    var notification = alertify.notify('Cancelled', 'custom', 4);  
    localStorage.removeItem("cancelled");
  }

  if(approved){
    var notification = alertify.notify('Letter Signed', 'success', 4);  
    localStorage.removeItem("approved");
  }
}

fetch(`http://localhost/COMS/AdminPage/Functions/GetDocuments.php?action=getDocumentDetails`)
    .then(response => response.json())
    .then(data => {
        Documents = data;
        console.log(data);
        let selectedRequest = JSON.parse(localStorage.getItem("selectedRequest"));

        Documents.forEach((e) => {
            if (e.id == selectedRequest) {
                id = e.id;
                $("#headerTitleRequest").text(e.subject);
                $("#documentPrev").attr('src', `../PDF-FILES/${e.id}.pdf#toolbar=0`);
            }
        });
        
    })
    .catch(error => console.error('Error:', error));

    
    $.ajax({
      url: "http://localhost/COMS/AdminPage/Functions/GetDocuments.php",
      method: "POST",
      data: {selectedID: selectedRequest},
      success: function(response){
          resp = response;
          console.log(resp);
          displayRecipient(resp);
          checkIfDownloadable(resp);
          signature();
      }
  })

  console.log(selectedRequest);




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
  let totalRejected = 0;

  Users.forEach((e)=>{
      if(e.status == "Signed"){
          totalSigned++;
      }
  });

  Users.forEach((e)=>{
    if(e.status == "Rejected"){
        totalRejected++;
    }
});

  console.log(totalRecipient + " - " + totalSigned);
  if(totalSigned === totalRecipient){
      $("#downloadButton").removeAttr("disabled", false);
      console.log(selectedRequest);
      $.ajax({
        url: "http://localhost/COMS/AdminPage/Functions/GetDocuments.php?action=updateDocumentStatusApproved",
        method: "POST",
        data: {id: selectedRequest},
        success: function(response){
            console.log(response);
        }
    })
  }
  else if(totalRecipient === totalRejected){
    $("#downloadButton").removeAttr("disabled", false);
      console.log(selectedRequest);
      $.ajax({
        url: "http://localhost/COMS/AdminPage/Functions/GetDocuments.php?action=updateDocumentStatusRejected",
        method: "POST",
        data: {id: selectedRequest},
        success: function(response){
            console.log(response);
        }
    })
      $("#downloadButton").attr("disabled", true);
  }
  else{
    $("#downloadButton").attr("disabled", true);
  }
} 

let img = new Image();
var offscreenCanvas = document.getElementById("offscreen-sig-canvas");
var offscreenCtx = offscreenCanvas.getContext("2d");   


function signature(){

  let offscreenUploadCanvas = document.getElementById("offscreen-canvas-upload");
  let offscreenUploadCtx = offscreenUploadCanvas.getContext("2d");    

  $("#backButton").on("click", ()=>{
    window.location.href = "../AdminPage/Request.php";
  });

  $("#downloadButton").on("click", ()=>{
    console.log("Hello")
  });


  $("#fileSelector").on("change", ()=>{
  $("#labelFile").text($("#fileSelector")[0].files[0].name);
  });


  $("#UploadSignature").click(()=>{
    $("#UploadBody").css("display", "flex");
    $("#UploadSignature").addClass("seclectedOption");
    $("#SignBody").css("display", "none");
    $("#SignWithCanvas").removeClass("seclectedOption");
    $("#ApproveOptions").css("display", "flex");
  });

  $("#SignWithCanvas").click(()=>{
    $("#UploadBody").css("display", "none");
    $("#UploadSignature").removeClass("seclectedOption");
    $("#SignBody").css("display", "flex");
    $("#SignWithCanvas").addClass("seclectedOption");
    $("#ApproveOptions").css("display", "none");
  });

  (function() {
    window.requestAnimFrame = (function(callback) {
      return window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        window.oRequestAnimationFrame ||
        window.msRequestAnimaitonFrame ||
        function(callback) {
          window.setTimeout(callback, 1000 / 60);
        };
    })();

    var canvas = document.getElementById("sig-canvas");
    var ctx = canvas.getContext("2d");
    ctx.strokeStyle = "#222222";
    ctx.lineWidth = 1;

    var drawing = false;
    var mousePos = {
      x: 0,
      y: 0
    };
    var lastPos = mousePos;

    canvas.addEventListener("mousedown", function(e) {
      drawing = true;
      lastPos = getMousePos(canvas, e);
    }, false);

    canvas.addEventListener("mouseup", function(e) {
      drawing = false;
    }, false);

    canvas.addEventListener("mousemove", function(e) {
      mousePos = getMousePos(canvas, e);
    }, false);

    // Add touch event support for mobile
    canvas.addEventListener("touchstart", function(e) {

    }, false);

    canvas.addEventListener("touchmove", function(e) {
      var touch = e.touches[0];
      var me = new MouseEvent("mousemove", {
        clientX: touch.clientX,
        clientY: touch.clientY
      });
      canvas.dispatchEvent(me);
    }, false);

    canvas.addEventListener("touchstart", function(e) {
      mousePos = getTouchPos(canvas, e);
      var touch = e.touches[0];
      var me = new MouseEvent("mousedown", {
        clientX: touch.clientX,
        clientY: touch.clientY
      });
      canvas.dispatchEvent(me);
    }, false);

    canvas.addEventListener("touchend", function(e) {
      var me = new MouseEvent("mouseup", {});
      canvas.dispatchEvent(me);
    }, false);

    function getMousePos(canvasDom, mouseEvent) {
      var rect = canvasDom.getBoundingClientRect();
      return {
        x: mouseEvent.clientX - rect.left,
        y: mouseEvent.clientY - rect.top
      }
    }

    function getTouchPos(canvasDom, touchEvent) {
      var rect = canvasDom.getBoundingClientRect();
      return {
        x: touchEvent.touches[0].clientX - rect.left,
        y: touchEvent.touches[0].clientY - rect.top
      }
    }

    function renderCanvas() {
      if (drawing) {
        ctx.moveTo(lastPos.x, lastPos.y);
        ctx.lineTo(mousePos.x, mousePos.y);
        ctx.stroke();
        lastPos = mousePos;
      }
    }

    // Prevent scrolling when touching the canvas
    document.body.addEventListener("touchstart", function(e) {
      if (e.target == canvas) {
        e.preventDefault();
      }
    }, false);
    document.body.addEventListener("touchend", function(e) {
      if (e.target == canvas) {
        e.preventDefault();
      }
    }, false);
    document.body.addEventListener("touchmove", function(e) {
      if (e.target == canvas) {
        e.preventDefault();
      }
    }, false);

    (function drawLoop() {
      requestAnimFrame(drawLoop);
      renderCanvas();
    })();

    function clearCanvas() {
      canvas.width = canvas.width;
    }

    // Set up the UI
    var clearBtn = document.getElementById("sig-clearBtn");
    var submitBtn = document.getElementById("sig-submitBtn");
    clearBtn.addEventListener("click", function(e) {
      clearCanvas();
    }, false);
    submitBtn.addEventListener("click", function(e) {  
      if(canvas.toDataURL() != offscreenCanvas.toDataURL()){    
        offscreenCtx.font = "bold 11px Arial";
        offscreenCtx.fillStyle = "rgba(255, 0, 0, 0.7)";
        offscreenCtx.drawImage(canvas,0,0);
        offscreenCtx.fillText("THIS SIGNATURE IS FOR INTERNAL USE ONLY",70 ,90);
        var dataUrl = offscreenCanvas.toDataURL();
        console.log(selectedRequest);
        $.ajax({
          url: "http://localhost/COMS/AdminPage/Functions/GetDocuments.php?action=approved",
          method: "POST",
          data: {signature: dataUrl, id: selectedRequest},
          success: function(response){
              //console.log(response);
              
          }
      })
        //console.log(dataUrl);
        localStorage.setItem("approved", true);
      }
      else{
        alert("bruh")
      }
    }, false);
    
    $("#exitApproveHeader").click(()=>{
      $("#ApprovePopUp_Con").css("display", "none");
      $("body").css("overflow", "auto");
      clearCanvas();
      localStorage.removeItem("image");
      $("#fileSelector").val("");
      $("#prevIMg").attr("src", "");
      $("#prevIMg").css("display", "none");
      img.src = "";
      offscreenUploadCanvas.width = offscreenUploadCanvas.width;
      offscreenCanvas.width = offscreenCanvas.width;
    });

    $("#cancelUpload").click(()=>{
      $("#ApprovePopUp_Con").css("display", "none");
      $("body, html").css("overflow", "auto");
      clearCanvas();
      localStorage.removeItem("image");
      $("#fileSelector").val("");
      $("#prevIMg").attr("src", "");
      $("#prevIMg").css("display", "none");
      img.src = "";
      offscreenUploadCanvas.width = offscreenUploadCanvas.width;
      offscreenCanvas.width = offscreenCanvas.width;
    });

  })();


  $("#approveRequest").click(()=>{
    $("#labelFile").text("Choose A File");
    $("#ApprovePopUp_Con").css("display", "flex");
    localStorage.removeItem("image");
    $("body, html").css("overflow", "hidden");
  });

  $("#rejectRequest").click(()=>{

    alertify.confirm("Are you sure you want to reject this letter?.",
    function(){
      localStorage.setItem("rejected", true);
      $("#ApprovePopUp_Con").css("display", "none");
      let filePath = '../Images/reject.png';
  
      var xhr = new XMLHttpRequest();
      xhr.responseType = 'blob';
      xhr.onload = function() {
          var reader = new FileReader();
          reader.onload = function() {
              rejectImage = reader.result;
              $.ajax({
                  url: "http://localhost/COMS/AdminPage/Functions/GetDocuments.php?action=rejected",
                  method: "POST",
                  data: {signature: rejectImage, id: selectedRequest},
                  success: function(response){
                    console.log(response);
                  }
              })
          };
          reader.readAsDataURL(xhr.response);
      };
      xhr.open('GET', filePath);
      xhr.send();

      window.location.reload();
    },
    function(){
      localStorage.setItem("cancelled", true);
      window.location.reload();
    }).setHeader('<strong>Reject Confirmation</strong>');
    
  });


  $("#fileSelector").change(()=>{
  const file = document.querySelector('#fileSelector').files[0];

  let reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = ()=>{
    localStorage.setItem("image", reader.result);
    $("#prevIMg").attr("src", localStorage.getItem("image"));
    $("#prevIMg").css("display", "inline");
  };

  if(localStorage.getItem("image")){
    $("#prevIMg").attr("src", localStorage.getItem("image"));
  }
  });


  $("#signUploaded").click((e)=>{
    console.log(localStorage.getItem("image"))
    if(localStorage.getItem("image") != null){ 
      img.src = localStorage.getItem("image");
      console.log(localStorage.getItem("image"));
      offscreenUploadCtx.font = "bold 11px Arial";
      offscreenUploadCtx.fillStyle = "rgba(255, 0, 0, 0.7)";
      offscreenUploadCtx.drawImage(img,0,0);
      offscreenUploadCtx.fillText("THIS SIGNATURE IS FOR INTERNAL USE ONLY",70 ,90);
      var dataUrl = offscreenUploadCanvas.toDataURL();
      console.log(selectedRequest);
      $.ajax({
        url: "http://localhost/COMS/AdminPage/Functions/GetDocuments.php?action=approved",
        method: "POST",
        data: {signature: dataUrl, id: selectedRequest},
        success: function(response){
            console.log(response);
            localStorage.setItem("approved", true);
        }
    })
    localStorage.setItem("approved", true);
  }
  else{
    alert("bruh");
  }
  });
}