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
    public static function register( $wp_customize )
    {
        $wp_customize->add_setting('link_textcolor', array(
                'default'   => '#49a0a0',
        ) );
        $wp_customize->add_setting('headercolor', array(
                'default'   => '#aaaaaa',
        ) );
        $wp_customize->add_setting('textcolor', array(
                'default'   => '#666666',
        ) );
        $wp_customize->add_setting('background_color', array(
                'default'   => '#2b2b2b',
        ) );
        $wp_customize->remove_section('static_front_page');
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_textcolor', array(
                'label'      => __( 'Link Color', 'nimbus' ),
                'section'    => 'colors',
                'settings'   => 'link_textcolor',
        ) ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'headercolor', array(
                'label'      => __( 'Header Color', 'nimbus' ),
                'section'    => 'colors',
                'settings'   => 'headercolor',
        ) ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'textcolor', array(
                'label'      => __( 'Text Color', 'nimbus' ),
                'section'    => 'colors',
                'settings'   => 'textcolor',
        ) ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
                'label'      => __( 'Background Color', 'nimbus' ),
                'section'    => 'colors',
                'settings'   => 'background_color',
        ) ) );
    }

    /**
     * This will output the custom WordPress settings to the theme's WP head.
     *
     * Used by hook: 'wp_head'
     *
     * @see add_action('wp_head',$func)
     */
    public static function render()
    {
        ?>
        <!--Customizer CSS-->
        <style type="text/css">
                <?php self::generate_css('#site-title a', 'color', 'header_textcolor', '#'); ?>
                <?php self::generate_css('a, .format-image .post-header h1:before, .format-link .post-header h1:before, .format-video .post-header h1:before, .format-status .post-header h1:before, .format-gallery .post-header h1:before, .format-audio .post-header h1:before', 'color', 'link_textcolor'); ?>
                <?php self::generate_css('body:before, body:after, input[type="submit"], .button', 'background', 'link_textcolor'); ?>
                <?php self::generate_css('body', 'color', 'textcolor'); ?>
                <?php self::generate_css('hr', 'background', 'textcolor'); ?>
                <?php self::generate_css('h1, h2, h3, h4, h5, h6', 'color', 'headercolor'); ?>
                <?php self::generate_css('html', 'background-color', 'background_color', '#'); ?>
                @media only screen and (min-width: 768px) {
                    /* Styles only applied to desktop */
                    <?php self::generate_css('ul.menu ul li a', 'color', 'background_color', '#' ); ?>
                    <?php self::generate_css('ul.menu ul', 'background', 'link_textcolor'); ?>
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
     * @since Nouveau 1.0
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
add_action( 'customize_register'    , array( 'NimbusOptions' , 'register' ) );
add_action( 'wp_head'               , array( 'NimbusOptions' , 'render' ) );

$args = array(
    'default-color' => '2b2b2b',
);
add_theme_support( 'custom-background', $args );
