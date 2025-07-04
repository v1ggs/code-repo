<?php

namespace Your_Namespace;

/**
 * Restrict access to wp-login.php using a query string "gate".
 *
 * Blocks access to the login page unless a specific query string key/value
 * is present (e.g. ?password=your_value).
 *
 * Security & Reliability:
 * - Obscures wp-login.php but does NOT replace real authentication.
 * - Intended for personal sites or trusted-user setups only.
 * - Query string can leak via:
 *   - Browser history
 *   - Referrer headers (e.g. clicking external links from login page)
 *   - Analytics or proxy logs
 * - Use HTTPS to prevent interception.
 * - Avoid external links on the login page, or add:
 *     rel="noreferrer noopener" and/or referrerpolicy="no-referrer"
 *
 * Recommended:
 * - Define the password via a constant in wp-config.php instead of hardcoding.
 * - Optionally log failed access attempts for basic monitoring.
 */
function hide_login_page_query_string()
{
    $key   = 'password';
    $value = 'mypass_1234';

    // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- This is a gate, not form processing
    if (!isset($_GET[$key])) {
        wp_safe_redirect(home_url('/'));
        exit;
    }

    // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- This is a gate, not form processing
    $actual = sanitize_text_field(wp_unslash($_GET[$key]));

    if ($actual !== $value) {
        wp_safe_redirect(home_url('/'));
        exit;
    }
}

add_action('login_head', __NAMESPACE__ . '\\hide_login_page_query_string');
