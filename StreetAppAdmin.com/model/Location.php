<?php

    class Location {

        private $id;
        private $name;
        private $latitude;
        private $longitude;
        private $radius;
        private $performance_type;
        private $duration;
        private $reservation_type;

        public function __construct($id, $name, $latitude, $longitude, $radius, $performance_type, $duration, $reservation_type) {
            $this->id = $id;
            $this->name = $name;
            $this->latitude = $latitude;
            $this->longitude = $longitude;
            $this->radius = $radius;
            $this->performance_type = $performance_type;
            $this->duration = $duration;
            $this->reservation_type = $reservation_type;

        }

        public function getId() {
            return $this->id;
        }

        public function getName() {
            return $this->name;
        }

        public function getLatitude() {
            return $this->latitude;
        }

        public function getLongitude() {
            return $this->longitude;
        }

        public function getRadius() {
            return $this->radius;
        }

        public function getPerformanceType() {
            return $this->performance_type;
        }

        public function getDuration() {
            return $this->duration;
        }

        public function getReservationType() {
            return $this->reservation_type;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function setLatitude($latitude) {
            $this->latitude = $latitude;
        }

        public function setLongittude($longitude) {
            $this->longitude = $longitude;
        }

        public function setRadius($radius) {
            $this->radius = $radius;
        }

        public function setPerformanceType($performance_type) {
            $this->performance_type = $performance_type;
        }

        public function setDuration($duration) {
            $this->duration = $duration;
        }

        public function setReservationType($reservation_type) {
            $this->reservation_type = $reservation_type;
        }

        public function __toString() {
            return "Location [id={$this->id}, name={$this->name}, latitude={$this->latitude}, 
            longitude={$this->longitude}, radius={$this->radius}, 
            performance_type={$this->performance_type}, duration={$this->duration}, 
            reservation_type={$this->reservation_type}]";
        }

        public function toGeoJsonFeature() {
            return json_encode([
            'type' => 'Feature',
            'properties' => [
                'name' => "Name: ". $this->name . 
                          "<br> Performance Type: " . $this->performance_type .
                          "<br> Duration: " . $this->duration . " minutes" .
                          "<br> Reservation Type: " . $this->reservation_type .
                          "<br> Radius: " . $this->radius . " feet"
               
            ],
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [$this->longitude, $this->latitude]
            ]
            ]);
        }

    }

    