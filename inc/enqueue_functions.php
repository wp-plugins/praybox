<?php
add_action('wp_enqueue_scripts','public_praybox_assets');
add_action('admin_enqueue_scripts', 'admin_praybox_assets');

function public_praybox_assets() {
	wp_register_style('pbx-public', plugins_url().'/praybox/css/bt-praybox-sc.css');
	wp_enqueue_style('pbx-public');

	wp_enqueue_script('jquery');
//	wp_enqueue_script('praybox_public', plugins_url().'/praybox/js/jquery.pb_public.js');

wp_enqueue_script( 'praybox_public', plugins_url().'/praybox/js/jquery.pb_public.js', array( 'jquery' ) );
wp_localize_script( 'praybox_public', 'pbAjax', array( 'pb_ajaxurl' => admin_url( 'public_pb_ajax.php' ) ) );
}

function admin_praybox_assets() {
	wp_register_style('pbx-admin', plugins_url().'/praybox/css/bt-praybox-admin.css');
	wp_enqueue_style('pbx-admin');

	wp_enqueue_script('praybox_admin', plugins_url().'/praybox/js/jquery.pb_admin.js');
}

