<?php 
    require "creaDB.php"; 

    function iscrizione(){

        if(isset($_POST["nome"])){
            $nome=$_POST['nome'];
            $cognome=$_POST['cognome'];
            $data_nascita=$_POST['data_nascita'];
            $email=$_POST['email'];
            $password1=$_POST['password1'];
            $password2=$_POST['password2'];
            
            if($password1!=$password2)
                die("ERRORE, le password non corrispondono");

            $host="127.0.0.1";
            $user="root";
            $passwordDB="root";
            $database="universita";

            $conn=new mysqli($host,$user,$passwordDB,$database);
            if($conn->connect_error)
                die("ERRORE DI CONNESSIONE: ".$conn->connect_error);

            $sql="INSERT INTO studente(nome, cognome, data_nascita, email, password)
                    VALUES (?,?,?,?,?);";

            $stmt=$conn->prepare($sql);
            //var_dump($stmt);
            if(!$stmt)
                die("ERRORE nella preparazione della query: ".$conn->error);

            $stmt->bind_param("sssss", $nome,$cognome,$data_nascita,$email,$password1);
            $stmt->execute();

            //visualizzazione della data in d-m-Y
            date_default_timezone_set("UTC");
            $data_nascita=date("d-m-Y", strtotime($data_nascita));
           
            echo "Registrazione avvenuta con successo!<br>
                    <b>Nome: </b>$nome<br>
                    <b>Cognome: </b>$cognome<br>
                    <b>Data di nascita </b>$data_nascita<br>
                    <b>Email </b>$email";
            $stmt->close();
            $conn->close();
        }
    }
?> 
<!DOCTYPE html>
<html>
<head>
    <title>Iscrizione</title>
</head>
<body>
    <h1>Benvenuto nella pagina di iscrizione all'universita'</h1>
    <form method="post" action="">
        <b><label for="nome">Nome</label></b>
        <p><input type="text" name="nome" placeholder="inserisci il tuo nome" required></p>
        <b><label for="cognome" >Cognome</label></b>
        <p><input type="text" name="cognome" placeholder="inserisci il tuo cognome" required></p>
        <b><label for="data_nascita">Data di nascita</label></b>
        <p><input type="date" name="data_nascita" required></p>
        <b><label for="email">Email</label></b>
        <p><input type="email" id="email" name="email" placeholder="inserisci la tua email" required></p>
        <b><label for="password">Password</label></b>
        <p><input type="password" id="password" name="password1" placeholder="inserisci la password" required></p>
        <p><input type="password" id="password" name="password2" placeholder="ripeti la password" required></p>
        <a href="login.php">Hai gia' un account? Accedi!</a>
        <p><input type="submit" value="registrati"></p>
    </form>
    <?php iscrizione(); ?>
</body>
</html>