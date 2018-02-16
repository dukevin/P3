<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/vocab.css">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="js/main.js"></script>
</head>

<body>
    <div id="header">
        <div id="nav">
            <a href="index.html">
                <p>‹ Back</p>
            </a>
        </div>
        <div id="title">
            <p>My Vocab</p>
        </div>
        <div id="settings">
            <p class="hidden">☰</p>
        </div>
    </div>
    <div id="body">
        <div id="top">
            <div class="button text">Edit</div>
        </div>
        <?php echo get_word_of_day(); ?>
    </div>
</body>

</html>

<?php 
    function get_word_of_day()
    {
        $words = json_decode("library/SAT.json", true);
        srand(date("dmy"));
        return array_rand($words);
    }
?>