<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://jefferykarbowski.com
 * @since      1.0.0
 *
 * @package    Mako_Reservations
 * @subpackage Mako_Reservations/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Mako_Reservations
 * @subpackage Mako_Reservations/public
 * @author     Jeffery Karbowski <jefferykarbowski@gmail.com>
 */
class Mako_Reservations_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mako-reservations-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mako-reservations-public.js', array( 'jquery', 'thickbox' ), $this->version, true );
	}


    /**
     * @return string
     */
    public function add_mako_calendars_css()
    {
        $background = get_field('background', 'option');
        $background_hover = get_field('background_hover', 'options');
        $text_color = get_field('text_color', 'options');
        $show_box_shadow = get_field('show_box_shadow', 'options');
        $box_shadow_size = get_field('box_shadow_size', 'options');
        $box_shadow_color = get_field('box_shadow_color', 'options');
        $show_border = get_field('show_border', 'options');
        $border_size = get_field('border_size', 'options');
        $border_color = get_field('border_color', 'options');
        $border_radius = get_field('border_radius', 'options');
        // var_dump($show_border);
        ?>
        <script src=""></script>
        <style type="text/css">
            .btn-mako-book-now {
                background: <?php echo $background; ?>;
                color: <?php echo $text_color; ?>;
            <?php
                echo ($show_box_shadow ? 'box-shadow:' . $box_shadow_size . 'px ' . $box_shadow_size . 'px ' . $box_shadow_size . 'px ' . $box_shadow_color .';' : '');
                echo ($show_border ? 'border:' . $border_size . 'px solid ' . $border_color . '; border-radius:' . $border_radius .'px' : '');
?>
            }
            .btn-mako-book-now:hover {
                background:   <?php echo $background_hover; ?>;
            }
            .btn-mako-book-now svg {
                fill: <?php echo $text_color; ?>
            }
        </style>
        <?php
    }



	public function add_mako_calendars() {
        add_thickbox();
	    // First Look For Page Specific Calendars
        $args = array(
            'post_type'		=> 'mako_calendar',
            'posts_per_page'	=> 1,
            'meta_query'		=> array(
                array(
                    'key' => 'show_on_page',
                    'value' => '"' . get_the_ID() . '"',
                    'compare' => 'LIKE'
                )
            )
        );
        $wp_query = new WP_Query( $args );
        $count = $wp_query->found_posts;
        if ($count > 0) {
            //echo 'Page Specific Calendar Found';
        } else {
            // Look for Show Everywhere Calendar
            $args = array(
                'post_type'		=> 'mako_calendar',
                'posts_per_page'	=> 1,
                'meta_query'		=> array(
                    array(
                        'key' => 'show_everywhere',
                        'value' => '1'
                    )
                )
            );
            $wp_query = new WP_Query( $args );
            $count = $wp_query->found_posts;
            if ($count > 0) {
                //echo 'Show Everywhere Calendar Found';
            }
        }
        while( $wp_query->have_posts() ) {
            $wp_query->the_post();
            $calendar_id = get_field('id');
            $calendar_key = get_field('key');
            include plugin_dir_path( __FILE__ ) . 'partials/mako-reservations-public-display.php';
        }
    }


}
