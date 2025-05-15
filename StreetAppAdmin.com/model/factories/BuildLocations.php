<?php

    include 'objects/Location.php'; 

    class BuildLocations {

        private $conn;
        private $location;

        public function __construct($conn) {

            $this->conn = $conn;
            $this->location;
        }

        function build(){

            $query = "SELECT id, location_name, latitude, longitude, radius, performance_type,
            duration, reservation_type  FROM locations";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $data = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $location = new Location(
                    $row['id'],
                    $row['location_name'],
                    $row['latitude'],
                    $row['longitude'],
                    $row['radius'],
                    $row['performance_type'],
                    $row['duration'],
                    $row['reservation_type']
                );

                array_push($data, $location->toGeoJsonFeature());

                unset($location);

            }

            return $data;
        }

    }
