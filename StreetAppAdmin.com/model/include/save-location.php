<?php

    include '../db_connection/db_connection.php';

    $data = $_GET["data"];

    $data = explode(',', $data);

    $location_name = $data[0];
    $latitude = $data[1];
    $longitude = $data[2];
    $radius = $data[3];
    $performance_type = $data[4];
    $duration = $data[5];
    $reservation_type = $data[6];

    if (empty($location_name) || empty($latitude) || empty($longitude) || empty($radius) 
        || empty($performance_type) || empty($duration) || empty($reservation_type)) {

        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);

        exit;
    }

    try {

        $query = "INSERT INTO locations (location_name, latitude, longitude, radius, performance_type, duration, reservation_type) 
        VALUES ('" . $location_name . "'," . $latitude . "," . $longitude . "," . $radius . ",'" 
        . $performance_type . "'," . $duration . ",'" . $reservation_type . "')"; 

        $stmt = $conn->prepare($query);

        /*
        $stmt->bindParam('location_name',$location_name);
        $stmt->bindParam('latitude', $latitude);
        $stmt->bindParam('longitude', $longitude);
        $stmt->bindParam('radius', $radius);
        $stmt->bindParam('performance_type', $performance_type);
        $stmt->bindParam('duration', $duration);
        $stmt->bindParam('reservation_type', $reservation_type);

        */

        $stmt->execute();

        echo json_encode(['status' => 'success', 'message' => 'Location saved successfully.']);
        
    } catch (PDOException $e) {

        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }

    $conn = null;
?>

