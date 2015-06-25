<?php
if(is_array($_POST) && isset($_POST['pb_action'])){
	if($_POST['pb_action']=="pb_flag_request"){
		global $wpdb;

		if($_POST['flag_op']=="abuse"){
			$req_id=$_POST['req_id'];
			$time_now=time();
			$ip_address=$_SERVER['REMOTE_ADDR'];
			$wpdb->insert($wpdb->prefix.'pb_flags',array('request_id'=>$req_id,'flagged_date'=>$time_now,'ip_address'=>$ip_address));
			$flag_msg=(isIPBanned($ip_address)=="pass")? PB_THANK_YOU_FLAGGER : PB_ILLEGAL_FLAGGER;
		
			echo $flag_msg;
			exit;
		}elseif($_POST['flag_op']=="prayed"){
			$req_id=$_POST['req_id'];
			$time_now=time();
			$ip_address=$_SERVER['REMOTE_ADDR'];
			$wpdb->insert($wpdb->prefix.'pb_prayedfor',array('request_id'=>$req_id,'prayedfor_date'=>$time_now,'ip_address'=>$ip_address));
				
			echo "prayed";
			exit;
		}		
	}
	
}

