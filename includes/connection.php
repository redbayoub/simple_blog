<?php
	require("constants.php");
	// 1) Create a database Connection
	$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
	if (!$conn){
		die("Database connection failed :" . mysqli_error($conn));
	}

	// 2) Select a database to use
	$sql="USE ".DB_NAME;
	$db_select=mysqli_query($conn,$sql);
	if (!$db_select){
		die("Database selecting failed : ".mysqli_error($db_select));
	}
?>
