<?php
/**
 * About_Me_Widget.php
 *
 * Plugin Name: About Me Widget
 * Description: A widget that show yor pic, social networks and bref bio.
 * Version: 1.0
 * Author: Luis Manuel Ramirez Vargas
 * Author URI: http://www.luismdeveloper.com
 * License: GPLv2
 */

class About_Me_Widget extends WP_Widget
{
    function __construct() {
        parent::__construct(
            'about-me-widget',
            __( 'About Me', 'simple-blog' ),
            array(
                'classname' => 'about-me-widget',
                'description' => __( 'A widget that show yor pic, social networks and bref bio.', 'simple-blog' )
            )
        );
    }

    function form( $instance ) {
        $defaults = array(
            'title' => 'About Me'
        );

        $instance = wp_parse_args( (array) $instance, $defaults );?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'simple-blog' ); ?></label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>
        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance[ 'title' ] = strip_tags( stripcslashes( $new_instance[ 'title' ] ) );
        return $instance;
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters('widget-title', $instance['title']);

        echo $before_widget;

        if ($title) {
            echo $before_title . $title . $after_title;
        } else {
            echo $before_title . 'About Me' . $after_title;
        }

    }
}