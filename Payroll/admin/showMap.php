<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Location</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        #map {
            height: 100vh;
            width: 100%;
        }
    </style>
</head>
<body>
    <?php
    echo <<< _END
        <div id = "map"></div>
        <script>
            function initMap() {
                var location = {lat: {$_GET['lat']}, lng: {$_GET['lng']}};
                var map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 15,
                    center: location
                });
                var marker = new google.maps.Marker({
                    position: location,
                    map: map
                })
            }
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-ntkzWK3RNvjIhGVZNpzQAGgkHx2zeDc&callback=initMap"></script>
_END;
    ?>
</body>
</html>