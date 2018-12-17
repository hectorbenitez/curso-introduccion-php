<?php

//$comment = '';
//if (!empty($_POST)) {
//    $comment = $_POST['comment'];
//}

//$comment = '<script>alert("xss")</script>';
$comment = "<script>$( '#submitBtn' ).click(function(e) { e.preventDefault();window.location = 'http://platzi.com';});</script>";
//$comment = strip_tags($comment);
$comment = htmlspecialchars($comment);
?>
<html>
<head>
    <title>Databases with Platzi</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <h1>XSS Attack</h1>
    <a href="index.php">Home</a>
    <form action="xss.php" method="post">
        <label for="comment">Comment</label>
        <input type="text" name="comment" id="comment">
        <input type="submit" id="submitBtn" value="Send Comment" >
    </form>
    <h2>Comment</h2>
    <div>
        <?php
        print_r($comment);
        ?>
    </div>
</div>

</body>
</html>