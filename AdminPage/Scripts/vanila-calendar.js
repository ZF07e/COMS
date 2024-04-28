const monthYearElement = document.querySelector('.monthYear');
const datesElement = document.querySelector('.dates');
const prevBtn = document.querySelector('.prevBtn');
const nextBtn = document.querySelector('.nextBtn');

let currentDate = new Date();

function updateCalendar(){
    const CurrentYear = currentDate.getFullYear();
    const CurrentMonth = currentDate.getMonth();
    
    const firstDay = new Date(CurrentYear, CurrentMonth, 0); 
    const lastDay = new Date(CurrentYear, CurrentMonth + 1, 0);
    const totalDays = lastDay.getDate();
    const firstDayIndex = firstDay.getDay();
    const lastDayIndex = lastDay.getDay();

    const monthYearString = currentDate.toLocaleString('default', {month: 'long', year: 'numeric'});
    monthYearElement.textContent = monthYearString;

    let HTML = "";
    let total = 0;

    for(let i = firstDayIndex; i > 0; i--){
        const prevDate = new Date(CurrentYear, CurrentMonth, 0 - i + 1);
        HTML += `<div class="date inactive2">${prevDate.getDate()}</div>`
        total++;
    }

    for(let i = 1; i <= totalDays; i++){
        const date = new Date(CurrentYear, CurrentMonth, i);
        const activeClass = date.toDateString() === new Date().toDateString() ? 'active': '';
        HTML += `<div class="date ${activeClass}">${i}</div>`;
        total++;
    }

    if(total != 35){
        for(let i = 1; i <= 7 - lastDayIndex; i++){
            const nextDate = new Date(CurrentYear, CurrentMonth + 1, i);
            HTML += `<div class="date inactive2">${nextDate.getDate()}</div>`;
        }
    }


    datesElement.innerHTML = HTML;
}

prevBtn.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    updateCalendar();
});

nextBtn.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    updateCalendar();
});

updateCalendar();