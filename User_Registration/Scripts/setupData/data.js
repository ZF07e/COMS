const encrypt = (data)=> (btoa(unescape(encodeURIComponent(JSON.stringify(data)))));
let decode = (data) => JSON.parse(decodeURIComponent(escape(atob(data))));

$(".submit-data").click((e)=>{
    e.preventDefault();
   window.location.href = "../../LandingPage/Associations.php";
})