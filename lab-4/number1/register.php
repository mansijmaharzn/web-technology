<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection variables
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user_database";

    // Connect to MySQL database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate full name length
    if (strlen($fullname) > 40) {
        die("Full name must be up to 40 characters long.");
    }

    // Validate email format
    if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        die("Invalid email format.");
    }

    // Validate username pattern (starts with letters followed by numbers)
    if (!preg_match('/^[a-zA-Z]+\d+$/', $username)) {
        die("Username must start with letters followed by numbers.");
    }

    // Validate password length
    if (strlen($password) <= 8) {
        die("Password must be more than 8 characters long.");
    }

    // Hash the password before storing it in the database
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    
    // SQL to create table if it doesn't exist
    $create_table_sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fullname VARCHAR(40) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        username VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    )";

    if ($conn->query($create_table_sql) !== TRUE) {
        die("Error creating table: " . $conn->error);
    }


    // Insert data directly into the database
    $sql = "INSERT INTO users (fullname, email, username, password) VALUES ('$fullname', '$email', '$username', '$passwordHash')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
