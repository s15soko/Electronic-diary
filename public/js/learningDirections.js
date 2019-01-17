

// create form to add new learning direction
function directionsFormBuilder()
{
    // find form div
    var form = document.getElementById("newForm");


    var checkForm = form.querySelector(".activeNewForm");
    if(checkForm)
    {
        form.removeChild(checkForm);
        return;
    }
    
    // create div (form)
    var div = document.createElement("form");
    div.setAttribute("class", "activeNewForm");
    // append div to form
    form.appendChild(div);


    // create paragraph 1
    var p1 = document.createElement("p");
    // append it to form
    div.appendChild(p1);
    // create h2 text
    var h1 = document.createElement("h2");
    h1.innerHTML = "Name: ";
    // append h1 to p1
    p1.appendChild(h1);
    // create input 1
    var input1 = document.createElement("input");
    input1.setAttribute("name", "name");
    input1.setAttribute("type", "text");
    input1.setAttribute("placeholder", "Enter name");
    // append input1 to p1
    p1.appendChild(input1);


    // create paragraph 2
    var p2 = document.createElement("p");
    // append it to form
    div.appendChild(p2);
    // create h2 text
    var h2 = document.createElement("h2");
    h2.innerHTML = "Short name: ";
    // append h2 to p2
    p2.appendChild(h2);
    // create input 2
    var input2 = document.createElement("input");
    input2.setAttribute("name", "short_name");
    input2.setAttribute("type", "text");
    input2.setAttribute("placeholder", "Enter short name");
    // append input2 to p2
    p2.appendChild(input2);



    // submit
    // create paragraph 3
    var p3 = document.createElement("p");
    // append it to form
    div.appendChild(p3);
    // create input 3
    var input3 = document.createElement("input");
    input3.setAttribute("type", "submit");
    input3.setAttribute("onclick", "addNewLearDirection()");
    input3.setAttribute("value", "Add");
    // append input3 to p3
    p3.appendChild(input3);

}


// ajax for adding new learning direction
function addNewLearDirection()
{
    var n1 = document.getElementsByName("name")[0].value;
    var n2 = document.getElementsByName("short_name")[0].value;

    $.ajax({
        type: "post",
        url: "public/ajax/admin/ajax_learningDirection-add.php",
        data: ({
            name: n1,
            short: n2
        }), 
        success: function()
        {
            // reload
            window.location.reload();
        }
    });
}


// ajax for edit / update learning direction data 
function editLearningDirection()
{
    // get values
    var eleN1 = document.getElementsByName("name")[0].value;
    var eleN2 = document.getElementsByName("short")[0].value;
    var id_learningdirection = document.getElementsByName("id")[0].value;

    // start ajax
    $.ajax({
        type: "POST",
        url: "public/ajax/admin/ajax_learningDirection-update.php",
        data: ({
            name: eleN1,
            short: eleN2,
            id: id_learningdirection
        }),
        success: function()
        {
            window.location.href = "?ap=directions";
        }
    });


}