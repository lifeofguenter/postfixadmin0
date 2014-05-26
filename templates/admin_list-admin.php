<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<div class="container">

    <div class="row">
        <div class="col-md-8">
            <h2>List of Admins</h2>
        </div>
        <div class="col-md-4 margin-top-20">
            <a href="create-admin.php" class="btn btn-default pull-right"><?php print $PALANG['pAdminMenu_create_admin']; ?></a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th><?php echo html_escape($PALANG['pAdminList_admin_username']) ?></th>
                <th><?php echo html_escape($PALANG['pAdminList_admin_count']) ?></th>
                <th><?php echo html_escape($PALANG['pAdminList_admin_modified']) ?></th>
                <th><?php echo html_escape($PALANG['pAdminList_admin_active']) ?></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($list_admins) && is_array($list_admins)): ?>
            <?php foreach($list_admins as $i => $list_admin): ?>
            <tr>
                <td><a href="list-domain.php?username=<?php echo urlencode($list_admin) ?>"><?php echo html_escape($list_admin) ?></a></td>
                <?php if ($admin_properties[$i]['domain_count'] == 'ALL'): ?>
                <td><?php echo html_escape($PALANG['pAdminEdit_admin_super_admin']) ?></td>
                <?php else: ?>
                <td><?php echo html_escape($admin_properties[$i]['domain_count']) ?></td>
                <?php endif; ?>
                <td><?php echo html_escape($admin_properties[$i]['modified']) ?></td>
                <td><a href="edit-active-admin.php?username=<?php echo urlencode($list_admin) ?>"><?php echo html_escape((($admin_properties[$i]['active'] == 1) ? $PALANG['YES'] : $PALANG['NO'])) ?></a></td>
                <td>
                    <div class="btn-group pull-right">
                        <a class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" href="#">Action <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="edit-admin.php?username=<?php echo urlencode($list_admin) ?>"><?php echo html_escape($PALANG['edit']) ?></a></li>
                            <li><a href="delete.php?table=admin&delete=<?php echo urlencode($list_admin) ?>" onclick="return confirm('Are you sure?')"><?php echo html_escape($PALANG['del']) ?></a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>