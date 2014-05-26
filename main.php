<?php

require_once 'common.php';

$SESSID_USERNAME = authentication_get_username();

authentication_require_role('admin');

$template_title = 'Dashboard - Postfix Admin (Zero)';
include './templates/header.php';
include './templates/menu.php';
include './templates/main.php';
include './templates/footer.php';