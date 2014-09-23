<?php

function pb_request_list_archived_page() {
global $wpdb;
?>

<div class="wrap">
<h2 class="logo-title">PrayBox Archived Prayer Request List</h2>
<div id="pbx-wrap">

<p>In future updates, we hope to provide further tools for managing archives.</p>

<h3>Archived Prayer Requests</h3>

<table class="pbx-data">
<tr><th>ID</th><th>First/Last/Email</th><th width="250">Prayer Request</th><th>IP</th><th>Posted</th><th># Prayers</th><th>&nbsp;</th></tr>

<?php
echo getRequestList('archived');
?>
</table>
</div>
</div>
<?php }