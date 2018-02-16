var state = "unlogged";
var popcontent = {
    "login": {
        "title": "Login",
        "button1": "Register",
        "button2": "Login"
    },
    "register": {
        "title": "Register a new account",
        "button1": "Back",
        "button2": "Register"
    },
    "unimplemented": {
        "title": "Work in progress",
        "button1": "Back",
        "button2": "Ok",
    }
}
$(document).ready(function () {
    $("#settings").click(function () {
        $("#settings-list").show();
        $("#popup").hide();
    });
    $("#login-btn").click(function () {
        $("#settings-list").hide();
        loadPopup("login");
    });
    $("#head, #closeBtn").click(function () {
        $("#popup").hide();
        $("#settings-list").hide();
    });
    $("#button1, #button2").click(function () {
        $("#popup").hide();
        $("#settings-list").hide();
    });
    $("#button2").click(function () {
        $(".main-button1 p").text("Word of The Day");
        $(".main-button1").removeClass("login");
        $(".main-button1").addClass("word_of_day");
        $(".main-button2 p").text("My Vocab");
        $(".main-button2").addClass("vocab");
        $(".main-button2").removeClass("register");
        $(".main-button3").removeClass("hidden");
    });
    $(".main-button1, .main-button2, .main-button3").on("click", function () {
        if ($(this).hasClass("login")) {
            loadPopup("login");
        }
        if ($(this).hasClass("register")) {
            loadPopup("register");
        }
        if ($(this).hasClass("vocab")) {
            window.location.href = "vocab.html";
        }
        if ($(this).hasClass("word_of_day")) {
            window.location.href = "word.html";
        }
    })
});
function loadPopup(key) {
    $("#popup").show();
    $("#popup p").text(popcontent[key].title);
    $("#popup #button1 p").text(popcontent[key].button1);
    $("#popup #button2 p").text(popcontent[key].button2);
}