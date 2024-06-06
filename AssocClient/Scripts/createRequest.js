const quill = new Quill('#editor', {
    theme: 'snow'
  });

let selectedRecipients = {
    to: [],
    endorsed: [],
    noted: [],
    approved: []
}

fetch('http://localhost/COMS/LandingPage/Functions/GetAssociationDetails.php?action=getUserPositions')
    .then(response => response.json())
    .then(data => {
        console.log(data);
        myData = [];
        data.forEach((e)=>{
            let fullName = e.firstName + " " + e.lastName;
            myData.push({
                label: fullName,
                value: `${e.email + "," + e.position + "," + e.affiliation + "," + e.firstName + "," + e.lastName}`
            });
        });
        
        let mySelect1 = new MultiSelect2(".field1", {
            options: myData,
            autocomplete: true,
            onChange: value => {
                let formattedValue = {email: value.split(",")[0], position: value.split(",")[1], affiliation: value.split(",")[2],
                                        firstname: value.split(",")[3], lastname: value.split(",")[4]}
                selectedRecipients.to = formattedValue;
            }
        });
        
        let mySelect2 = new MultiSelect2(".field2", {
            options: myData,
            value: [],
            multiple: true,
            autocomplete: true,
            icon: "fa fa-times",
            onChange: value => {
                console.log(value);
                let formattedValue = []
                let incrmt = 0;

                value.forEach((val)=>{
                    formattedValue[incrmt] = {email: value[incrmt].split(",")[0], position: value[incrmt].split(",")[1], affiliation: value[incrmt].split(",")[2],
                                            firstname: value[incrmt].split(",")[3], lastname: value[incrmt].split(",")[4]}
                    incrmt++;
                })
                selectedRecipients.endorsed = formattedValue;
            },
        });
        
        let mySelect3 = new MultiSelect2(".field3", {
            options: myData,
            value: [],
            multiple: true,
            autocomplete: true,
            icon: "fa fa-times",
            onChange: value => {
                let formattedValue = []
                let incrmt = 0;

                value.forEach((val)=>{
                    formattedValue[incrmt] = {email: value[incrmt].split(",")[0], position: value[incrmt].split(",")[1], affiliation: value[incrmt].split(",")[2],
                                            firstname: value[incrmt].split(",")[3], lastname: value[incrmt].split(",")[4]}
                    incrmt++;
                })
                selectedRecipients.noted = formattedValue;
            },
        });

        // let mySelect4 = new MultiSelect2(".field4", {
        //     options: myData,
        //     value: [],
        //     multiple: true,
        //     autocomplete: true,
        //     icon: "fa fa-times",
        //     onChange: value => {
        //         let formattedValue = []
        //         let incrmt = 0;

        //         value.forEach((val)=>{
        //             formattedValue[incrmt] = {email: value[incrmt].split(",")[0], position: value[incrmt].split(",")[1], 
        //                                     firstname: value[incrmt].split(",")[2], lastname: value[incrmt].split(",")[3]}
        //             incrmt++;
        //         })
        //         selectedRecipients.approved = formattedValue;
        //     },
        // });
    })
    .catch(error => console.error('Error:', error));


$("#sendReq").on("click", (e)=>{
    e.preventDefault();

    console.log(selectedRecipients.to);
    const delta = quill.root.innerHTML;
    const subject = $("#SubjectInput").val();
    console.log(delta);
    console.log("Recipient Data" + selectedRecipients.to);
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'http://localhost/COMS/AssocClient/Functions/GenerateLetter.php';

    const textField = document.createElement('input');
    textField.type = 'hidden';
    textField.name = 'text';
    textField.value = delta;

    const subjectField = document.createElement('input');
    subjectField.type = 'hidden';
    subjectField.name = 'subject';
    subjectField.value = JSON.stringify(subject);

    const reciepientTOField = document.createElement('input');
    reciepientTOField.type = 'hidden';
    reciepientTOField.name = 'recipientTo';
    reciepientTOField.value = JSON.stringify(selectedRecipients.to);

    const endorsedField = document.createElement('input');
    endorsedField.type = 'hidden';
    endorsedField.name = 'endorsed';
    endorsedField.value = JSON.stringify(selectedRecipients.endorsed);

    const notedField = document.createElement('input');
    notedField.type = 'hidden';
    notedField.name = 'noted';
    notedField.value = JSON.stringify(selectedRecipients.noted);

    // const approvedField = document.createElement('input');
    // approvedField.type = 'hidden';
    // approvedField.name = 'approved';
    // approvedField.value = JSON.stringify(selectedRecipients.approved);

    form.appendChild(textField);
    form.appendChild(subjectField);
    form.appendChild(reciepientTOField);
    form.appendChild(endorsedField);
    form.appendChild(notedField);
    //form.appendChild(approvedField);

    document.body.appendChild(form);

    form.submit();
});

$("#canlReq").on("click", (e)=>{
   window.location.href = "../AssocClient/Request.php"
});