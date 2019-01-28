// my alert window
function myAlert(objectName)
{  
    this.render = function(text)
    {
        // if confirmWin div is not exists
        if(!document.body.querySelector(".confirmWin"))
        {   
            var myBox = document.createElement("div");
            myBox.setAttribute("class", "confirmWin");

            // mybox header
            var myBoxHeader = document.createElement("span");
            myBoxHeader.innerHTML = text;
            myBox.appendChild(myBoxHeader);

            // mybox options
            var myBoxOptions = document.createElement("div");
            myBoxOptions.setAttribute("class", "options");
            myBox.appendChild(myBoxOptions);

            // option true
            var rTrue = document.createElement("div");
            rTrue.innerHTML = "<button onclick='returnOption(true);'><span>OK</span></button>";

            // option false
            var rFalse = document.createElement("div");
            rFalse.innerHTML = "<button onclick='returnOption(false);'><span>ANULUJ</span></button>";

            // append options
            myBoxOptions.appendChild(rTrue);
            myBoxOptions.appendChild(rFalse);

            // append my Box
            document.body.appendChild(myBox);
        
            var winW = window.innerWidth;
            //var winH = window.innerHeight;

            // display box on the center on the screen
            myBox.style.display = "block";
            myBox.style.left = (winW/2)-(200)+"px";
        }   
    }

    // delete confirm window if exists
    this.deleteMe = function()
    {
        var myBox = document.body.querySelector(".confirmWin");
        if(myBox)
        {
            document.body.removeChild(myBox);
        }
    }
}
