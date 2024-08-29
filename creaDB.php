<?php
$host="127.0.0.1";
$user="root";
$passwordDB="root";
$database="universita";

//------------CREAZIONE DATABASE----------------

$conn=new mysqli($host,$user,$passwordDB);
// var_dump($conn);
if($conn->connect_error)
    die("ERRORE DI CONNESSIONE: ".$conn->connect_error);

// echo "connessione effettuata correttamente ".$conn->host_info."<br>";

$sql="CREATE DATABASE if not exists $database";
// var_dump($conn->query($sql));
if($conn->query($sql)==false)
    die("errore nell'esecuzione della query: ".$conn->error);

// echo "database creato correttamente";
$conn->close();

//------------CREAZIONE TABELLA UTENTI----------------

$conn=new mysqli($host,$user,$passwordDB,$database);

if($conn->connect_error)
    die("ERRORE DI CONNESSIONE: ".$conn->connect_error);

$sql="CREATE TABLE if not exists studente(
        matricola int auto_increment PRIMARY KEY,
        nome varchar(30) not null,
        cognome varchar(30) not null,
        data_nascita date not null
    )";

if($conn->query($sql)==false)
    die("ERRORE QUERY TABELLA STUDENTE: ".$conn->error);

//------------CREAZIONE TABELLA DOCENTI----------------

$sql="CREATE TABLE if not exists docente(
        id int auto_increment PRIMARY KEY,
        nome varchar(30) not null,
        cognome varchar(30) not null,
        data_nascita date not null
    )";

if($conn->query($sql)==false)
    die("ERRORE QUERY TABELLA DOCENTE: ".$conn->error);

//------------CREAZIONE TABELLA CORSO----------------

$sql="CREATE TABLE if not exists corso(
    id int auto_increment PRIMARY KEY,
    nome varchar(30) not null,
    descrizione varchar(100) not null,
    data_inizio date not null,
    data_fine date not null
)";

if($conn->query($sql)==false)
die("ERRORE QUERY TABELLA CORSO: ".$conn->error);

//------------CREAZIONE TABELLA ISCRITTO----------------

$sql="CREATE TABLE if not exists iscritto(
    matricola int,
    id_corso int,
    data_iscrizione datetime default now(),
    PRIMARY KEY (matricola, id_corso),
    FOREIGN KEY (matricola) REFERENCES studente(matricola) ON DELETE CASCADE,
    FOREIGN KEY (id_corso) REFERENCES corso(id) ON DELETE CASCADE
)";

if($conn->query($sql)==false)
die("ERRORE QUERY TABELLA ISCRITTO: ".$conn->error);

//------------CREAZIONE TABELLA INSEGNA----------------

$sql="CREATE TABLE if not exists insegna(
    id_docente int,
    id_corso int,
    PRIMARY KEY (id_docente, id_corso),
    FOREIGN KEY (id_docente) REFERENCES docente(id) ON DELETE CASCADE,
    FOREIGN KEY (id_corso) REFERENCES corso(id) ON DELETE CASCADE
)";

if($conn->query($sql)==false)
die("ERRORE QUERY TABELLA INSEGNA: ".$conn->error);

?>