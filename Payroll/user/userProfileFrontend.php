<?php
    session_start();
    if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false){
        echo "Error 404. The page you requested doesn't exists. ".isset($_SESSION['loggedIn'])." and {$_SESSION['loggedIn']}";
        header("Refresh:02; url=../index.php");
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Data Upload</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
    <script type='text/javascript' src="userProfile.js"></script>

    <form type='post' enctype="multipart/form-data" action='userProfile.php' style="display:none">
        <input type="text" name='latitude' id='latitude'>
        <input type="text" name='longitude' id='longitude'>
        <button type='submit' id='buttonId' >Submit</button>
    </form>

    <div id='seconds-counter'> </div>
    <script>
        var seconds = 0;
        var el = document.getElementById('seconds-counter');

        function incrementSeconds() {
            seconds += 1;
            el.innerText = "Tracking location in " + seconds + " seconds.";
        }

        var cancel = setInterval(incrementSeconds, 1000);
    </script>

    <div class="container">
        <form action="userLogoutImage.php" type="post" enctype="multipart/form-data">
            <input type="submit" name="logout" id="logout" value="Logout" class="btn btn-primary m-3">
        </form>
    </div>
    
</body>
</html>