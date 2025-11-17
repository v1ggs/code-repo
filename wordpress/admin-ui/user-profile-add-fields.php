<?php

namespace Code_Repo;

function add_user_contact_methods($fields)
{
    $fields['github'] = 'Github';
    $fields['facebook'] = 'Facebook';
    return $fields;
}

add_filter('user_contactmethods', __NAMESPACE__ . '\\add_user_contact_methods', 10, 1);
