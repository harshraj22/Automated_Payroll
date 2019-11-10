<?php
    session_start();
    require_once "../authenticate/login.php";

    if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false){
        echo "Error 404. The page you requested doesn't exists. ".isset($_SESSION['loggedIn'])." and {$_SESSION['loggedIn']}";
        header("Refresh:02; url=../index.php");
        exit();
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Homepage</title>
</head>
<body>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>

<?php
    echo "<div class='container p-auto m-auto'>";

        echo "Latitude : {$_GET['latitude']}<br> Longitude : {$_GET['longitude']}<br>";

        $latitude = trim($_GET['latitude']);
        $longitude = trim($_GET['longitude']);

        $date = date('Y-n-d');
        echo $date."<br>";

        $conn = mysqli_connect($hostname, $username, $password, $database);
        if(!$conn)
            echo "Connection error. Details can't be updated.";
        else{
            $curUserName = trim($_SESSION['user']);
            $user_update_query = "INSERT INTO {$curUserName} VALUES('{$date}','{$latitude}','{$longitude}','NULL')";
            $user_update_result = mysqli_query($conn, $user_update_query);

            if(!$user_update_result)
                echo "Error updating the user details.";
            else 
                echo "Successfully updated the user details.";
        }

    echo "</div>";

    header('Refresh:10; url=userProfileFrontend.php');
    mysqli_close($conn);

    // echo "asldfja asdlf";
    exit();
?>