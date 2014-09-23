<?php
function pb_bannedips_page() {
global $wpdb;
?>

<div class="wrap">
<h2 class="logo-title">PrayBox Banned IP Addresses</h2>
<div id="pbx-wrap">

<?php
if($_POST['action']=="unban_ip"){
	$id=$_POST['banned_id'];
	$wpdb->query("DELETE FROM ".$wpdb->prefix."pb_banned_ips WHERE id='$id'");
?>
<p><strong><?php _e('IP Address Unbanned.','menu-test'); ?></strong></p>
<?php } ?>

<table class="pbx-data">
<tr><th>ID</th><th>IP Address</th><th>Date Banned</th><th>Reason</th><th>&nbsp;</th></tr>

<?php
$bannedips=$wpdb->get_results("SELECT id,ip_address,banned_date,reason FROM ".$wpdb->prefix."pb_banned_ips ORDER BY banned_date DESC");

if($bannedips){
	foreach($bannedips as $bip){
		$id=$bip->id;
		$ip=$bip->ip_address;
		$date=date("m-d-y",$bip->banned_date);
		$reason=$bip->reason;
		
		
		echo "<tr><td>$id</td><td>$ip</td><td>$date</td><td>$reason</td><td align='center'>";
		echo "<form method='post'><input type='hidden' name='action' value='unban_ip' /><input type='hidden' name='banned_id' value='$id' /><input type='submit' class='button-secondary' value='Unban' /></form>";
		echo "</td></tr>";
	}
}else{
	echo "<tr><td colspan='5'>There are currently no banned ip addresses.</td></tr>";
}

?>
</table>
</div>
<?php }