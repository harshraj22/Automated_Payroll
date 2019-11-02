<?php
    // This is just to automate the basic table creation.
    require_once "../authenticate/login.php";
    $conn = mysqli_connect($hostname, $username, $password);

    if(!$conn)
        die("Error while connecting to database.".mysqli_connect_error());

    // If database with same name exists, delete it.
    try{
        $drop_query = "DROP DATABASE {$database}";
        $drop_res = mysqli_query($conn, $drop_query);
    }
    // if database with same name doesn't exists, it raises error.
    catch (Exception $exception){
        echo "The given database doensn't exist. <br>";
    }
    
    // create the database.
    $db_create_query = "CREATE DATABASE {$database}";
    $db_create_result = mysqli_query($conn, $db_create_query);

    if(!$db_create_result)
        die("Error creating database. ".mysqli_error($conn));
    else 
        echo "Successfully created Database. <br>";

    mysqli_close($conn);

    // ------------------------Database Created, Now creating admin table -----------------------------

    $conn = mysqli_connect($hostname, $username, $password, $database);

    if(!$conn)
        die("Error connecting database.<br>".mysqli_connect_error());
    else 
        echo "Connected to databse, creating tables.<br>";
    
    // create auth table which stores username and password for each user, along with info it he/she is admin
    $table_query = "CREATE TABLE auth (username VARCHAR(20) NOT NULL PRIMARY KEY, pass VARCHAR(20) NOT NULL, isAdmin VARCHAR(3) NOT NULL DEFAULT 'No', isHr VARCHAR(3) NOT NULL DEFAULT 'No')";

    $table_result = mysqli_query($conn, $table_query);

    if(!$table_result)
        die("Error creating authentication table. <br>".mysqli_error($conn));
    else 
        echo "Successfully created auth table.<br>";

    // create an admin auth credentials.
    $create_admin_query = "INSERT INTO auth VALUES('{$admin_name}', '{$admin_pass}', 'yes', 'No')";
    $create_admin_result = mysqli_query($conn, $create_admin_query);


    if(!$create_admin_result)
        die("Error creating admin.<br>".mysqli_error($conn));
    else    
        echo "Successfully Created admin.<br>";

?>