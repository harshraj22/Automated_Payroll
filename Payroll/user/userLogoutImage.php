<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Image Capture</title>
</head>
<body>

    Signing out...
    <video id="video" width="640" height="480" style="display: none;" autoplay></video>
    <button id="snap" style="display: none;">Snap Photo</button>
    <canvas id="canvas" width="640" height="480" style="display: none;" name="login"></canvas>
    
    <form type="post" enctype="multipart/form-data" action="saveImage.php" name="form1">
        <input type="hidden" name="hidden" id="hidden">
        <input type="text" name="type" value="logout" style="display: none;">
    </form>
    <form type="post" enctype="multipart/form-data" action="../index.php" name="form2">
    </form>
    <script type="text/javascript" src="imageCapture.js"></script>
</body>
</html>