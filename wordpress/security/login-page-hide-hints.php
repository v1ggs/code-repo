<?php

namespace Code_Repo;

// :::::::::: Method 1 :::::::::: //
// Do not display 'wrong password' or user name.
function hide_login_hints()
{
    return 'Wrong credentials!';
}

add_filter('login_errors', __NAMESPACE__ . '\\hide_login_hints');

// :::::::::: Method 2 :::::::::: //
// https://gist.github.com/zergiocosta/72f87176b236ed0c6e13
// Insert into your functions.php and have fun by creating login error msgs
function guwp_error_msgs()
{
    // insert how many msgs you want as array items. it will be shown randomly (html is allowed)
    $custom_error_msgs = [
        '<strong>YOU</strong> SHALL NOT PASS!',
        '<strong>HEY!</strong> GET OUT OF HERE!',
    ];

    // get and returns a random array item to show as the error msg
    return $custom_error_msgs[array_rand($custom_error_msgs)];
}

add_filter('login_errors', __NAMESPACE__ . '\\guwp_error_msgs');
