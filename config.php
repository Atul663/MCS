<?php
$dbuser = "root";
$dbpass = "";
$host = "localhost";
$dbname = "MCS";

$mysqli = new mysqli($host, $dbuser, $dbpass);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($mysqli->query($sql) === true) {
    $mysqli->select_db($dbname);
} else {
    echo "Error creating database: " . $mysqli->error;
}

$citizenTableSql = "CREATE TABLE IF NOT EXISTS citizen (
    email VARCHAR(50) PRIMARY KEY, 
    name VARCHAR(50),
    password VARCHAR(255)
)";

if ($mysqli->query($citizenTableSql) === false) {
    echo "Error creating citizen table: " . $mysqli->error;
}

$userRolesql = "CREATE TABLE IF NOT EXISTS userRole (
    email VARCHAR(50) PRIMARY KEY, 
    role VARCHAR(50)
)";

if ($mysqli->query($userRolesql) === false) {
    echo "Error creating user role table: " . $mysqli->error;
}

$adminTableSql = "CREATE TABLE IF NOT EXISTS admin (
    email VARCHAR(50) PRIMARY KEY, 
    password VARCHAR(255)
)";

if ($mysqli->query($adminTableSql) === false) {
    echo "Error creating admin table: " . $mysqli->error;
} else {
    $query = "INSERT INTO admin (email, password) VALUES ('admin@gmail.com', '123456')";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();

    $query1 = "INSERT INTO userRole (email, role) VALUES ('admin@gmail.com', 'admin')";
    $stmt1 = $mysqli->prepare($query1);
    $stmt1->execute();
}

// $mysqli->close();
?>
