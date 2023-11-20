<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_syaz";
$port = 3307; // Change this to the port your MySQL server is running on

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
