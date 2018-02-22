$(document).ready(function () {
    $("#settings").click(function () {
        $("#settings-list").toggle(500);
    });
    $("#head, #closeBtn, #body").click(function () {
        $("#settings-list").fadeOut();
    });
});