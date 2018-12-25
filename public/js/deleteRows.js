// global variable for checked rows
var gCheckedRows = new Array();
// array for options
var gCheckedOptions = new Array();
// create alert object
var alert = new myAlert();

// confirm to delete
function deleteRows(elementsName, fileName)
{
    // table for row id
    var myRows = Array();
    // get elements by name
    var ROWS = document.getElementsByName(elementsName);

    // check which one row is checked -> save to array
    ROWS.forEach(element => {
        if(element.checked === true)
        {
            // if is checked push to table myRows
            myRows.push(element.value);
        }
    });
    // save rows id to global variable
    gCheckedRows = myRows;

    // if myRows is not empty
    if(myRows.length != 0)
    {
        gCheckedOptions = [fileName];
        alert.render("Chcesz usunac <b>"+myRows.length+"</b> posty?");
    }
        
}


function returnOption(option)
{
    // delete confirm window
    alert.deleteMe();

    // if option is true
    if(option === true)
    {
        // delete from database ...
        $.ajax({
            type: "POST",
            url: "public/ajax/admin/"+gCheckedOptions[0]+".php",
            data: ({id: gCheckedRows}), // take rows id from global variable
            success: function()
            {
                // set null
                gCheckedRows = null;
                // reload
                window.location.reload();
            }
        });
    }

}