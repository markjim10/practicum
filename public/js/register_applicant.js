var province = document.querySelector("#province");
province.onchange = (e) => {
    var id = e.target.value;

    var select = document.querySelector("#city");
    var length = select.options.length;
    for (i = length - 1; i > 0; i--) {
        select.options[i] = null;
    }

    $.ajax({
        type: "GET",
        url: "/get_city/" + id + "",
        data: {
            id: id,
        },
        success: function (response) {
            console.log(response);
            response.forEach((item) => {
                console.log(item.city_municipality_description);
                var city = document.querySelector("#city");
                var node = document.createElement("option");
                var textnode = document.createTextNode(
                    item.city_municipality_description
                );
                node.setAttribute("value", item.city_municipality_description);
                node.appendChild(textnode);
                city.appendChild(node);
            });
        },
        error: function (request, status, error) {
            alert(request.responseText);
        },
    });
};

var application = document.querySelector("#application");
application.onchange = (e) => {
    var id = e.target.value;

    var select = document.querySelector("#preferred_program");
    var length = select.options.length;
    for (i = length - 1; i > 0; i--) {
        select.options[i] = null;
    }

    $.ajax({
        type: "GET",
        url: "/get_application/" + id + "",
        data: {
            id: id,
        },
        success: function (response) {
            console.log(response);
            response.forEach((item) => {
                var city = document.querySelector("#preferred_program");
                var node = document.createElement("option");
                var textnode = document.createTextNode(item.program_name);
                node.setAttribute("value", item.id);
                node.appendChild(textnode);
                city.appendChild(node);
            });
        },
        error: function (request, status, error) {
            alert(request.responseText);
        },
    });
};

var phone = document.querySelector("#phone");
phone.onkeyup = (e) => {
    var phone = e.target.value;
    var message = document.querySelector("#phone_message");

    $.ajax({
        type: "GET",
        url: "/phone_validation/" + phone + "",
        data: {
            phone: phone,
        },
        success: function (response) {
            console.log(response);
            if (response == "invalid") {
                message.textContent = `Invalid Phone Number`;
                message.style.color = "red";
                message.style.fontWeight = "Bold";
            } else {
                message.textContent = "";
            }
        },
    });
};

var birth_month = document.querySelector("#birth_month");
birth_month.onchange = (e) => {

    var day = document.querySelector("#birth_day").value;
    var month = document.querySelector("#birth_month").value;
    var year = document.querySelector("#birth_year").value;

    if(day!="" && month!="" && year!="") {
        validateBirthDate(month, day, year);
    }
}

var birth_day = document.querySelector("#birth_day");
birth_day.onchange = (e) => {

    var day = document.querySelector("#birth_day").value;
    var month = document.querySelector("#birth_month").value;
    var year = document.querySelector("#birth_year").value;

    if(day!="" && month!="" && year!="") {
        validateBirthDate(month, day, year);
    }
}

var birth_year = document.querySelector("#birth_year");
birth_year.onchange = (e) => {

    var day = document.querySelector("#birth_day").value;
    var month = document.querySelector("#birth_month").value;
    var year = document.querySelector("#birth_year").value;

    if(day!="" && month!="" && year!="") {
        validateBirthDate(month, day, year);
    }
}

