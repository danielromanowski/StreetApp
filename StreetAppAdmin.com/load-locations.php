<?php 

    include '../model/db_connection/db_connection.php';
    include '../model/BuildLocations.php';

    $build = new BuildLocations($conn);

    $savedLocations = $build->build();

?>