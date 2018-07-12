
<html>

<head>
	<title>ETA</title>
</head>

<body>
  <h1>E</h1>
  <h4>quipment</h4>
  <h1>T</h1>
  <h4>racking</h4>
  <h1>A</h1>
  <h4>pplication</h4>
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



		echo 'Connected successfully<br />';
		$sql = 'CREATE TABLE USERS';
		$retval = mysql_query( $sql, $conn );

		if(! $retval ) {
		die('Could not create table: ' . mysql_error());
		}

		echo "table USERS created successfully\n";

		mysql_close($conn);
	?>

</body>

</html>
