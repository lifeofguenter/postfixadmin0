<?php

require_once 'common.php';

authentication_require_role('admin');
$username = authentication_get_username();
$SESSID_USERNAME = $username;
if(authentication_has_role('global-admin')) {
    $list_domains = list_domains ();
}
else {
    $list_domains = list_domains_for_admin ($username);
}

$pCreate_alias_goto_text = $PALANG['pCreate_alias_goto_text'];

if ($_SERVER['REQUEST_METHOD'] == "GET")
{
    if (isset ($_GET['domain'])) {
        $tDomain = escape_string ($_GET['domain']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    if (isset ($_POST['fAddress']) && isset ($_POST['fDomain'])) {
        $fAddress = escape_string($_POST['fAddress']) . "@" . escape_string ($_POST['fDomain']);
        $fAddress = strtolower ($fAddress);
    }

    if (isset ($_POST['fGoto'])) {
        $fGoto = escape_string ($_POST['fGoto']);
        $fGoto = strtolower ($fGoto);
    }
    if(isset($_POST['fActive'])) {
        $fActive = escape_string ($_POST['fActive']);
    }
    else {
        $fActive = "1";
    }

    if(isset($_POST['fDomain'])) {
        $fDomain = escape_string ($_POST['fDomain']);
    }

# TODO: Doesn't work with multiple aliases - fix or discard...
#    if(!preg_match ('/@/',$fGoto)) {
#        $fGoto = $fGoto . "@" . escape_string ($_POST['fDomain']);
#    }

    if(!(authentication_has_role('global-admin') ||
        check_owner ($SESSID_USERNAME, $fDomain) ))
    {
        $error = 1;
        $tAddress = escape_string ($_POST['fAddress']);
        $tGoto = $fGoto;
        $tDomain = $fDomain;
        $pCreate_alias_address_text = $PALANG['pCreate_alias_address_text_error1'];
    }

    if(!check_alias($fDomain)) {
        $error = 1;
        $tAddress = escape_string ($_POST['fAddress']);
        $tGoto = $fGoto;
        $tDomain = $fDomain;
        $pCreate_alias_address_text = $PALANG['pCreate_alias_address_text_error3'];
    }

    if(empty ($fAddress) || !check_email ($fAddress)) {
        $error = 1;
        $tAddress = escape_string ($_POST['fAddress']);
        $tGoto = $fGoto;
        $tDomain = $fDomain;
        $pCreate_alias_address_text = $PALANG['pCreate_alias_address_text_error1'];
    }

    // Begin check alias email
    $goto = preg_replace ('/\\\r\\\n/', ',', $fGoto);
    $goto = preg_replace ('/\r\n/', ',', $goto);
    $goto = preg_replace ('/,[\s]+/i', ',', $goto);
    $goto = preg_replace ('/[\s]+,/i', ',', $goto);
    $goto = preg_replace ('/,*$|^,*/', '', $goto);
    $goto = preg_replace ('/,,*/', ',', $goto);

    if (empty ($goto) && !authentication_has_role('global-admin')) {
       $error = 1;
       $tGoto = $_POST['fGoto'];
       $tMessage = array(
           'level' => 'danger',
           'msg' => $PALANG['pEdit_alias_goto_text_error1'],
       );
    }

    $new_aliases = array();
    if ($error != 1) {
       $new_aliases = explode(',', $goto);
    }
    $new_aliases = array_unique($new_aliases);

    foreach($new_aliases as $address) {
       if (in_array($address, $CONF['default_aliases'])) continue;
       if (empty($address)) continue; # TODO: should never happen - remove after 2.2 release
       if (!check_email($address)) {
           $error = 1;
           $tGoto = $goto;
           if (!empty($tMessage)) {
               $tMessage = array(
                   'level' => 'danger',
                   'msg' => $PALANG['pEdit_alias_goto_text_error2'] . $address,
               );
           }
       }
    }

    $goto = implode(',', $new_aliases);
    $fGoto = escape_string($goto);
    // End check alias mail

    if (empty($fGoto)) {
        $error = 1;
        $tAddress = escape_string ($_POST['fAddress']);
        $tGoto = $fGoto;
        $tDomain = $fDomain;
        $pCreate_alias_goto_text = $PALANG['pCreate_alias_goto_text_error'];
    }

    if (escape_string($_POST['fAddress']) == "*") {
        $fAddress = "@" . escape_string ($_POST['fDomain']);
    }

    $result = db_query ("SELECT * FROM $table_alias WHERE address='$fAddress'");
    if ($result['rows'] == 1)
    {
        $error = 1;
        $tAddress = escape_string ($_POST['fAddress']);
        $tGoto = $fGoto;
        $tDomain = $fDomain;
        $pCreate_alias_address_text = $PALANG['pCreate_alias_address_text_error2'];
    }

    if ($fActive == "on") {
        $sqlActive = db_get_boolean(True);
    }
    else {
        $sqlActive = db_get_boolean(False);
    }

    if ($error != 1) {
        if (preg_match('/^\*@(.*)$/', $fGoto, $match)) {
            $fGoto = "@" . $match[1];
        }

        $result = db_query ("INSERT INTO $table_alias (address,goto,domain,created,modified,active) VALUES ('$fAddress','$fGoto','$fDomain',NOW(),NOW(),'$sqlActive')");
        if ($result['rows'] != 1) {
            $tDomain = $fDomain;
            $tMessage = array(
                'level' => 'danger',
                'msg' => $PALANG['pCreate_alias_result_error'] . ' (' . $fAddress . ' -> ' . $fGoto . ')',
            );
        }
        else {
            db_log ($SESSID_USERNAME, $fDomain, 'create_alias', "$fAddress -> $fGoto");

            $tDomain = $fDomain;
            $tMessage = array(
            	'level' => 'success',
                'msg' => $PALANG['pCreate_alias_result_success'] . ' (' . $fAddress . ' -> ' . $fGoto . ')',
            );
        }
    } else { # on error
        $tAddress = htmlentities($_POST['fAddress']);
        $tGoto = htmlentities($_POST['fGoto']);
        $tDomain = htmlentities($_POST['fDomain']);

    }
}

$template_title = 'Create Alias - Postfix Admin (Zero)';
include 'templates/header.php';
include 'templates/menu.php';
include 'templates/create-alias.php';
include 'templates/footer.php';
/* vim: set expandtab softtabstop=4 tabstop=4 shiftwidth=4: */