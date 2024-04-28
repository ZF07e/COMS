

document.addEventListener('DOMContentLoaded',() => {
    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: "title",
        center: "",
        right: 'prev,next'
      },

      titleFormat:{
        month: 'long', year: 'numeric'
      },

      initialView: 'dayGridMonth'
    });

    
    calendar.setOption('height', 300);
    calendar.on('dateClick', (date) => {
      console.log("Date: " + date.dateStr);
      
    });
    calendar.render();
  });

