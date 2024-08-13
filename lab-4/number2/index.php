<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD User Management</title>
</head>
<body>
    <h2>User Management</h2>

    <!-- Form for Create/Update/Delete -->
    <form action="crud.php" method="POST">
        <input type="hidden" name="action" value="create">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>

        <button type="submit">Add User</button>
    </form>

    <!-- Read Operation -->
    <?php
        // Database connection variables
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydb";

        // Connect to MySQL database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    ?>
    <h2>Existing Users</h2>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Action</th>
        </tr>

        <?php
            // Fetch users from the database
            $result = $conn->query("SELECT * FROM user");

            // Check if any users were found
            if ($result->num_rows > 0) {
                // Loop through and display each user
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['password']}</td>
                            <td>
                            <form action='edit.php' method='GET'>
                                <input type='hidden' name='action' value='edit'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <button type='submit'>Edit</button>
                            </form>
                            <form action='crud.php' method='POST'>
                                <input type='hidden' name='action' value='delete'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <button type='submit'>Delete</button>
                            </form>
                        </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No users found</td></tr>";
            }
        ?>
    </table>
    <?php
        $conn->close();
    ?>
</body>
</html>
