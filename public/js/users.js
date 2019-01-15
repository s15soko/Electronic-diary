
// add new user
function addNewUser()
{
    // get values
    var name = document.getElementsByName("name")[0].value;
    var surname = document.getElementsByName("surname")[0].value;
    var schoolrole = document.getElementsByName("schoolrole")[0].value;
    var email = document.getElementsByName("email")[0].value;
    var pin = document.getElementsByName("pin")[0].value;
    var address = document.getElementsByName("address")[0].value;
    var contact = document.getElementsByName("contact")[0].value;
    var date = document.getElementsByName("birthdate")[0].value;
    var login = document.getElementsByName("login")[0].value;
    var password = document.getElementsByName("password")[0].value;
    var role = document.getElementsByName("role")[0].value;


    // start ajax
    $.ajax({
        type: "POST",
        url: "public/ajax/admin/ajax_user-add.php",
        data: ({
            name: name,
            surname: surname,
            schoolrole: schoolrole,
            email: email,
            pin: pin,
            address: address,
            contact: contact,
            date: date,
            login: login,
            password: password,
            role: role
        }),
        success: function()
        {
            window.location.href = "?ap=users";
        }
    });
}