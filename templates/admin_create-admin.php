<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<div class="container">

    <h2><?php echo html_escape($PALANG['pAdminCreate_admin_welcome']) ?></h2>

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
                <div class="form-group <?php echo ((!empty($pAdminCreate_admin_username_text)) ? 'has-error' : '') ?>">
                    <label for="fUsername" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pAdminCreate_admin_username']) ?></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="fUsername" id="fUsername" placeholder="<?php echo html_escape($tUsername) ?>" autocomplete="off">
                        <?php if (!empty($pAdminCreate_admin_username_text)): ?>
                        <span class="help-block"><?php echo html_escape($pAdminCreate_admin_username_text) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group <?php echo ((!empty($pAdminCreate_admin_password_text)) ? 'has-error' : '') ?>">
                    <label for="fPassword" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pAdminCreate_admin_password']) ?></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="password" name="fPassword" id="fPassword" autocomplete="off">
                        <?php if (!empty($pAdminCreate_admin_password_text)): ?>
                        <span class="help-block"><?php echo html_escape($pAdminCreate_admin_password_text) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fPassword2" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pAdminCreate_admin_password2']) ?></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="password" name="fPassword2" id="fPassword2" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="fDomains" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pAdminCreate_admin_address']) ?></label>
                    <div class="col-sm-8">
                        <select id="fDomains" name="fDomains[]" size="10" multiple class="form-control">
                        <?php if (!empty($list_domains) && is_array($list_domains)): ?>
                        <?php foreach($list_domains as $list_domain): ?>
                            <?php if (in_array($list_domain, $tDomains)): ?>
                            <option value="<?php echo html_escape($list_domain) ?>" selected><?php echo html_escape($list_domain) ?></option>
                            <?php else: ?>
                            <option value="<?php echo html_escape($list_domain) ?>"><?php echo html_escape($list_domain) ?></option>
                            <?php endif;?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary"><?php echo html_escape($PALANG['pAdminCreate_admin_button']) ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>