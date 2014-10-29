<?php

function pb_request_list_closed_page() {
global $wpdb;
?>

<div class="wrap">
<h2 class="logo-title">PrayBox Closed Prayer Request List</h2>
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
if(isset($_POST['action']) && $_POST['action']=="reopen_request"){
	$req_id=$_POST['pb_request_id'];
	$time_now=time();
	$wpdb->update($wpdb->prefix.'pb_requests',array('closed'=>0,'closed_comment'=>'','active'=>1),array('id'=>$req_id));
?>
<p><strong><?php _e('Request Reopened.','menu-test'); ?></strong></p>
<?php } ?>

<?php
if(isset($_POST['action']) && $_POST['action']=="archive_request"){
	$req_id=$_POST['pb_request_id'];
	$wpdb->update($wpdb->prefix.'pb_requests',array('active'=>3),array('id'=>$req_id));
?>
<p><strong><?php _e('Request Archived.','menu-test'); ?></strong></p>
<?php } ?>

<h3>Closed Prayer Requests</h3>

<table class="pbx-data">
<tr><th>ID</th><th>First/Last/Email</th><th width="250">Prayer Request</th><th>IP</th><th>Posted</th><th># Prayers</th><th>&nbsp;</th></tr>

<?php
echo getRequestList('closed');
?>
</table>
</div>
</div>
<?php }