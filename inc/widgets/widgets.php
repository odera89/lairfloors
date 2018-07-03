<?php

include 'image-widget.php';
include 'shortcode-widget.php';
include 'home-text-widget.php';
include 'home-blue-widget.php';
include 'home-products-list.php';
include 'text-css-class.php';
include 'slider-widget.php';
include 'video-widget.php';
include 'blue-widget.php';
include 'ballet-colors.php';


function register_lair_widgets() {
    register_widget('Lair_Image_Widget');
    register_widget('Lair_Shortcode_Widget');
    register_widget('Lair_Home_Text_Widget');
    register_widget('Lair_Home_Blue_Widget');
    register_widget('Lair_Home_Product_List_Widget');
    register_widget('Lair_Blue_Widget');
    register_widget('Lair_Slider_Widget');
    register_widget('Lair_Video_Widget');
    register_widget('Lair_Text_CSS_Class');
    register_widget('Lair_Ballet_Colors');
}
add_action('widgets_init', 'register_lair_widgets');


function lair_add_admin_media_script() {
	wp_enqueue_media();
}
add_action('admin_head', 'lair_add_admin_media_script');


