<?php
include "config.php";

$key 	 	= $_POST['key'];
$redme		= $_POST['redfocus'];
$keyhide	= $_POST['keyhide'];
$pagelike	= $_POST['pagelike'];
$selpay		= $_POST['selpay'];
$selpay2	= $_POST['selpay2'];
$selall		= array(
	'payment1' => $selpay,
	'payment2' => $selpay2
);
$selpayer 	= serialize($selall);

$namere 	= $_POST['Referencename'];
$UrlLin 	= $_POST['UrlLink'];

$refall 	= array(
	'Reference' => $namere,
	'url' 		=> $UrlLin
);
$reful 		= serialize($refall);


if(empty($redme ))
{
	if(empty($keyhide))
	{
		if(empty($pagelike)){
			$querycari2  = mysql_query("select * from worksheet_meta where work_id='$key' and meta_key='Payment'");
			while ($row2 = mysql_fetch_array ($querycari2)) {
				$meta_value = $row2['meta_value'];
				$meta_id 	= $row2['meta_id'];
			}
			if(empty($meta_value)){
				$insert = mysql_query("INSERT INTO worksheet_meta (work_id, meta_key, meta_value) VALUES ('$key', 'Payment', '$selpayer')"); 
			}
			else{
				$update = mysql_query("UPDATE worksheet_meta set work_id='$key', meta_key='Payment', meta_value='$selpayer' where meta_id='$meta_id'");	
			}	
		}
		else{
			$querycari5  = mysql_query("select * from worksheet_meta where work_id='$key' and meta_key='Page-Likes'");
			while ($row5 = mysql_fetch_array ($querycari5)) {
				$meta_value = $row5['meta_value'];
				$meta_id 	= $row5['meta_id'];
			}
			if(empty($meta_value)){
				$insert = mysql_query("INSERT INTO worksheet_meta (work_id, meta_key, meta_value) VALUES ('$key', '2-current-page-likes', '$pagelike')"); 
			}
			else{
				$update = mysql_query("UPDATE worksheet_meta set work_id='$key', meta_key='Payment', meta_value='$selpayer' where meta_id='$meta_id'");	
			}	
		}
	}
	else{
		$querycari1  = mysql_query("select * from worksheet_meta where work_id='$key' and meta_key='Reference'");
		while ($row1 = mysql_fetch_array ($querycari1)) {
			$meta_value  = $row1['meta_value'];
			$meta_id 	 = $row1['meta_id'];
		}
		if(empty($meta_value)){
			$insert  = mysql_query("INSERT INTO worksheet_meta (work_id, meta_key, meta_value) VALUES ('$key', 'Reference', '$reful')");
		}
		else{
			$update = mysql_query("UPDATE worksheet_meta set work_id='$key', meta_key='Reference', meta_value='$reful' where meta_id='$meta_id'");	
		}	
	}
}
else{
	$querycari7  = mysql_query("select * from worksheet_meta where work_id='$key' and meta_key='Redme'");
	while ($row7 = mysql_fetch_array ($querycari7)) {
		$meta_value  = $row7['meta_value'];
		$meta_id 	 = $row7['meta_id'];
	}
	if(empty($meta_value)){
		$insert7 = mysql_query("INSERT INTO worksheet_meta (work_id, meta_key, meta_value) VALUES ('$key', 'Redme', '$redme')"); 	
	}
	else{
		$update7 = mysql_query("UPDATE worksheet_meta set work_id='$key', meta_key='Redme', meta_value='$redme' where meta_id='$meta_id'");	
	}
}



?>