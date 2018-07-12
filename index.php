
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
         $dbhost = 'hrr5mwqn9zs54rg4.chr7pe7iynqr.eu-west-1.rds.amazonaws.com:3306';
         $dbuser = 'n7c7rrk1rwdzvs3l';
         $dbpass = 'zdan1klwh8drfa9n';
         $conn = mysql_connect($dbhost, $dbuser, $dbpass);
      
         if(! $conn ) {
            die('Could not connect: ' . mysql_error());
         }
         else{
         	echo '<h2>Connected successfully</h2>';
         }
         mysql_close($conn);
      ?>

</body>

</html>
