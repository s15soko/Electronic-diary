// function for term change
function changeTerm(data)
{
    opt = data.options[data.selectedIndex];

    default_url = "userPanel.php?up=marks";
    termid = opt.getAttribute("data-term_id");
    yearid = opt.getAttribute("data-year_id");


    // set GET (if termid null set null)
    window.location.href = default_url+"&y="+yearid+"&t="+termid;
    
    
}



function showMarkInformation(mark_data)
{
    /*
    var win = window;

    var mouse_x = win.event.screenX;
    var mouse_y = win.event.screenY;

    var mark    = mark_data.getAttribute('data-mark');
    var desc    = mark_data.getAttribute('data-desc');
    var kind    = mark_data.getAttribute('data-kind');
    var range   = mark_data.getAttribute('data-range');
    var data    = mark_data.getAttribute('data-data');
    var weight  = mark_data.getAttribute('data-weight');


    var smallWinBox = document.createElement('div');
    smallWinBox.setAttribute("class", "small_win_data");
    document.body.appendChild(smallWinBox);


    var apMe = {0: mark, 1: desc, 2: kind, 3: range, 4: data, 5: weight};

    var p = Array();
    var count;
    for(count = 0; count < 6; count++)
    {
        p[count] = document.createElement("p");
        smallWinBox.appendChild(p[count]);
    }

    var TNode = Array();
    for(count = 0; count < 6; count++)
    {
        TNode[count] = document.createTextNode(apMe[count]);
        p[count].appendChild(TNode[count]);
    }
*/
    
}

