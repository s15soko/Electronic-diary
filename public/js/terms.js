// create form to add new term
function termFormBuilder()
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
    h1.innerHTML = "Rok szkolny: ";
    // append h1 to p1
    p1.appendChild(h1);
    // create input 1
    var input1 = document.createElement("input");
    input1.setAttribute("name", "school_year");
    input1.setAttribute("type", "text");
    input1.setAttribute("placeholder", "Wprowadź rok szkolny");
    // append input1 to p1
    p1.appendChild(input1);




    // create paragraph 2
    var p2 = document.createElement("p");
    // append it to form
    div.appendChild(p2);
    // create h2 text
    var h2 = document.createElement("h2");
    h2.innerHTML = "Semestr: ";
    // append h2 to p2
    p2.appendChild(h2);
    // create input 2
    var input2 = document.createElement("input");
    input2.setAttribute("name", "term");
    input2.setAttribute("type", "text");
    input2.setAttribute("placeholder", "Wprowadź nazwe semestru");
    // append input2 to p2
    p2.appendChild(input2);




    // create paragraph 3
    var p3 = document.createElement("p");
    // append it to form
    div.appendChild(p3);
    // create h2 text
    var h3 = document.createElement("h2");
    h3.innerHTML = "Data od: ";
    // append h3 to p3
    p3.appendChild(h3);
    // create input 3
    var input3 = document.createElement("input");
    input3.setAttribute("name", "date_f");
    input3.setAttribute("type", "date");
    // append input3 to p3
    p3.appendChild(input3);




    // create paragraph 4
    var p4 = document.createElement("p");
    // append it to form
    div.appendChild(p4);
    // create h2 text
    var h4 = document.createElement("h2");
    h4.innerHTML = "Data od: ";
    // append h4 to p4
    p4.appendChild(h4);
    // create input 4
    var input4 = document.createElement("input");
    input4.setAttribute("name", "date_t");
    input4.setAttribute("type", "date");
    // append input4 to p4
    p4.appendChild(input4);

 




    // submit
    // create paragraph 5
    var p5 = document.createElement("p");
    // append it to form
    div.appendChild(p5);
    // create input 5
    var input5 = document.createElement("input");
    input5.setAttribute("type", "submit");
    input5.setAttribute("onclick", "addNewTerm()");
    input5.setAttribute("value", "Dodaj do bazy");
    // append input5 to p5
    p5.appendChild(input5);

}




// ajax for adding new term
function addNewTerm()
{
    //var n1 = document.getElementsByName("name")[0].value;
    //var n2 = document.getElementsByName("short_name")[0].value;

    /*
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
    */
}
