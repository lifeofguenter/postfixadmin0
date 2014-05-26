<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<div class="container">

    <?php if (authentication_has_role('global-admin') && file_exists('motd-admin.txt')): ?>
    <div class="jumbotron">
        <?php readfile('motd.txt') ?>
    </div>
    <?php elseif (file_exists('motd.txt')): ?>
    <div class="jumbotron">
        <?php readfile('motd.txt') ?>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-4">
            <h4><a href="list-domain.php"><?php print $PALANG['pMenu_overview']; ?></a></h4>
            <p><?php print $PALANG['pMain_overview']; ?></p>
        </div>
        <div class="col-md-4">
            <h4><a href="create-alias.php"><?php print $PALANG['pMenu_create_alias']; ?></a></h4>
            <p><?php print $PALANG['pMain_create_alias']; ?></p>
        </div>
        <div class="col-md-4">
            <h4><a href="create-mailbox.php"><?php print $PALANG['pMenu_create_mailbox']; ?></a></h4>
            <p><?php print $PALANG['pMain_create_mailbox']; ?></p>
        </div>
    </div>
    <div class="row">
        <?php if (!empty($CONF['sendmail'])): ?>
        <div class="col-md-4">
            <h4><a href="sendmail.php"><?php print $PALANG['pMenu_sendmail']; ?></a></h4>
            <p><?php print $PALANG['pMain_sendmail']; ?></p>
        </div>
        <?php endif; ?>
        <div class="col-md-4">
            <h4><a href="password.php"><?php print $PALANG['pMenu_password']; ?></a></h4>
            <p><?php print $PALANG['pMain_password']; ?></p>
        </div>
        <div class="col-md-4">
            <h4><a href="viewlog.php"><?php print $PALANG['pMenu_viewlog']; ?></a></h4>
            <p><?php print $PALANG['pMain_viewlog']; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h4><a href="logout.php"><?php print $PALANG['pMenu_logout']; ?></a></h4>
            <p><?php print $PALANG['pMain_logout']; ?></p>
        </div>
    </div>

</div>