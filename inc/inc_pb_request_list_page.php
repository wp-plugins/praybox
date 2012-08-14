<?php

function pb_request_list_page() {
global $wpdb;
	function howManyFlags($req_id){
		global $wpdb;
		$flags=$wpdb->get_results("SELECT id FROM ".$wpdb->prefix."pb_flags WHERE request_id='$req_id'");
		return $wpdb->num_rows;
	}
	function howManyPrayers($req_id){
		global $wpdb;
		$flags=$wpdb->get_results("SELECT id FROM ".$wpdb->prefix."pb_prayedfor WHERE request_id='$req_id'");
		return $wpdb->num_rows;
	}

?>

<div class="wrap">
<h2>PrayBox Prayer Request List</h2>
<?php
if($_POST['action']=="remove_request"){
	$req_id=$_POST['pb_request_id'];
	$wpdb->query("DELETE FROM ".$wpdb->prefix."pb_requests WHERE id='$req_id'");
	$wpdb->query("DELETE FROM ".$wpdb->prefix."pb_flags WHERE request_id='$req_id'");
?>
<p><strong><?php _e('Request Removed.','menu-test'); ?></strong></p>
<?php } ?>

<?php
if($_POST['action']=="close_request"){
	$req_id=$_POST['pb_request_id'];
	$time_now=time();
	$wpdb->update($wpdb->prefix.'pb_requests',array('closed'=>$time_now,'closed_comment'=>'closed by administrator.','active'=>0),array('id'=>$req_id));
?>
<p><strong><?php _e('Request Closed.','menu-test'); ?></strong></p>
<?php } ?>

<?php
if($_POST['action']=="reopen_request"){
	$req_id=$_POST['pb_request_id'];
	$wpdb->update($wpdb->prefix.'pb_requests',array('closed'=>0,'closed_comment'=>'','active'=>1),array('id'=>$req_id));
?>
<p><strong><?php _e('Request Reopened.','menu-test'); ?></strong></p>
<?php } ?>

<h3>Active Prayer Requests</h3>

<table class="gdadmin">
<tr class="headrow"><td>ID</td><td>First/Last/Email</td><td width="250">Prayer Request</td><td>IP</td><td>Posted</td><td># Prayers</td><td>&nbsp;</td></tr>

<?php
$active_requests=$wpdb->get_results("SELECT id,first_name,last_name,email,title,body,ip_address,submitted FROM ".$wpdb->prefix."pb_requests WHERE active='1' ORDER BY submitted DESC");

foreach($active_requests as $a_req){
	$req_id=$a_req->id;
	$first_name=$a_req->first_name;
	$last_name=$a_req->last_name;
	$email=$a_req->email;
	$title=stripslashes($a_req->title);
	$body=stripslashes($a_req->body);
	$ip=$a_req->ip_address;
	$submitted=date("m-d-y",$a_req->submitted);
	$num_prayers=howManyPrayers($req_id);
	
	echo "<tr class='datarow'><td>$req_id</td><td>$first_name $last_name<br />$email</td><td><strong>$title</strong><br />$body</td><td>$ip</td><td>$submitted</td><td>$num_prayers</td><td align='center'>";
	echo "<form method='post'><input type='hidden' name='action' value='remove_request' /><input type='hidden' name='pb_request_id' value='$req_id' /><input type='submit' class='button-secondary' value='Remove Request' /></form>";
	echo "<form method='post'><input type='hidden' name='action' value='close_request' /><input type='hidden' name='pb_request_id' value='$req_id' /><input type='submit' class='button-secondary' value='Close Request' /></form>";
	echo "</td></tr>";
}

?>
</table>


<h3>Closed Prayer Requests</h3>

<table class="gdadmin">
<tr class="headrow"><td>ID</td><td>First/Last/Email</td><td width="300">Prayer Request</td><td>IP/Posted/Closed</td><td width="300">Closing Comment</td><td># Prayers</td><td>&nbsp;</td></tr>

<?php
$closed_requests=$wpdb->get_results("SELECT id,first_name,last_name,email,title,body,ip_address,submitted,closed,closed_comment FROM ".$wpdb->prefix."pb_requests WHERE active='0' ORDER BY submitted DESC");

foreach($closed_requests as $c_req){
	$req_id=$c_req->id;
	$first_name=$c_req->first_name;
	$last_name=$c_req->last_name;
	$email=$c_req->email;
	$title=stripslashes($c_req->title);
	$body=stripslashes($c_req->body);
	$ip=$c_req->ip_address;
	$submitted=date("m-d-y",$c_req->submitted);
	$closed=date("m-d-y",$c_req->closed);
	$closed_comment=stripslashes($c_req->closed_comment);
	$num_prayers=howManyPrayers($req_id);
	
	echo "<tr class='datarow'><td>$req_id</td><td>$first_name $last_name<br />$email</td><td><strong>$title</strong><br />$body</td><td>$ip<br />$submitted<br />$closed</td><td>$closed_comment</td><td>$num_prayers</td><td align='center'>";
	echo "<form method='post'><input type='hidden' name='action' value='remove_request' /><input type='hidden' name='pb_request_id' value='$req_id' /><input type='submit' class='button-secondary' value='Remove Request' /></form>";
	echo "<form method='post'><input type='hidden' name='action' value='reopen_request' /><input type='hidden' name='pb_request_id' value='$req_id' /><input type='submit' class='button-secondary' value='Reopen Request' /></form>";
	echo "</td></tr>";
}

?>
</table>

</div>
<?php }