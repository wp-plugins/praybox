<?php
function pb_settings_page() {
$needupdate=(get_option('pb_admin_moderation')=="")? 1 : 0;
?>

<div class="wrap">
<h2 class="logo-title">PrayBox General Settings</h2>
<div id="pbx-wrap">
<?php
 if( isset($_POST['update']) && $_POST['update'] == 'Y' ) {
	$kv=array();
	foreach($_POST as $key => $value){
		if($key!="update"){
		update_option($key,stripslashes($value));	
		}
	}
?>
<p class="pbx-alert"><?php _e('settings saved.','menu-test'); ?></p>
<?php } 

 if(isset($_POST['action']) && $_POST['action']=="praybox_update"){
	updateOptionsAlpha();
?>
<p class="pbx-alert"><?php _e('PrayBox Plugin Options Updated. <a href="?page=pb_settings">Click here to reload the PrayBox interface.</a>','menu-test'); ?></p>
<?php } else { 

if($needupdate==1){ ?>
<form method="post" class="update">
<input type="hidden" name="action" value="praybox_update" />
<p>Your PrayBox plugin has been updated and there are a few housekeeping things that need to be performed.</p>
<input type="submit" value="Update PrayBox Options" />
</form>

<?php } ?>

	<div class="pbx-well">
	<p>Before using this plugin, make sure the correct information is listed in the fields below and paste the following shortcodes into the appropriate pages as indicated below:</p>
	
	<ul>
		<li>Paste this shortcode into the page you would like to use to display your listings: [pb-requests]</li>
		<li>Paste this shortcode into the page you would like to use to display your submission form: [pb-forms]</li>
		<li>IMPORTANT: Make sure you tell the plugin where you placed the [pb-forms] shortcode by selecting that page from the list beside "Prayer Request Form Page" below</li>
	</ul>
	
	<p>Have fun using this plugin and if you have any questions, requests, or positive feedback, we would love to hear from you at <a href="http://www.blazingtorch.com/" target="_blank">www.blazingtorch.com</a>.  We are constantly making updates to this plugin and looking for opportunities to develop new applications, so please do not hesitate to <a href="http://www.blazingtorch.com/contact/" target="_blank">contact us</a>.</p>
	</div>


	<div id="pbx-main">
		
		<form method="post" action="">
			<input type="hidden" name="update" value="Y" />
		
	        <div class="formfield">
		        <label>Flag Threshhold</label>
		        <div class="formelement">
		        <p>How many times do you want a prayer request listing to be flagged before it is hidden from public?</p>
		        <input type="number" name="pb_flag_threshhold" value="<?php echo get_option('pb_flag_threshhold'); ?>" /> <em>(enter '0' to disable this feature)</em>
				</div>
	        </div>
	        
	        <div class="formfield">
		        <label>Request Form Intro Text</label>
		        <div class="formelement">
			        <p>This message is displayed above the form that allows people to submit their prayer requests.</p>
			        <textarea  name="pb_request_form_intro" ><?php echo get_option('pb_request_form_intro'); ?></textarea>
		        </div>
	        </div>
	
	        <div class="formfield">
		        <label>Request List Intro Text</label>
		        <div class="formelement">
			        <p>This message is displayed above the list of active prayer requests.</p>
			        <textarea  name="pb_request_list_intro" ><?php echo get_option('pb_request_list_intro'); ?></textarea>
		        </div>
	        </div>
	
	        <div class="formfield">
		        <label>Prayer Request Form Page</label>
		        <div class="formelement">
				   <?php
				   $pb_currently_selected_page=get_option('pb_management_page');
				   wp_dropdown_pages(array('selected'=>$pb_currently_selected_page,'name'=>'pb_management_page'));
				   ?>
				   <p>NOTE: The following shortcode MUST be pasted into the "Prayer Request Form Page" in order for people who have posted prayer requests to close their requests or submit praise reports.</p>
				   <p>[pb-forms]</p>
		        </div>
	        </div>
	
	        <div class="formfield">
		        <label>Daily Email Subject</label>
		        <div class="formelement"><input type="text" name="pb_email_subject" value="<?php echo get_option('pb_email_subject'); ?>"  /></div>
	        </div>
	         
	        <div class="formfield">
		        <label>Daily Email Reply-To Email Address</label>
		        <div class="formelement"><input type="email" name="pb_reply_to_email" value="<?php echo get_option('pb_reply_to_email'); ?>"  /></div>
	        </div>
	        
	        <div class="formfield">
		        <label>Daily Email Greeting/Prefix</label>
		        <div class="formelement">
			        <p>The portion of the email that precedes the information notifying the requestor how many times they have been prayed for that day.</p>
			        <textarea  name="pb_email_prefix" ><?php echo get_option('pb_email_prefix'); ?></textarea>
		        </div>
	        </div>
	
	        <div class="formfield">
		        <label>Daily Email Closing/Suffix</label>
		        <div class="formelement">
			        <p>The portion of the email that follows the information notifying the requestor how many times they have been prayed for that day.</p>
			        <textarea  name="pb_email_suffix" ><?php echo get_option('pb_email_suffix'); ?></textarea>
		        </div>
	        </div>
	
	        <div class="formfield">
		        <label>Initial Prayer Gap</label>
		        <div class="formelement">
		        <p>How many hours do you want a new prayer request to sit and not be prayed for before you are notified?</p>
		        <input type="number" name="pb_send_notify_hours" value="<?php echo get_option('pb_send_notify_hours'); ?>" /> <em>(enter '0' to disable this feature)</em>
				</div>
	        </div>
	
			<div class="formfield">
		        <label>Prayer Gap Alert Email</label>
		        <div class="formelement"><input type="email" name="pb_send_notify_email" value="<?php echo get_option('pb_send_notify_email'); ?>" /></div>
	        </div>
		
		    
			<div class="formfield">
			    <div class="formelement submit">
			    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			    </div>
			</div>
			
		</form>
	</div>

	<div id="pbx-sidebar">
		<h3>Do You Enjoy Using PrayBox?</h3>
		<p>The development of this plugin has been and will continue to be a labor of love. It's one of those projects that we'd like to put more time into than we actually have available, adding features to PrayBox and building more web-based tools for churches and ministries.</p>
		<p><strong>If you like PrayBox, please consider giving us a 5-star rating on the WordPress Plugins directory by <a href="http://wordpress.org/support/view/plugin-reviews/praybox?rate=5#postform" target="_blank">clicking here</a>!</strong></p>
		<div class="pbx-featured">
			<h3>Upgrade to PrayBox+</h3>
			<p>Purchase PrayBox+, a premium paid version of PrayBox with advanced features, such as:</p>
			<ul>
				<li>Admins have the option to moderate and edit requests before they appear publicly</li>
				<li>Admins can edit active requests</li>
				<li>Users can edit their own prayer requests</li>
				<li>Users can close their requests and add praise report notes</li>
				<li>Ability to link directly to individual prayer requests</li>
				<li>Enhanced spam protection</li>
				<li>Prayer requests can be shown over multiple pages instead of all at once</li>
				<li>Admins can set the number of requests that show up per page</li>
				<li>Ability to archive old requests</li>
				<li>Premium support and free lifetime upgrades</li>
			</ul>
			<p>For just a few bucks, you can enjoy these advanced features and help us to keep moving forward with the development of this plugin and future church/ministry related tools. Thank you!</p>
			<p><a href="http://www.blazingtorch.com/products/praybox-prayer-request-management/">Click here for more info or to upgrade to PrayBox+</a></p>
		</div>
	</div>

	<div id="pbx-footer">
	<p align="right">Prayer Gap emails set to run <em><?php echo wp_get_schedule('prayer_gap'); ?></em><br />
	Daily Emails set to run <em><?php echo wp_get_schedule('daily_emails'); ?></em></p>
	</div>
</div>
</div>
<?php }}