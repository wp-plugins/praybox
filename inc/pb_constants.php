<?php

if (function_exists("praybox_babelfish")) {


} else {
	/* SHORTCODE CONSTANTS */
	
	//REQUEST FORM (inc_display_pb_forms.php)
	define("PB_REQ_UPDATED_TITLE",		"Your Prayer Request Has Been Updated");
	define("PB_REQ_UPDATED_MSG",		"Any changes that you have made to your prayer request have been updated.");
	define("PB_REQ_CLOSED_TITLE",		"Your Prayer Request Has Been Closed");
	define("PB_REQ_CLOSED_MSG",			"You will no longer have access to edit this prayer request.");

	define("PB_REQ_EMAIL_SUBJECT",		"Prayer Request Posted");
	define("PB_REQ_EMAIL_MSG1",			"Your prayer request has been posted. If you would like to edit your prayer request, click here:");
	define("PB_REQ_EMAIL_MSG2",			"If you have indicated that you would like to receive notifications, you will receive an email at the end of each day that your prayer request is lifted up to the Lord letting you know how many times you were prayed for that day.");

	define("PB_REQ_SUBMITTED_TITLE",	"Your Prayer Request Has Been Submitted");
	define("PB_REQ_SUBMITTED_MSG",		"You will be receiving an email shortly that contains a link that will allow you to update your prayer request. If you have indicated that you would like to be notified when you are prayed for, you will receive an email once a day letting you know how many times your prayer request has been lifted up.");

	define("PB_REQ_FAIL_TITLE",			"Prayer Request Not Submitted");
	define("PB_REQ_FAIL_MSG",			"Your prayer request submission has failed for the following reason(s):");
	define("PB_REQ_FAIL_DUPLICATE",		"You have submitted an identical request and it is already listed.");
	define("PB_REQ_FAIL_SPAM",			"You seem to be a spam bot.");
	define("PB_REQ_FAIL_BANNED",		"You are banned from using this resource.");

	define("PB_FORM_TITLE",				"Submit Your Prayer Request");
	define("PB_FORM_FIRST_NAME",		"First Name");
	define("PB_FORM_LAST_NAME",			"Last Name");
	define("PB_FORM_ANONYMOUS",			"I would like to remain anonymous. Please do not post my name.");
	define("PB_FORM_NOTIFY",			"I would like to be notified (once per day) when I have been prayed for.");
	define("PB_FORM_EMAIL",				"Email Address");
	define("PB_FORM_REQTITLE",			"Prayer Request Title");
	define("PB_FORM_REQ",				"Prayer Request");
	define("PB_FORM_SUBMIT",			"Submit My Prayer Request");

	define("PB_FORM_EDIT_TITLE",		"Make Changes to Your Prayer Request");
	define("PB_FORM_EDIT_MSG",			"Use the form below to make changes to your prayer request listing.");
	define("PB_FORM_EDIT_CLOSE",		"I would like to close this prayer request.");
	define("PB_FORM_EDIT_SUBMIT",		"Update My Prayer Request");

	define("PB_FORM_CLOSED_TITLE",		"This Request Has Been Closed");
	define("PB_FORM_CLOSED_MSG",		"Sorry, this Prayer Request has been closed and can no longer be edited.");

	//REQUEST LIST
	define("PB_REQ_TITLE",				"Request Title");
	define("PB_REQ_NUM_PRAYERS",		"# Prayers");
	define("PB_REQ_SUBMITTED_ON",		"Submitted On");
	define("PB_REQ_DETAILS",			"Details");
	define("PB_REQ_ANONYMOUS",			"Anonymous");
	define("PB_REQ_UNTITLED",			"Untitled");
	define("PB_LINK_BACK",				"Back to Request List");
	define("PB_REQ_SUBMITTED_BY",		"Submitted By");
	define("PB_FLAG_ABUSE",				"Report Abuse");
	define("PB_REQ_REQUEST",			"Prayer Request");
	define("PB_FLAG_PRAYED",			"I Prayed For You");
	define("PB_THANK_YOU_FLAGGER",		"Thank you for reporting inappropriate content.");
	define("PB_ILLEGAL_FLAGGER",		"Sorry, you're not allowed to do that.");
	define("PB_THANK_YOU_PRAYER",		"Thank you for lifting up this request in prayer.");

	/* ADMIN CONSTANTS */
	define("PB_ADMIN_APPROVE",			"Approve");
	define("PB_ADMIN_EDIT",				"Edit");
	define("PB_ADMIN_DELETE",			"Delete");
	define("PB_ADMIN_BAN",				"Remove/Ban");
	define("PB_ADMIN_REMOVE",			"Remove");
	define("PB_ADMIN_CLOSE",			"Close");
	define("PB_ADMIN_REOPEN",			"Reopen");
	define("PB_ADMIN_CURRENTLY",		"There are currently no");
	define("PB_ADMIN_PRAYER_REQ",		"prayer requests");
	define("PB_ADMIN_PAGE",				"Page");

	define("PB_ADMIN_ACTIVE_PAGE_TITLE","PrayBox Active Prayer Request List");
	define("PB_ADMIN_REQ_CLOSED",		"Request Closed.");



}

