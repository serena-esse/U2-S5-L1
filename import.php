<?php

// Connessione al database
$servername = "localhost";
$username = "root";
$dbname = "S5L1";

$conn = new mysqli($servername, $username);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Selezione del database
if (!mysqli_select_db($conn, $dbname)) {
    die("Selezione del database fallita: " . mysqli_error($conn));
}

// Importa i dati dal file CSV con i campi delimitati
$delimited_file = "C:/xampp/htdocs/Esercizi/U2-S5-L1/utenti_delimitati.csv";
$sql_delimited = <<<SQL
    LOAD DATA INFILE '$delimited_file'
    INTO TABLE tabella_utenti
    FIELDS TERMINATED BY ','
    ENCLOSED BY '"'
    LINES TERMINATED BY '\n'
    IGNORE 1 ROWS;
SQL;
$conn->query($sql_delimited);

// Importa i dati dal file CSV con i campi non delimitati
$non_delimited_file = "C:/xampp/htdocs/Esercizi/U2-S5-L1/utenti_non_delimitati.csv";
$sql_non_delimited = <<<SQL
    LOAD DATA INFILE '$non_delimited_file'
    INTO TABLE tabella_utenti
    LINES TERMINATED BY '\n';
SQL;
$conn->query($sql_non_delimited);


// Chiudi la connessione al database
$conn->close();

echo "Importazione completata.";

?>
