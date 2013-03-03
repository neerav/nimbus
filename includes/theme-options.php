<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 */
class NimbusOptions
{

    /**
     * Registers the settings with WordPress.
     *
     * Used by hook: 'customize_register'
     *
     * @see add_action('customize_register',$func)
     * @param WP_Customize_Manager $wp_customize
     */
    public static function nimbus_register( $wp_customize )
    {
        /**
         * Theme Option Defaults
         */

        // Layout Default
        $wp_customize->add_setting( 'nimbus_theme_options[theme_layout]', array(
            'type'              => 'option',
            'default'           => 'sidebar-content',
            'sanitize_callback' => 'sanitize_key',
        ) );

        // Typography Default
        $wp_customize->add_setting( 'nimbus_theme_options[theme_typography]', array(
            'type'              => 'option',
            'default'           => 'open-sans',
            'sanitize_callback' => 'sanitize_key',
        ) );

        // Link Color Default
        $wp_customize->add_setting('link_textcolor', array(
                'default'   => '#49a0a0',
        ) );

        // Heading Color Default
        $wp_customize->add_setting('headercolor', array(
                'default'   => '#aaaaaa',
        ) );

        // Text Color Default
        $wp_customize->add_setting('textcolor', array(
                'default'   => '#666666',
        ) );

        // Background Color Default
        $wp_customize->add_setting('background_color', array(
                'default'   => '#2b2b2b',
        ) );


        /**
         * Theme Option Sections
         */

        // Navigation Section
        $wp_customize->add_section( 'nav', array(
             'title'          => __( 'Navigation' ),
             'theme_supports' => 'menus',
             'priority'       => 100,
        ) );

        // Layout Section
        $wp_customize->add_section( 'nimbus_layout', array(
            'title'    => __( 'Layout', 'nimbus' ),
            'priority' => 50,
        ) );

        // Typography Section
        $wp_customize->add_section( 'nimbus_typography', array(
            'title'    => __( 'Typography', 'nimbus' ),
            'priority' => 60,
        ) );


        /**
         * Theme Option Controls
         */

        // Link Color Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_textcolor', array(
                'label'      => __( 'Link Color', 'nimbus' ),
                'section'    => 'colors',
                'settings'   => 'link_textcolor',
        ) ) );

        // Heading Color Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'headercolor', array(
                'label'      => __( 'Header Color', 'nimbus' ),
                'section'    => 'colors',
                'settings'   => 'headercolor',
        ) ) );

        // Text Color Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'textcolor', array(
                'label'      => __( 'Text Color', 'nimbus' ),
                'section'    => 'colors',
                'settings'   => 'textcolor',
        ) ) );

        // Background Color Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
                'label'      => __( 'Background Color', 'nimbus' ),
                'section'    => 'colors',
                'settings'   => 'background_color',
        ) ) );

        // Layout Control
        $layouts = nimbus_layouts();
        $choices = array();
        foreach ( $layouts as $layout ) {
            $choices[$layout['value']] = $layout['label'];
        }
        $wp_customize->add_control( 'nimbus_theme_options[theme_layout]', array(
            'section'    => 'nimbus_layout',
            'type'       => 'radio',
            'choices'    => $choices,
        ) );

        // Typography Control
        $typography_options = nimbus_typography();
        $choices = array();
        foreach ( $typography_options as $typography_option ) {
            $choices[$typography_option['value']] = $typography_option['label'];
        }
        $wp_customize->add_control( 'nimbus_theme_options[theme_typography]', array(
            'section'    => 'nimbus_typography',
            'type'       => 'radio',
            'choices'    => $choices,
        ) );
    }


    /**
     * This will output the custom WordPress settings to the theme's WP head.
     *
     * Used by hook: 'wp_head'
     *
     * @see add_action('wp_head',$func)
     */
    public static function nimbus_render()
    {
        ?>
        <!--Customizer CSS-->
        <style type="text/css">
                <?php
                    // Link color applied to color
                    self::generate_css( 'a, .format-image .post-header h1:before, .format-link .post-header h1:before, .format-video .post-header h1:before, .format-status .post-header h1:before, .format-gallery .post-header h1:before, .format-audio .post-header h1:before', 'color', 'link_textcolor' );

                    // Link color applied to background
                    self::generate_css( 'body:before, body:after, input[type="submit"], .button', 'background', 'link_textcolor' );

                    // Text color applied to color
                    self::generate_css( 'body', 'color', 'textcolor' );

                    // Text color applied to background
                    self::generate_css( 'hr, ul.menu li.current-menu-item a:before', 'background', 'textcolor' );

                    // Header color applied to color
                    self::generate_css( 'h1, h2, h3, h4, h5, h6, .alpha, .beta, .gamma, .delta, .comments .comment-author cite a, .comments .comment-author cite', 'color', 'headercolor' );

                    // Header color applied to background
                    self::generate_css( 'input[type="text"], textarea', 'background', 'headercolor' );

                    // Background color applied to color
                    self::generate_css( 'input[type="submit"], .button, input[type="text"], textarea', 'color', 'background_color', '#' );

                    // Background color applied to background
                    self::generate_css( 'html', 'background-color', 'background_color', '#' );
                ?>
                @media only screen and (min-width: 768px) {
                    /* Styles only applied to desktop */
                    <?php
                        // Background color applied to color
                        self::generate_css( 'ul.menu ul li a', 'color', 'background_color', '#' );

                        // Link color applied to background
                        self::generate_css( 'ul.menu ul', 'background', 'link_textcolor' );

                        // Text color applied to border-color
                        self::generate_css( '.header .logo a img, .header .logo a span', 'border-color', 'textcolor' );
                    ?>
                }
        </style>
        <!--/Customizer CSS-->
        <?php
    }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     *
     * A custom helper function used within this class to keep code clean.
     *
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS property to modify
     * @param string $mod_name The name of the theme_mod option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since Nimbus 0.1.1
     */
    public static function generate_css($selector,$style,$mod_name,$prefix='',$postfix='',$echo=true)
    {
        $return = '';
        $mod = get_theme_mod($mod_name);
        if ( ! empty( $mod ) )
        {
            $return = sprintf('%s { %s:%s; }',
                $selector,
                $style,
                $prefix.$mod.$postfix
            );
            if ( $echo )
            {
                echo $return;
            }
        }
        return $return;
    }

}
add_action( 'customize_register'    , array( 'NimbusOptions' , 'nimbus_register' ) );
add_action( 'wp_head'               , array( 'NimbusOptions' , 'nimbus_render' ) );

