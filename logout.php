
<?php require_once("includes/functions.php"); ?>

<?php
		// 2. Unset all the session variables
		$_SESSION = array();


		// 3. Destroy the session cookie
		if(isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-42000,"/");
		}

		// 4. Destroy the session
		session_destroy();


		if (isset($_GET["msg"])) {
			$msg=$_GET["msg"];
		}else {
			$msg="You are logged out";
		}
		redirect_to("login.php?msg=".urlencode($msg));

?>
