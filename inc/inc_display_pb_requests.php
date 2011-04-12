<?php
function display_pb_requests($atts) {
	global $wpdb;
	function howManyFlags($req_id){
		global $wpdb;
		$flags=$wpdb->get_results("SELECT id FROM wp_pb_flags WHERE request_id='$req_id'");
		return $wpdb->num_rows;
	}
	function howManyPrayers($req_id){
		global $wpdb;
		$flags=$wpdb->get_results("SELECT id FROM wp_pb_prayedfor WHERE request_id='$req_id'");
		return $wpdb->num_rows;
	}
	function isIPBanned($ip){
		global $wpdb;
		$wpdb->get_results("SELECT id FROM wp_pb_banned_ips WHERE ip_address='$ip'");
		if($wpdb->num_rows==0){
			return "pass";
		}else{
			return "fail";
		}
	}

if($_POST['action']=="view_details"){

//VIEW DETAILS OUTPUT
	$req_id=$_POST['pb_request_id'];
	$prayer_request=$wpdb->get_row("SELECT first_name,last_name,anon,title,body FROM wp_pb_requests WHERE id='$req_id'");
	$first_name=stripslashes($prayer_request->first_name);
	$last_name=stripslashes($prayer_request->last_name);
	$anon=$prayer_request->anon;
	$title=stripslashes($prayer_request->title);
	$body=stripslashes($prayer_request->body);
	if($anon!=1){$display_name=$first_name." ".$last_name;}else{$display_name="<em>Anonymous</em>";}
	
	$view_details_output="<div id='praybox'>";
	$view_details_output.="<div class='title'>$title<div style='clear:both;'></div></div>";
	$view_details_output.="<table class='details'>";
	$view_details_output.="<tr><td class='label'>Submitted By:</td><td class='content'>$display_name";
	$view_details_output.="<form class='flag' method='post'><input type='hidden' name='action' value='flag_this_request' /><input type='hidden' name='pb_request_id' value='$req_id' /><input type='submit' value='Report This' /></form>";
	$view_details_output.="</td></tr>";
	$view_details_output.="<tr><td class='label'>Prayer Request:</td><td class='content'>$body</td></tr>";
	$view_details_output.="<tr><td class='response' colspan='2'>";
	$view_details_output.="<form method='post'><input type='hidden' name='action' value='prayed_for' /><input type='hidden' name='pb_request_id' value='$req_id' /><input type='submit' value='I Prayed For You' /></form>";
	$view_details_output.="</td></tr>";
	$view_details_output.="</table>";
	$view_details_output.="<div class='back'><form method='post'><input type='hidden' name='action' value='' /><input type='submit' value='&laquo; Back to Prayer Request List' /></form><div style='clear:both;'></div></div>";
	$view_details_output.="<div style='clear:both;'></div></div>";

return $view_details_output;

}elseif($_POST['action']=="flag_this_request"){

//PRAYED FOR INSERT SCRIPT AND CONTENT
	$req_id=$_POST['pb_request_id'];
	$time_now=time();
	$ip_address=$_SERVER['REMOTE_ADDR'];
	$wpdb->insert('wp_pb_flags',array('request_id'=>$req_id,'flagged_date'=>$time_now,'ip_address'=>$ip_address));

	if(isIPBanned($ip_address)=="pass"){
		$flag_action_output="<div id='praybox'>";
		$flag_action_output.="<div class='thankyou'>Thank you for reporting inappropriate content.<div style='clear:both;'></div></div>";
		$flag_action_output.="<div class='back'><form method='post'><input type='hidden' name='action' value='' /><input type='submit' value='&laquo; Back to Prayer Request List' /></form><div style='clear:both;'></div></div>";
		$flag_action_output.="<div style='clear:both;'></div></div>";
	}else{
		$flag_action_output="<div id='praybox'>";
		$flag_action_output.="<div class='thankyou'>Sorry, you're not allowed to do that.<div style='clear:both;'></div></div>";
		$flag_action_output.="<div class='back'><form method='post'><input type='hidden' name='action' value='' /><input type='submit' value='&laquo; Back to Prayer Request List' /></form><div style='clear:both;'></div></div>";
		$flag_action_output.="<div style='clear:both;'></div></div>";
	}
	
return $flag_action_output;

}elseif($_POST['action']=="prayed_for"){

//PRAYED FOR INSERT SCRIPT AND CONTENT
	$req_id=$_POST['pb_request_id'];
	$time_now=time();
	$ip_address=$_SERVER['REMOTE_ADDR'];
	$wpdb->insert('wp_pb_prayedfor',array('request_id'=>$req_id,'prayedfor_date'=>$time_now,'ip_address'=>$ip_address));
		
	$view_details_output="<div id='praybox'>";
	$view_details_output.="<div class='thankyou'>Thank you for lifting up this request in prayer.<div style='clear:both;'></div></div>";
	$view_details_output.="<div class='back'><form method='post'><input type='hidden' name='action' value='' /><input type='submit' value='&laquo; Back to Prayer Request List' /></form><div style='clear:both;'></div></div>";
	$view_details_output.="<div style='clear:both;'></div></div>";

return $view_details_output;

}else{

//REQUEST LIST OUTPUT CONTENT
	$flag_thresh=get_option('pb_flag_threshhold');
	
	$req_list_output="<div id='praybox'>";
	$req_list_output.="<div class='intro'>".get_option('pb_request_list_intro')."<div style='clear:both;'></div></div>";
	$req_list_output.="<table class='praybox'>";
	$req_list_output.="<tr class='pb-titlerow'><td>Request Title</td><td># Prayers</td><td>Submitted On</td><td>&nbsp;</td>";
	
	$active_requests=$wpdb->get_results("SELECT id,title,body,submitted FROM wp_pb_requests WHERE active='1' ORDER BY submitted DESC");
	
	foreach($active_requests as $a_req){
		$req_id=$a_req->id;
		$title=stripslashes($a_req->title);
		$body=stripslashes($a_req->body);
		$submitted=date("F j, Y",$a_req->submitted);
		$num_prayers=howManyPrayers($req_id);
		$num_flags=howManyFlags($req_id);
		
		if($flag_thresh!=0){$flag_ratio=$num_flags/$flag_thresh;}else{$flag_ratio=0;}
		
		if($flag_ratio<1){
		$req_list_output.="<tr class='pb-datarow'><td>$title</td><td>$num_prayers</td><td>$submitted</td><td class='input'>";
		$req_list_output.="<form method='post'><input type='hidden' name='action' value='view_details' /><input type='hidden' name='pb_request_id' value='$req_id' /><input type='submit' value='View Details' /></form>";
		$req_list_output.="</td></tr>";
		}
	}
	$req_list_output.="</table>";
	$req_list_output.="<div style='clear:both;'></div></div>";

return $req_list_output;
}
}
