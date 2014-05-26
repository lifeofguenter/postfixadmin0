<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="main.php">PostfixAdminZero</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php if (authentication_has_role('global-admin')): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $PALANG['pAdminMenu_list_admin'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="list-admin.php"><?php echo $PALANG['pAdminMenu_list_admin'] ?></a></li>
                        <li><a href="create-admin.php"><?php echo $PALANG['pAdminMenu_create_admin'] ?></a></li>
                    </ul>
                </li>
                <?php endif; ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $PALANG['pAdminMenu_list_domain'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="list-domain.php"><?php echo $PALANG['pAdminMenu_list_domain'] ?></a></li>
                        <?php if (authentication_has_role('global-admin')): ?>
                        <li><a href="create-domain.php"><?php echo $PALANG['pAdminMenu_create_domain'] ?></a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $PALANG['pAdminMenu_list_virtual'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="list-virtual.php<?php if (!empty($_SESSION['list_virtual_sticky_domain'])) echo '?domain=' . urlencode($_SESSION['list_virtual_sticky_domain']) ?>"><?php echo $PALANG['pAdminMenu_list_virtual'] ?></a></li>
                        <li><a href="create-mailbox.php<?php if (!empty($_GET['domain'])) echo '?domain=' . urlencode($_GET['domain']) ?>"><?php echo $PALANG['pMenu_create_mailbox'] ?></a></li>
                        <li><a href="create-alias.php<?php if (!empty($_GET['domain'])) echo '?domain=' . urlencode($_GET['domain']) ?>"><?php echo $PALANG['pMenu_create_alias'] ?></a></li>
                        <?php if (boolconf('alias_domain')): ?>
                        <li><a href="create-alias-domain.php<?php if (!empty($_GET['domain'])) echo '?target_domain=' . urlencode($_GET['domain']) ?>"><?php echo $PALANG['pMenu_create_alias_domain'] ?></a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li><a href="password.php"><?php echo $PALANG['pMenu_password'] ?></a></li>
                <li><a href="viewlog.php"><?php echo $PALANG['pMenu_viewlog'] ?></a></li>
          </ul>
        </div>
    </div>
</div>