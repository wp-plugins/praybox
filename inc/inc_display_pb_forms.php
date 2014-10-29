<?php
function display_pb_forms($atts) {
	global $wpdb;

if(isset($_POST['action']) && $_POST['action']=="update_request"){

//UPDATE REQUEST
	$req_id=$_POST['req_id'];
	$anon=(isset($_POST['anon']) && $_POST['anon']=='on')? 1 : 0;	
	$notify=(isset($_POST['notify']) && $_POST['notify']=='on')? 1 : 0;
	if(isset($_POST['closed']) && $_POST['closed']=='on'){
		$closed=time();
		$active=2;
	$wpdb->update($wpdb->prefix.'pb_requests',array('anon'=>$anon,'closed'=>$closed,'notify'=>$notify,'active'=>$active),array('id'=>$req_id));
	}else{
	$wpdb->update($wpdb->prefix.'pb_requests',array('anon'=>$anon,'notify'=>$notify),array('id'=>$req_id));
	}

	$updated_title=(isset($closed))? PB_REQ_CLOSED_TITLE : PB_REQ_UPDATED_TITLE;
	$updated_msg=(isset($closed))? PB_REQ_CLOSED_MSG : PB_REQ_UPDATED_MSG;
	
	$updated_request_output="<div id='praybox_wrapper'>";
	$updated_request_output.="<h2 class='pbx-title'>$updated_title</h2>";
	$updated_request_output.="<p class='pbx-text'>$updated_msg</p>";
	$updated_request_output.="</div>";	

	return $updated_request_output;

}elseif(isset($_POST['action']) && $_POST['action']=="submit_request"){
//Submit Request to DB, Email Mgmt Link, and Display a Message
	$first_name=(isset($_POST['first_name']) && $_POST['first_name']!="")? clean($_POST['first_name']) : "anon";
	$last_name=(isset($_POST['last_name']) && $_POST['last_name']!="")? clean($_POST['last_name']) : "anon";
	$anon=(isset($_POST['anon']) && $_POST['anon']=='on')? 1 : 0;	
	$email=$_POST['email'];	
	$authcode=rand_chars();
	$title=clean($_POST['title']);	
	$body=clean($_POST['body']);	
	$notify=(isset($_POST['notify']) && $_POST['notify']=='on')? 1 : 0;
	$ip_address=$_SERVER['REMOTE_ADDR'];
	$time_now=time();
	if(get_option('pb_admin_moderation')==1){$active=0;}else{$active=1;}

	//THROW FLAGS IF ANY OF THESE CONDITIONS ARE MET
	if((isIPBanned($ip_address)=="fail")||(isDuplicate($first_name,$last_name,$email,$title,$ip_address)=="fail")){$flaggit=1;}else{$flaggit=0;}

	//IF NO FLAGS, RUN IT
	if($flaggit==0){
		$site_name=get_bloginfo('name');
		
		$wpdb->insert($wpdb->prefix.'pb_requests',array('first_name'=>$first_name,'last_name'=>$last_name,'anon'=>$anon,'email'=>$email,'authcode'=>$authcode,'submitted'=>$time_now,'title'=>$title,'body'=>$body,'notify'=>$notify,'ip_address'=>$ip_address,'active'=>$active));
		
		$management_url=getManagementUrl($authcode);
		
	   	$email_from=get_option('pb_reply_to_email');
	   	$email_message=get_option('pb_email_prefix');
	   	$email_message.="\n\n".PB_REQ_EMAIL_MSG1." $management_url\n\n".PB_REQ_EMAIL_MSG2."\n\n";
	   	$email_message.=get_option('pb_email_suffix');
		$headers= 'Reply-To:'.$site_name.' <'.$email_from.'>'."\r\n";
		$headers.= 'From:'.$site_name.' <'.$email_from.'>'."\r\n";
	   	
	   	wp_mail($email,PB_REQ_EMAIL_SUBJECT,$email_message,$headers);

		$submitted_output="<div id='praybox_wrapper'>";
		$submitted_output.="<h2 class='pbx-title'>".PB_REQ_SUBMITTED_TITLE."</h2>";
		$submitted_output.="<p class='pbx-text'>".PB_REQ_SUBMITTED_MSG."</p>";
		$submitted_output.="</div>";

	}else{

		$submitted_output="<div id='praybox_wrapper'>";
		$submitted_output.="<h2 class='pbx-title'>".PB_REQ_FAIL_TITLE."</h2>";
		$submitted_output.="<p class='pbx-text'>".PB_REQ_FAIL_MSG."</p><ul>";

		if(isDuplicate($first_name,$last_name,$email,$title,$ip_address)=="fail"){
			$submitted_output.="<li>".PB_REQ_FAIL_DUPLICATE."</li>";
		}
		if($_POST['required']!=""){
			$submitted_output.="<li>".PB_REQ_FAIL_SPAM."</li>";
		}
		if(isIPBanned($ip_address)=="fail"){
			$submitted_output.="<li>".PB_REQ_FAIL_BANNED."</li>";
		}
		$submitted_output.="</ul></div>";

	}

	return $submitted_output;

}else{

	if(!isset($_GET['pbid']) || $_GET['pbid']==""){
		$stat=0; //new request
		$anon="";
		$notify="";
		
		$sub_form_title=PB_FORM_TITLE;
		$sub_form_msg=get_option('PB_REQ_form_intro');
		$sub_form_action="submit_request";
		$sub_form_req_id_input="";
		$sub_form_submit=PB_FORM_SUBMIT;
	
	}else{
		$authcode=$_GET['pbid'];
		if(isRequestActive($authcode)=="yes"){
			$prayer_request=$wpdb->get_row("SELECT id,first_name,last_name,anon,email,title,body,notify FROM ".$wpdb->prefix."pb_requests WHERE authcode='$authcode'");
			
			$stat=1; //open request
			$anon=($prayer_request->anon==1)? "checked" : "";
			$notify=($prayer_request->notify==1)? "checked" : "";
	
			$sub_form_title=PB_FORM_EDIT_TITLE;
			$sub_form_msg=PB_FORM_EDIT_MSG;
			$sub_form_action="update_request";
			$sub_form_req_id_input="<input type='hidden' name='req_id' value='".$prayer_request->id."' />";
			$sub_form_submit=PB_FORM_EDIT_SUBMIT;
		}else{
			$stat=2; //request is closed
		}
	}

	$sub_form_output="<div id='praybox_wrapper'>";

	if($stat==2){
		//CLOSED REQUEST OUTPUT
		$sub_form_output.="<h2 class='pbx-title'>".PB_FORM_CLOSED_TITLE."</h2>";
		$sub_form_output.="<p class='pbx-text'>".PB_FORM_CLOSED_MSG."</p>";
	}else{
		//INITIAL SUBMISSION FORM OUTPUT
		$sub_form_output.="<h2 class='pbx-title'>$sub_form_title</h2>";
		$sub_form_output.="<p class='pbx-text'>$sub_form_msg</p>";
		$sub_form_output.="<form class='pbx-form' method='post'><input type='hidden' name='action' value='$sub_form_action' />$sub_form_req_id_input";
		$sub_form_output.=($stat==0)? "<div class='pbx-formfield'><label>".PB_FORM_FIRST_NAME.":</label><input type='text' name='first_name' /></div>" : "";
		$sub_form_output.=($stat==0)? "<div class='pbx-formfield'><label>".PB_FORM_LAST_NAME.":</label><input type='text' name='last_name' /></div>" : "";
		$sub_form_output.="<div class='pbx-formfield'><input type='checkbox' name='anon' $anon /><span>".PB_FORM_ANONYMOUS."</span></div>";
		$sub_form_output.=($stat==0)? "<div class='pbx-formfield'><label>".PB_FORM_EMAIL.":</label><input type='text' name='email' /></div>" : "";
		$sub_form_output.=($stat==0)? "<div class='pbx-formfield'><label>".PB_FORM_REQTITLE.":</label><input type='text' name='title' /></div>" : "";
		$sub_form_output.=($stat==0)? "<div class='pbx-formfield'><label>".PB_FORM_REQ.":</label><textarea name='body'></textarea></div>" : "";
		$sub_form_output.="<div class='pbx-formfield'><input type='checkbox' name='notify' $notify /><span>".PB_FORM_NOTIFY."</span></div>";
		$sub_form_output.=($stat==1)? "<div class='pbx-formfield'><input type='checkbox' name='closed' /><span>".PB_FORM_EDIT_CLOSE."</span></div>" : "";
		$sub_form_output.="<div class='pbx-formfield'><input type='submit' value='$sub_form_submit' /></div>";
		$sub_form_output.="</form>";
	}

	$sub_form_output.="</div>";

return $sub_form_output;

/*

}else{
	$authcode=$_GET['pbid'];
	
	if (isRequestActive($authcode)=="yes"){
		//IF REQUEST IS OPEN
		$prayer_request=$wpdb->get_row("SELECT id,first_name,last_name,anon,email,title,body,notify FROM ".$wpdb->prefix."pb_requests WHERE authcode='$authcode'");
		$req_id=$prayer_request->id;
		if($prayer_request->anon==1){$anon="checked";}else{$anon="";}
		if($prayer_request->notify==1){$notify="checked";}else{$notify="";}
		
		$mgmt_form_output="<div id='praybox'>";
		$mgmt_form_output.="<div class='title'>Make Changes to Your Prayer Request<div style='clear:both;'></div></div>";
		$mgmt_form_output.="<div class='intro'>Use the form below to make changes to your prayer request listing.<div style='clear:both;'></div></div>";
		$mgmt_form_output.="<form method='post'><input type='hidden' name='action' value='update_request' /><input type='hidden' name='req_id' value='$req_id' />";
		$mgmt_form_output.="<table class='subform'>";
		$mgmt_form_output.="<tr><td class='checkbox'><input type='checkbox' name='anon' $anon /> I would like to remain anonymous. Please do not post my name.</td></tr>";
		$mgmt_form_output.="<tr><td class='checkbox'><input type='checkbox' name='notify' $notify /> I would like to be notified (once per day) when I have been prayed for.</td></tr>";
		$mgmt_form_output.="<tr><td><hr /></td></tr>";
		$mgmt_form_output.="<tr><td class='checkbox'><input type='checkbox' name='closed' /> I would like to close this prayer request.</td></tr>";
		$mgmt_form_output.="<tr><td class='submit'><input type='submit' value='Update My Prayer Request' /></td></tr>";
		$mgmt_form_output.="</table>";
		$mgmt_form_output.="</form>";
		$mgmt_form_output.="<div style='clear:both;'></div></div>";
	}else{
		//IF REQUEST IS CLOSED
		$mgmt_form_output="<div id='praybox'>";
		$mgmt_form_output.="<div class='title'>This Request Has Been Closed<div style='clear:both;'></div></div>";
		$mgmt_form_output.="<div class='intro'>Sorry, this Prayer Request has been closed and can no longer be edited.<div style='clear:both;'></div></div>";
		$mgmt_form_output.="<div style='clear:both;'></div></div>";
	}

return $mgmt_form_output;

	
}

*/

}
}