$args = array(
    'default-color' => '2b2b2b',
);
add_theme_support( 'custom-background', $args );


/**
 * Returns the options array for Nimbus.
 *
 * @since Nimbus 0.3
 */
function nimbus_get_theme_options() {
    return get_option( 'nimbus_theme_options', nimbus_get_default_theme_options() );
}


/**
 * Returns the default options for Nimbus.
 *
 * @since Nimbus 0.3
 */
function nimbus_get_default_theme_options() {
    $default_theme_options = array(
        'theme_layout'      => 'sidebar-content',
        'theme_typography'  => 'open-sans'
    );

    if ( is_rtl() )
        $default_theme_options['theme_layout'] = 'content-sidebar';

    return apply_filters( 'nimbus_default_theme_options', $default_theme_options );
}


/**
 * Returns an array of layout options registered for Nimbus.
 *
 * @since Nimbus 0.3
 */
function nimbus_layouts() {
    $layout_options = array(
        'sidebar-content' => array(
            'value' => 'sidebar-content',
            'label' => __( 'Content on right', 'nimbus' ),
        ),
        'content-sidebar' => array(
            'value' => 'content-sidebar',
            'label' => __( 'Content on left', 'nimbus' ),
        ),
        /*
        No 'no sidebar' option for now
        'content' => array(
            'value' => 'nosidebar',
            'label' => __( 'One-column, no sidebar', 'nimbus' ),
        ),*/
    );

    return apply_filters( 'nimbus_layouts', $layout_options );
}


/**
 * Adds Nimbus layout classes to the array of body classes.
 *
 * @since Nimbus 0.3
 */
function nimbus_layout_classes( $existing_classes ) {
    $options = nimbus_get_theme_options();
    $current_layout = $options['theme_layout'];

    if ( in_array( $current_layout, array( 'content-sidebar', 'sidebar-content' ) ) )
        $classes = array( 'two-column' );
    else
        $classes = array( 'one-column' );

    if ( 'content-sidebar' == $current_layout )
        $classes[] = 'content-sidebar';
    elseif ( 'sidebar-content' == $current_layout )
        $classes[] = 'sidebar-content';
    else
        $classes[] = $current_layout;

    $classes = apply_filters( 'nimbus_layout_classes', $classes, $current_layout );

    return array_merge( $existing_classes, $classes );
}
add_filter( 'body_class', 'nimbus_layout_classes' );


/**
 * Returns an array of typography options registered for Nimbus.
 *
 * @since Nimbus 0.3
 */
function nimbus_typography() {
    $typography_options = array(
        'open-sans' => array(
            'value' => 'open-sans',
            'label' => __( 'Open Sans', 'nimbus' ),
        ),
        'helvetica' => array(
            'value' => 'helvetica',
            'label' => __( 'Helvetica', 'nimbus' ),
        ),
        'georgia' => array(
            'value' => 'georgia',
            'label' => __( 'Georgia', 'nimbus' ),
        ),
    );

    return apply_filters( 'nimbus_typography', $typography_options );
}

/**
 * Adds Nimbus typography classes to the array of body classes.
 *
 * @since Nimbus 0.3
 */
function nimbus_typography_classes( $existing_classes ) {
    $options = nimbus_get_theme_options();
    $current_typography = $options['theme_typography'];

    if ( 'open-sans' == $current_typography )
        $classes[] = 'open-sans';
    elseif ( 'helvetica' == $current_typography )
        $classes[] = 'helvetica';
    elseif ( 'georgia' == $current_typography )
        $classes[] = 'georgia';
    else
        $classes[] = $current_typography;

    $classes = apply_filters( 'nimbus_typography_classes', $classes, $current_typography );

    return array_merge( $existing_classes, $classes );
}
add_filter( 'body_class', 'nimbus_typography_classes' );
