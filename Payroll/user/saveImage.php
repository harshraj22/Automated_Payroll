<?php
    session_start();

    require_once "../authenticate/login.php";

    $conn = mysqli_connect($hostname, $username, $password, $database);
    if(!$conn)
        die("Error while connectine. Try later. <br>".mysqli_connect_error());

        
    $user = $_SESSION['user'];
    $dir = '../user_images/'.$user.'/';
    if($_POST['type'] == 'login') {
        $img = $_POST['hidden'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        //saving
        $date = date('Y-n-d');
        $fileName = $dir.$date.'-in.png';
        $insert_image_query = "INSERT INTO {$user} VALUE('{$date}','NA','NA','{$fileName}')";
        $result = mysqli_query($conn, $insert_image_query);
        file_put_contents($fileName, $fileData);
    }
    
    if($_POST['type'] == 'logout') {
        $img = $_POST['hidden'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        //saving
        $date = date('Y-n-d');
        $fileName = $dir.$date.'-out.png';
        $insert_image_query = "INSERT INTO {$user} VALUE('{$date}','NA','NA','{$fileName}')";
        $result = mysqli_query($conn, $insert_image_query);
        file_put_contents($fileName, $fileData);
    }

    mysqli_connect($conn);
    
?>