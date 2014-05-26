<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<div class="container">

    <h2><?php echo html_escape($PALANG['pAdminCreate_domain_welcome']) ?></h2>

    <?php if (!empty($tMessage) && is_array($tMessage)): ?>
        <div class="alert alert-<?php echo $tMessage['level'] ?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo html_escape($tMessage['msg']) ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8">
            <form class="form-horizontal" role="form" method="post">
                <div class="form-group <?php echo ((!empty($pAdminCreate_domain_domain_text)) ? 'has-error' : '') ?>">
                    <label for="fDomain" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pAdminCreate_domain_domain']) ?></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="fDomain" id="fDomain" value="<?php echo html_escape($tDomain) ?>" autocomplete="off">
                        <?php if (!empty($pAdminCreate_domain_domain_text)): ?>
                        <span class="help-block"><?php echo html_escape($pAdminCreate_domain_domain_text) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fDescription" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pAdminCreate_domain_description']) ?></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="fDescription" id="fDescription" value="<?php echo html_escape($tDescription) ?>" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="fAliases" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pAdminCreate_domain_aliases']) ?></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="fAliases" id="fAliases" value="<?php echo html_escape($tAliases) ?>" autocomplete="off">
                        <span class="help-block"><?php echo html_escape($PALANG['pAdminCreate_domain_aliases_text']) ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fMailboxes" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pAdminCreate_domain_mailboxes']) ?></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="fMailboxes" id="fMailboxes" value="<?php echo html_escape($tMailboxes) ?>" autocomplete="off">
                        <span class="help-block"><?php echo html_escape($PALANG['pAdminCreate_domain_mailboxes_text']) ?></span>
                    </div>
                </div>
                <?php if (!empty($CONF['quota'])): ?>
                <div class="form-group">
                    <label for="fMaxquota" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pAdminCreate_domain_maxquota']) ?></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="fMaxquota" id="fMaxquota" value="<?php echo html_escape($tMaxquota) ?>" autocomplete="off">
                        <span class="help-block"><?php echo html_escape($PALANG['pAdminCreate_domain_maxquota_text']) ?></span>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($CONF['transport'])): ?>
                <div class="form-group">
                    <label for="fTransport" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pAdminCreate_domain_transport']) ?></label>
                    <div class="col-sm-8">
                        <select name="fTransport" id="fTransport" class="form-control">
                        <?php if (!empty($CONF['transport_options']) && is_array($CONF['transport_options'])): ?>
                        <?php foreach($CONF['transport_options'] as $transport_option): ?>
                        <?php if ($transport_option == $tTransport): ?>
                        <option value="<?php echo html_escape($transport_option) ?>" selected><?php echo html_escape($transport_option) ?></option>
                        <?php else: ?>
                        <option value="<?php echo html_escape($transport_option) ?>"><?php echo html_escape($transport_option) ?></option>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </select>
                        <span class="help-block"><?php echo html_escape($PALANG['pAdminCreate_domain_transport_text']) ?></span>
                    </div>
                </div>
                <?php endif; ?>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8 checkbox">
                        <label>
                            <input type="checkbox" name="fDefaultaliases" id="fDefaultaliases" <?php echo (($tDefaultaliases == 'on') ? 'selected' : '') ?> value="on">
                            <?php echo html_escape($PALANG['pAdminCreate_domain_defaultaliases']) ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8 checkbox">
                        <label>
                            <input type="checkbox" name="fBackupmx" id="fBackupmx" <?php echo (($tBackupmx == 'on') ? 'selected' : '') ?> value="on">
                            <?php echo html_escape($PALANG['pAdminCreate_domain_backupmx']) ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary"><?php echo html_escape($PALANG['pAdminCreate_domain_button']) ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>