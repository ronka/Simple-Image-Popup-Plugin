<?php
/**
 * Plugin Name:       WP-RTL - Popup
 * Description:       תוסף פשוט להקפצת פופאפ עם תמונה וקישור
 * Version:           1.0.0
 * Author:            WP-RTL.co.il
 * Author URI:        http://wp-rtl.co.il
 * Text Domain:       wp-rtl-popup
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: #
 */

class WP_RTL_Popup
{
    public function __construct(){
        // add settings page to customizer
        add_action( 'customize_register', array( $this, 'add_customizer_controllers') );

        // load popup view in footer
        add_action( 'wp_footer', array( $this, 'get_popup_view' ) );
    }

    public function add_customizer_controllers($wp_customize){
        // Global theme settings
        $wp_customize->add_section("wp-rtl-popup", array(
            "title" => __('Popup Settings', 'wp-rtl-popup'),
            "priority" => 30,
        ));
        // Add control and output for select field
        $wp_customize->add_setting("wp-rtl-popup--checkbox");
        $wp_customize->add_control("wp-rtl-popup--checkbox", array(
            'label' => __('Enable popup'),
            'section' => 'wp-rtl-popup',
            'settings' => 'wp-rtl-popup--checkbox',
            'type' => 'checkbox'
        ));
        // Popup image
        $wp_customize->add_setting("wp-rtl-popup--image");
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "wp-rtl-popup--image", array(
            "label" => __('Image', 'wp-rtl-popup'),
            "section" => "wp-rtl-popup",
            "settings" => "wp-rtl-popup--image"
        )));
        
    }

    public function get_popup_view(){
        require_once( plugin_dir_path('/') . 'wp-rtl-popup-view.php' );
    }

}


new WP_RTL_Popup();