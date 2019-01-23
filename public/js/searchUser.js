
// search option for users
function searchUser(row_name = "users_row")
{
    // find form div
    var form = document.getElementById("searchForm");

    // if form is active turn it off
    var checkForm = form.querySelector(".activeSearchForm");
    if(checkForm)
    {
        form.removeChild(checkForm);
        return;
    }
    
    // create div (form)
    var div = document.createElement("form");
    div.setAttribute("class", "activeSearchForm");
    // append div to form
    form.appendChild(div);
    


    // create paragraph 1
    var p1 = document.createElement("p");
    // append it to form
    div.appendChild(p1);
    // create h2 text
    var h1 = document.createElement("h2");
    h1.innerHTML = "Enter surname: ";
    // append h1 to p1
    p1.appendChild(h1);
    // create input 1
    var input1 = document.createElement("input");
    input1.setAttribute("type", "text");
    input1.setAttribute("onkeyup", "startSearch('"+row_name+"');");
    input1.setAttribute("id", "searchUserInput");
    // append input1 to p1
    p1.appendChild(input1);
}

// start search
function startSearch(row_name)
{
    var value = document.getElementById("searchUserInput").value;
    var vlength = value.length;

    // get all users
    var users = document.getElementsByClassName(row_name);

    // get rows value
    var Surname = Array();
    for(i = 0; i < users.length; i++)
    { 
        Surname.push((users[i].querySelector(".userSurname").innerHTML).toLowerCase());      
    }

    // show all rows
    for(i = 0; i < users.length; i++)
    { 
        users[i].style.display = "table-row";   
    }

    // filter
    for(i = 0; i < users.length; i++)
    { 
        for(j = 0; j < vlength; j++)
        {
            if(Surname[i][j] !== value[j])
            {
                users[i].style.display = "none";
            }          
        } 
    }
}

