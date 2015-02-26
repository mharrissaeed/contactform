<?php
require 'configf.php';
?>
<!DOCTYPE HTML> 
<html>
<head>
	<title>Stored Data</title>
</head>

	<body>

             
  		<header>
    			
  		</header>   
                               
 				<h3>Stored Data in DB</h3>
        <table>
<?php
        $result = mysql_query("SELECT * FROM form");
		while($rows = mysql_fetch_array($result)) {

		$fname = $rows['fname'];
		$sname= $rows['sname'];
		$email = $rows['email'];
		$tel = $rows['tel'];
		$gender = $rows['gender'];
		$date = $rows['date'];
		$comment = $rows['comment'];
              echo "User Record and Comments:<br>";
		echo "FirstName: $fname<br> Surename: $sname <br> Email: $email  <br> Telephone Number: $tel <br>Gender: $gender <br>Date of Birth: $date <br>Comments: $comment<br><br><br>";
              

}
?>
        </table>             

</body>
<footer>
</footer>
</html>