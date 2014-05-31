<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="shortcut icon" href="../../assets/ico/favicon.ico"> -->

    <?php if (!empty($template_title)): ?>
    <title><?php echo html_escape($template_title); ?></title>
    <?php else: ?>
    <title>Postfix Admin - <?php print $_SERVER['HTTP_HOST'] ?></title>
    <?php endif; ?>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <?php if (!empty($CONF['theme_css'])): ?>
    <link href="<?php echo html_escape($CONF['theme_css']) ?>" rel="stylesheet">
    <?php else: ?>
    <link href="assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <?php endif; ?>
    <link href="assets/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <?php if (stripos($_SERVER['SCRIPT_NAME'], '/login.php') !== false): ?>
    <link href="assets/css/signin.css" rel="stylesheet">
    <?php endif; ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
