document.addEventListener('DOMContentLoaded', function() {

  //PopUp Forms
  let addForm = document.getElementById("popUpCreateEvent");
  let editForm = document.getElementById("popUpCreateEvent2");

  //Calendar
  let calendarEl = document.getElementById('calendar');

  //edit Elements
  let editstartDate = document.getElementById("edit_startEvent");
  let editendDate = document.getElementById("edit_endEvent");
  let editName = document.getElementById("edit_eventName");


  //Library Calendar
  var calendar = new FullCalendar.Calendar(calendarEl, {
    dayMaxEvents: true,
    navLinks: true, 
    initialView: 'dayGridMonth',
    headerToolbar: {
      left: "dayGridMonth,listMonth",
      center: "title",
      right: 'today,prev,next,addEventButton'
    },
    
    titleFormat:{
      month: 'long', year: 'numeric'
    },
    customButtons: {
      addEventButton: {
        text: 'add Event',
        click: () => {
          addForm.style.display = "flex";
          
        }
      }
    },
    events:[ //events Here
      { 
              id: 100,
              title: 'Sample event',
              start: "2024-05-14",
              end: "2024-05-16",
              allDay: true
      }
    ],
    eventClick: (arg)=> {
        editForm.style.display = "flex";
        editName.value = arg.event.title;
        editstartDate.value = arg.event.startStr;
        editendDate.value = reformatDate(arg.event.end);
        editEvent(arg);
      }
  });

  
  calendar.render();
  exitCloseFunction();
  addEvent();
  

  function addEvent(){
    let eventstartDate = document.getElementById("start_eventDate");
    let eventendDate = document.getElementById("end_eventDate");
    let eventName = document.getElementById("eventName");
    eventstartDate.addEventListener("change", ()=>{
      eventendDate.value = eventstartDate.value;
    });


    //Submit Is clicked
    document.getElementById("submitEvent").addEventListener("click", ()=>{
      if(eventstartDate.value != "" && eventendDate.value != "" && eventName.value != ""){
        let startDate = new Date(eventstartDate.value);
        let endDate = new Date(eventendDate.value );
        let i = 1;
        calendar.addEvent({
          id: i++,
          title: eventName.value,
          start: startDate.toISOString(),
          end: getdateFormat(endDate),
          allDay: true
        });
        alert("Event Added");
        addForm.style.display = "none";
        eventName.value = ""
        eventstartDate.value = "";
        eventendDate.value = "";
      }
      else{
        alert("Please Fill The Missing Information");
      }
    });
  }

  function editEvent(arg){
    document.getElementById("saveEditEvent").addEventListener("click", ()=>{
      if(editendDate.value != "" && editstartDate.value != "" && editName.value != ""){
        calendar.eventsSet();
        arg.event.setProp("title", editName.value);
        arg.event.setStart(editstartDate.value, true);
        arg.event.setEnd(getdateFormat(new Date(editendDate.value)), true);
        editForm.style.display = "none"
        alert("Event Updated Successfuly");
      }
    });

    document.getElementById("removeEditEvent").addEventListener("click", ()=>{
      arg.event.remove();
      editForm.style.display = "none"
    });
  }
  
  function getdateFormat(date){
    let formattedMonth = "" + (date.getMonth() + 1);
    let formattedDate = "" + (date.getDate() + 1);
    let formattedYear = date.getFullYear();

    if(formattedMonth.length < 2){
      formattedMonth = "0" + formattedMonth;
    }

    if(formattedDate.length < 2){
      formattedDate = "0" + formattedDate;
    }

    return [formattedYear, formattedMonth, formattedDate].join("-");
  }

  function reformatDate(date){
    let formattedMonth = "" + (date.getMonth() + 1);
    let formattedDate = "" + (date.getDate() - 1);
    let formattedYear = date.getFullYear();

    if(formattedMonth.length < 2){
      formattedMonth = "0" + formattedMonth;
    }

    if(formattedDate.length < 2){
      formattedDate = "0" + formattedDate;
    }

    return [formattedYear, formattedMonth, formattedDate].join("-");
  }

  function exitCloseFunction(){
    //x and cancel button
    document.getElementById("cancelAddEvent").addEventListener("click", ()=>{
      addForm.style.display = "none";
    });

    document.getElementById("xButtonPopUp").addEventListener("click", ()=>{
      addForm.style.display = "none";
    });

    document.getElementById("cancelEditEvent").addEventListener("click", ()=>{
      editForm.style.display = "none";
    });

    document.getElementById("xButtonEditPopUp").addEventListener("click", ()=>{
      editForm.style.display = "none";
    });

    
    
  }
});