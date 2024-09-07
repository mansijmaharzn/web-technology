<?php
    // Set the name of the cookie
    $cookie_name = "user";
    $cookie_value = "John Doe";

    // Set the expiry time for the cookie to one day (86400 seconds)
    $expiry_time = time() + 86400;

    // Set the cookie
    setcookie($cookie_name, $cookie_value, $expiry_time, "/"); // '/' indicates the cookie is available across the entire domain

    // Check if the cookie is set
    if (isset($_COOKIE[$cookie_name])) {
        echo "Cookie '" . $cookie_name . "' is set!<br>";
        echo "Value: " . $_COOKIE[$cookie_name];
    } else {
        echo "Cookie '" . $cookie_name . "' is not set!";
    }
?>
