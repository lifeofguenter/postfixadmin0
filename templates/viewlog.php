<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<div class="container">

    <div class="row">
        <div class="col-md-8">
            <h2><?php echo html_escape($PALANG['pViewlog_welcome'] . ' ' . $fDomain) ?></h2>
        </div>
        <div class="col-md-4 margin-top-20">
            <form name="overview" method="post" class="form-inline pull-right">
                <select name="fDomain" class="selectpicker" onchange="this.form.submit();">
                <?php if (!empty($list_domains) && is_array($list_domains)): ?>
                <?php foreach($list_domains as $list_domain): ?>
                    <option value="<?php echo html_escape($list_domain) ?>"<?php echo (($fDomain == $list_domain) ? ' selected' : '') ?>><?php echo html_escape($list_domain) ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
                </select>
                <button type="submit" class="btn btn-default"><?php print $PALANG['pViewlog_button']; ?></button>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th><?php echo html_escape($PALANG['pViewlog_timestamp']) ?></th>
                <th><?php echo html_escape($PALANG['pViewlog_username']) ?></th>
                <th><?php echo html_escape($PALANG['pViewlog_domain']) ?></th>
                <th><?php echo html_escape($PALANG['pViewlog_action']) ?></th>
                <th><?php echo html_escape($PALANG['pViewlog_data']) ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($tLog) && is_array($tLog)): ?>
            <?php foreach($tLog as $each): ?>
            <tr>
                <td><?php echo html_escape($each['timestamp']) ?></td>
                <td><?php echo html_escape($each['username']) ?></td>
                <td><?php echo html_escape($each['domain']) ?></td>
                <td><?php echo html_escape($PALANG['pViewlog_action_' . $each['action']]) ?></td>
                <td><?php echo html_escape($each['data']) ?></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>