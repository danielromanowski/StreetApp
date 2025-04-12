<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street Art Dreams</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            bottom: 0;
        }
        .content {
            padding: 20px;
            margin-bottom: 50px; /* Space for the footer */
        }

        .locationOptions {
            padding: 20px;
            margin-bottom: 50px; /* Space for the footer */
        }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

</head>

<script>

    function initMap() {

        var map = L.map('map').setView([40.7128, -74.0060], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        map.on('click', function(e) {

            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            L.marker([lat, lng]).addTo(map);

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
            });

    }

    function deleteLocation() {
            const locationName = document.getElementById('locationName').value;
            alert('Location deleted: ' + locationName);
        }

    function saveLocation() {

            const locationName = document.getElementById('locationName').value;
            const latitude = document.getElementById('latitude').value;
            const longitude = document.getElementById('longitude').value;
            const radius = document.getElementById('radius').value;
            const performanceType = document.querySelector('input[name="performanceType"]:checked').value;
            const duration = document.getElementById('duration').value;
            const reservationType = document.getElementById('reservationType').value;

            var data = locationName + ',' + latitude + ',' + longitude + ',' + radius + ',' + 
                       performanceType + ',' + duration + ',' + reservationType;

            const xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText);
                }
            };

            xhr.open("GET","../include/save-location.php?data="+data,true);

            xhr.send();
           
            }


    </script>

<body onload="initMap()">

    <div class="navbar">
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="#services">Services</a>
        <a href="#contact">Contact</a>
    </div>

    <div class="content">
        <h1>Street Art Dreams Set User Geolocations</h1>

    <div id="map" style="width:100%;height:400px;"></div></div>

    <div class="locationOptions">  

        <label for="locationName">Location Name:</label>
        <input type="text" id="locationName" name="locationName">

        <p></p>

        <div>

            <label for="latitude">Latitude:</label>
            <input type="text" id="latitude" name="latitude">

            <label for="longitude">Longitude:</label>
            <input type="text" id="longitude" name="longitude">

        </div>

        <p></p>

        <label for="radius">Radius (feet):</label>
        <input type="number" id="radius" name="radius">

        <div class="perfoemanceType">

            <h3>Performance Type:</h3>

            <input type="radio" id="performanceTypeAny" name="performanceType" value="any">
            <label for="performanceTypeAny">Any</label>

            <input type="radio" id="performanceTypeMusic" name="performanceType" value="music">
            <label for="performanceTypeMusic">Music</label>

            <input type="radio" id="performanceTypeDance" name="performanceType" value="dance">
            <label for="performanceTypeDance">Dance</label>

            <input type="radio" id="performanceTypeDrama" name="performanceType" value="drama">
            <label for="performanceTypeDrama">Drama</label>

            <input type="radio" id="performanceTypeArt" name="performanceType" value="art">
            <label for="performanceTypeArt">Art</label>

        </div>

        <p></p>

        <div>

            <label for="duration">Duration (minutes):</label>
            <input type="number" id="duration" name="duration">

        </div>

        <p></p>

        <div>
            <label for="reservationType">Reservation Type:</label>
            <select id="reservationType" name="reservationType">
                <option value="reserve">Reserve</option>
                <option value="queue">Queue</option>
            </select>
        </div>

        <p></p>

        <div>

            <button onclick="saveLocation()">Save Location</button>

            <button onclick="clear()">Clear</button>

            <button onclick="deleteLocation()">Delete Location</button>

        </div>

    </div>

    <div class="footer">
        <p>&copy; 2023 My Website</p>
    </div>
</body>
</html>
