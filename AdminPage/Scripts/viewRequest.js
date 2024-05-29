let Documents = [];

let selectedRequest = JSON.parse(localStorage.getItem("selectedRequest"));
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
                $("#documentPrev").attr('src', `../PDF-FILES/${e.id}.pdf`);
            }
        });
    })
    .catch(error => console.error('Error:', error));

    $.ajax({
      url: "http://localhost/COMS/AdminPage/Functions/GetDocuments.php",
      method: "POST",
      data: {selectedID: selectedRequest},
      success: function(response){
          console.log(response);
          displayRecipient(response);
          checkIfDownloadable(response);
          signature();
      }
  })

  console.log(selectedRequest);

let img = new Image();
let offscreenUploadCanvas = document.getElementById("offscreen-canvas-upload");
let offscreenUploadCtx = offscreenUploadCanvas.getContext("2d");    
var offscreenCanvas = document.getElementById("offscreen-sig-canvas");
var offscreenCtx = offscreenCanvas.getContext("2d");   

$("#backButton").on("click", ()=>{
  window.location.href = "../AdminPage/Request.php";
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
      if(e.status == "Signed"){
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


function signature(){
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
      e.preventDefault();
      if(canvas.toDataURL() != offscreenCanvas.toDataURL()){    
        offscreenCtx.font = "bold 11px Arial";
        offscreenCtx.fillStyle = "rgba(255, 0, 0, 0.7)";
        offscreenCtx.drawImage(canvas,0,0);
        offscreenCtx.fillText("THIS SIGNATURE IS FOR INTERNAL USE ONLY",70 ,170);
        var dataUrl = offscreenCanvas.toDataURL();
        console.log(selectedRequest);
        $.ajax({
          url: "http://localhost/COMS/AdminPage/Functions/GetDocuments.php",
          method: "POST",
          data: {signature: dataUrl, id: selectedRequest},
          success: function(response){
              console.log(response);
          }
      })
        //console.log(dataUrl);
      }
      else{
        alert("bruh")
      }
    }, false);
    
    $("#exitApproveHeader").click(()=>{
      $("#ApprovePopUp_Con").css("display", "none");
      clearCanvas();
      localStorage.clear("image");
      $("#fileSelector").val("");
      $("#prevIMg").attr("src", "");
      $("#prevIMg").css("display", "none");
      img.src = "";
      offscreenUploadCanvas.width = offscreenUploadCanvas.width;
      offscreenCanvas.width = offscreenCanvas.width;
    });

    $("#cancelUpload").click(()=>{
      $("#ApprovePopUp_Con").css("display", "none");
      clearCanvas();
      localStorage.clear("image");
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
    localStorage.clear("image")
  });

  $("#rejectRequest").click(()=>{
    $("#ApprovePopUp_Con").css("display", "none");
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
    e.preventDefault();  
    console.log(localStorage.getItem("image"))
    if(localStorage.getItem("image") != null){ 
      img.src = localStorage.getItem("image");
      console.log(localStorage.getItem("image"));
      offscreenUploadCtx.font = "bold 11px Arial";
      offscreenUploadCtx.fillStyle = "rgba(255, 0, 0, 0.7)";
      offscreenUploadCtx.drawImage(img,0,0);
      offscreenUploadCtx.fillText("THIS SIGNATURE IS FOR INTERNAL USE ONLY",70 ,170);
      var dataUrl = offscreenUploadCanvas.toDataURL();
      console.log(selectedRequest);
      $.ajax({
        url: "http://localhost/COMS/AdminPage/Functions/GetDocuments.php",
        method: "POST",
        data: {signature: dataUrl, id: selectedRequest},
        success: function(response){
            console.log(response);
        }
    })
  }
  else{
    alert("bruh");
  }
  });
}