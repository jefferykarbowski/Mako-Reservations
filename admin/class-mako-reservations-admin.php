<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://jefferykarbowski.com
 * @since      1.0.0
 *
 * @package    Mako_Reservations
 * @subpackage Mako_Reservations/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mako_Reservations
 * @subpackage Mako_Reservations/admin
 * @author     Jeffery Karbowski <jefferykarbowski@gmail.com>
 */
class Mako_Reservations_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mako-reservations-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mako-reservations-admin.js', array( 'acf-input', 'jquery' ), $this->version, true );

	}


    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function button_preview_message($field) {
        global $post;

         $field['message'] = '<a class="btn-mako-book-now" style="display: none" href="#">Book Now <svg width="32" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M21 11c0-.552-.448-1-1-1s-1 .448-1 1c0 .551.448 1 1 1s1-.449 1-1m3 .486c-1.184 2.03-3.29 4.081-5.66 5.323-1.336-1.272-2.096-2.957-2.103-4.777-.008-1.92.822-3.704 2.297-5.024 2.262.986 4.258 2.606 5.466 4.478m-6.63 5.774c-.613.255-1.236.447-1.861.573-1.121 1.348-2.796 2.167-5.287 2.167-.387 0-.794-.02-1.222-.061.647-.882.939-1.775 1.02-2.653-2.717-1.004-4.676-2.874-6.02-4.287-1.038 1.175-2.432 2-4 2 1.07-1.891 1.111-4.711 0-6.998 1.353.021 3.001.89 4 1.999 1.381-1.2 3.282-2.661 6.008-3.441-.1-.828-.399-1.668-1.008-2.499.429-.04.837-.06 1.225-.06 2.467 0 4.135.801 5.256 2.128.68.107 1.357.272 2.019.495-1.453 1.469-2.271 3.37-2.263 5.413.008 1.969.773 3.799 2.133 5.224"/></svg></a>';
         return $field;
    }


    /**
     * Register the post type.
     *
     * @since    1.0.0
     */
    public function mako_reservations_cpt() {


        $labels = array(
            'name'                  => _x( 'Mako Calendars', 'Post Type General Name', 'mako_reservations' ),
            'singular_name'         => _x( 'Mako Calendar', 'Post Type Singular Name', 'mako_reservations' ),
            'menu_name'             => __( 'Mako Calendars', 'mako_reservations' ),
            'name_admin_bar'        => __( 'Mako Calendar', 'mako_reservations' ),
            'archives'              => __( 'Mako Calendar Archives', 'mako_reservations' ),
            'attributes'            => __( 'Mako Calendar Attributes', 'mako_reservations' ),
            'parent_item_colon'     => __( 'Parent Calendar:', 'mako_reservations' ),
            'all_items'             => __( 'All Mako Calendars', 'mako_reservations' ),
            'add_new_item'          => __( 'Add New Mako Calendar', 'mako_reservations' ),
            'add_new'               => __( 'Add New', 'mako_reservations' ),
            'new_item'              => __( 'New Mako Calendar', 'mako_reservations' ),
            'edit_item'             => __( 'Edit Mako Calendar', 'mako_reservations' ),
            'update_item'           => __( 'Update Mako Calendar', 'mako_reservations' ),
            'view_item'             => __( 'View Mako Calendar', 'mako_reservations' ),
            'view_items'            => __( 'View Mako Calendars', 'mako_reservations' ),
            'search_items'          => __( 'Search Mako Calendars', 'mako_reservations' ),
            'not_found'             => __( 'Not found', 'mako_reservations' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'mako_reservations' ),
            'featured_image'        => __( 'Featured Image', 'mako_reservations' ),
            'set_featured_image'    => __( 'Set featured image', 'mako_reservations' ),
            'remove_featured_image' => __( 'Remove featured image', 'mako_reservations' ),
            'use_featured_image'    => __( 'Use as featured image', 'mako_reservations' ),
            'insert_into_item'      => __( 'Insert into Calendar', 'mako_reservations' ),
            'uploaded_to_this_item' => __( 'Uploaded to this Calendar', 'mako_reservations' ),
            'items_list'            => __( 'Mako Calendars list', 'mako_reservations' ),
            'items_list_navigation' => __( 'Mako Calendars list navigation', 'mako_reservations' ),
            'filter_items_list'     => __( 'Filter Calendars list', 'mako_reservations' ),
        );
        $args   = array(
            'label'               => __( 'Mako Calendars', 'mako_reservations' ),
            'description'         => __( 'Mako Calendar Manager', 'mako_reservations' ),
            'labels'              => $labels,
            'supports'            => array( 'title'),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-calendar-alt',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => true,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'capabilities' => array(
                'edit_post'          => 'update_core',
                'read_post'          => 'update_core',
                'delete_post'        => 'update_core',
                'edit_posts'         => 'update_core',
                'edit_others_posts'  => 'update_core',
                'delete_posts'       => 'update_core',
                'publish_posts'      => 'update_core',
                'read_private_posts' => 'update_core'
            ),
        );
        register_post_type( 'mako_calendar', $args );

    }


    public function add_acf_options_page() {

        acf_add_options_sub_page(array(
            'page_title' 	=> 'Settings',
            'menu_title'	=> 'Settings',
            'parent_slug'	=> 'edit.php?post_type=mako_calendar',
        ));

    }


    public function add_acf_fields() {

        if( function_exists('acf_add_local_field_group') ):

            acf_add_local_field_group(array(
                'key' => 'group_5f8198de763b5',
                'title' => 'Mako Reservations',
                'fields' => array(
                    array(
                        'key' => 'field_5f8198ec4ec85',
                        'label' => 'Calendar ID',
                        'name' => 'id',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5f81991f4ec86',
                        'label' => 'Calendar Key',
                        'name' => 'key',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5f8199464ec87',
                        'label' => 'Show On Page',
                        'name' => 'show_on_page',
                        'type' => 'post_object',
                        'instructions' => 'Choose the pages or posts that you would like your calendar to show.',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5f8199ae4ec88',
                                    'operator' => '!=',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'post_type' => '',
                        'taxonomy' => '',
                        'allow_null' => 1,
                        'multiple' => 1,
                        'return_format' => 'id',
                        'ui' => 1,
                    ),
                    array(
                        'key' => 'field_5f8199ae4ec88',
                        'label' => 'Show Everywhere',
                        'name' => 'show_everywhere',
                        'type' => 'true_false',
                        'instructions' => 'Show Calendar on all pages and posts',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui' => 1,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'mako_calendar',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ));


            acf_add_local_field_group(array(
                'key' => 'group_5f87a1187237f',
                'title' => 'Button Styling Options',
                'fields' => array(
                    array(
                        'key' => 'field_5f819b974ec91',
                        'label' => 'Background',
                        'name' => 'background',
                        'type' => 'color_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '33',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '#FF0000',
                    ),
                    array(
                        'key' => 'field_5f819bb54ec92',
                        'label' => 'Background Hover',
                        'name' => 'background_hover',
                        'type' => 'color_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '33',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '#e3ad31',
                    ),
                    array(
                        'key' => 'field_5f819bd24ec93',
                        'label' => 'Text Color',
                        'name' => 'text_color',
                        'type' => 'color_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '28',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '#FFFFFF',
                    ),
                    array(
                        'key' => 'field_5f819a1c4ec8a',
                        'label' => 'Show Box Shadow',
                        'name' => 'show_box_shadow',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui' => 1,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_5f819a434ec8b',
                        'label' => 'Box Shadow Size',
                        'name' => 'box_shadow_size',
                        'type' => 'range',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5f819a1c4ec8a',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'min' => 1,
                        'max' => 50,
                        'step' => '',
                        'prepend' => '',
                        'append' => 'px',
                    ),
                    array(
                        'key' => 'field_5f819a8c4ec8c',
                        'label' => 'Box Shadow Color',
                        'name' => 'box_shadow_color',
                        'type' => 'color_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5f819a1c4ec8a',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '#999999',
                    ),
                    array(
                        'key' => 'field_5f819b044ec8d',
                        'label' => 'Show Border',
                        'name' => 'show_border',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui' => 1,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_5f819b184ec8e',
                        'label' => 'Border Size',
                        'name' => 'border_size',
                        'type' => 'range',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5f819b044ec8d',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '33',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'min' => 1,
                        'max' => 10,
                        'step' => '',
                        'prepend' => '',
                        'append' => 'px',
                    ),
                    array(
                        'key' => 'field_5f819b474ec8f',
                        'label' => 'Border Color',
                        'name' => 'border_color',
                        'type' => 'color_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5f819b044ec8d',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '33',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '#999999',
                    ),
                    array(
                        'key' => 'field_5f819b694ec90',
                        'label' => 'Border Radius',
                        'name' => 'border_radius',
                        'type' => 'range',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5f819b044ec8d',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '33',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'min' => '',
                        'max' => 50,
                        'step' => '',
                        'prepend' => '',
                        'append' => '%',
                    ),
                    array(
                        'key' => 'field_5f819c545ea9e',
                        'label' => 'Button Preview',
                        'name' => '',
                        'type' => 'message',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '30',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '<a class="btn-mako-book-now" style="display: none" href="#">Book Now <svg width="32" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M21 11c0-.552-.448-1-1-1s-1 .448-1 1c0 .551.448 1 1 1s1-.449 1-1m3 .486c-1.184 2.03-3.29 4.081-5.66 5.323-1.336-1.272-2.096-2.957-2.103-4.777-.008-1.92.822-3.704 2.297-5.024 2.262.986 4.258 2.606 5.466 4.478m-6.63 5.774c-.613.255-1.236.447-1.861.573-1.121 1.348-2.796 2.167-5.287 2.167-.387 0-.794-.02-1.222-.061.647-.882.939-1.775 1.02-2.653-2.717-1.004-4.676-2.874-6.02-4.287-1.038 1.175-2.432 2-4 2 1.07-1.891 1.111-4.711 0-6.998 1.353.021 3.001.89 4 1.999 1.381-1.2 3.282-2.661 6.008-3.441-.1-.828-.399-1.668-1.008-2.499.429-.04.837-.06 1.225-.06 2.467 0 4.135.801 5.256 2.128.68.107 1.357.272 2.019.495-1.453 1.469-2.271 3.37-2.263 5.413.008 1.969.773 3.799 2.133 5.224"/></svg></a>',
                        'new_lines' => 'wpautop',
                        'esc_html' => 0,
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'acf-options-settings',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ));




        endif;

    }



}
