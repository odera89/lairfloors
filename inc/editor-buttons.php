<?php

add_action('init', 'lair_buttons');
function lair_buttons() {
	add_filter('mce_external_plugins', 'lair_add_buttons');
	add_filter('mce_buttons', 'lair_register_buttons');
}
function lair_add_buttons($plugin_array) {
	$plugin_array['lair'] = get_template_directory_uri().'/js/lair-mce-plugin.js';
	return $plugin_array;
}
function lair_register_buttons($buttons) {
	$buttons[] = 'blue-line';
	$buttons[] = 'gray';
	$buttons[] = 'cod-excerpt';

	return $buttons;
}