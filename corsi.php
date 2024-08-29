<?php
    require "creaDB.php";
    require "connessione.php";
    session_start();
    $id=$_SESSION["id"];

    $sql="SELECT corso.*, iscritto.data_iscrizione,
  
    
    CASE WHEN iscritto.matricola = $id THEN 'Iscritto' ELSE 'Non iscritto' END AS stato_iscrizione
    FROM corso
    LEFT JOIN iscritto ON corso.id = iscritto.id_corso AND iscritto.matricola = $id
   
    ;";
    $result=$conn->query($sql);
    if(!$result)
        die("ERRORE impossibile caricare i corsi ".$conn->error);

    if($result->num_rows<1)
        echo "Nessun corso disponibile";

        echo "<h1>I corsi disponibili in universita sono i seguenti:</h1>";
        echo "<table style='border:1px solid black;'>
                <thead>
                    <tr>
                        <th>ID corso</th>
                        <th>Nome corso</th>
                        <th>Descrizione</th>
                        <th>Data inizio</th>
                        <th>Data fine</th>
                        <th>Stato iscrizione</th>
                        <th>Data iscrizione</th>
                    </tr>
                </thead>
                <tbody>";
        while($row=$result->fetch_array()){  
            
            echo    "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['nome']."</td>
                        <td>".$row['descrizione']."</td>
                        <td>".$row['data_inizio']."</td>
                        <td>".$row['data_fine']."</td>
                        <td>".$row['stato_iscrizione']."</td>
                        <td>".$row['data_iscrizione']."</td>
                    </tr>";
        }
        echo        "</tbody>
            </table>";

      //  $_SESSION["corsi"]=array();
        $conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>corsi disponibili</title>
    <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <a href="index.php">Torna nella tua area personale</a>
</body>
</html>
