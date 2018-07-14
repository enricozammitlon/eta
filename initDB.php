    <?php
        echo "Connecting with DB...";
        $url = getenv('JAWSDB_MARIA_URL');
        $dbparts = parse_url($url);

        $hostname = $dbparts['host'];
        $username = $dbparts['user'];
        $password = $dbparts['pass'];
        $database = ltrim($dbparts['path'],'/');


        // Create connection
        $conn = mysqli_connect($hostname, $username, $password, $database);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            echo "<p style='color:#f00'>Not Connected</p>";
        }
        echo "<p style='color:#00fc4a'>Connected</p>";
        mysql_close($conn);
    ?>