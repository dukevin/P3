$(document).ready(function () {
    $(".ans, .mis").click(function () {
        elm = $(this).parent().parent().find(".result2");
        if (elm.hasClass("wrong") || elm.hasClass("correct"))
            return;
        elm = $(this).siblings(".tdrad").children(".radio");
        if (elm.length == 0)
            elm = $(this).children(".radio");
        elm.css({ "background-color": "black", "border": "3px double white" });
        elm = $(this).parent().parent().find(".result2");
        if ($(this).hasClass("ans")) {
            elm.css("background-color", "#dff0d8");
            elm.addClass("correct");
            $(this).parent().parent().find(".ans .radio-text").css("color", "green");
        }
        if ($(this).hasClass("mis")) {
            elm.css("background-color", "#f2dede");
            elm.addClass("wrong");
            $(this).parent().parent().find(".ans .radio-text").css("color", "red");
        }
    });
    $(".pronounce").click(function () {
    	$(".popup-content p").text("Test your pronunciation");
        $(".popup").toggle();
        $("#start").attr('data', $(this).parent().parent().parent().parent().attr('class'));
    });
    $("#start").click(function () {
        elm = $("table." + $(this).attr('data') + " .result1");
        elm.css("background-color", "#dff0d8");
        elm.addClass("correct");
    })
});