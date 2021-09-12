<?php

function ourlabtheme_scripts(){
    //theme style
    wp_enqueue_style( 'ourlabtheme-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );

    //bootstrap
    wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array(), '5.0.2' );
    wp_enqueue_script( 'popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', array('jquery'), '2.9.2',true);
    wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', array('jquery'), '4.0.0',true);
}
add_action( 'wp_enqueue_scripts', 'ourlabtheme_scripts' );

function ourlabtheme_setup(){
    /*
     * Add support for core custom logo.
     * @link https://codex.wordpress.org/Theme_Logo
     */
    $logo_width  = 95;
    $logo_height = 47;

    add_theme_support(
        'custom-logo',
        array(
            'height'               => $logo_height,
            'width'                => $logo_width,
            'flex-width'           => true,
            'flex-height'          => true,
            'unlink-homepage-logo' => true,
        )
    );

    add_theme_support('custom-header');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form'));

    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );

    // Add custom editor font sizes.
    add_theme_support(
        'editor-font-sizes',
        array(
            array(
                'name'      => esc_html__( 'Extra small', 'ourlabtheme' ),
                'shortName' => esc_html_x( 'XS', 'Font size', 'ourlabtheme' ),
                'size'      => 16,
                'slug'      => 'extra-small',
            ),
            array(
                'name'      => esc_html__( 'Small', 'ourlabtheme' ),
                'shortName' => esc_html_x( 'S', 'Font size', 'ourlabtheme' ),
                'size'      => 18,
                'slug'      => 'small',
            ),
            array(
                'name'      => esc_html__( 'Normal', 'ourlabtheme' ),
                'shortName' => esc_html_x( 'M', 'Font size', 'ourlabtheme' ),
                'size'      => 20,
                'slug'      => 'normal',
            ),
            array(
                'name'      => esc_html__( 'Large', 'ourlabtheme' ),
                'shortName' => esc_html_x( 'L', 'Font size', 'ourlabtheme' ),
                'size'      => 24,
                'slug'      => 'large',
            ),
            array(
                'name'      => esc_html__( 'Extra large', 'ourlabtheme' ),
                'shortName' => esc_html_x( 'XL', 'Font size', 'ourlabtheme' ),
                'size'      => 40,
                'slug'      => 'extra-large',
            ),
            array(
                'name'      => esc_html__( 'Huge', 'ourlabtheme' ),
                'shortName' => esc_html_x( 'XXL', 'Font size', 'ourlabtheme' ),
                'size'      => 96,
                'slug'      => 'huge',
            ),
            array(
                'name'      => esc_html__( 'Gigantic', 'ourlabtheme' ),
                'shortName' => esc_html_x( 'XXXL', 'Font size', 'ourlabtheme' ),
                'size'      => 144,
                'slug'      => 'gigantic',
            ),
        )
    );

    // Editor color palette.
    $black     = '#000000';
    $dark_gray = '#28303D';
    $gray      = '#39414D';
    $green     = '#D1E4DD';
    $blue      = '#D1DFE4';
    $purple    = '#D1D1E4';
    $red       = '#E4D1D1';
    $orange    = '#E4DAD1';
    $yellow    = '#EEEADD';
    $white     = '#FFFFFF';

    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name'  => esc_html__( 'Black', 'ourlabtheme' ),
                'slug'  => 'black',
                'color' => $black,
            ),
            array(
                'name'  => esc_html__( 'Dark gray', 'ourlabtheme' ),
                'slug'  => 'dark-gray',
                'color' => $dark_gray,
            ),
            array(
                'name'  => esc_html__( 'Gray', 'ourlabtheme' ),
                'slug'  => 'gray',
                'color' => $gray,
            ),
            array(
                'name'  => esc_html__( 'Green', 'ourlabtheme' ),
                'slug'  => 'green',
                'color' => $green,
            ),
            array(
                'name'  => esc_html__( 'Blue', 'ourlabtheme' ),
                'slug'  => 'blue',
                'color' => $blue,
            ),
            array(
                'name'  => esc_html__( 'Purple', 'ourlabtheme' ),
                'slug'  => 'purple',
                'color' => $purple,
            ),
            array(
                'name'  => esc_html__( 'Red', 'ourlabtheme' ),
                'slug'  => 'red',
                'color' => $red,
            ),
            array(
                'name'  => esc_html__( 'Orange', 'ourlabtheme' ),
                'slug'  => 'orange',
                'color' => $orange,
            ),
            array(
                'name'  => esc_html__( 'Yellow', 'ourlabtheme' ),
                'slug'  => 'yellow',
                'color' => $yellow,
            ),
            array(
                'name'  => esc_html__( 'White', 'ourlabtheme' ),
                'slug'  => 'white',
                'color' => $white,
            ),
        )
    );

    /*
     * Create Secondary Logo Setting and Upload Control
     */
    add_action('customize_register', function ($wp_customize) {
        $wp_customize->add_setting('secondary_theme_logo');
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'secondary_theme_logo',
                [
                    'label' => __( 'Upload Secondary Logo', 'ourlabtheme' ),
                    'description' => __( 'Secondary logo shown on the right side of the header', 'ourlabtheme' ),
                    'section' => 'title_tagline',
                    'settings' => 'secondary_theme_logo',
                ]
            )
        );
    });

    /*
     * Register menus
     */
    register_nav_menus(
        array(
            'primary' => esc_html__( 'Primary menu', 'ourlabtheme' )
        )
    );

    add_filter('nav_menu_css_class', function ($classes, $item, $args) {
        if(isset($args->item_class)) {
            $classes[] = $args->item_class;
        }
        return $classes;
    }, 1, 3);

    add_filter( 'nav_menu_link_attributes', function ( $atts, $item, $args ) {
        if(isset($args->link_class)) {
            $atts['class'] = $args->link_class;
        }
        return $atts;
    }, 1, 3 );

	/*
     * Change default exerpt
     */
    add_filter( 'excerpt_more', function ($more) {
        return "... <small class='mx-1'><a href=". get_the_permalink() ." class='link-secondary'>Read more</a></small>";
    }, 1, 3 );

    /*
     * Register Sidebar
     */
    register_sidebar(
        array(
            'name'          => 'Blog',
            'id'            => 'blog',
            'description'   => 'Blog Sidebar',
            'before_widget' => '<div class="widget-wrapper blog-wrapper">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
}
add_action( 'after_setup_theme', 'ourlabtheme_setup' );

//POST TYPES
include_once 'inc/post-types/people.php';
include_once 'inc/post-types/publications.php';
include_once 'inc/post-types/research.php';