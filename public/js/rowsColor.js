function colorMyRows(row_name)
{
    var marks_row = document.querySelectorAll("."+row_name);
    var counter = 0;

    marks_row.forEach(element => 
    {
        if(counter == 0)
        {
            element.style.backgroundColor = '#EBEBEB';
            counter++;
        }
        else
        {
            element.style.backgroundColor = '#F3F3F3';
            counter = 0;
        }             
    });
} 
    
