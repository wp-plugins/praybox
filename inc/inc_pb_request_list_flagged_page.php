<?php
function pb_request_list_flagged_page() {
global $wpdb;
?>

<div class="wrap">
<h2 class="logo-title">PrayBox Flagged Prayer Requests</h2>
<div id="pbx-wrap">

<?php
if(isset($_POST['action']) && $_POST['action']=="remove_request"){
	$req_id=$_POST['pb_request_id'];
	$wpdb->query("DELETE FROM ".$wpdb->prefix."pb_requests WHERE id='$req_id'");
	$wpdb->query("DELETE FROM ".$wpdb->prefix."pb_flags WHERE request_id='$req_id'");
?>
<p><strong><?php _e('Request Removed.','menu-test'); ?></strong></p>
<?php } ?>

<?php
if(isset($_POST['action']) && $_POST['action']=="clear_flags"){
	$req_id=$_POST['pb_request_id'];
	$wpdb->query("DELETE FROM ".$wpdb->prefix."pb_flags WHERE request_id='$req_id'");
?>
<p><strong><?php _e('Flags Cleared.','menu-test'); ?></strong></p>
<?php } ?>

<?php
if(isset($_POST['action']) && $_POST['action']=="remove_ban"){
	$req_id=$_POST['pb_request_id'];
	$ip=$_POST['pb_ip_address'];
	$time_now=time();
	$wpdb->query("DELETE FROM ".$wpdb->prefix."pb_requests WHERE id='$req_id'");
	$wpdb->query("DELETE FROM ".$wpdb->prefix."pb_flags WHERE request_id='$req_id'");
	$wpdb->insert($wpdb->prefix.'pb_banned_ips',array('ip_address'=>$ip,'banned_date'=>$time_now,'reason'=>'request flagged as inappropriate'))
?>
<p><strong><?php _e('Request Removed and IP Address Banned.','menu-test'); ?></strong></p>
<?php } ?>

<table class="pbx-data">
<tr><th>ID</th><th>First/Last/Email</th><th>Title</th><th width="300">Body</th><th>IP Address</th><th>Date Posted</th><th># Times Flagged</th><th>&nbsp;</th></tr>

<?php
$flags=$wpdb->get_results("SELECT request_id FROM ".$wpdb->prefix."pb_flags GROUP BY request_id");

if($flags){
	foreach($flags as $flag){
		$req_id=$flag->request_id;
		$num_flags=howManyFlags($req_id);
		
		$request=$wpdb->get_row("SELECT first_name,last_name,email,title,body,ip_address,submitted FROM ".$wpdb->prefix."pb_requests WHERE id='$req_id'");
		
		$first_name=$request->first_name;
		$last_name=$request->last_name;
		$email=$request->email;
		$title=stripslashes($request->title);
		$body=prePgphOutput($request->body);
		$ip=$request->ip_address;
		$submitted=date("m-d-y",$request->submitted);
		
		echo "<tr><td>$req_id</td><td>$first_name $last_name<br />$email</td><td>$title</td><td>$body</td><td>$ip</td><td>$submitted</td><td>$num_flags</td><td align='center'>";
		echo "<form method='post'><input type='hidden' name='action' value='remove_request' /><input type='hidden' name='pb_request_id' value='$req_id' /><input type='submit' class='button-secondary' value='Remove' /></form>";
		echo "<form method='post'><input type='hidden' name='action' value='clear_flags' /><input type='hidden' name='pb_request_id' value='$req_id' /><input type='submit' class='button-secondary' value='Clear Flags' /></form>";
		echo "<form method='post'><input type='hidden' name='action' value='remove_ban' /><input type='hidden' name='pb_request_id' value='$req_id' /><input type='hidden' name='pb_ip_address' value='$ip' /><input type='submit' class='button-secondary' value='Remove/Ban' /></form>";
		echo "</td></tr>";
	}
}else{
	echo "<tr><td colspan='8'>There are currently no flagged prayer requests.</td></tr>";
}

?>
</table>
</div>
</div>
<?php }