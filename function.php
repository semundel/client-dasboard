<?php
function input ($nim, $nama, $alamat) {
    $query = mysql_query("insert into tb_mhs values ('','$nim','$nama','$alamat')");    
}
function edit ($id, $nim, $nama, $alamat) {
    $query = mysql_query("update tb_mhs set nim='$nim',nama='$nama',alamat='$alamat' where id=$id");
}
function GetUsers($id=null) {
	$data = array();
	$query = mysql_query("select * from users");//kueri untuk menampilkan
	if (!empty($id))
		$query = mysql_query("select * from users where user_id=$id limit 1");
		while ($row = mysql_fetch_array ($query)) {
			$data[]=$row;
		}    
		return $data;
}

function GetApps($idapp=null) {
	$data = array();
	$query = mysql_query("select * from apps");//kueri untuk menampilkan
	if (!empty($idapp))
		$query = mysql_query("select * from apps where app_id=$idapp limit 1");
		while ($row = mysql_fetch_array ($query)) {
			$data[]=$row;
		}    
		return $data;
}

function Getworksheet($idwork=null) {
	$data = array();
	$query = mysql_query("select * from worksheets");//kueri untuk menampilkan
	if (!empty($idwork))
		$query = mysql_query("select * from worksheets where work_id=$idwork limit 1");
		while ($row = mysql_fetch_array ($query)) {
			$data[]=$row;
		}    
		return $data;
}

function GetDetails($meta_id=null) {
	$data = array();
	$query = mysql_query("select * from worksheet_meta");//kueri untuk menampilkan
	if (!empty($meta_id))
		$query = mysql_query("select * from worksheet_meta where meta_id=$meta_id limit 1");
		while ($row = mysql_fetch_array ($query)) {
			$data[]=$row;
		}    
		return $data;
}

function GetUrlFB($idfb=null) {
	$query = mysql_query("select existing_facebook from worksheet_details where meta_id=$idfb limit 1");
	$hasil=mysql_query($query); 
	while($row=mysql_fetch_array($hasil)){
		echo $row['existing_facebook'];
	}  
}

function GetAllData($idmeta_id=null) {
	$data = array();
	$query = mysql_query("select * from worksheet_details");//kueri untuk menampilkan
	if (!empty($id))
		$query = mysql_query("select * from worksheet_details where meta_id=$idmeta_id limit 1");
		while ($row = mysql_fetch_array ($query)) {
			$data[]=$row;
		}    
		return $data;
}

function hapus($d) {
	$id = $_GET['d'];
	mysql_query("DELETE FROM tb_mhs WHERE id = $id");
}
 
?>