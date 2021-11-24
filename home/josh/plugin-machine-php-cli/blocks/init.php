<?php

//Enqueue assets for  plugin
add_action('enqueue_block_editor_assets', function () {
    $handle = '-plugin';
    $assets = include dirname(__FILE__, 3). "/build/plugin-$handle.asset.php";
    $dependencies = $assets['dependencies'];
    wp_enqueue_script(
        $handle,
        plugins_url("/build/plugin-$handle.js", dirname(__FILE__, 2)),
        $dependencies,
        $assets['version']
    );
});

//Register meta fields for plugin
add_action( 'init', function() {
    register_meta( 'post', 'meta_key', [
        'sidebar' => 'integer',
        'single' => true,
        'show_in_rest' => true,
        'default' => 16,
    ] );
} );
