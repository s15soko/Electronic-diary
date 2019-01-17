// create form to add new term
function termFormBuilder()
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
    h1.innerHTML = "School year: ";
    // append h1 to p1
    p1.appendChild(h1);
    // create input 1
    var input1 = document.createElement("select");
    input1.setAttribute("id", "termSelect");
    input1.setAttribute("name", "school_year");
    // append input1 to p1
    p1.appendChild(input1);
    // get options 
    getAllSchoolYears();


    // create paragraph 2
    var p2 = document.createElement("p");
    // append it to form
    div.appendChild(p2);
    // create h2 text
    var h2 = document.createElement("h2");
    h2.innerHTML = "Term: ";
    // append h2 to p2
    p2.appendChild(h2);
    // create input 2
    var input2 = document.createElement("input");
    input2.setAttribute("name", "term");
    input2.setAttribute("type", "text");
    input2.setAttribute("placeholder", "Enter term name");
    // append input2 to p2
    p2.appendChild(input2);




    // create paragraph 3
    var p3 = document.createElement("p");
    // append it to form
    div.appendChild(p3);
    // create h2 text
    var h3 = document.createElement("h2");
    h3.innerHTML = "Date from: ";
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
    h4.innerHTML = "Date to: ";
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
    input5.setAttribute("value", "Add");
    // append input5 to p5
    p5.appendChild(input5);

    
}


// get by ajax data from database
function getAllSchoolYears()
{
    // start ajax
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "public/ajax/admin/get/ajax_schoolYears-get.php",
        success: function(data)
        {
            // find by id
            var termSelect = document.getElementById("termSelect");
            
            // add options
            data.forEach(element => 
            {
                // create element
                var opt = document.createElement("option");
                opt.setAttribute("value", element['id']);
                opt.innerHTML = element['school_year'];
                termSelect.appendChild(opt);


            });
        }
    });
    
}




// ajax for adding new term
function addNewTerm()
{
    // get values
    var n1 = document.getElementsByName("school_year")[0].value;
    var n2 = document.getElementsByName("term")[0].value;
    var n3 = document.getElementsByName("date_f")[0].value;
    var n4 = document.getElementsByName("date_t")[0].value;


    // start ajax
    $.ajax({
        type: "post",
        url: "public/ajax/admin/ajax_term-add.php",
        data: ({
            year: n1,
            term: n2,
            date_f: n3,
            date_t: n4
        }), 
        success: function()
        {
            // reload
            window.location.reload();
        }
    });
    
}



// ajax for edit / update term data 
function editTerm()
{
    // get values
    var eleN1 = document.getElementsByName("rok_szkolny")[0].value;
    var eleN2 = document.getElementsByName("semestr")[0].value;
    var eleN3 = document.getElementsByName("data_f")[0].value;
    var eleN4 = document.getElementsByName("data_t")[0].value;
    var id_term = document.getElementsByName("id")[0].value;


    // start ajax
    $.ajax({
        type: "POST",
        url: "public/ajax/admin/ajax_term-update.php",
        data: ({
            year: eleN1,
            term: eleN2,
            df: eleN3,
            dt: eleN4,
            id: id_term
        }),
        success: function()
        {
            window.location.href = "?ap=terms";
        }
    });

}