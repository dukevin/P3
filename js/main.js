var popcontent = {
    "login": {
        "title": "Login",
        "field1": "username",
        "field2": "password",
        "button1": "Forgot?",
        "button2": "Login"
    },
    "register": {
        "title": "Register a new account",
        "field1": "username",
        "field2": "password",
        "field3": "retype password",
        "field4": "email",
        "button1": "Back",
        "button2": "Register"
    },
    "forgot": {
        "title": "Forgot Password?",
        "field1": "email",
        "button1": "Back",
        "button2": "Ok",
    }
}
$(document).ready(function () {
    $("#head, #closeBtn").click(function () {
        $("#popup").fadeOut();
        $("#settings-list").fadeOut();
    });
    $(".main-button1, .main-button2, .main-button3").on("click", function () {
        if ($(this).hasClass("login")) {
            loadPopup("login");
        }
        if ($(this).hasClass("register")) {
            loadPopup("register");
        }
    });
    $("#button1, #button2").on("click", function () {
        if ($(this).find('p').text() == "Back")
            $("#popup").fadeOut();
        if ($(this).find('p').text() == "Forgot?")
            loadPopup("forgot");
        if ($(this).find('p').text() == "Login")
            handleLogin();
        if ($(this).find('p').text() == "Register")
            handleRegister();
        if ($(this).find('p').text() == "Ok")
            handleForgot();
    });

});
function loadPopup(key) {
    $("#popup").fadeIn();
    $("#popup p").text(popcontent[key].title);
    $("#popup #button1 p").text(popcontent[key].button1);
    $("#popup #button2 p").text(popcontent[key].button2);
    for (i = 1; i <= 4; i++) {
        if (!popcontent[key].hasOwnProperty('field' + i))
            $("#popup .input" + i).hide();
        else {
            $("#popup .input" + i).attr({ "name": popcontent[key]['field' + i], "placeholder": popcontent[key]['field' + i] });
            $("#popup .input" + i).val('');
            $("#popup .input" + i).show();
        }
    }
}
function handleRegister() {
    vf = validateForm();
    if (vf != '') {
        $("#popup-content p").html("<span style='color:red'>" + vf + "</span>");
        return false;
    }
    $.ajax({
        url: "handleUser.php",
        method: "post",
        data: {
            "request": "register",
            "name": $("input[name='username']")[0].value,
            "password": $("input[name='password']")[0].value,
            "email": $("input[name='email']")[0].value
        },
        success: function (res) {
            msg = res.split(": ")[1];
            type = res.split(": ")[0];
            $("#popup-content p").html("<span style='color:red'>" + msg + "</span>");
            if (type == "Error")
                return;
            if (type == "Ok") {
                $("#popup").delay(2000).fadeOut();
                $("#title p").text("Please login");
                $("#header").css("background-color", "dodgerblue");
            }
        }
    })
}
function handleLogin() {
    vf = validateForm();
    if (vf != '') {
        $("#popup-content p").html("<span style='color:red'>" + vf + "</span>");
        return false;
    }
    $.ajax({
        url: "handleUser.php",
        method: "post",
        data: {
            "request": "login",
            "name": $("input[name='username']")[0].value,
            "password": $("input[name='password']")[0].value
        },
        success: function (res) {
            msg = res.split(": ")[1];
            type = res.split(": ")[0];
            $("#popup-content p").html("<span style='color:red'>" + msg + "</span>");
            if (type == "Error")
                return;
            if (type == "Ok") {
                $("#popup").fadeOut();
                $("#title p").text("Logged in!");
                $("#header").css("background-color", "green");
                setTimeout(function () {
                    window.location = "home.php";
                }, 2000);
            }
        }
    });
}
function handleForgot() {
    //Wizard of Oz.. should ask server for email and send it
    $("#popup-content p").html("<span style='color:red'>" + "Check your email!" + "</span>");
}
function validateForm() {
    name = $("input[name='username']")[0].value;
    password = $("input[name='password']")[0].value;
    if (name.length < 3)
        return "Your username must be 3 or more characters";
    //if (!RegExp("/^[a-z0-9]+$/i").test(name))
    //return "You may only use alphanumeric characters in your username";
    if (password.length < 3)
        return "Your password must be 3 or more characters";
    //if (!RegExp("/^[a-z0-9]+$/i").test(password))
    //return "You may only use alphanumeric characters in your password";
    if ($("#button2 p").text() == "Register" && password != $("input[name='retype password']")[0].value) {
        return "The passwords do not match";
    }
    return '';
}