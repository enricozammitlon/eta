    <?php

        $hostname = '127.0.0.1:3306';
        $username = 'root';
        $password = '';
        $database = 'eta';


        // Create connection
        $conn = mysqli_connect($hostname, $username, $password, $database);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            echo "<p style='color:#f00'>Not Connected</p>";
        }
        echo "<p class='status-section' style='color:#00fc4a'>Connected</p>";
    ?>