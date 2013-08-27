<?php
session_start();
$username = $_SESSION['username'];
if (isset($username))
{
?>
<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php
	include('config.php');
	include('function.php');
?>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Foundation 4</title>

  <!-- If you are using CSS version, only link these 2 files, you may add app.css to use for your overrides if you like. -->
  <link rel="stylesheet" href="css/normalize.css" />
  <link rel="stylesheet" href="css/foundation.css" />
  <link rel="stylesheet" href="css/skin.css" />
   
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/sorttable/stupidtable.js"></script>
  <script type="text/javascript" src="js/foundation.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/sorttable/stupidtable.min.js"></script>
  <script type="text/javascript" src="js/jquery.tablesorter.min.js"></script> 
  <script>
    jQuery(document).ready(function($) {
        $("table").stupidtable();
    });
  </script>
  <script type="text/javascript">
	$(document).ready(function() {
		//Tooltips
		$(".tip_trigger").hover(function(){
			tip = $(this).find('.tip');
			tip.show(); //Show tooltip
		}, function() {
			tip.hide(); //Hide tooltip		  
		}).mousemove(function(e) {
			var mousex = e.pageX + 20; //Get X coodrinates
			var mousey = e.pageY + 20; //Get Y coordinates
			var tipWidth = tip.width(); //Find width of tooltip
			var tipHeight = tip.height(); //Find height of tooltip
			
			//Distance of element from the right edge of viewport
			var tipVisX = $(window).width() - (mousex + tipWidth);
			//Distance of element from the bottom of viewport
			var tipVisY = $(window).height() - (mousey + tipHeight);
			  
			if ( tipVisX < 20 ) { //If tooltip exceeds the X coordinate of viewport
				mousex = e.pageX - tipWidth - 20;
			} if ( tipVisY < 20 ) { //If tooltip exceeds the Y coordinate of viewport
				mousey = e.pageY - tipHeight - 20;
			} 
			tip.css({  top: mousey, left: mousex });
		});
	});
  </script>
  <script type="text/javascript">
		jQuery(document).ready(function($) {
			// display detail table
			$(".add").click(function () {
				var id = $(this).attr('data-parameter');
				console.log(id);
				$("#tampil-"+id).toggle("slow");
			});
			$(".selchange").change(function() {
				var id 			= $(this).attr('data-parameter');
				var datear 		= $("#selpay-"+id);
				var submittype	= datear.serialize();
				$.ajax({
					type	: "POST",
					url		: "updaterefrences.php",
					data	: submittype,
					success: function(tere){	
						$('#save-modal').addClass("show"); 
						$(".selpay-"+id).attr('disabled', 'disabled');
					}
				});
				
			}); 
			
			// insert red me
			$('.redmefocus').focusout(function() {
				var id 			= $(this).attr('data-parameter');
				var dateafo 	= $("#redmefocus-"+id);
				var submitfoc	= dateafo.serialize();
				$.ajax({
					type	: "POST",
					url		: "updaterefrences.php",
					data	: submitfoc,
					success: function(foc){							
						$(".dispop").hide();
						$('#save-modal').addClass("show"); 
					}
				});
			});
			
			// display form edit refrences
			$(".editRefrences").click(function () {
				var id = $(this).attr('data-parameter');
				$("#References-"+id).toggle("slow");
			});
			
			// add textbox for input refrences and url 
			$(".addmore").click(function () {
				var id = $(this).attr('data-parameter');
				var maincontent = "<div class='inputref'><input type='text' name='Referencename[]' placeholder='Reference name' /></div><div class='inputref' style='float:right'><input type='text' name='UrlLink[]'  placeholder='Url Link'/></div>";
				$("#morefields-"+id).append(maincontent);
			});
			
			// when user will update refrences
			$(".updatechages").submit(function(){
				var id 			= $(this).attr('data-parameter');
				var date 		= $("#updatechages-"+id);
				var submitglos	= date.serialize();
				$.ajax({
					type	: "POST",
					url		: "updaterefrences.php",
					data	: submitglos,
					success: function(brandvote){	
						$('#save-modal').addClass("show"); 
						$(".refdes").hide();
					}
				});
				return false;
			});
			
			// user click edit payment recieved
			$(".editpayment").click(function () {
				var id = $(this).attr('data-parameter');
				$(".selpay-"+id).removeAttr('disabled');
				
			});
			
			
			// user click edit targeted fans 
			$(".editLike").click(function () {
				var id 			= $(this).attr('data-parameter');
				$("#editLike-"+id).removeAttr('disabled');
				
				$("#editLike-"+id).focusout(function() {
					var datelike 	= $("#editLikeform-"+id);
					var submitlike	= datelike.serialize();
					$.ajax({
						type	: "POST",
						url		: "podio/updatepodio.php",
						data	: submitlike,
						success: function(foclike){	
							$('#save-modal').addClass("show"); 
							$("#editLike-"+id).attr('disabled', 'disabled');
						}
					});
				});
			});
			// user click edit targeted sign up 
			$(".editsignup").click(function () {
				var id 			= $(this).attr('data-parameter');
				$("#editsignup-"+id).removeAttr('disabled');
				
				$("#editsignup-"+id).focusout(function() {
					var datelike 	= $("#editsignform-"+id);
					var submitlike	= datelike.serialize();
					$.ajax({
						type	: "POST",
						url		: "podio/updatepodio.php",
						data	: submitlike,
						success: function(foclike){	
							$('#save-modal').addClass("show"); 
							$("#editsignup-"+id).attr('disabled', 'disabled');
						}
					});
				});
			});
			
			// display and add redme
			$(".redme").click(function () {
				var id = $(this).attr('data-parameter');
				$("#redme-"+id).toggle("slow");
			});
			$(".redclass").click(function () {
				var id = $(this).attr('data-parameter');
				$("#redme-"+id).toggle("slow");
			});
			$(".loading").hide();
			// user update podio data
			$(".refresh").click(function () {
				$(".loading").show();
				$(".allgetdata").hide();
				var form 		= $(".valupdate");
				var post_data 	= form.serialize();
				$.ajax({
					type	: "POST",
					url		: "podio/items.php",
					data	: post_data,
					success: function(brandvote){	
						$(".loading").hide();
						alert("suksess");
						window.location.reload();
					}
				});
				return false;
			});
			
			$(".modal-dialog .close").click(function(){
				$(this).closest(".modal-dialog").removeClass("show");
				window.location.reload();
			});

			/*$('select[name="valupdate"]').change(function() {
				var id = $(this).val();
				if (id !== '0'){
					$(".row-list").hide();
					$('.'+id).show();
				}
				else{
					$(".row-list").show();
				}
			}); */
		});
	</script>
</head>
<body>
	<div id="top-header">
		<div class="row">
			<div class="large-4 columns">
				<form method="post" class="valupdate" name="valupdate">
					<select style="width:200px;float: left;margin-top: 5px;" name="valupdate">
						<option value="0">Facebook All</option>
						<option value="4607150">Facebook Manage</option>
						<option value="4604711">Facebook Unmanage</option>
					</select>
					<a href="#" class="small button success radius refresh" data-parameter="4607150">Refresh</a>
				</form>
			</div>
			<div class="large-8 columns" style="text-align:right"><h3>
				<strong>Key Metrics:</strong> 
				Avg CPL <span>$<?php 
					$queryc = mysql_query("select sum(meta_value) as jumlah from worksheet_meta where meta_key='Current-Fans'");
					$jum  	= mysql_fetch_array ($queryc);
					$jumlahtotal = $jum['jumlah'];
					echo $jumlahtotal;
				?>
				</span> 
				Avg CPS <span>$6.80</span>
				</h3>
			</div>
		</div>
		<div class="clear"></div>
		<div class="loading">
			<img src="img/loading.gif" style=""/>
		</div>
		<div class="allgetdata" style="width:100%;">
			<table id="myTable" class="tablesorter"> 
				<thead>
					<tr class="headtop">
						<th data-sort="string" class="headeres">Company Name</th>
						<th data-sort="string" style="text-align: center;">White Label</th>
						<th data-sort="int" class="">Targeted Fans</th>
						<th data-sort="int" class="">Current Fans</th>
						<th data-sort="int" class="">Targeted </br>Sign-Ups</th>
						<th data-sort="int" class="" style="text-align: center;">Current </br>Sign-Ups</th>
						<th data-sort="string" class="headeres">Type</th>
						<th >Payment Received</th>
						<th>Remarks</th>
						<th>Alerts</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					
					// Get data Current Sign-Ups
					$companies = mysql_query("SELECT company, COUNT(id) total FROM client GROUP BY company ORDER BY company ASC");
					$participant = array();
					while ($p = mysql_fetch_array ($companies)) { 
						$participant[$p['company']] = $p['total'];
					}	
					function Getparticpant($name) {
						global $participant;
						$chars = preg_split('/\s/', $name, -1, PREG_SPLIT_NO_EMPTY);
						$f     = $chars[0];
						$res  = array_filter(array_flip($participant), function($array) use($participant, $f){
							if(preg_match("/\b".$f."\b/i", $array, $match))
							{
								return $match;
							};	
						});
						$value = key($res);
						return $value ? $value : 0 ;
					}
						
					// All setting here -----------------------------------------------
					if (isset($_GET['page'])) {
						$page		=  $_GET['page'];
					}
					$batas		= 10;
					$posisi		= null;
					if(empty($page)){
						$posisi		=0;
						$page 	=1;
					}
					else{
						$posisi=($page-1)* $batas;
					}	
					
					$querycariuse = mysql_query("SELECT * FROM worksheets order by work_id limit $posisi,$batas");
					$no=1;
					while ($datadetailuer = mysql_fetch_array ($querycariuse)) { 
						$work_ids = $datadetailuer['work_id'];
						$item_id  = $datadetailuer['item_id'];
						$iduser   = $datadetailuer['user_id'];	
						$app_id   = $datadetailuer['app_id'];
					?>
					<tr>
						<td><?php echo $iduser; ?> </td>
						<?php
							// Get data FROM WORKSHEET TABLE
							$querycari = mysql_query("SELECT * FROM worksheet_meta where work_id='$work_ids'");
							$data = array();
							while ($datadetail = mysql_fetch_array ($querycari)) { 
								$data[$datadetail['work_id']][$datadetail['meta_key']] = $datadetail['meta_value'];	
							}			
							foreach ($data as $key => $value) { 
								$querycariuse1  = mysql_query("SELECT app_id FROM worksheets where work_id='$key'");
								$appid 			= mysql_fetch_array ($querycariuse1);
								$app 			= $appid['app_id'];
								if($app == 4607150){ 
									$apidnya="Manage";
								}
								else{ 
									$apidnya="Unmanage";
								}
								$like1 	 	= array_key_exists('2-current-page-likes',$value) ? $value['2-current-page-likes'] : "" ; 
								$like2 	 	= array_key_exists('existing-facebook-page',$value) ? $value['existing-facebook-page'] : "" ; 
								if($like2=='' || $like1==''){$like2="0";$$like1="0";}
								$Redme   	= array_key_exists('Redme',$value) ? $value['Redme'] : "" ;
								$whitelbl  	= array_key_exists('white-label-internal-use',$value) ? $value['white-label-internal-use'] : "" ;
								$signup  	= array_key_exists('signup-guarantees-internal-use',$value) ? $value['signup-guarantees-internal-use'] : "" ;
								$garfans  	= array_key_exists('fans-purchased-internal-use',$value) ? $value['fans-purchased-internal-use'] : "" ;
    
								$startd  	= array_key_exists('campaign-start-date',$value) ? $value['campaign-start-date'] : "" ;
								$tmpdate 	= unserialize($startd);
								$startdte   = $tmpdate['start_date'];
								$endte 		= $tmpdate['end_date'];
				
								$assigned  	= array_key_exists('assigned-to',$value) ? $value['assigned-to'] : "" ;
								$Paymen  	= array_key_exists('Payment',$value) ? $value['Payment'] : "" ;
								$Payment 	= unserialize($Paymen);
								
								$day 		= date("Y-m-d");
								$today		= strtotime($day);
								$dtstart 	= strtotime($startdte);
								$dtend 		= strtotime($endte);
								
								$firsdate 	= abs($today-$dtstart);
								$hsildat1 	= $firsdate/86400;
								$secdate 	= abs($dtend-$dtstart);
								$hsildat2 	= $secdate/86400;
								$daypas		= ($firsdate / $secdate);
								$DaysPassed = sprintf("%.2f",$daypas); 

								$fansNow1 = $garfans * $DaysPassed;
								$fansNow2 = $signup * $DaysPassed;
								
								$garfans 	= str_replace(',','',$garfans);
								$like1 		= str_replace(',','',$like1);
								$like2 		= str_replace(',','',$like2);
								$signup 	= str_replace(',','',$signup);
								
								$targfans 	= $like2 + $garfans; 
								echo "<td style='text-align: center;'>".$whitelbl."</td> "; 
								echo "						
								<td>
									<form method='post' id='editLikeform-".$key."' class='editype'>
										<input type='text' id='editLike-".$key."' name='pagelike' value='".$targfans."' disabled='disabled' style='background:#fff; border: 1px solid #fff;width: 65px;padding: 3px 5px;height: auto;margin: 0px;float: left;'/>
										<img src='img/edit-icon.gif' class='editLike'  style='cursor:pointer;margin-left:7px;' data-parameter='".$key."'/>
										<input type='hidden' name='key' value='".$key."'/>
										<input type='hidden' name='item_id' value='".$item_id."'/>
									</form>
								</td> ";
								if($like2 >= $targfans){
									echo "<td style='text-align: center;'>".$like2."</td> ";									
								}
								else{
									echo "<td style='text-align: center;'><span style='color:red;'>".$like2."</span></td> ";
								}
								echo "
									<td>
										<form method='post' id='editsignform-".$key."' class='editype'>
											<input type='text' id='editsignup-".$key."' name='pageSignup' value='".$signup."' disabled='disabled' style='background:#fff; border: 1px solid #fff;width: 65px;padding: 3px 5px;height: auto;margin: -2px 0 0;float: left;'/>
											<img src='img/edit-icon.gif' class='editsignup'  style='cursor:pointer;margin-left:7px;' data-parameter='".$key."'/>
											<input type='hidden' name='key' value='".$key."'/>
											<input type='hidden' name='item_id' value='".$item_id."'/>
										</form>
									</td> 
								</form>	";	
								
								echo "<td style='text-align: center;'>";
								$totalsignups =  Getparticpant($iduser);
								if($totalsignups >= $signup){
									echo "<div class='large-1 columns' style='text-align: center; float: left; width: 100%;'>".$totalsignups."</div> ";
								}
								else{
									echo "<div class='large-1 columns' style='text-align: center; float: left; width: 100%;'>
										<span style='color:red;'>".$totalsignups."</span>
									</div> ";
								}
								echo "</td> ";
								
								echo "<td >".$apidnya."</td> ";
								echo "<td> 
									<form method='post' id='selpay-".$key."' class='editype'>
										<select style='width:50px;' name='selpay' disabled class='selpay-".$key." selchange' data-parameter='".$key."'>
											<option >".$Payment['payment1']."</option>
											<option value='1'>1</option>
											<option value='2'>2</option>
											<option value='3'>3</option>
											<option value='4'>4</option>
											<option value='5'>5</option>
										</select> /
										<select style='width:50px;' name='selpay2' disabled class='selpay-".$key." selchange' data-parameter='".$key."'>
											<option>".$Payment['payment2']."</option>
											<option value='1'>1</option>
											<option value='2'>2</option>
											<option value='3'>3</option>
											<option value='4'>4</option>
											<option value='5'>5</option>
										</select>
										<img src='img/edit-icon.gif'/ style='cursor:pointer;' class='editpayment' data-parameter='".$key."'>
										<input type='hidden' name='key' value='".$key."'/>
									</form>
								</td> ";
								if(empty($Redme)){ 
									echo "<td><span style='width:55px;float:left'>N.A</span> 
										<img src='img/edit-icon.gif' class='redme' style='cursor:pointer;' data-parameter='".$key."'/>
										</td> ";
								}
								else{
									echo "<td><span style='width:75px;color:#2781cf;float:left;cursor:pointer;' class='redclass' data-parameter='".$key."'>Read Me</span> 
									<img src='img/edit-icon.gif' class='redme' style='cursor:pointer;' data-parameter='".$key."'/></td> ";
								}
								if($like2 >= $fansNow1 && $totalsignups >= $fansNow2){
									echo "<td style='cursor: pointer; text-align: center; width: 50px;'>
											<img src='img/green-alert.gif'/>
									</td> ";
								}
								else{
									echo "<td style='cursor: pointer; text-align: center; width: 50px;'>
									<a class='tip_trigger' href='#'>
										<img src='img/red-alert.gif'/>
										<span class='tip' style='width: 400px; color:#666;'>";
										if($like2 <= $fansNow1){
											echo " <p>Current Fans is less than Targeted Fans to date</p> ";
										}
										if($totalsignups <= $fansNow2){
											echo "<p>Current sign-ups  is less than targeted sign-ups to date</p>";
										}
										else{}
									echo "</span>
									</a>
									</td> ";							
								}
								
								echo "<td style='cursor: pointer; text-align: center; width: 90px;'><img class='add' data-parameter='".$key."'  src='img/add.png'/></td> ";
								echo "
								<tr class='dispop' id='redme-".$key."' style='border:0px;padding:0px;margin:0px;'>
									<td colspan='11'>
										<div class='redhek'>
											<form name='redmefocus' id='redmefocus-".$key."' method='post'>
												<textarea style='height: 100px;' id='redfocus-".$key."' name='redfocus' class='redmefocus' data-parameter='".$key."'>".$Redme."</textarea> 
												<input type='hidden' name='key' value='".$key."'/>
											</form>
										</div>
									</td>
								</tr> ";	
							
						?>
					</tr>
						<tr  class="dispop" id="tampil-<?php echo $key;?>" >
							<div class="dispop">
								<td colspan="11">Guaranted Fans <span style="margin-right:10px;color:#2781CF;"><?php echo $garfans;?></span>
								Guaranteed Sign ups <span style="margin-right:10px;color:#2781CF;"><?php echo $signup;?></span>
								Campaign Start <span style="margin-right:10px;color:#2781CF;"><?php echo $startdte;?></span>
								Campaign End <span style="margin-right:10px;color:#2781CF;"><?php echo $endte;?>
								</span>
								Assigned to <span style="margin-right:10px;color:#2781CF;"><?php echo $assigned;?></span></br>
								<p style="float:left; margin:0px;">References 
									<?php
										$ref 	= array_key_exists('Reference',$value) ? $value['Reference'] : "" ;
										$refren = unserialize($ref);
										for($i=0; $i<count($refren['Reference']); $i++){ ?>
												<span style="margin-right:10px;color:#2781CF;">
													<a href="<?php echo $refren['url'][$i]; ?>">
													<?php echo $refren['Reference'][$i]; ?></a>
												</span>
										<?php } ?>						
									<img src="img/edit-icon.gif" style="margin-left:6px;cursor:pointer;" class="editRefrences" data-parameter="<?php echo $key;?>">
								<p>
								<div class="VoteforBrand_Reslt" style="float:left;width:100%;"></div>
									<div id="References-<?php echo $key;?>" class="refdes" data-parameter="<?php echo $key;?>">
									<div class="refdesdex">
										<form action="" method="post" id="updatechages-<?php echo $key;?>" class="updatechages" data-parameter="<?php echo $key;?>">	
											<div class="inputref">
												<input type="text" name="Referencename[]" placeholder="Reference name" />
											</div>
											<div class="inputref" style="float:right">
												<input type="text" name="UrlLink[]" class="inputref"  placeholder="Url Link" />
											</div>
											<div id="morefields-<?php echo $key;?>" style="float:left;width: 100%;"></div>
											<div class="inputref" style="width:100%;">
												<img class="addinput" src="img/add.png"/>
												<span style="margin-right:10px;color:#2781CF;"><a href="#" class="addmore" data-parameter="<?php echo $key;?>"> Add More</a></span>
											</div>
											<div class="inputref" style="float:right">
												<input class="small button success radius" type="submit" name="submit" value="Update Changes" style="float:right;" />
											</div>
											<?php
											$ref 	= array_key_exists('Reference',$value) ? $value['Reference'] : "" ;
											$refren = unserialize($ref);
											for($i=0; $i<count($refren['Reference']); $i++){ ?>
												<input type="hidden" name="UrlLink[]" value="<?php echo $refren['url'][$i]; ?>"/>
									</div>
												<input type="hidden" name="Referencename[]" value="<?php echo $refren['Reference'][$i]; ?>"/>
									</div>
											<?php } ?>
											<input type="hidden" name="key" value="<?php echo $key;?>"/>
											<input type="hidden" name="keyhide" value="refinsert"/>
										</form>
									</td>
							</div>
						</tr>
					<?php 
						}   //end foreach here -----------------------------
					} //end while here ---------------------------------?> 
					<div id="save-modal" class="modal-dialog">
						<div>
						  <a href="#close" title="Close" class="close">X</a>
						  <h2>Success !</h2>
						  <p>Data Have Been Updated</p>
						</div>
					</div>
				</tbody>	
			</table>
			<?php
			//=============PAGING ========================
			$sql_paging 	= mysql_query("SELECT work_id FROM worksheets");
			$jmldata 		= mysql_num_rows($sql_paging);
			$jumlah_page = ceil($jmldata / $batas);
			?>
			<div class="pagination-centered">
				<ul class="pagination">
				<?php		
				for($i = 1; $i <= $jumlah_page; $i++)
					if($i != $page) {
						echo "<li><a href=dashboard.php?page=$i>$i</a></li>";
					} 
					else {
						echo "<li class='current'><a href=dashboard.php?page=$i>$i</a></li>";
					}
				?>
				</ul>
			</div>
		</div>
	</div>
<!-- body content here -->
</body>
</html>
<?php
}
else {
	header ('location:login.php');
	exit();
}
?>