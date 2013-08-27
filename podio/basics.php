<?php

require_once '../PodioAPI.php';

$client_id 		= 'mobile2';
$client_secret 	= 'EepEbXW8de1IkhqYQzB0H8Y8SCkglzE1iMAW8tkNrg6UvHAUBF09eZnT1tA9jadR';
$YOUR_APP_ID 	= '4607150';
$YOUR_APP_TOKEN = '9dc3dbcf0cbe4fb1adb28a887ade44bf';
$app_id			= '4607150';

Podio::setup($client_id, $client_secret);


$field_id 		= '35723048';
$field	 		= PodioAppField::get( $app_id, $field_id );
$item 			= PodioItem::filter( $app_id, $attributes = array() );
$apps 			= PodioApp::get( $app_id, $attributes = array() );



$itemlist = PodioItem::get(62061410);
print $itemlist->title;
echo '<br/>';




/*
$hasile = $itemlist->fields;

foreach ($hasile as $sidemenu){
	echo '<pre>';
	echo $sidemenu;
	echo '</pre>';
}
echo '<pre>';
print_r();
//var_dump($itemlist);

*/

?>