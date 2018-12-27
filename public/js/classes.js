// create form to add new class
function classFormBuilder()
{
    // find form div
    var form = document.getElementById("newForm");


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
    h1.innerHTML = "Numer: ";
    // append h1 to p1
    p1.appendChild(h1);
    // create input 1
    var input1 = document.createElement("input");
    input1.setAttribute("name", "number");
    input1.setAttribute("type", "number");
    input1.setAttribute("placeholder", "Wprowadź numer klasy");
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
    input2.setAttribute("name", "name");
    input2.setAttribute("type", "text");
    input2.setAttribute("placeholder", "Wprowadź nazwe klasy");
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
    input3.setAttribute("onclick", "addNewClass()");
    input3.setAttribute("value", "Dodaj do bazy");
    // append input3 to p3
    p3.appendChild(input3);

}




// ajax for adding new class
function addNewClass()
{
    var n1 = document.getElementsByName("number")[0].value;
    var n2 = document.getElementsByName("name")[0].value;

    
    $.ajax({
        type: "post",
        url: "public/ajax/admin/ajax_class-add.php",
        data: ({
            number: n1,
            name: n2
        }), 
        success: function()
        {
            // reload
            window.location.reload();
        }
    });
    
}
