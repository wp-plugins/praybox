<?php
function pb_settings_page() {
if(get_option('pb_admin_moderation')==""){$needupdate=1;}
?>

<div class="wrap">
<h2>PrayBox General Settings Page</h2>

<?php
 if( isset($_POST['update']) && $_POST['update'] == 'Y' ) {
	$kv=array();
	foreach($_POST as $key => $value){
		if($key!="update"){
		update_option($key,$value);	
		}
	}
?>
<p><strong><?php _e('settings saved.','menu-test'); ?></strong></p>
<?php } 

 if($_POST['action']=="praybox_update"){
	updateOptionsAlpha();
?>
<p><strong><?php _e('PrayBox Plugin Options Updated. <a href="?page=pb_settings">Click here to reload the PrayBox interface.</a>','menu-test'); ?></strong></p>
<?php } else { 

if($needupdate==1){ ?>
<form method="post" class="update">
<input type="hidden" name="action" value="praybox_update" />
<p>Your PrayBox plugin has been updated and there are a few housekeeping things that need to be performed.</p>
<input type="submit" value="Update PrayBox Options" />
</form>

<?php }

$contributors = file_get_contents('http://www.praybox.com/contributors_list.php');

$domain=$_SERVER['HTTP_HOST'];
$iswww=strpos($domain,"www.");
if($iswww!==false){$domain=str_replace("www.","",$domain);}

$iscontributor=strpos($contributors,$domain);

if($iscontributor===false){
?>

<div class="donateform">
	<p>The development of this plugin has been and will continue to be a labor of love. It's one of those projects that we'd like to put more time into than we actually have available, and it really helps out when folks who enjoy using it can donate a little bit to help us keep it going.</p>
	<p>With that in mind, I ask that you consider donating a few dollars to help us keep moving forward with the development of this plugin. If you have any special or custom requests, hire us! The more business we get, the more we can afford to spend time on projects like PrayBox. Thank you!</p>
	<form class="donate" action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="support@guilddev.com">
	<input type="hidden" name="lc" value="US">
	<input type="hidden" name="item_name" value="WordPress Plugin Donation - PrayBox">
	<input type="hidden" name="item_number" value="PB20-web">
	<input type="hidden" name="amount" value="20.00">
	<input type="hidden" name="currency_code" value="USD">
	<input type="hidden" name="button_subtype" value="services">
	<input type="hidden" name="no_note" value="1">
	<input type="hidden" name="no_shipping" value="1">
	<input type="hidden" name="shipping" value="20.00">
	<input type="hidden" name="bn" value="PP-BuyNowBF:donate20.png:NonHosted">
	<input type="image" src="http://www.guilddev.com/wp-content/uploads/2011/04/donate20.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	<form class="donate" action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="support@guilddev.com">
	<input type="hidden" name="lc" value="US">
	<input type="hidden" name="item_name" value="WordPress Plugin Donation - PrayBox">
	<input type="hidden" name="item_number" value="PB10-web">
	<input type="hidden" name="amount" value="10.00">
	<input type="hidden" name="currency_code" value="USD">
	<input type="hidden" name="button_subtype" value="services">
	<input type="hidden" name="no_note" value="1">
	<input type="hidden" name="no_shipping" value="1">
	<input type="hidden" name="shipping" value="10.00">
	<input type="hidden" name="bn" value="PP-BuyNowBF:donate10.png:NonHosted">
	<input type="image" src="http://www.guilddev.com/wp-content/uploads/2011/04/donate10.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	<form class="donate" action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="support@guilddev.com">
	<input type="hidden" name="lc" value="US">
	<input type="hidden" name="item_name" value="WordPress Plugin Donation - PrayBox">
	<input type="hidden" name="item_number" value="PB5-web">
	<input type="hidden" name="amount" value="5.00">
	<input type="hidden" name="currency_code" value="USD">
	<input type="hidden" name="button_subtype" value="services">
	<input type="hidden" name="no_note" value="1">
	<input type="hidden" name="no_shipping" value="1">
	<input type="hidden" name="shipping" value="5.00">
	<input type="hidden" name="bn" value="PP-BuyNowBF:donate5.png:NonHosted">
	<input type="image" src="http://www.guilddev.com/wp-content/uploads/2011/04/donate5.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
<div style="clear:both;"></div></div>
<?php } ?>
<p>Before using this plugin, make sure the correct information is listed in the fields below and paste the following shortcodes into the appropriate pages as indicated below:</p>

<ul style="list-style-type:disc; margin-left: 30px;">
	<li>Paste this shortcode into the page you would like to use to display your listings: [pb-requests]</li>
	<li>Paste this shortcode into the page you would like to use to display your submission form: [pb-forms]</li>
	<li>IMPORTANT: Make sure you tell the plugin where you placed the [pb-forms] shortcode by selecting that page from the list beside "Prayer Request Form Page" below</li>
</ul>

<p>Have fun using this plugin and if you have any questions, requests, or positive feedback, we would love to hear from you at <a href="http://www.guilddev.com/wordpress-plugins/" target="_blank">Guild Development, LLC</a></p>

<form method="post" action="">
	<input type="hidden" name="update" value="Y" />

    <table class="form-table">
        <tr valign="top">
        <th scope="row">Flag Threshhold</th>
        <td>
        How many times do you want a prayer request listing to be flagged before it is hidden from public?<br />
        <input type="text" name="pb_flag_threshhold" value="<?php echo get_option('pb_flag_threshhold'); ?>" /> <em>(enter '0' to disable this feature)</em>
		</td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Request Form Intro Text</th>
        <td>
	        This message is displayed above the form that allows people to submit their prayer requests.<br />
	        <textarea  name="pb_request_form_intro" rows="3" cols="60"><?php echo get_option('pb_request_form_intro'); ?></textarea>
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">Request List Intro Text</th>
        <td>
	        This message is displayed above the list of active prayer requests.<br />
	        <textarea  name="pb_request_list_intro" rows="3" cols="60"><?php echo get_option('pb_request_list_intro'); ?></textarea>
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">Prayer Request Form Page</th>
        <td>
		   <?php
		   $pb_currently_selected_page=get_option('pb_management_page');
		   wp_dropdown_pages(array('selected'=>$pb_currently_selected_page,'name'=>'pb_management_page'));
		   ?>
		   <p>NOTE: The following shortcode MUST be pasted into the "Prayer Request Form Page" in order for people who have posted prayer requests to close their requests or submit praise reports.</p>
		   <p>[pb-forms]</p>
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">Daily Email Subject</th>
        <td><input type="text" name="pb_email_subject" value="<?php echo get_option('pb_email_subject'); ?>" size="80" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Daily Email Reply-To Email Address</th>
        <td><input type="text" name="pb_reply_to_email" value="<?php echo get_option('pb_reply_to_email'); ?>" size="80" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Daily Email Greeting/Prefix</th>
        <td>
	        The portion of the email that precedes the information notifying the requestor how many times they have been prayed for that day.<br />
	        <textarea  name="pb_email_prefix" rows="3" cols="60"><?php echo get_option('pb_email_prefix'); ?></textarea>
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">Daily Email Closing/Suffix</th>
        <td>
	        The portion of the email that follows the information notifying the requestor how many times they have been prayed for that day.<br />
	        <textarea  name="pb_email_suffix" rows="3" cols="60"><?php echo get_option('pb_email_suffix'); ?></textarea>
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">Initial Prayer Gap</th>
        <td>
        How many hours do you want a new prayer request to sit and not be prayed for before you are notified?<br />
        <input type="text" name="pb_send_notify_hours" value="<?php echo get_option('pb_send_notify_hours'); ?>" /> <em>(enter '0' to disable this feature)</em>
		</td>
        </tr>

		<tr valign="top">
        <th scope="row">Prayer Gap Alert Email</th>
        <td><input type="text" name="pb_send_notify_email" value="<?php echo get_option('pb_send_notify_email'); ?>" size="80" /></td>
        </tr>

<?php if($needupdate!=1){ ?>
		<tr valign="top">
        <th scope="row">Admin Moderation of All Requests</th>
        <td>
        Turn this option "on" if you want to moderate all requests before they are displayed publicly.<br /><input type="radio" type="checkbox" <?php if(get_option('pb_admin_moderation')=="1"){ ?>checked="checked" <?php } ?> name="pb_admin_moderation" value="1" />on &nbsp; &nbsp; &nbsp; <input type="radio" <?php if(get_option('pb_admin_moderation')=="0"){ ?>checked="checked" <?php } ?> name="pb_admin_moderation" value="0" />off</td>
        </tr>

		<tr valign="top">
        <th scope="row">Which Requests Would You Like to Display?</th>
        <td>
        <select name="pb_timeframe_display">
        <option value="0" <?php if(get_option('pb_timeframe_display')=="0"){ ?>selected="selected"<?php } ?>>all of them</option>
        <option value="30" <?php if(get_option('pb_timeframe_display')=="30"){ ?>selected="selected"<?php } ?>>only the last 30 days</option>
        <option value="60" <?php if(get_option('pb_timeframe_display')=="60"){ ?>selected="selected"<?php } ?>>only the last 60 days</option>
        <option value="90" <?php if(get_option('pb_timeframe_display')=="90"){ ?>selected="selected"<?php } ?>>only the last 90 days</option>
        <option value="120" <?php if(get_option('pb_timeframe_display')=="120"){ ?>selected="selected"<?php } ?>>only the last 120 days</option>
        </select></td>
        </tr>

		<tr valign="top">
        <th scope="row">How Many Request Would You Like to Display Per Page?</th>
        <td>
        <select name="pb_page_display">
        <option value="0" <?php if(get_option('pb_page_display')=="0"){ ?>selected="selected"<?php } ?>>all of them</option>
        <option value="20" <?php if(get_option('pb_page_display')=="20"){ ?>selected="selected"<?php } ?>>20</option>
        <option value="40" <?php if(get_option('pb_page_display')=="40"){ ?>selected="selected"<?php } ?>>40</option>
        <option value="60" <?php if(get_option('pb_page_display')=="60"){ ?>selected="selected"<?php } ?>>60</option>
        <option value="80" <?php if(get_option('pb_page_display')=="80"){ ?>selected="selected"<?php } ?>>80</option>
        <option value="100" <?php if(get_option('pb_page_display')=="100"){ ?>selected="selected"<?php } ?>>100</option>
        </select></td>
        </tr>
<?php } ?>                
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
<p align="right">Prayer Gap emails set to run <em><?php echo wp_get_schedule('prayer_gap'); ?></em><br />
Daily Emails set to run <em><?php echo wp_get_schedule('daily_emails'); ?></em></p>

</div>
<?php }}