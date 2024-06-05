const quill = new Quill('#editor', {
    theme: 'snow'
  });

myData = [];

Users.forEach((e)=>{
    myData.push({
        label: e.name,
        value: e.email
    });
});



let selectedRecipients = {
    to: [],
    endorsed: [],
    noted: [],
    approved: []
}

let mySelect1 = new MultiSelect2(".field1", {
    options: myData,
    value: [],
    multiple: true,
    autocomplete: true,
    icon: "fa fa-times",
    onChange: value => {
        selectedRecipients.to = value;
    },
});

let mySelect2 = new MultiSelect2(".field2", {
    options: myData,
    value: [],
    multiple: true,
    autocomplete: true,
    icon: "fa fa-times",
    onChange: value => {
        selectedRecipients.endorsed = value;
    },
});

let mySelect3 = new MultiSelect2(".field3", {
    options: myData,
    value: [],
    multiple: true,
    autocomplete: true,
    icon: "fa fa-times",
    onChange: value => {
        selectedRecipients.noted = value;
    },
});

let mySelect4 = new MultiSelect2(".field4", {
    options: myData,
    value: [],
    multiple: true,
    autocomplete: true,
    icon: "fa fa-times",
    onChange: value => {
        selectedRecipients.approved = value;       
    },
});


$("#sendReq").on("click", (e)=>{
    //e.preventDefault();
    const delta = quill.getText();
    console.log(delta);
    console.log("Recipient Data" + selectedRecipients);

    fetch('http://localhost/COMS/AdminPage/Functions/letterGenerator.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'data=' + encodeURIComponent(JSON.stringify(delta))
    })
    .then(response => response.text())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
});

$("#canlReq").on("click", (e)=>{
   window.location.href = "../AdminPage/Request.php"
});