function validateBirthDate(month, day, year) {

    bdayMsg = document.querySelector("#birthday_message");

    valid = true;

    if ( month == "January" || month == "March" || month == "May" || month == "July" || month == "August" ||month == "October" || month == "December")
    {
        if(day < 32) {
            valid = true;
        } else {
            valid = false;
        }
    }
    else if (month == "April" ||month == "June" ||month == "September" ||month == "November")
    {
        if(day < 31) {
            valid = true;
        } else {
            valid = false;
        }
    }
    else
    {
        if(day < 29) {
            valid = true;
        } else {
            if((((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0))==true && day < 30 ) {
                valid = true;
            } else {
                valid = false;
            }
        }
    }

    if(valid==false) {
        bdayMsg.textContent = "Please enter a valid date";
        bdayMsg.style.color = "red";
        bdayMsg.style.fontWeight = "Bold";
    } else {
        bdayMsg.textContent = "";
    }
}

var email_address = document.querySelector("#email_address");
email_address.onkeyup = (e) => {
    var email = e.target.value;

    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var validation = regex.test(email);

    if (validation === true) {
        $.ajax({
            type: "GET",
            url: "/email_validation/" + email + "",
            data: {
                email: email,
            },
            success: function (response) {
                console.log(response);
                email = document.querySelector("#email_message");
                if (response == "taken") {
                    email.textContent = `Email is unavailable`;
                    email.style.color = "red";
                    email.style.fontWeight = "Bold";
                } else {
                    email.textContent = `Email is available`;
                    email.style.color = "green";
                    email.style.fontWeight = "Bold";
                }
            },
        });
    } else {
        email = document.querySelector("#email_message");
        email.textContent = `Enter a valid Email`;
        email.style.color = "red";
        email.style.fontWeight = "Bold";
    }
};

var password = document.querySelector("#password");
password.onkeyup = (e) => {
    var password = e.target.value;
    var confirm = document.querySelector("#confirm").value;
    var message = document.querySelector("#password_message");

    if (password.length > 3 && confirm.length > 3) {
        if (password != confirm) {
            message.textContent = "The Passwords do not match";
            message.style.color = "red";
            message.style.fontWeight = "Bold";
        } else {
            message.textContent = "";
        }
    } else {
        message.textContent =
            "The length of the password and confirm password must be at least 4 characters";
        message.style.color = "orange";
        message.style.fontWeight = "Bold";
    }
};

var confirmPass = document.querySelector("#confirm");
confirmPass.onkeyup = (e) => {
    var confirmPass = e.target.value;
    var password = document.querySelector("#password").value;
    var message = document.querySelector("#password_message");

    if (password.length > 3 && confirmPass.length > 3) {
        if (password != confirmPass) {
            message.textContent = "The Passwords do not match";
            message.style.color = "red";
            message.style.fontWeight = "Bold";
        } else {
            message.textContent = "";
        }
    } else {
        message.textContent =
            "The length of the password and confirm password must be at least 4 characters";
        message.style.color = "orange";
        message.style.fontWeight = "Bold";
    }
};

var photo = document.querySelector("#applicant_photo");
photo.onchange = () => {
    var message = document.querySelector("#photo_message");
    var fsize = photo.files[0].size;
    var file = Math.round(fsize / 1024);
    if (file > 4096) {
        message.textContent = "The image must be less than 4MB";
        message.style.color = "orange";
        message.style.fontWeight = "Bold";
    } else {
        message.textContent = "";
    }
};

var card = document.querySelector("#card_photo");
card.onchange = () => {
    var message = document.querySelector("#card_message");
    var fsize = card.files[0].size;
    var file = Math.round(fsize / 1024);
    if (file > 4096) {
        message.textContent = "The image must be less than 4MB";
        message.style.color = "orange";
        message.style.fontWeight = "Bold";
    } else {
        message.textContent = "";
    }
};

var submit = document.querySelector("#form_submit");
submit.onsubmit = (e) => {
    var validation = true;

    var phone = document.querySelector("#phone_message").textContent;
    if (phone == "Invalid Phone Number") {
        validation = false;
    }

    var email = document.querySelector("#email_message").textContent;
    if (email == "Enter a valid Email" || email == "Email is unavailable") {
        validation = false;
    }

    var photo = document.querySelector("#photo_message").textContent;
    if (photo == "The image must be less than 4MB") {
        validation = false;
    }

    var card = document.querySelector("#card_message").textContent;
    if (photo == "The image must be less than 4MB") {
        validation = false;
    }

    var birthday = document.querySelector("#birthday_message").textContent;
    if (birthday == "Please enter a valid date") {
        validation = false;
    }

    return validation;
};

var photoUpload = document.getElementById("applicant_photo");
photoUpload.onchange = (e) => {
    var label = document.getElementById("photo_label");
    label.innerHTML = "Photo image has been Selected";
};

var cardUpload = document.getElementById("card_photo");
cardUpload.onchange = (e) => {
    var label = document.getElementById("card_label");
    label.innerHTML = "Card image has been Selected";
};
