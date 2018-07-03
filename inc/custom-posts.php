<?php

add_action('init', 'lair_create_post_type');
function lair_create_post_type() {
	register_post_type('accessories', array(
		'labels' => array(
			'name' => __('Accessories'),
			'singular_name' => __('Accessory'),
		),
		'public' => true,
		'has_archive' => true,
		'menu_position' => 5,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
		),
	));
	register_post_type('product', array(
		'labels' => array(
			'name' => __('Products'),
			'singular_name' => __('Product'),
		),
		'public' => true,
		'has_archive' => true,
		'menu_position' => 6,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
		),
	));
}


function lair_column_add($post) {

	// Use nonce for verification
	wp_nonce_field(plugin_basename(__FILE__), 'myplugin_noncename');

	// The actual fields for data entry
	// Use get_post_meta to retrieve an existing value from the database and use the value for the form
	$value1 = get_post_meta($post->ID, 'title_extra1', true);
	$value2 = get_post_meta($post->ID, 'title_extra2', true);
	// echo '<label for="post_subtitle">Small Title</label> ';
?>

	<div>
		<label for="post_title_extra1">First line under title</label>
		<input class="regular-text" type="text" name="post_title_extra1" value="<?php echo esc_attr($value1) ?>" />
	</div>
	<div>
		<label for="post_title_extra2">Second line under title</label>
		<input class="regular-text" type="text" name="post_title_extra2" value="<?php echo esc_attr($value2) ?>" />
	</div>

<?php
}

function lair_add_post_meta() {
	add_meta_box('lair_column_extra', 'Product title extra', 'lair_column_add', 'product', 'normal', 'high');
	add_meta_box('lair_column_extra', 'Accesories title extra', 'lair_column_add', 'accessories', 'normal', 'high');
}
add_action('add_meta_boxes', 'lair_add_post_meta');


function lair_save_posts_meta($post_id, $post) {

	// First we need to check if the current user is authorised to do this action.
	if ('post' == $_REQUEST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return;
		}
	} else {
		if (!current_user_can('edit_post', $post_id)) {
			return;
		}
	}

	// Secondly we need to check if the user intended to change this value.
	if (!isset($_POST['myplugin_noncename']) || !wp_verify_nonce($_POST['myplugin_noncename'], plugin_basename(__FILE__))) {
		return;
	}

	// Thirdly we can save the value to the database

	//if saving in a custom table, get post_ID
	$post_ID = $_POST['post_ID'];
	//sanitize user input
	$value1 = $_POST['post_title_extra1'];

	add_post_meta($post_ID, 'title_extra1', $value1, true) or
	update_post_meta($post_ID, 'title_extra1', $value1);

	//sanitize user input
	$value2 = $_POST['post_title_extra2'];

	add_post_meta($post_ID, 'title_extra2', $value2, true) or
	update_post_meta($post_ID, 'title_extra2', $value2);
}
add_action('save_post', 'lair_save_posts_meta', 1, 2); // save the custom fields
