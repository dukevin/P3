$(document).ready(function () {
    var curWord = '';
    var mode = "edit";
    $("#settings-list").css("height", $("#header").height());
    $(".answer, .check, .define").click(function () {
        $(".popup").hide();
        word = $(this).closest('td').prev('td').text();
        if ($(this).hasClass("answer")) {
            var msg = new SpeechSynthesisUtterance(word);
            window.speechSynthesis.speak(msg);
        }
        if ($(this).hasClass("check")) {
            $(".popup.record").fadeIn();
        }
        if ($(this).hasClass("define")) {
            $.ajax({
                url: "handleVocab.php",
                method: "post",
                data: { "request": "define", "word": word },
                success: function (res) {
                    $(".popup.definition").fadeIn();
                    $(".popup.definition .popup-content p").text(res);
                }
            });
        }
    });

    $(".edit, .delete").click(function () {
        $(".popup").hide();
        word = $(this).closest('td').prev('td').prev('td').text();
        curWord = word;
        if ($(this).hasClass("edit")) {
            $(".popup.modify .popup-content p").text("Edit word:");
            mode = "edit";
            $(".popup.modify").fadeIn();
            $("input.spelling").val(word);
            $.ajax({
                url: "handleVocab.php",
                method: "post",
                data: { "request": "define", "word": word },
                success: function (res) {
                    $("input.meaning").val(res);
                }
            });
        }
        if ($(this).hasClass("delete")) {
            $(".popup.modify .popup-content p").text("Are you sure you want to delete this word?");
            mode = "deleteOne";
            $(".popup.del").fadeIn();
        }
    });
    $("#submit_edit").click(function () {
        if (mode == "edit") {
            $.ajax({
                url: "handleVocab.php",
                method: "post",
                data: {
                    "request": "edit",
                    "oldword": curWord,
                    "newword": $("input.spelling").val(),
                    "definition": $("input.meaning").val()
                },
                success: function (res) {
                    if (res == "Ok") {
                        $(".popup.modify .popup-content p").html("<span style='color:green'>Successfully edited " + curWord + "</span>");
                        $("td." + curWord).text($("input.spelling").val());
                    }
                    else
                        $(".popup.modify .popup-content p").html("<span style='color:red'>Error</span>");
                    setTimeout(function () {
                        $(".popup.modify").fadeOut();
                    }, 3000);
                }
            });
        }
        if (mode == "add") {
            $.ajax({
                url: "handleVocab.php",
                method: "post",
                data: {
                    "request": "add",
                    "word": $("input.spelling").val(),
                    "definition": $("input.meaning").val()
                },
                success: function (res) {
                    if (res == "Ok") {
                        $(".popup.modify .popup-content p").html("<span style='color:green'>Successfully added " + $("input.spelling").val() + "</span>");
                        location.reload();
                    }
                    else
                        $(".popup.modify .popup-content p").html("<span style='color:red'>Error</span>");
                    setTimeout(function () {
                        $(".popup.modify").fadeOut();
                    }, 3000);
                }
            });
        }
    });
    $("#submit_delete").click(function () {
        if (mode == "deleteOne") {
            $.ajax({
                url: "handleVocab.php",
                method: "post",
                data: {
                    "request": "delete",
                    "word": curWord,
                },
                success: function (res) {
                    if (res == "Ok") {
                        $(".popup.del .popup-content p").html("<span style='color:green'>Deleted " + curWord + "</span>");
                        $("tr." + curWord).fadeOut();
                    }
                    else
                        $(".popup.del .popup-content p").html("<span style='color:red'>Error</span>");
                    setTimeout(function () {
                        $(".popup.del").fadeOut();
                    }, 3000);
                }
            });
        }
        if (mode == "deleteAll") {
            $.ajax({
                url: "handleVocab.php",
                method: "post",
                data: { "request": "deleteAll", "word": "" },
                success: function (res) {
                    if (res == "Ok") {
                        $(".popup.del .popup-content p").html("<span style='color:red'>Goodbye cruel world!</span>");
                        location.reload();
                    }
                    else
                        $(".popup.del .popup-content p").html("<span style='color:red'>Error</span>");
                    setTimeout(function () {
                        $(".popup.del").fadeOut();
                    }, 3000);
                }
            });
        }
    });
    $("#add_word").click(function () {
        mode = "add";
        $(".popup.modify").fadeIn();
        $(".popup.modify .popup-content p").text("Add a new word:");
    });
    $("#delete_all").click(function () {
        mode = "deleteAll";
        $(".popup.del").fadeIn();
        $(".popup.del .popup-content p").text("ARE YOU SURE YOU WANT TO DELETE ALL WORDS?");
    });
});