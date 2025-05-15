<?php

   include '../controller/load-locations.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreetApp Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/spectator-main-view.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    

     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

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
                            }
                        }).addTo(map);
                        
                    "; 
                }

            ?>

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            }

    </script>
</head>
<body onload="initMap()">

    <nav>
        <div class="logo">Performer</div>
        <div class="hamburger" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </div>
        <div class="menu" id="menu">
            <a href="../index.html">Home</a>
            <a href="location-control-view.php">Admin</a>
            <a href="spectator-main-view.php">Spectator</a>
        </div>
    </nav>

    <p></p>

    <div id="map" style="width:100%;height:400px;"></div>

    <p></p>

    
            <label for="status">Select Status:</label>
            <select name="status" id="status" onchange="filterType()">
                <option value="reserve">Reserve</option>
                <option value="queued">Queued</option>
            </select>
          
    </div>



    <footer>
        &copy; <?php echo date("Y"); ?> StreetApp Admin. All rights reserved.
    </footer>

    
</body>
</html>