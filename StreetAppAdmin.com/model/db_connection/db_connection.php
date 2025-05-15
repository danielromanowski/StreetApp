<?php

    $host = "localhost";
    $port = "5432";
    $dbname = "streetdreams";
    $user = "postgres";
    $password = "root";

    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);


?>
