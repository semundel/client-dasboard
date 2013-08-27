<?php
//ini adalah membuat sessionnya
session_start();
include "config.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}
$username = anti_injection($_POST['username']);
$password = anti_injection($_POST['password']);
//script berikut berfungsi untuk mengecek apakah form sudah terisi dengan benar
if (!ctype_alnum($username) OR !ctype_alnum($password)){
  echo "Sekarang loginnya tidak bisa di injeksi lho.";
}
else{
	if ($username&&$password){
	$get_sql = mysql_query ("SELECT * FROM users WHERE username = '$username'");
	$num = mysql_num_rows($get_sql);
	//script ini berfungsi untuk mengecek apakah usernama sudah ada atau belum
	if ($num==0){
		echo "Username not register";
		header ('location:index.php');
		}
		else {
			while($row = mysql_fetch_assoc($get_sql)){
				$dbusername = $row ['username'];
				$dbpassword = $row ['password'];
			}			
			$pass = md5($password);
			if ($username == $dbusername && ($pass==$dbpassword)){
				$_SESSION['username'] = $username;
				header ('location:dashboard.php');
			}
			else {
				echo "wrong password";
				header ('location:index.php');
			}
			
		}
	}
	else {
		echo "input username or password";
		}
}
?>