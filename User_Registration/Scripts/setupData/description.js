const encrypt = (data)=> (btoa(unescape(encodeURIComponent(JSON.stringify(data)))));
let decode = (data) => JSON.parse(decodeURIComponent(escape(atob(data))));

let crst = document.getElementById("courseStrand");
let desc = document.getElementById("desc");


$(".submit-desc").click((e)=>{
    e.preventDefault();
    if($("#courseStrand").val().trim() == ""){
        sendErrorToStrandCourse();
    }   
    if($("#desc").val().trim() == ""){
        sendErrorToDesc()
    }   

    else if($("#courseStrand").val().trim() != "" && $("#desc").val().trim() != ""){
        let prevData = decode(sessionStorage.getItem('userInfo'));
        let combineData = Object.assign({}, prevData, {courseStrand: crst.value, description: desc.value});
        sessionStorage.setItem('userInfo', encrypt(combineData));
        window.location.href = "password.php";
    }
})

crst.addEventListener("keypress", ()=>{
    clearErrorToStrandCourse();
});

desc.addEventListener("keypress", ()=>{
    clearErrorToDesc();
});

function sendErrorToStrandCourse(){
    crst.classList.add("ErrorInput");
    document.querySelector(".Emsg1").innerText = "Fill This Form";
}

function sendErrorToDesc(){
    desc.classList.add("ErrorInput");
    document.querySelector(".Emsg2").innerText = "Fill This Form";
}


function clearErrorToStrandCourse(){
    crst.classList.remove("ErrorInput");
    document.querySelector(".Emsg1").innerText = "";
}

function clearErrorToDesc(){
    desc.classList.remove("ErrorInput");
    document.querySelector(".Emsg2").innerText = "";
}