<?php

$dbHost = '192.168.11.10';
$dbName = 'cursophp';
$dbUser = 'homestead';
$dbPass = 'secret';

$user = null;
$query = null;

if (!empty($_POST)) {
    try {
        $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(Exception $e) {
        echo $e->getMessage();
    }

//    $query = 'SELECT * FROM users WHERE email = "' . $_POST['email'] . '" AND password = "' . md5($_POST['password']) . '"';
//    $user = $pdo->query($query)->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT * FROM users WHERE email = :email AND password = :password";
    $prepared = $pdo->prepare($query);
    $prepared->execute([
        'email' => $_POST['email'],
        'password' => md5($_POST['password'])
    ]);

    $user = $prepared->fetch(PDO::FETCH_ASSOC);
}

?>
<html>
<head>
    <title>Databases with Platzi</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>SQL Injection</h1>
    <a href="index.php">Home</a>
    <form action="sql-injection.php" method="post">
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <br>
        <input type="submit" value="Login" >
    </form>
    <h2>Query</h2>
    <div>
        <?php
        print_r($query);
        ?>
    </div>
    <h2>User Data</h2>
    <div>
        <?php
        print_r($user);
        ?>
    </div>
</div>
</body>
</html>