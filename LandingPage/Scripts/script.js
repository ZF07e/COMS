console.log("Working");
renderAssosiation();

function renderAssosiation(){
    let Listhtml = "";
    Club.forEach((assosiation) => {
        const html = `
            <div class="itemList">
                <div class="pictureFrame">
                    <img src="${assosiation.image}">
                </div>
                
                <div class="title-description">
                    <div class="topSection">
                        <h2>${assosiation.name}</h2>
                    </div>
                    <div class="details">
                        <p>Adviser: ${assosiation.adviser}</p>
                        <span>Total Members: ${assosiation.totalMembers}</span>
                        <a href="Register.html"><button>Apply</button></a>
                    </div>
                </div>
            </div>
        `;
        Listhtml += html;
    });
    
    document.querySelector(".orgList").innerHTML = Listhtml;
}
