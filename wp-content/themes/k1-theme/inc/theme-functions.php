<?php

/**
 * The helper functions to use
 * 
 * @since 1.3
 * 
 */

/**
 * Enqueues the page style.
 *
 * @param string $id The id you set in webpack.config.js.
 * @param array $deps Optional array of dependencies.
 */
function cno_enqueue_page_style(string $id, array $deps = array('main')) {
    wp_enqueue_style(
        $id,
        get_stylesheet_directory_uri() . "/dist/{$id}.css",
        $deps,
        filemtime(get_stylesheet_directory() . "/dist/{$id}.css")
    );
}

/**
 * Enqueues the page script.
 *
 * @param string $id The id you set in webpack.config.js.
 * @param array $deps Optional array of dependencies.
 */
function cno_enqueue_page_script(string $id, array $deps = array('main')) {
    $asset_file = get_stylesheet_directory() . "/dist/{$id}.asset.php";

    if (file_exists($asset_file)) {
        $asset = require $asset_file;

        wp_enqueue_script(
            $id,
            get_stylesheet_directory_uri() . "/dist/{$id}.js",
            $asset['dependencies'] ?? $deps,
            $asset['version'],
            true
        );
    } else {
        wp_enqueue_script(
            $id,
            get_stylesheet_directory_uri() . "/dist/{$id}.js",
            $deps,
            filemtime(get_stylesheet_directory() . "/dist/{$id}.js"),
            true
        );
    }
}

/**
 * Enqueues both the page style and script.
 *
 * @param string $id The id you set in webpack.config.js.
 * @param array $deps Associative array of dependencies for styles and scripts.
 */
function cno_enqueue_page_assets(string $id, array $deps = array()) {
    $default_deps = array(
        'styles' => array('main'),
        'scripts' => array('main'),
    );

    $deps = wp_parse_args($deps, $default_deps);

    cno_enqueue_page_style($id, $deps['styles']);
    cno_enqueue_page_script($id, $deps['scripts']);
}