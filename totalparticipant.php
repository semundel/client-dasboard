<?php
include_once "ez_sql_core.php";
include_once "ez_sql_mysql.php";
include_once "ez_sql_shortstack.php";
$fb_db = new ezSQL_mysql($ezsql_DB_USER, $ezsql_DB_PASSWORD, $ezsql_DB_NAME, $ezsql_DB_HOST);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Contest list</title>
</head>
<body>
<?php
if (isset($_REQUEST['password'])&&$_REQUEST['password']=='chmisthebest') {
	$companies = $fb_db->get_results("SELECT company, COUNT(id) total FROM client GROUP BY company ORDER BY company ASC");
	$companynames=array("<strong>Company</strong>");
	$totalcontest=array("<strong>Number of participant</strong>");
	if ($companies!=NULL) {
		foreach ($companies as $company) {
			$companynames[] = $company->company;
			$totalcontest[] = $company->total;
		}
	}
?>
<div style="font-weight:bold;text-decoration:underline;margin-bottom:8px;">Company List</div>
<table cellpadding="2" cellspacing="0" border="1">
<tr>
<?php
for ($i=0;$i<count($companynames);$i++) {
	echo "<td>{$companynames[$i]}</td>";
}
?>
</tr>
<tr>
<?php
for ($i=0;$i<count($companynames);$i++) {
	echo "<td>{$totalcontest[$i]}</td>";
}
?>
</tr>
</table>
<?php
}
else {
?>
<form name="partForm" action="totalparticipant.php" method="post">
Password: <input type="password" name="password" /><br />
<input type="submit" name="submitBtn" value="Submit" />
</form>
<?php
}
?>
</body>
</html>