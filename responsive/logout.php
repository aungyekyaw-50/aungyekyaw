<?php
	session_start();//for destroy session variables
	session_destroy();//destroy session
	session_unset();
	header('Location:testlogin.php');
	
	/*if(empty($_SESSION['user']))
	{
		header('Location:login.php');
		
	}
	*/
?>