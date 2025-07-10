<?php

namespace Code_Repo;

// Dev-only helpers for 'local' or 'development' environments:
// Adds a visible admin notice in WP backend.
// Logs a console message on the frontend for quick confirmation.
// Sets a custom favicon (🛠️ emoji) via inline SVG.
// Only runs when WP_ENVIRONMENT_TYPE is 'local' or 'development'.

function admin_dev_notice()
{
    echo '<div class="notice notice-warning is-dismissible"><p>You are working in a development environment.</p></div>';
}

function dev_notice_console()
{
    wp_register_script('dev-console-log', '', [], null, false);
    wp_enqueue_script('dev-console-log');
    wp_add_inline_script(
        'dev-console-log',
        'console.log("%cDevelopment environment active", "color: green; font-weight: bold;");',
        'before'
    );
}

function dev_favicon()
{
    echo '<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,'
        . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><text y=".9em" font-size="90">🛠️</text></svg>')
        . '">';
}

function load_dev_helpers()
{
    $env = function_exists('wp_get_environment_type') ? wp_get_environment_type() : 'production';

    /**
     * Disable features you don't need by commenting them out.
     */
    if (in_array($env, ['local', 'development'], true)) {
        add_action('admin_notices', __NAMESPACE__ . '\\admin_dev_notice');
        add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\dev_notice_console');
        add_action('wp_head', __NAMESPACE__ . '\\dev_favicon');
    }
}

// Hook into plugins_loaded or after_setup_theme
add_action('after_setup_theme', __NAMESPACE__ . '\\load_dev_helpers');
