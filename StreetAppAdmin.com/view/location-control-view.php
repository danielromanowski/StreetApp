<?php

   include '../controller/load-locations.php';

?>

<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street Art Dreams</title>

    <link link rel="stylesheet" href="css/location-control-view2.css"/>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

</head>

<script>

    function toggleMenu() {
        
        const menu = document.getElementById('menu');
        menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
            }

    function initMap() {

        var map = L.map('map').setView([40.7128, -74.0060], 13);

        var noteIcon = L.icon({

        iconUrl: 'images/icons/music-note.png',
        iconSize:     [38, 40], // size of the icon
        iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });

        var danceIcon = L.icon({

        iconUrl: 'images/icons/dance.png',
        iconSize:     [38, 40], 
        iconAnchor:   [10, 10], 
        popupAnchor:  [10, 10] 
        });

        var dramaIcon = L.icon({

        iconUrl: 'images/icons/drama.png',
        iconSize:     [40, 30], 
        iconAnchor:   [10, 10], 
        popupAnchor:  [10, 10] 
        });

        var artIcon = L.icon({

        iconUrl: 'images/icons/art.png',
        iconSize:     [40, 40], 
        iconAnchor:   [10, 10], 
        popupAnchor:  [10, 10] 
        });

        var anyIcon = L.icon({

        iconUrl: 'images/icons/any.png',
        iconSize:     [40, 40], 
        iconAnchor:   [10, 10], 
        popupAnchor:  [10, 10] 
        });

        <?php 

            foreach ($savedLocations as $location) {

                echo"

                    var data ="; echo $location;   echo ";

                    var type = data.properties.performance_type; 

                    var icon = null;

                        if (type === 'music') {

                            icon = noteIcon;

                        } else if (type === 'dance') {

                            icon = danceIcon;

                        } else if (type === 'drama') {

                            icon = dramaIcon;

                        } else if (type === 'art') {

                            icon = artIcon;

                        } else if (type === 'any') {

                            icon = anyIcon;

                        }

                    var geojsonLayer = L.geoJSON(data, {

                        pointToLayer: function (feature, latlng) {
                            return L.marker(latlng, {icon: icon});
                        },

                        onEachFeature: function (feature, layer) {

                            layer.bindPopup(feature.properties.name + '<br>' + feature.properties.performance_type);

                            layer.on('click', function () {

                                document.getElementById('latitude').value = feature.geometry.coordinates[1];
                                document.getElementById('longitude').value = feature.geometry.coordinates[0];
                                document.getElementById('locationName').value = feature.properties.name;
                                document.getElementById('radius').value = feature.properties.radius;
                                document.getElementById('timeLimit').value = feature.properties.timeLimit;

                                if (feature.properties.performance_type === 'music') {

                                    document.getElementById('performanceTypeMusic').checked = true;

                                } else if (feature.properties.performance_type === 'dance') {

                                    document.getElementById('performanceTypeDance').checked = true;

                                } else if (feature.properties.performance_type === 'drama') {

                                    document.getElementById('performanceTypeDrama').checked = true;

                                } else if (feature.properties.performance_type === 'art') {

                                    document.getElementById('performanceTypeArt').checked = true;

                                } else if (feature.properties.performance_type === 'any') {

                                    document.getElementById('performanceTypeAny').checked = true;
                                }
                                
                                document.getElementById('reservationType').value = feature.properties.reservation_type;

                                var xhr = new XMLHttpRequest();

                                xhr.onreadystatechange = function () {
                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                        alert(xhr.responseText);
                                    }
                                };

                                xhr.open('GET','../model/include/setSessionLocationID.php?data='+feature.properties.id,true);
                                xhr.send();
                               
                            });
                        }
                    }).addTo(map);
                    
                "; 
            }

        ?>
        
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);



        map.on('click', function(e) {

            map.eachLayer(function (layer) {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });

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
            const timeLimit = document.getElementById('timeLimit').value;
            const reservationType = document.getElementById('reservationType').value;

            var data = locationName + ',' + latitude + ',' + longitude + ',' + radius + ',' + 
                       performanceType + ',' + timeLimit + ',' + reservationType;

            const xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText);
                }
            };

            xhr.open("GET","../model/include/save-location.php?data="+data,true);

            xhr.send();

            reload();
           
            }

    function reload() {
        location.reload();
    }

    function clear() {

        console.log("Cleared all fields");
        alert("Cleared all fields");

        /*

        document.getElementById('locationName').value = '';
        document.getElementById('latitude').value = '';
        document.getElementById('longitude').value = '';
        document.getElementById('radius').value = '';
        document.querySelector('input[name="performanceType"]:checked').checked = false;
        document.getElementById('timeLimit').value = '';
        document.getElementById('reservationType').selectedIndex = 0;*/
        
    }


    </script>

<body onload="initMap()">

    <div class="navbar">
        <a href="spectator-main-view.php">Spectator</a>
        <a href="performer-main-view.php">Performer</a>
        <a href="profile.php">Profile</a>
    </div>

    <div class="content">
        <h1>Street Art Dreams Set User Geolocations</h1>

    <div id="map" style="width:100%;height:400px;"></div></div>

    <p></p>

    

    <p></p>

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

            <label for="timeLimit">TIme Limit (minutes):</label>
            <input type="number" id="timeLimit" name="timeLimit">

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