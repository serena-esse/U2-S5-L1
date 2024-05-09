<?php

// Connessione al database
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "S5L1";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Query per estrarre i dati dalla tabella degli utenti
$sql = "SELECT * FROM tabella_utenti";
$result = $conn->query($sql);

// Esporta i dati in un file CSV con i campi delimitati
$delimited_file = fopen("utenti_delimitati.csv", "w");
while ($row = $result->fetch_assoc()) {
    fputcsv($delimited_file, $row);
}
fclose($delimited_file);

// Esporta i dati in un file CSV con i campi non delimitati
$non_delimited_file = fopen("utenti_non_delimitati.csv", "w");
while ($row = $result->fetch_assoc()) {
    // Formatta i dati senza delimitatori
    $line = implode("\t", $row);
    fwrite($non_delimited_file, $line . "\n");
}
fclose($non_delimited_file);

// Chiudi la connessione al database
$conn->close();

echo "Esportazione completata.";

?>
