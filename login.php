<?php 
    require "creaDB.php"; 
    session_start();
    if(isset($_SESSION["id"])){
        header("location: index.php");
    }
?> 
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Benvenuto nel portale dell'universita' accedi nella tua area personale</h1>
    <form method="post" action="index.php">
        <b><label for="email">Email</label></b>
        <p><input type="email" id="email" name="email" placeholder="inserisci la tua email"></p>
        <b><label for="password">Password</label></b>
        <p><input type="password" id="password" name="password" placeholder="inserisci la password"></p>
        <a href="iscrizione.php">Non hai ancora un account? Iscriviti!</a>
        <p><input type="submit" value="accedi"></p>
    </form>
    <?php
        if(isset($_SESSION["errLogin"]))
            echo $_SESSION["errLogin"];
    ?>
</body>
</html>