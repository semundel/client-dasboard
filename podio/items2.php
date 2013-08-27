<?php
require_once '../PodioAPI.php';
  
$CLIENT_ID 		= 'mobile2';
$CLIENT_SECRET 	= 'EepEbXW8de1IkhqYQzB0H8Y8SCkglzE1iMAW8tkNrg6UvHAUBF09eZnT1tA9jadR';
$APP_ID 		= '4604711';
$APP_TOKEN 		= '4578a1a1f2be4ffa987ad6f2b803a883';
$app_id			= '4604711';
$item_id		= '62061410';  
$field_id 		= '35723048';

Podio::setup($CLIENT_ID, $CLIENT_SECRET);
Podio::authenticate('app', array('app_id' => $APP_ID, 'app_token' => $APP_TOKEN));

$items = PodioItem::filter( $app_id, array('limit'=>100));

echo '<pre/>';
echo "count : " . count($items['items']);
print_r($items['items']);

$fields = array();
foreach ($items['items'] as $index=> $item) {
	foreach ($item->fields as $key=> $field) {
		$fields[$item->item_id][] = array( 
			'field_id' => $field->field_id,
			'title' => $field->label,
			'name'  => $field->external_id,
			'value' => $field->values[0]
		);
		
	}
}

echo '<pre/>';
print_r($fields);

?>
<table id="tabel">
	<tr>
		<th><?php echo $field->label; ?></td>	
	</tr>
	<tr>
		<td></td>
	</tr>
</table>	