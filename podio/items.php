<?php
require_once '../PodioAPI.php';
include('../config.php');
include('../function.php');

$valupdate	= $_POST['valupdate'];


/*
PodioItem::update(210606, array('fields' => array(
  "2-current-page-likes" => array('value' => 20000,),
));*/

function Getitems($idvallues) {
	if($idvallues == 4607150){
		$APP_TOKEN 		= '9dc3dbcf0cbe4fb1adb28a887ade44bf';
	}
	else if($idvallues == 4604711){
		$APP_TOKEN 		= '4578a1a1f2be4ffa987ad6f2b803a883';
	}
	else{
		$APP_TOKEN 		= '9dc3dbcf0cbe4fb1adb28a887ade44bf';
	}
		
	$CLIENT_ID 		= 'mobile2';
	$CLIENT_SECRET 	= 'EepEbXW8de1IkhqYQzB0H8Y8SCkglzE1iMAW8tkNrg6UvHAUBF09eZnT1tA9jadR';

	$APP_ID 		= $idvallues;
	$app_id			= $idvallues;

	$item_id		= '62061410';  
	$field_id 		= '35723048';


	Podio::setup($CLIENT_ID, $CLIENT_SECRET);
	Podio::authenticate('app', array('app_id' => $APP_ID, 'app_token' => $APP_TOKEN));

	$items  = PodioItem::filter( $app_id, array('limit'=>100));
	$fields = array();
	
	foreach ($items['items'] as $index=> $item) 
	{
		foreach ($item->fields as $key=> $field) {		
			$itemid = $field->field_id;
			$ind = array(35723048,35723049,35723051,35723052,37318243,35723068,35723069,35723071,35723072, 35704194,35715638,35714615,35704197,37318708,35722381,35722382,35704208);
			if(in_array($itemid, $ind)){
				if ($itemid == 35723048 || $itemid ==35704194){ 
					$item_id 	= $item->item_id;
					$namacomp1  = $field->values[0]['value']; 
					$namacomp = mysql_real_escape_string($namacomp1);
				}	
				if ($itemid== 35723049 || $itemid==35715638 ){  
					$meta_key = $field->external_id; 			
					$values	= $field->values[0]['embed']['original_url'];
					if(empty($values) || $values==''){
						$meta_value=0;
					}
					else{
						$addr	= "http://api.facebook.com/restserver.php?method=links.getStats&urls=".$values;
						$source	= file_get_contents($addr);
						$page 	= htmlentities($source);
						$like	= "<like_count>";
						$like1	= "</like_count>";
						$lik	= strpos($page,htmlentities($like));
						$lik1	= strpos($page,htmlentities($like1));
						$full	= strlen($page);
						$a		= $full-$lik1;
						$meta_value	= substr($page,$lik+18,-$a);
					}
				}
				if ($itemid==35723051 || $itemid==35714615){  
					$meta_key = $field->external_id; 			
					$meta_value = $field->values[0]['value'];
				}
				if ($itemid==35704197 || $itemid==35723052){
					$meta_key   = $field->external_id; 		
					$meta_value1["start_date"] = $field->values[0]['start_date']; 
					$meta_value1["end_date"]   = $field->values[0]['end_date']; 
					
					$meta_value  = serialize($meta_value1);
				}
				if ($itemid==37318243 || $itemid==37318708 ){ $meta_key = $field->external_id;		$meta_value = $field->values[0]['value']['title']; }
				if ($itemid==35723068 || $itemid==35722381){ $meta_key = $field->external_id; 		$meta_value = $field->values[0]['value']['text']; }
				if ($itemid==35723069 || $itemid==35722382){ $meta_key = $field->external_id;  		$meta_value = $field->values[0]['value']['text']; }
				if ($itemid==35723072 || $itemid==35704208){ $meta_key = $field->external_id; 		$meta_value = $field->values[0]['value']['text']; }
			
				$datausers = GetUsers();
				if(empty($datausers)){}
				else{
					foreach($datausers as $datauser){
						$user	= $datauser['user_id'];
					}
				} 

				if($namacomp == $user){
					if($itemid==35723048 || $itemid ==35704194){
						$insert = mysql_query("update users set user_id='$namacomp', username='$namacomp', password='ff77f98b59ceedadd9a2aa366c6c4b1c',role='client1' where user_id='$namacomp'"); 
						$insert2 = mysql_query("update worksheets set app_id='$app_id', user_id='$namacomp' item_id='$item_id' where user_id='$namacomp'");			
					}
					if($itemid==35723049 || $itemid==35723051 || $itemid==35723052 || $itemid==37318243 || $itemid==35723068 || $itemid==35723069 ||$itemid==35723071 ||$itemid==35723072  || $itemid==35715638 || $itemid==35714615 ||$itemid==35704197 ||$itemid==37318708 ||$itemid==35722381 ||$itemid==35722382 ||$itemid==35704208){	
						$querycari  = mysql_query("select work_id from worksheets");
						while ($row = mysql_fetch_array ($querycari)) {$work_id = $row['work_id'];}
						$querycari2 = mysql_query("select count(work_id) as jumlah from worksheet_meta where work_id='$work_id'");
						while ($row2 = mysql_fetch_array ($querycari2)) {$jumlah = $row2['jumlah'];}
						if($jumlah <=7){
							$update = mysql_query("update worksheet_meta set work_id='$work_id',meta_key='$meta_key',meta_value='$meta_value' where work_id='$work_id'");
						}
					}
				}
				else {
					if($itemid==35723048 || $itemid ==35704194){
						$insert = mysql_query("insert into users (user_id,username,password,role) value ('$namacomp','$namacomp','ff77f98b59ceedadd9a2aa366c6c4b1c','client')"); 
						if($insert){ $insert2 = mysql_query("insert into worksheets (app_id,user_id,item_id) value ('$app_id','$namacomp','$item_id')"); }
					}
					if($itemid==35723049 || $itemid==35723051 || $itemid==35723052 || $itemid==37318243 || $itemid==35723068 || $itemid==35723069 ||$itemid==35723071 ||$itemid==35723072  || $itemid==35715638 || $itemid==35714615 ||$itemid==35704197 ||$itemid==37318708 ||$itemid==35722381 ||$itemid==35722382 ||$itemid==35704208){					
						$querycari = mysql_query("select work_id from worksheets where user_id='$namacomp' order by work_id asc");
						while ($rowl = mysql_fetch_array ($querycari)) {$work_id = $rowl['work_id'];}
						$insert3 = mysql_query("insert into worksheet_meta (work_id,meta_key,meta_value) value ('$work_id','$meta_key','$meta_value')");
					}
				}
			}
		} 
	} 
}

$allitems =  Getitems($valupdate);
 
 ?>



