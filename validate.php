<?php
include "config.php";
$username = addslashes(strip_tags ($_POST['username']));
$password = addslashes(strip_tags ($_POST['password']));
$confirm = addslashes(strip_tags ($_POST['confirm']));

if ($username&&$password&&$confirm) {
	if (strlen($username)> 10){
		echo "username can't more then 10 character";
	}
	else {
		if (strlen($password)> 25 || strlen($confirm)<6){
			echo "Password must 6-25 char";
		}
		else {
			if ($password == $confirm){
				$sql_get = mysql_query ("SELECT * FROM users WHERE username = '$username'");
				$num_row = mysql_num_rows($sql_get);
				if ($num_row ==0) {
					$password = md5($password);
					$confirm = md5($confirm);
					$sql_insert = mysql_query("INSERT INTO users VALUES ('$username','$username','$password','admin')");
					echo "Register Succsessful. Login <a href='index.php'>here</a>";
				}
				else {
					echo "Username have register";
				}
			}
			else {
				echo "Password not Match!";
			}
		}
	}
}
 
else {
	echo "must full content!";
}
?>