
// return user id by ajax
function returnUserId()
{
    var userId;
    // start ajax
    // get user id
    $.ajax({
        type: "POST",
        async: false,
        url: "public/ajax/user/get/ajax_userID-get.php",
        success: function(data)
        {
            userId = data;
        }
    });

    return userId;
}

// return user marks by ajax
function returnUserMarks()
{
    var myAjaxResults;
    // start ajax
    // get all marks
    $.ajax({
        type: "POST",
        async: false,
        data: ({
            termID: $termSelect,
            userID: $userId
        }),
        url: "public/ajax/user/get/ajax_userMarksByTerm-get.php",
        success: function(data)
        {
            myAjaxResults = data;
        }
    });
    return myAjaxResults;
}

// return user subjects
function returnUserSubjects()
{
    var userSubjects;
    // start ajax
    // get user subjects
    $.ajax({
        type: "POST",
        async: false,
        data: ({
            userID: $userId
        }),
        url: "public/ajax/user/get/ajax_userSubjects-get.php",
        success: function(data)
        {
            userSubjects = data;
        }
    });
    return userSubjects;
    
}




// load default data
$(document).ready(function()
{
    // box for our results
    $resultBox = $("#marks_container");
    
    // get selected option from terms/ school years
    $schoolYear = $("#termSelect option:selected").attr("data-year_id");
    $termSelect = $("#termSelect option:selected").attr("data-term_id");


    // user id 
    $userId = returnUserId();
    // get user subjects
    $userSubjects = returnUserSubjects();
    
    // get user marks
    // by term id
    $userMarks = returnUserMarks();
    


    // parse to array
    $userMarks = JSON.parse($userMarks);
    $userSubjects = JSON.parse($userSubjects);


    // create containers
    // for marks header
    // marks content
    createStructure();

    // load marks
    loadMarksData();

      
});


function createStructure()
{
    // header for marks
    var marks_header = document.createElement("div");
    $marks_header = $(marks_header);
    $marks_header.attr("id", "marks_header");
    $resultBox.append($marks_header);
    
    var header_text_box = document.createElement("div");  
    $header_text_box = $(header_text_box);
    $header_text_box.attr("class", "header_text_box");
    $marks_header.append($header_text_box);

    var subject_box_header_short = document.createElement("div");  
    $subject_box_header_short = $(header_text_box);
    $subject_box_header_short.attr("class", "subject_box-header_short");
    $header_text_box.append($subject_box_header_short);

    $subject_box_header_short.text("Subject");
    // end

    
}

function createMarksBody()
{
    // marks body
    var marks_body = document.createElement("div");
    $marks_body = $(marks_body);
    $marks_body.attr("id", "marks_body");

    $resultBox.append($marks_body);
    // end
}


function loadMarksData()
{
    // 
    container = document.querySelector("#marks_body");
    if(container !== null)
    {
        $container = $(container);
        $container.each(function(index)
        {
            this.remove();
        })
    }  

    // create marks body
    createMarksBody();

    $termSelect = $("#termSelect option:selected").attr("data-term_id");
    // by term id
    $userMarks = returnUserMarks();
    // parse to array
    $userMarks = JSON.parse($userMarks);

    // foreach subject
    $userSubjects.forEach(subject => 
    {
        var row = document.createElement("div");
        row.setAttribute("class", "marks_row");

        $marks_body.append(row);


        var subject_box = document.createElement("div");
        subject_box.setAttribute("class", "subject_box");
        subject_box.innerHTML = subject['name'];
        row.appendChild(subject_box);
       
        var marks_box = document.createElement("div");
        marks_box.setAttribute("class", "marks_box");
        row.appendChild(marks_box);

        // foreach mark
        $userMarks.forEach(user_mark => 
        {
            if(subject['id'] === user_mark['subject_id'])
            {
                var mark = document.createElement("div");
                mark.setAttribute("class", "mark");
                mark.innerHTML = user_mark['grade'];
                mark.style.color = ""+user_mark['color']+"";

                mark.setAttribute("data-mark", user_mark['grade']);
                mark.setAttribute("data-desc", user_mark['name']);
                mark.setAttribute("data-kind", user_mark['type']);
                mark.setAttribute("data-range", user_mark['range']);
                mark.setAttribute("data-date", user_mark['date']);
                mark.setAttribute("data-weight", user_mark['weight']);

                marks_box.appendChild(mark);
            }
        });


        var last_mark_box = document.createElement("div");
        last_mark_box.setAttribute("class", "last_mark_box");
        row.appendChild(last_mark_box);

        var mark = document.createElement("div");
        mark.setAttribute("class", "mark");
        last_mark_box.appendChild(mark);

    });    
    

    
}