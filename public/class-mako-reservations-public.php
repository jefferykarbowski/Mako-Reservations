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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mako-reservations-public.js', array( 'jquery' ), $this->version, false );

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
            ?>
            <div class="mako-book-now">
            <a class="btn-mako-book-now thickbox" href="https://staging.makoreservations.com/mako-app/light-frame/select/<?php echo $calendar_key; ?>/<?php echo $calendar_id; ?>/?TB_iframe=true&width=600&height=550">Book Now <svg width="32" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M21 11c0-.552-.448-1-1-1s-1 .448-1 1c0 .551.448 1 1 1s1-.449 1-1m3 .486c-1.184 2.03-3.29 4.081-5.66 5.323-1.336-1.272-2.096-2.957-2.103-4.777-.008-1.92.822-3.704 2.297-5.024 2.262.986 4.258 2.606 5.466 4.478m-6.63 5.774c-.613.255-1.236.447-1.861.573-1.121 1.348-2.796 2.167-5.287 2.167-.387 0-.794-.02-1.222-.061.647-.882.939-1.775 1.02-2.653-2.717-1.004-4.676-2.874-6.02-4.287-1.038 1.175-2.432 2-4 2 1.07-1.891 1.111-4.711 0-6.998 1.353.021 3.001.89 4 1.999 1.381-1.2 3.282-2.661 6.008-3.441-.1-.828-.399-1.668-1.008-2.499.429-.04.837-.06 1.225-.06 2.467 0 4.135.801 5.256 2.128.68.107 1.357.272 2.019.495-1.453 1.469-2.271 3.37-2.263 5.413.008 1.969.773 3.799 2.133 5.224"/></svg></a></div>
            <?php
        }
    }


}
