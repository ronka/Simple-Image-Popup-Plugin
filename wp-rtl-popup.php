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

        // load assets files 
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_popup_scripts') );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_popup_styles') );
    }

    /**
     * load css files
     *
     * @return void
     */
    public function enqueue_popup_styles(){
        wp_enqueue_style( 'wprtl-popup', plugin_dir_url( __FILE__ ) . 'style.css', array(), '1.0');
    }

    /**
     * load js files
     *
     * @return void
     */
    public function enqueue_popup_scripts(){
        wp_enqueue_script( 'wprtl-popup', plugin_dir_url( __FILE__ ) . 'scripts.js', array('jquery'), '1.0');
    }

    /**
     * Add popup settings page to the customizer page
     *
     * @param WP_Customize_Manager $wp_customize
     * @return void
     */
    public function add_customizer_controllers($wp_customize){
        // Global theme settings
        $wp_customize->add_section("wp-rtl-popup", array(
            "title" => __('Popup Settings', 'wp-rtl-popup'),
            "priority" => 30,
        ));
        // Add control and output for select field
        $wp_customize->add_setting("wp-rtl-popup--checkbox");
        $wp_customize->add_control("wp-rtl-popup--checkbox", array(
            'label' => __('Enable popup', 'wp-rtl-popup'),
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
        // Popup url
        $wp_customize->add_setting("wp-rtl-popup--url");
        $wp_customize->add_control("wp-rtl-popup--url", array(
            'label' => __('Popup URL', 'wp-rtl-popup'),
            'section' => 'wp-rtl-popup',
            'description' => __('On click redirect user to the given url, not required', 'wp-rtl-popup'),
            'settings' => 'wp-rtl-popup--url',
            'type' => 'url'
        ));
    }

    /**
     * Load popup view in footer if popup is enabled
     *
     * @return void
     */
    public function get_popup_view(){
        if( get_theme_mod('wp-rtl-popup--checkbox', false) ){
            require_once( plugin_dir_path(__FILE__) . 'wp-rtl-popup-view.php' );
        }
    }

}


new WP_RTL_Popup();