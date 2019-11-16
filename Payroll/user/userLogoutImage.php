<?php

    session_start();
    if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false){
        // echo "Error 404. The page you requested doesn't exists. ".isset($_SESSION['loggedIn'])." and {$_SESSION['loggedIn']}";
        echo "<script>alert('The page you requested doesn\'t exist.')</script>";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Image Capture</title>
</head>
<body>
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Signing out...</span>
            </div>
        </div>
        <video id="video" width="640" height="480" style="display: none;" autoplay></video>
        <button id="snap" style="display: none;">Snap Photo</button>
        <div class="d-flex justify-content-center">
            <canvas id="canvas" width="640" height="480" name="login"></canvas>
        </div>
    </div>

    <form type="post" enctype="multipart/form-data" action="saveImage.php" name="form1">
        <input type="hidden" name="hidden" id="hidden">
        <input type="text" name="type" value="logout" style="display: none;">
    </form>
    <form type="post" enctype="multipart/form-data" action="logout.php" name="form2">
    </form>
    <script type="text/javascript" src="imageCapture.js"></script>
</body>
</html>