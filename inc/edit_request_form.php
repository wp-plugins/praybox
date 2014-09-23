<?php
if($_POST['action']=="edit_request"){
	$req_id=$_POST['pb_request_id'];
	$request=$wpdb->get_row("SELECT first_name,last_name,email,title,body,ip_address,submitted FROM ".$wpdb->prefix."pb_requests WHERE id='$req_id'");
	$first_name=stripslashes($request->first_name);
	$last_name=stripslashes($request->last_name);
	$email=$request->email;
	$title=stripslashes($request->title);
	$body=stripslashes($request->body);
	
?>	
<form method="post" action="">
	<input type="hidden" name="action" value="edit_request_exec" />
	<input type="hidden" name="pb_request_id" value="<?php echo $req_id; ?>" />

    <div class="formfield">
    <label>First Name</label>
    <div class="formelement"><input type="text" name="first_name" value="<?php echo $first_name; ?>" /></div>
    </div>

    <div class="formfield">
    <label>Last Name</label>
    <div class="formelement"><input type="text" name="last_name" value="<?php echo $last_name; ?>" /></div>
    </div>

    <div class="formfield">
    <label>Email Address</label>
    <div class="formelement"><input type="text" name="email" value="<?php echo $email; ?>" /></div>
    </div>

    <div class="formfield">
    <label>Request Title</label>
    <div class="formelement"><input type="text" name="title" value="<?php echo $title; ?>" /></div>
    </div>

    <div class="formfield">
    <label>Request Body</label>
    <div class="formelement"><textarea name="body"><?php echo $body; ?></textarea></div>
    </div>

	<div class="formfield">
	    <div class="formelement submit">
	    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	    </div>
	</div>

</form>
<?php }