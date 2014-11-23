<?php

/**
 * Plugin Name: Terminal
 * Plugin URI: https://github.com/felixcarmona/terminal
 * Description: Implements the [terminal][/terminal] tag, which allows you to include a fancy terminal div.
 * Version: 1.0.0
 * Author: Felix Carmona (mail@felixcarmona.com)
 * Author URI: http://www.felixcarmona.com
 * License: MIT
 */

add_shortcode('terminal', function ($atts = array(), $content = null) {
    if (is_null($content)) {
        return '';
    }

    $content = preg_replace('/^\s*(?:<br\s*\/?>\s*)*/i', '', $content); // ltrim br
    $content = preg_replace('/\s*(?:<br\s*\/?>\s*)*$/i', '', $content); // rtrim br

    if ($content == '') {
        return '';
    }

    $class = 'fancy-terminal';

    if (in_array('spaced', $atts)) {
        $class .= ' fancy-terminal-spaced';
    }

    return '<div class="' . $class . '"><div>' . $content . '</div></div>';
});

add_action('wp_head', function () {
    $css_url = get_bloginfo("wpurl") . "/wp-content/plugins/terminal/style.css";
    echo "\n<link rel=\"stylesheet\" href=\"$css_url\" type=\"text/css\" media=\"screen\" />\n";
}, -1);

// Exempt terminal shortcode from wptexturize()
add_filter('no_texturize_shortcodes', function () {
    return array('terminal');
});