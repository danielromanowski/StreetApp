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

            function edit() {

                const username = prompt("Enter new username:");
                const email = prompt("Enter new email:") + document.querySelector('.profile-email').textContent; ;
                const performanceType = prompt("Enter new performance type:");

                if (username && email) {
                    const xhr = new XMLHttpRequest();
                    xhr.open("POST", "../controller/update-user.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            const response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                document.querySelector('.profile-name').textContent = username;
                                document.querySelector('.profile-email').textContent = email;
                                document.querySelector('.profile-type').textContent = performanceType;
                                alert("Profile updated successfully!");
                            } else {
                                alert("Error updating profile: " + response.message);
                            }
                        }
                    };

                    xhr.send("username=" + encodeURIComponent(username) + "&email=" + encodeURIComponent(email));
                }
            }

    </script>
</head>
<body>

    <nav>
        <div class="logo">StreetApp Admin</div>
        <div class="hamburger" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>`
        </div>
        <div class="menu" id="menu">
            <a href="location-control-view.php">Admin</a>
            <a href="spectator-main-view.php">Spectator</a>
            <a href="performer-main-view.php">Performer</a>
        </div>
    </nav>

    <p></p>

  
    <div class="profile-container">

        <div class="profile-header">
            <img src="images/profile-pics/user1-pic.jpg" alt="Profile Picture" class="profile-picture" width="100%" height="auto">
            <h2 class="profile-name">John Doe</h2> 
            <p class="profile-email">johndoe@example.com</p>
            <p><strong>Type: </strong> Music</p>
            <button onclick="edit()" class="edit-button">Edit</button>

            <script>
               
            </script>
        </div>

    <div class="qr-code-container">
        <h3>Your QR Code</h3>
        <img class="qr" src="images/qr-codes/user1.png" alt="QR Code" class="qr-code" width="100%" height="auto">
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> StreetApp Admin. All rights reserved.
    </footer>

    
</body>
</html>