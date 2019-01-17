

// laod default
// 1) hours data in lesson plan
$(document).ready(function()
{
    // 1*
    getHours();



    
});



// get hours by ajax
function getHours()
{
    // start ajax
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "public/ajax/user/get/ajax_hoursLesson-get.php",
        success: function(data)
        {
            // find by id
            var hours_container = document.getElementById("hours_container");
            
            data.forEach(element => 
            {
                // create element
                var div = document.createElement("div");
                div.setAttribute("class", "h_box");
                div.innerHTML = element['hour_from'];
                hours_container.appendChild(div);  

            });
        }
    });
}
