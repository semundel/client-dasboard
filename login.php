<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>

<body>
<form action="log_act.php" method="post">	
	<div> Username :</div><input name="username" type="text" />
	<div> Password :</div><input name="password" type="password" /> 
	<?php
		$timezone = "Asia/Jakarta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$jam = date('H');
	?>
	<input type="hidden" value="<?php echo $jam; ?>" name="timer"/>
	<input type="submit" value="Login" /></br>
</form>
</body>
</html>
