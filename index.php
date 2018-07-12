
<html>

<head>
    <title>ETA</title>
</head>

<body>
  <h1>E</h1>
  <p>quipment</p>
  <h1>T</h1>
  <p>racking</p>
  <h1>A</h1>
  <p>pplication</p>
  <p><strong>ETA</strong> is an auotmated tracking system for replacement of faulty or broken parts </p>
    
    <?php
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
        }
        echo "Connection was successfully established!";

        mysql_close($conn);
    ?>

</body>

</html>
