// create form to add new school year
function schoolYearFormBuilder()
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
    h1.innerHTML = "School year: ";
    // append h1 to p1
    p1.appendChild(h1);
    // create input 1
    var input1 = document.createElement("input");
    input1.setAttribute("name", "schoolyear");
    input1.setAttribute("type", "text");
    input1.setAttribute("placeholder", "Enter school year");
    // append input1 to p1
    p1.appendChild(input1);


    // create paragraph 2
    var p2 = document.createElement("p");
    // append it to form
    div.appendChild(p2);
    // create h2 text
    var h2 = document.createElement("h2");
    h2.innerHTML = "Date from: ";
    // append h2 to p2
    p2.appendChild(h2);
    // create input 2
    var input2 = document.createElement("input");
    input2.setAttribute("name", "datef");
    input2.setAttribute("type", "date");
    // append input2 to p2
    p2.appendChild(input2);


    // create paragraph 3
    var p3 = document.createElement("p");
    // append it to form
    div.appendChild(p3);
    // create h2 text
    var h3 = document.createElement("h2");
    h3.innerHTML = "Date to";
    // append h3 to p3
    p3.appendChild(h3);
    // create input 3
    var input3 = document.createElement("input");
    input3.setAttribute("name", "datet");
    input3.setAttribute("type", "date");
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
    input4.setAttribute("onclick", "addNewSchoolYear()");
    input4.setAttribute("value", "Add");
    // append input4 to p4
    p4.appendChild(input4);

}


// ajax for adding new school year
function addNewSchoolYear()
{
    // get values
    var n1 = document.getElementsByName("schoolyear")[0].value;
    var n2 = document.getElementsByName("datef")[0].value;
    var n3 = document.getElementsByName("datet")[0].value;

    // start ajax
    $.ajax({
        type: "post",
        url: "public/ajax/admin/ajax_schoolYear-add.php",
        data: ({
            schoolyear: n1,
            datef: n2,
            datet: n3
        }), 
        success: function()
        {
            // reload
            window.location.reload();
        }
    });
}



// ajax for edit / update school year data 
function editSchoolYear()
{
    // get values
    var eleN1 = document.getElementsByName("schoolYear")[0].value;
    var eleN2 = document.getElementsByName("datef")[0].value;
    var eleN3 = document.getElementsByName("datet")[0].value;
    var id_schoolYear = document.getElementsByName("id")[0].value;


    // start ajax
    $.ajax({
        type: "POST",
        url: "public/ajax/admin/ajax_schoolYear-update.php",
        data: ({
            schoolYear: eleN1,
            datef: eleN2,
            datet: eleN3,
            id: id_schoolYear
        }),
        success: function()
        {
            window.location.href = "?ap=schoolyears";
        }
    }); 


}