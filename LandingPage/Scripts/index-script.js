let isVisible = false;

$("#seePass").click(()=>{
    if(isVisible){
        document.getElementById("password").type = 'password';
        isVisible = false;
    }
   else{
        document.getElementById("password").type = 'text';
        isVisible = true;
   }
});

$("#loginButtonInput").click(()=>{
    let emailInput = $("#inputEmail").val();
    let passInput = $("#password").val();

    console.log(emailInput +" : "+ passInput)
});

