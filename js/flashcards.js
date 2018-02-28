var hist = [];
var hindex = 0;
$(document).ready(function () {
    $(".card").click(function () {
        $(this).toggleClass("flipped");
    });
    $(".forward").click(function () {
        if (hindex == hist.length)
            getRandWord();
        else {
            hindex++;
            setWord(hist[hindex].word, hist[hindex].definition);
        }
    });
    $(".prev").fadeTo(0.1, 0.3);
    $(".prev").click(function () {
        hindex--;
        if (hindex < 1)
            return;
        if (hindex == 1)
            $(".prev").fadeTo(0.1, 0.3);
        setWord(hist[hindex - 1].word, hist[hindex - 1].definition);
    });
    getRandWord();
});
function getRandWord() {
    $.ajax({
        url: "handleVocab.php",
        method: "post",
        data: { "request": "random" },
        success: function (res) {
            dict = JSON.parse(res);
            setWord(dict.word, dict.definition);
            hist.push(dict);
            hindex++;
            if (hist.length > 1)
                $(".prev").fadeTo(0.5, 1);
        }
    });
}
function setWord(word, def) {
    $("#word").text(word);
    $("#def").text(def);
    $(".card").removeClass("flipped");
    if ($("input[name='speak']")[0].checked) {
        window.speechSynthesis.speak(new SpeechSynthesisUtterance(word));
    }
}