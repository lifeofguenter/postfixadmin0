<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<div class="container">

    <div class="row">
        <div class="col-md-8">
            <h2><?php echo html_escape($PALANG['pCreate_mailbox_welcome']) ?></h2>
        </div>
        <div class="col-md-4 margin-top-20">
            <?php if (isset($_SESSION['list_virtual_sticky_domain'])): ?>
            <a href="list-virtual.php?domain=<?php echo urlencode($_SESSION['list_virtual_sticky_domain']) ?>" class="btn btn-default pull-right"><?php echo html_escape($PALANG['pAdminMenu_list_virtual']) ?></a>
            <?php endif; ?>
        </div>
    </div>

    <hr>

    <?php if (!empty($tMessage) && is_array($tMessage)): ?>
    <div class="alert alert-<?php echo $tMessage['level'] ?> alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo html_escape($tMessage['msg']) ?>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8">
            <form class="form-horizontal" role="form" method="post">
                <div class="form-group<?php echo ((!empty($pCreate_mailbox_username_text)) ? ' has-error' : '') ?>">
                    <label for="fUsername" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pCreate_mailbox_username']) ?></label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="fUsername" id="fUsername" autocomplete="off">
                        <?php if (!empty($pCreate_mailbox_username_text)): ?>
                        <span class="help-block"><?php echo html_escape($pCreate_mailbox_username_text) ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-addon">@</span>
                            <select name="fDomain" class="form-control no-appearance">
                            <?php if (!empty($list_domains) && is_array($list_domains)): ?>
                            <?php foreach($list_domains as $list_domain): ?>
                            <option value="<?php echo html_escape($list_domain) ?>" <?php echo (($tDomain == $list_domain) ? 'selected' : '') ?>><?php echo html_escape($list_domain) ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fPassword" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pCreate_mailbox_password']) ?></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="password" name="fPassword" id="fPassword" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="fPassword2" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pCreate_mailbox_password2']) ?></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="password" name="fPassword2" id="fPassword2" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="fName" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pCreate_mailbox_name']) ?></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="fName" id="fName" value="<?php echo html_escape($tName) ?>" autocomplete="off">
                        <span class="help-block"><?php echo html_escape($pCreate_mailbox_name_text) ?></span>
                    </div>
                </div>
                <?php if (!empty($CONF['quota'])): ?>
                <div class="form-group">
                    <label for="fQuota" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pCreate_mailbox_quota']) ?></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="fQuota" id="fQuota" value="<?php echo html_escape($tQuota) ?>" autocomplete="off">
                        <span class="help-block"><?php echo html_escape($pCreate_mailbox_quota_text) ?></span>
                    </div>
                </div>
                <?php endif; ?>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8 checkbox">
                        <label>
                            <input type="checkbox" name="fActive" id="fActive" checked>
                            <?php echo html_escape($PALANG['pCreate_mailbox_active']) ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8 checkbox">
                        <label>
                            <input type="checkbox" name="fMail" id="fMail">
                            <?php echo html_escape($PALANG['pCreate_mailbox_mail']) ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary"><?php echo html_escape($PALANG['pCreate_mailbox_button']) ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>