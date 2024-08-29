<?php 
    require "creaDB.php";
    require "connessione.php";
    session_start();
    
    // unset($_SESSION["id"]); //fino a quando non completo il primo IF
    if(isset($_SESSION["id"])){
        $id=$_SESSION["id"];

        $sql="SELECT * FROM studente WHERE matricola='$id'";
        $result=$conn->query($sql);
        if(!$result){
            $conn->close();
            header("location: login.php");
            exit;
        }
    
        if($result->num_rows<1){
            $_SESSION["errLogin"]="<b>nessun account e' associato a questa email</b>";
            $stmt->close();
            $conn->close();
            header("location: login.php");
            exit;
        }

        $row=$result->fetch_array();
        $matricola=$row["matricola"];
        $nomeU=$row["nome"];
        $cognomeU=$row["cognome"];
        $data_nascitaU=$row["data_nascita"];
        $_SESSION["id"]=$matricola;

        $conn->close();

    }elseif(isset($_POST["email"]) && isset($_POST["password"])){

        $email=trim($_POST["email"]);
        $password=trim($_POST["password"]);

        $sql="SELECT * FROM studente WHERE email=?";

        $stmt=$conn->prepare($sql);
        if(!$stmt)
            die("ERRORE nella preparazione della query: ".$conn->error);

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result=$stmt->get_result();
        // var_dump($result->num_rows);
        if($result->num_rows<1){
            $_SESSION["errLogin"]="<b>nessun account e' associato a questa email</b>";
            $stmt->close();
            $conn->close();
            header("location: login.php");
            exit;
        }
        $row=$result->fetch_array();

        $passwordU=$row["password"];
        if($passwordU!=$password){
            $_SESSION["errLogin"]="<b>password errata</b>";
            $stmt->close();
            $conn->close();
            header("location: login.php");
        }

        $matricola=$row["matricola"];
        $nomeU=$row["nome"];
        $cognomeU=$row["cognome"];
        $data_nascitaU=$row["data_nascita"];
        $_SESSION["id"]=$matricola;

        $stmt->close();
        $conn->close();

    }else{
        header("location: login.php");
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Area personale</title>
    </head>
    <body>
        <h1>Benvenuto nella tua area personale <?php echo $nomeU." ".$cognomeU." | matricola N^($matricola)";?></h1>
        <a href="corsi.php">Corsi disponibili</a><br>
        <a href="logout.php">Logout</a>


    </body>
</html>