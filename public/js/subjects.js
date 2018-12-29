// create form to add new subject
function subjectFormBuilder()
{
    // find form div
    var form = document.getElementById("newForm");

    // if form is active turn it off
    var checkForm = form.querySelector(".activeNewForm");
    if(checkForm)
    {
        form.removeChild(checkForm);
        return;
    }
    
    // create div
    var div = document.createElement("div");
    div.setAttribute("class", "activeNewForm");
    // append div to form
    form.appendChild(div);


    // create paragraph 1
    var p1 = document.createElement("p");
    // append it to form
    div.appendChild(p1);
    // create h2 text
    var h1 = document.createElement("h2");
    h1.innerHTML = "Kolejnosc: ";
    // append h1 to p1
    p1.appendChild(h1);
    // create input 1
    var input1 = document.createElement("input");
    input1.setAttribute("name", "order");
    input1.setAttribute("type", "number");
    input1.setAttribute("placeholder", "Wprowadź numer kolejności");
    // append input1 to p1
    p1.appendChild(input1);


    // create paragraph 2
    var p2 = document.createElement("p");
    // append it to form
    div.appendChild(p2);
    // create h2 text
    var h2 = document.createElement("h2");
    h2.innerHTML = "Krótka nazwa: ";
    // append h2 to p2
    p2.appendChild(h2);
    // create input 2
    var input2 = document.createElement("input");
    input2.setAttribute("name", "shortname");
    input2.setAttribute("type", "text");
    input2.setAttribute("placeholder", "Wprowadź krótką nazwe");
    // append input2 to p2
    p2.appendChild(input2);


    // create paragraph 3
    var p3 = document.createElement("p");
    // append it to form
    div.appendChild(p3);
    // create h2 text
    var h3 = document.createElement("h2");
    h3.innerHTML = "Nazwa";
    // append h3 to p3
    p3.appendChild(h3);
    // create input 3
    var input3 = document.createElement("input");
    input3.setAttribute("name", "name");
    input3.setAttribute("type", "text");
    input3.setAttribute("placeholder", "Wprowadź nazwe");
    // append input3 to p3
    p3.appendChild(input3);


    // submit
    // create paragraph 4
    var p4 = document.createElement("p");
    // append it to form
    div.appendChild(p4);
    // create input 4
    var input4 = document.createElement("input");
    input4.setAttribute("type", "submit");
    input4.setAttribute("onclick", "addNewSubject()");
    input4.setAttribute("value", "Dodaj do bazy");
    // append input4 to p4
    p4.appendChild(input4);

}


// ajax for adding new subject
function addNewSubject()
{
    // get values
    var n1 = document.getElementsByName("order")[0].value;
    var n2 = document.getElementsByName("shortname")[0].value;
    var n3 = document.getElementsByName("name")[0].value;

    // start ajax
    $.ajax({
        type: "post",
        url: "public/ajax/admin/ajax_subject-add.php",
        data: ({
            order: n1,
            short: n2,
            name: n3
        }), 
        success: function()
        {
            // reload
            window.location.reload();
        }
    });
    
}


// ajax for edit / update subject data 
function editSubject()
{
    // get values
    var eleN1 = document.getElementsByName("order")[0].value;
    var eleN2 = document.getElementsByName("short")[0].value;
    var eleN3 = document.getElementsByName("name")[0].value;
    var id_subject = document.getElementsByName("id")[0].value;

    // start ajax
    $.ajax({
        type: "POST",
        url: "public/ajax/admin/ajax_subject-update.php",
        data: ({
            order: eleN1,
            short: eleN2,
            name: eleN3,
            id: id_subject
        }),
        success: function()
        {
            window.location.href = "?ap=subjects";
        }
    });
}