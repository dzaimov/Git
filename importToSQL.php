<?php
	
	$username="root";
	$password="root";
	$database="fromApi";

	
	
    	$connection=mysql_connect ('localhost', $username, $password);
	if (!$connection) {  die('Not connected : ' . mysql_error());}



	$db_selected = mysql_select_db($database, $connection);
	if (!$db_selected) {
	  die ('Can\'t use db : ' . mysql_error());
	}

	
	$file = fopen("/home/zaimov/Downloads/cityList.json","r");
		$count = 0;
	 while (($line = fgets($file)) !== false || $count == 20000) {	

		$data = json_decode($line, true);
	
		$id = $data['_id'];
	    	$name = $data['name'];
	    	$country = $data['country'];
	    	$lon = $data['coord']['lon'];
	    	$lat = $data['coord']['lat'];
	

			
		$sql = "INSERT INTO marker(id, name, country, lon, lat)
	    	VALUES('".$id."', '".$name."', '".$country."', '".$lon."', '".$lat."')";
	
	
	   	if(!mysql_query($sql,$connection))
	    	{
			die('Error : ' . mysql_error());
	    	}

	   	
	}
	fclose($file);
?>
