let date = new Date();
let dayArr = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

//Set Yesterday's Date
$("#yesterdayDateday").html(dayArr[date.getDay() - 1]);
$("#yesterdayDatedate").html(date.getDate() - 1);

//Set Today's Date
$("#Today_day").html(dayArr[date.getDay()]);
$("#Today_date").html(date.getDate());

//Set Tomorrow's Date
$("#tomorrowDateday").html(dayArr[date.getDay() + 1]);
$("#tomorrowDatedate").html(date.getDate() + 1);




fetch('http://localhost/COMS/AdminPage/Functions/userName.php')
.then(response => response.json())
.then(data => {
    let UserName = data[0].split("(")[0];
    $("#UserNameHome").text(UserName);
    $("#PositionHome").text(data[1]);
    //document.getElementById("userNameHdr").innerHTML =  + " " + "(" +  + ")";
})
.catch(error => console.error('Error:', error));
