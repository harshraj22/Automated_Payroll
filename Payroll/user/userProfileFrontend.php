<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EXclamation</title>
</head>
<body>
    <script type='text/javascript' src="userProfile.js"></script>

    <form type='post' enctype="multipart/form-data" action='userProfile.php'>
        <input type="text" name='latitude' id='latitude'>
        <input type="text" name='longitude' id='longitude'>
        <button type='submit' id='buttonId' >Submit</button>
    </form>
    <form action="userLogoutImage.php" type="post" enctype="multipart/form-data">
        <input type="submit" name="logout" id="logout" value="Logout">
    </form>
    
</body>
</html>