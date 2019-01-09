
// create form for new message
function newMessageFormBuilderForUser()
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


    // create paragraph 0
    var p0 = document.createElement("p");
    // append it to form
    div.appendChild(p0);
    var h0 = document.createElement("h2");
    h0.innerHTML = "Nadawcą jestes Ty";
    p0.appendChild(h0);


    // create paragraph 1
    var p1 = document.createElement("p");
    // append it to form
    div.appendChild(p1);
    // create h2 text
    var h1 = document.createElement("h2");
    h1.innerHTML = "Nauczyciel: ";
    // append h1 to p1
    p1.appendChild(h1);
    // create input 1
    var input1 = document.createElement("select");
    input1.setAttribute("id", "teacherSelect");
    input1.setAttribute("name", "teacherID");
    // append input1 to p1
    p1.appendChild(input1);
    // get options
    getAllTeachers();


    // create paragraph 2
    var p2 = document.createElement("p");
    // append it to form
    div.appendChild(p2);
    // create h2 text
    var h2 = document.createElement("h2");
    h2.innerHTML = "Tytuł: ";
    // append h2 to p2
    p2.appendChild(h2);
    // create input 2
    var input2 = document.createElement("input");
    input2.setAttribute("name", "title");
    input2.setAttribute("type", "text");
    input2.setAttribute("placeholder", "Wprowadź tytuł dla wiadomości");
    // append input2 to p2
    p2.appendChild(input2);



    // create paragraph 3
    var p3 = document.createElement("p");
    // append it to form
    div.appendChild(p3);
    // create h2 text
    var h3 = document.createElement("h2");
    h3.innerHTML = "Wiadomość";
    // append h3 to p3
    p3.appendChild(h3);
    // create input 3
    var input3 = document.createElement("textarea");
    input3.setAttribute("name", "content");
    input3.setAttribute("type", "text");
    input3.setAttribute("placeholder", "Wiadomość...");
    // append input3 to p3
    p3.appendChild(input3);


    // create hidden for user id
    var hidden_p = document.createElement("p");
    // append it to form
    div.appendChild(hidden_p);
    // create hidden input
    var hidden_input = document.createElement("input");
    hidden_input.setAttribute("type", "hidden");
    hidden_input.setAttribute("name", "userID"); 
    hidden_input.setAttribute("value", form.getAttribute("data-userid"));
    hidden_p.appendChild(hidden_input);



    // submit
    // create paragraph 4
    var p4 = document.createElement("p");
    // append it to form
    div.appendChild(p4);
    // create input 4
    var input4 = document.createElement("input");
    input4.setAttribute("type", "submit");
    input4.setAttribute("onclick", "sendAMessage()");
    input4.setAttribute("value", "Wyślij wiadomość");
    // append input4 to p4
    p4.appendChild(input4);
}



// get all teachers by ajax
// set as otions
function getAllTeachers()
{
    
    // start ajax
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "public/ajax/user/get/ajax_teachers-get.php",
        success: function(data)
        {
            // find by id
            var teacherSelect = document.getElementById("teacherSelect");

            data.forEach(element => 
            {
                // create element
                var opt = document.createElement("option");
                opt.setAttribute("value", element['id']);
                opt.innerHTML = element['imie'] + " " + element['nazwisko'];
                teacherSelect.appendChild(opt);
            });
        }
    });
}


// send a message by ajax
function sendAMessage()
{
    
    var n1 = document.getElementsByName("userID")[0].value;
    var n2 = document.getElementsByName("teacherID")[0].value;
    var n3 = document.getElementsByName("title")[0].value;
    var n4 = document.getElementsByName("content")[0].value;

    
    // start ajax
    $.ajax({
        type: "post",
        url: "public/ajax/user/send/ajax_message-send.php",
        data: ({
            stundentID: n1,
            teacherID: n2,
            title: n3,
            content: n4
        }),
        success: function()
        {
            // reload
            window.location.reload();
        }
    });

}