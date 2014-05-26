<?php

require_once 'common.php';

authentication_require_role('global-admin');

$list_domains = list_domains ();
$tDomains = array();

if ($_SERVER['REQUEST_METHOD'] == "GET")
{
    $tDomains = array ();
}

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
   if (isset ($_POST['fUsername'])) $fUsername = escape_string ($_POST['fUsername']);
   if (isset ($_POST['fPassword'])) $fPassword = escape_string ($_POST['fPassword']);
   if (isset ($_POST['fPassword2'])) $fPassword2 = escape_string ($_POST['fPassword2']);
   $fDomains = array();
   if (!empty ($_POST['fDomains'])) $fDomains = $_POST['fDomains'];

   list ($error, $tMessage, $pAdminCreate_admin_username_text, $pAdminCreate_admin_password_text) = create_admin($fUsername, $fPassword, $fPassword2, $fDomains);

   if ($error != 0) {
      if (isset ($_POST['fUsername'])) $tUsername = escape_string ($_POST['fUsername']);
      if (isset ($_POST['fDomains'])) $tDomains = $_POST['fDomains'];
   }
}

$template_title = 'Create Admin - Postfix Admin (Zero)';
include 'templates/header.php';
include 'templates/menu.php';
include 'templates/admin_create-admin.php';
include ("templates/footer.php");