$(document).ready(function () {
    $("#settings").click(function () {
        $("#settings-list").toggle(500);
    });
    $("#head, .closeBtn, #body").click(function () {
        $("#settings-list").fadeOut();
    });
    $(".closeBtn, #cancel, .cancel, .close").click(function () {
        $(".popup").fadeOut();
        $("#settings-list").fadeOut();
    });
    $("#logout-btn").click(function () {
        $("#settings-list").hide();
        $.ajax({
            url: "handleUser.php",
            method: "post",
            data: { "request": "logout" },
            success: function (res) {
                $("#title p").text("Logged out!");
                $("#header").css("background-color", "green");
                setTimeout(function () {
                    window.location = "index.php";
                }, 2000);
            }
        });
    });
    $(".main-button").on("click", function () {
        if ($(this).hasClass("vocab")) {
            if(name.slice(-1) == '1')
                window.location.href = "vocab_B.php";
            else
                window.location.href = "vocab.php";  
        }
    });
    $("#answer").click(function () {
        word = $("#word_of_day h1").text();
        var msg = new SpeechSynthesisUtterance(word);
        window.speechSynthesis.speak(msg);
    });
    $("h2").click(function () {
        var msg = new SpeechSynthesisUtterance($(this).text());
        window.speechSynthesis.speak(msg);
    });
    $("#check").click(function () {
        $(".popup").fadeIn();
    });
    $("#start").on("click", function () {
        if ($("#start p").text() == "Start") {
            $("#visualizer").fadeIn();
            captureAudio();
            $("#start p").text("Submit");
            $("#start").css("background-color", "darkred");
            $("#start p").css("color", "white");
        }
        else if ($("#start p").text() == "Submit") {
            $("#visualizer").fadeOut();
            $(".popup-content p").html("<span style='color:orange'>Uploading...</span>");
            setTimeout(function () {
                $(".popup-content p").html("<span style='color:gold'>Checking...</span>");
            }, 2000);
            setTimeout(function () {
                $(".popup-content p").html("<span style='color:green'>✔️&nbsp;Correct!</span>");
            }, 3500);
            setTimeout(function () {
                $(".popup").fadeOut();
            }, 4500);
            setTimeout(function () {
                $(".popup-content p").text("Test your pronunciation");
            }, 5600);
            $("#start p").text("Start");
            $("#start").css("background-color", "black");
        }
    });
    $(".quiz").click(function () {
        location.href = "quiz.php";
    });
    $(".flashcards").click(function () {
        location.href = "flashcards.php";
    });
});

