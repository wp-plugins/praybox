<?php
function display_pb_requests($atts) {
	global $wpdb;
	global $post;
	
	$page_id=$post->ID;
	$permalink=get_permalink($page_id);
	
if((isset($_GET['req']))&&(is_numeric($_GET['req']))){

//VIEW DETAILS OUTPUT
	$req_id=$_GET['req'];
	$prayer_request=$wpdb->get_row("SELECT first_name,last_name,anon,title,body FROM ".$wpdb->prefix."pb_requests WHERE id='$req_id'");
	$first_name=stripslashes($prayer_request->first_name);
	$last_name=stripslashes($prayer_request->last_name);
	$anon=$prayer_request->anon;
	if($prayer_request->title!=""){$title=stripslashes($prayer_request->title);}else{$title="<em>".PB_REQ_UNTITLED."</em>";}
	$body=prePgphOutput($prayer_request->body);
	if($anon!=1){$display_name=$first_name." ".$last_name;}else{$display_name="<em>".PB_REQ_ANONYMOUS."</em>";}
	
	$view_details_output="<div class='praybox_wrapper' rel='$req_id'>"
		."<div class='pbx-link'><a href='$permalink'><< ".PB_LINK_BACK."</a></div>"
		."<h2 class='pbx-title'>$title</h2>"
		."<div class='pbx-formfield'><label>".PB_REQ_SUBMITTED_BY.":</label> $display_name</div>"
		."<div class='pbx-formfield'><label>".PB_REQ_REQUEST.":</label> $body</div>"
		."<div class='pbx-formfield pbx-formfield-footer'>"
			."<button type='button' class='flag-btn flag-abuse'>".PB_FLAG_ABUSE."</button>"
			."<button type='button' class='flag-btn flag-prayed'>".PB_FLAG_PRAYED."</button>"
		."</div>";

/*
	$view_details_output.="<div class='pbx-formfield'><form class='pbx-flag' method='post' action='$permalink'><input type='hidden' name='action' value='flag_this_request' /><input type='hidden' name='pb_request_id' value='$req_id' /><input type='submit' value='".PB_FLAG_ABUSE."' /></form>";
	$view_details_output.="<form class='pbx-prayed' method='post' action='$permalink'><input type='hidden' name='action' value='prayed_for' /><input type='hidden' name='pb_request_id' value='$req_id' /><input type='submit' value='".PB_FLAG_PRAYED."' /></form></div>";
*/
	$view_details_output.="</div>";

return $view_details_output;

}elseif(isset($_POST['action']) && $_POST['action']=="flag_this_request"){
/* NOW IN AJAX
//PRAYED FOR INSERT SCRIPT AND CONTENT
	$req_id=$_POST['pb_request_id'];
	$time_now=time();
	$ip_address=$_SERVER['REMOTE_ADDR'];
	$wpdb->insert($wpdb->prefix.'pb_flags',array('request_id'=>$req_id,'flagged_date'=>$time_now,'ip_address'=>$ip_address));

	$flag_msg=(isIPBanned($ip_address)=="pass")? PB_THANK_YOU_FLAGGER : PB_ILLEGAL_FLAGGER;

	$flag_action_output="<div id='praybox_wrapper'>";
	$flag_action_output.="<div class='pbx-link'><a href='$permalink'><< ".PB_LINK_BACK."</a></div>";
	$flag_action_output.="<p class='pbx-text'>$flag_msg</p>";
	$flag_action_output.="</div>";
	
return $flag_action_output;
*/
}elseif(isset($_POST['action']) && $_POST['action']=="prayed_for"){
/* NOW IN AJAX
//PRAYED FOR INSERT SCRIPT AND CONTENT
	$req_id=$_POST['pb_request_id'];
	$time_now=time();
	$ip_address=$_SERVER['REMOTE_ADDR'];
	$wpdb->insert($wpdb->prefix.'pb_prayedfor',array('request_id'=>$req_id,'prayedfor_date'=>$time_now,'ip_address'=>$ip_address));
		
	$view_details_output="<div id='praybox_wrapper'>";
	$view_details_output.="<div class='pbx-link'><a href='$permalink'><< ".PB_LINK_BACK."</a></div>";
	$view_details_output.="<p class='pbx-text'>".PB_THANK_YOU_PRAYER."</p>";
	$view_details_output.="</div>";

return $view_details_output;
*/
}else{

//REQUEST LIST OUTPUT CONTENT
	if(isset($_GET['page'])){$page=$_GET['page'];}else{$page=1;}
	
	return displayRequests($page,$permalink);
	
}
}
