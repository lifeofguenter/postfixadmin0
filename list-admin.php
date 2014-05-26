<?php

require_once 'common.php';

authentication_require_role('global-admin');

$list_admins = list_admins();
if ((is_array ($list_admins) and sizeof ($list_admins) > 0)) {
    for ($i = 0; $i < sizeof ($list_admins); $i++) {
        $admin_properties[$i] = get_admin_properties ($list_admins[$i]);
    }
}

$template_title = 'Admin List - Postfix Admin (Zero)';
include 'templates/header.php';
include 'templates/menu.php';
include 'templates/admin_list-admin.php';
include 'templates/footer.php';