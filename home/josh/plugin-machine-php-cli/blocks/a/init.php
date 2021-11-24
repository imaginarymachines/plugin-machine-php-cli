<?php
/**
 * Register aa block
 */
add_action('init', 'build_with_two_admin_pages_init_a' );
function build_with_two_admin_pages_init_a () {
    $handle = 'a';
    wp_register_script(
        $handle,
        plugins_url("index.js", __FILE__),
        [
            'wp-element',
            'wp-blocks',
            'wp-components',
            'wp-block-editor',
            'wp-server-side-render'
        ]
    );
    register_block_type( 'build-with-two-admin-pages/a', [
        'editor_script' => $handle,
        'render_callback' => 'build_with_two_admin_pages_render_a',
        'attributes' => [
            'message' => [
                'type' => 'string'
            ]
        ]
    ]);
}

/**
 * Render aa block
 */
function build_with_two_admin_pages_render_a($attrs){
    $message = isset($atts['message']) && ! empty($atts['message']) ? $atts['message'] : 'Hi Roy';

    ob_start();
    ?>
        <p>
            <?php echo esc_html( $message ); ?>
        </p>
    <?php
    return ob_get_clean();
}
