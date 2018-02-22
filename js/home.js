$(document).ready(function () {
    $("#settings").click(function () {
        $("#settings-list").toggle(500);
    });
    $("#head, #closeBtn, #body").click(function () {
        $("#settings-list").fadeOut();
    });
    $("#closeBtn, #cancel").click(function () {
        $("#popup").fadeOut();
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
        $("#popup").fadeIn();
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
            $("#popup-content p").html("<span style='color:orange'>Uploading...</span>");
            setTimeout(function () {
                $("#popup-content p").html("<span style='color:gold'>Checking...</span>");
            }, 2000);
            setTimeout(function () {
                $("#popup-content p").html("<span style='color:green'>✔️&nbsp;Correct!</span>");
            }, 3500);
            $("#start p").text("Start");
            $("#start").css("background-color", "black");
        }
    });
});

//Adapted from https://developer.mozilla.org/en-US/docs/Web/API/Web_Audio_API/Visualizations_with_Web_Audio_API
function captureAudio() {
    var canvas = document.getElementById("visualizer");
    var canvasCtx = canvas.getContext("2d");
    canvasCtx.fillStyle = "black";
    canvasCtx.fillRect(0, 0, canvas.width, canvas.height);

    navigator.getUserMedia = (navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia);
    var audioCtx = new (window.AudioContext || window.webkitAudioContext)();
    var analyser = audioCtx.createAnalyser();
    analyser.minDecibels = -90;
    analyser.maxDecibels = -10;
    analyser.smoothingTimeConstant = 0.85;
    var distortion = audioCtx.createWaveShaper();
    var gainNode = audioCtx.createGain();
    var biquadFilter = audioCtx.createBiquadFilter();
    var convolver = audioCtx.createConvolver();
    function makeDistortionCurve(amount) {
        var k = typeof amount === 'number' ? amount : 50,
            n_samples = 44100,
            curve = new Float32Array(n_samples),
            deg = Math.PI / 180,
            i = 0,
            x;
        for (; i < n_samples; ++i) {
            x = i * 2 / n_samples - 1;
            curve[i] = (3 + k) * x * 20 * deg / (Math.PI + k * Math.abs(x));
        }
        return curve;
    };
    var source;
    var stream;
    if (navigator.getUserMedia) {
        navigator.getUserMedia(
            {
                audio: true
            },
            function (stream) {
                source = audioCtx.createMediaStreamSource(stream);
                source.connect(analyser);
                analyser.connect(distortion);
                distortion.connect(biquadFilter);
                biquadFilter.connect(convolver);
                convolver.connect(gainNode);
                gainNode.connect(audioCtx.destination);

                visualize();
            },
            function (err) {
                alert('Your browser does not support this feature: ' + err);
            }
        );
    } else {
        alert('Your browser does not support this feature!');
    }
    function visualize() {
        WIDTH = canvas.width;
        HEIGHT = canvas.height;

        analyser.fftSize = 2048;
        var bufferLength = analyser.fftSize;
        var dataArray = new Uint8Array(bufferLength);

        canvasCtx.clearRect(0, 0, WIDTH, HEIGHT);

        var draw = function () {
            drawVisual = requestAnimationFrame(draw);
            analyser.getByteTimeDomainData(dataArray);

            canvasCtx.fillStyle = 'rgb(0, 0, 0)';
            canvasCtx.fillRect(0, 0, WIDTH, HEIGHT);
            canvasCtx.lineWidth = 2;
            canvasCtx.strokeStyle = 'rgb(255, 255, 255)';
            canvasCtx.beginPath();

            var sliceWidth = WIDTH * 1.0 / bufferLength;
            var x = 0;
            for (var i = 0; i < bufferLength; i++) {
                var v = dataArray[i] / 128.0;
                var y = v * HEIGHT / 2;
                if (i === 0) {
                    canvasCtx.moveTo(x, y);
                } else {
                    canvasCtx.lineTo(x, y);
                }
                x += sliceWidth;
            }
            canvasCtx.lineTo(canvas.width, canvas.height / 2);
            canvasCtx.stroke();
        };
        draw();
    }
}
