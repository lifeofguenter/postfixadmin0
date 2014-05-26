<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<div class="container">

    <div class="row">
        <div class="col-md-6">
            <h2>Domain List</h2>
        </div>
        <div class="col-md-6 margin-top-20">
            <form method="post" class="form-inline pull-right">
                <select name="fUsername" class="selectpicker" onchange="this.form.submit();">
                <?php if (!empty($list_admins) && is_array($list_admins)): ?>
                <?php foreach($list_admins as $list_admin): ?>
                    <option value="<?php echo html_escape($list_admin) ?>"<?php echo (($fUsername == $list_admin) ? ' selected' : '') ?>><?php echo html_escape($list_admin) ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
                </select>
                <button type="submit" class="btn btn-default"><?php print $PALANG['pOverview_button']; ?></button>
                <a href="create-domain.php" class="btn btn-default"><?php echo html_escape($PALANG['pAdminMenu_create_domain']) ?></a>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th><?php echo html_escape($PALANG['pAdminList_domain_domain']) ?></th>
                <th><?php echo html_escape($PALANG['pAdminList_domain_description']) ?></th>
                <th><?php echo html_escape($PALANG['pAdminList_domain_aliases']) ?></th>
                <th><?php echo html_escape($PALANG['pAdminList_domain_mailboxes']) ?></th>
                <?php if (!empty($CONF['quota'])): ?>
                <th><?php echo html_escape($PALANG['pAdminList_domain_maxquota']) ?></th>
                <?php endif; ?>
                <?php if (!empty($CONF['transport'])): ?>
                <th><?php echo html_escape($PALANG['pAdminList_domain_transport']) ?></th>
                <?php endif; ?>
                <th><?php echo html_escape($PALANG['pAdminList_domain_backupmx']) ?></th>
                <th><?php echo html_escape($PALANG['pAdminList_domain_modified']) ?></th>
                <th><?php echo html_escape($PALANG['pAdminList_domain_active']) ?></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($domain_properties) && is_array($domain_properties)): ?>
            <?php foreach($domain_properties as $domain_property): ?>
            <tr>
                <td><a href="list-virtual.php?domain=<?php echo urlencode($domain_property['domain']) ?>"><?php echo html_escape($domain_property['domain']) ?></a></td>
                <td><?php echo html_escape($domain_property['description']) ?></td>
                <td><?php echo html_escape($domain_property['alias_count']) ?> / <?php echo html_escape($domain_property['aliases']) ?></td>
                <td><?php echo html_escape($domain_property['mailbox_count']) ?> / <?php echo html_escape($domain_property['mailboxes']) ?></td>
                <?php if (!empty($CONF['quota'])): ?>
                <td>
                    <?php if ($domain_property['maxquota'] == 0): ?>
                        <?php echo html_escape($PALANG['pOverview_unlimited']) ?>
                    <?php elseif ($domain_property['maxquota'] < 0): ?>
                        <?php echo html_escape($PALANG['pOverview_disabled']) ?>
                    <?php else: ?>
                        <?php echo html_escape($domain_property['maxquota']) ?>
                    <?php endif; ?>
                </td>
                <?php endif; ?>
                <?php if (!empty($CONF['transport'])): ?>
                <td><?php echo html_escape($domain_property['transport']) ?></td>
                <?php endif; ?>
                <td><?php echo html_escape(($domain_property['backupmx'] == db_get_boolean(true)) ? $PALANG['YES'] : $PALANG['NO']) ?></td>
                <td><?php echo html_escape($domain_property['modified']) ?></td>
                <?php if ($domain_property['active'] == db_get_boolean(true)): ?>
                <td><a href="edit-active-domain.php?domain=<?php echo urlencode($domain_property['domain']) ?>"><?php echo html_escape($PALANG['YES']) ?></a></td>
                <?php else: ?>
                <td><a href="edit-active-domain.php?domain=<?php echo urlencode($domain_property['domain']) ?>"><?php echo html_escape($PALANG['NO']) ?></a></td>
                <?php endif; ?>
                <td>
                    <div class="btn-group pull-right">
                        <a class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" href="#">Action <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="edit-domain.php?domain=<?php echo urlencode($domain_property['domain']) ?>"><?php echo html_escape($PALANG['edit']) ?></a></li>
                            <li><a href="delete.php?table=domain&delete=<?php echo urlencode($domain_property['domain']) ?>" onclick="return confirm('Are you sure?')"><?php echo html_escape($PALANG['del']) ?></a></li>
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