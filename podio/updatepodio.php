<?php
require_once '../PodioAPI.php';
include('../config.php');
include('../function.php');
	
$key 	 		= $_POST['key'];
$pagelike		= $_POST['pagelike'];	
$item_id		= $_POST['item_id'];
$pageSignup		= $_POST['pageSignup'];

$CLIENT_ID 		= 'mobile2';
$CLIENT_SECRET 	= 'EepEbXW8de1IkhqYQzB0H8Y8SCkglzE1iMAW8tkNrg6UvHAUBF09eZnT1tA9jadR';
$APP_ID 		= '4607150';
$APP_TOKEN 		= '9dc3dbcf0cbe4fb1adb28a887ade44bf';
$app_id			= '4607150';
$field_id 		= '35723048';

Podio::setup($CLIENT_ID, $CLIENT_SECRET);
Podio::authenticate('app', array('app_id' => $APP_ID, 'app_token' => $APP_TOKEN));

if(empty($pageSignup)){
	$querycari5  = mysql_query("select * from worksheet_meta where work_id='$key' and meta_key='2-current-page-likes'");
	while ($row5 = mysql_fetch_array ($querycari5)) {
		$meta_value = $row5['meta_value'];
		$meta_id 	= $row5['meta_id'];
	}
	if(empty($meta_value)){
		$insert = mysql_query("INSERT INTO worksheet_meta (work_id, meta_key, meta_value) VALUES ('$key', '2-current-page-likes', '$pagelike')"); 
	}
	else{
		$update = mysql_query("UPDATE worksheet_meta set work_id='$key', meta_key='2-current-page-likes', meta_value='$pagelike' where meta_id='$meta_id'");	
		if($update){
			PodioItem::update($item_id, array('fields' => array(
			  "2-current-page-likes" => array('value' => $pagelike)
			)));
		}
	}	
}
else{
	$querycari5  = mysql_query("select * from worksheet_meta where work_id='$key' and meta_key='signup-guarantees-internal-use'");
	while ($row5 = mysql_fetch_array ($querycari5)) {
		$meta_value = $row5['meta_value'];
		$meta_id 	= $row5['meta_id'];
	}
	if(empty($meta_value)){
		$insert = mysql_query("INSERT INTO worksheet_meta (work_id, meta_key, meta_value) VALUES ('$key', 'signup-guarantees-internal-use', '$pageSignup')"); 
	}
	else{
		$update = mysql_query("UPDATE worksheet_meta set work_id='$key', meta_key='signup-guarantees-internal-use', meta_value='$pageSignup' where meta_id='$meta_id'");	
		if($update){
			PodioItem::update($item_id, array('fields' => array(
			  "2-current-page-likes" => array('value' => $pagelike)
			)));
		}
	}	
}
?>



