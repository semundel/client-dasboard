<?php
session_start();
$username = $_SESSION['username'];
if (isset($username)){
?>
<!doctype html>
<html>
<head>
    <meta charset="utf8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Billing Cloud Service</title>
    <link rel="stylesheet" href="css/demo.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js?ver=1.4.2"></script>
    <script src="js/login.js"></script>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Typography Effects with CSS3 and jQuery" />
        <meta name="keywords" content="typography, css3, effect, lettering, letters, transition, jquery" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico">       
        <link rel="stylesheet" type="text/css" href="css/demo2.css" />
        <link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css' />
		
</head>
<body>     
<div id="bar">
    <div id="container">
		<div id="head_menu" style="width: 600px;float:left;">
		<?php
		echo "Welcome Back ".$_SESSION['username']."";
		?>
		<a href="podio/items.php" style="margin-left:20px;color:#FFFFFF;"><span>Update Podio</span><em></em></a>
		</div>
		<div id="loginContainer">
            <a href="logout.php" style="color:#FFFFFF; margin-top:-10px;"><span>Logout</span><em></em></a>
		</div>
	</div>
	<div class="center_box" style="overflow:;">
		<div class="tabeldua">
		<table width="300" border="1">
			  
			<tr>
				<td>Company Name</td>
				<td>White Label</td>
				<td>Targeted Fans</td>	
				<td>Current Fans</td>									
				<td>Targeted Sign-Ups</td>	
				<td>Current Sign-Ups</td>
				<td>Type</td>
				
				<th>Guaranteed Fans</td>
				<th>Guaranteed Sign ups</td>
				<th>Campaign Start</td>
				<th>Campaign End</td>
				<th>Assign</td>
			</tr>	
			
			 
			  <?php 
				include('config.php');
				include('function.php');
				
				$querycari = mysql_query("SELECT * FROM worksheet_meta order by meta_id");
				$data = array();
				while ($datadetail = mysql_fetch_array ($querycari)) { 
					$data[$datadetail['work_id']][$datadetail['meta_key']] = $datadetail['meta_value'];
						
				}
				//echo "<pre>";
				//print_r($data);
				
				foreach ($data as $key => $value) { ?>
					<tr id="<?php echo $key; ?>"> 
						<?php 
						$querycariuse = mysql_query("SELECT user_id FROM worksheets where work_id='$key'");
						$iduser = mysql_fetch_array ($querycariuse);
						echo "<td>".$iduser['user_id']."</td> "; 	
						/*
						$querycariuse1 = mysql_query("select meta_value from worksheet_meta where meta_key='Facebook' and work_id='$key'");
						while ($iduser1 = mysql_fetch_array ($querycariuse1)) { ?>
							<td><?php $urlfb = $iduser1['meta_value']; 
									$LinkUrl	= "https://graph.facebook.com/?ids=$urlfb";
									$json = file_get_contents($LinkUrl);
									$decode = json_decode($json);	
									foreach($decode as $dec){
										echo $dec->likes;	
									}
							?></td>  	
						<?php }*/
						?>
						
						<?php 
						echo "<td>".$value['White-Label']."</td>";
						echo "<td>".$value['Page-Likes']."</td>";
						echo "<td>0</td>";
						echo "<td>".$value['Guaranteed-Sign ups']."</td>";
						echo "<td>0</td>";
						
						$querycariuse1 = mysql_query("SELECT app_id FROM worksheets where work_id='$key'");
						$appid = mysql_fetch_array ($querycariuse1);
						$app = $appid['app_id'];
						if($app==4607150){ $apidnya="Manage";}else{ $apidnya="Unmanage";}
						echo "<td> <select><option>".$apidnya."</option></select></td> "; 
						
						echo "<td>".$value['Guaranteed-Fans']."</td>";
						echo "<td>".$value['Guaranteed-Sign ups']."</td>";
						echo "<td>".$value['Campaign-Start']."</td>";
						echo "<td>".$value['Campaign-End']."</td>";
						echo "<td>".$value['Assign']."</td>";
					?>
					</tr> 
				<?php
				}	

				?>
				

				<?php
				//}
				
				
				//print_r($datadetail);
				//<td><?php echo $datadetail['meta_value']</td>
				/*while ($datadetail = mysql_fetch_array ($querycari)) { ?>
				<td><?php echo $datadetail['meta_value']?></td>
				<?php } */ ?>

			</table>
		</div>
		<?php

		/*
			$query = mysql_query("select  from ");
			$hasil=mysql_query($query); 
			while($row=mysql_query($hasil)){
				echo $row[''];
			}  
			function getLike($LinkUrl){
				$json = file_get_contents($LinkUrl);
				$decode = json_decode($json);	
				foreach($decode as $dec){
					echo $dec->likes;
				}
			}
			$url = GetUrlFB();
			getLike($url);*/
		?>
	</div>
	
</div>
</body>
</html>

<?php
}
else {
	header ('location:login.php');
	exit();
}

?>