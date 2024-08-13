<?php
    // Database connection variables
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydb";

    // Connect to MySQL database
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $create_table_sql = "CREATE TABLE IF NOT EXISTS user (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    )";


    if ($conn->query($create_table_sql) !== TRUE) {
        die("Error creating table: " . $conn->error);
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $action = $_POST['action'];

        if ($action == 'create') {
            // Get the form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
        
            // Insert the data into the database
            $sql = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$password')";
            if ($conn->query($sql) === TRUE) {
                echo "New user created successfully";
                header("Location: index.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } elseif ($action == 'delete') {
            // Delete operation
            $id = $_POST['id'];
            $sql = "DELETE FROM user WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                echo "User deleted successfully";
                header("Location: index.php");
            } else {
                echo "Error deleting user: " . $conn->error;
            }
        } elseif ($action == 'edit') {
            // Delete operation
            $id = $_POST['id'];
            // Get the form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "UPDATE user SET name = '$name', email='$email', password='$password' WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                echo "User updated successfully";
                header("Location: index.php");
            } else {
                echo "Error updating user: " . $conn->error;
            }
        }
    }

    // Close the connection
    $conn->close();
?>