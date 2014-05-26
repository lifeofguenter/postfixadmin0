<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<div class="container">

    <h2><?php echo html_escape($PALANG['pPassword_welcome']) ?></h2>

    <?php if (!empty($tMessage) && is_array($tMessage)): ?>
        <div class="alert alert-<?php echo $tMessage['level'] ?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo html_escape($tMessage['msg']) ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8">
            <form class="form-horizontal" role="form" method="post">
                <div class="form-group">
                    <label for="fAdmin" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pPassword_admin']) ?></label>
                    <div class="col-sm-8">
                        <input class="form-control" id="fAdmin" type="text" placeholder="<?php echo html_escape($SESSID_USERNAME) ?>" disabled>
                        <?php if (!empty($pPassword_admin_text)): ?>
                        <span class="help-block"><?php echo html_escape($pPassword_admin_text) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group <?php echo ((!empty($pPassword_password_current_text)) ? 'has-error' : '') ?>">
                    <label for="fPassword_current" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pPassword_password_current']) ?></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="password" name="fPassword_current" id="fPassword_current">
                        <?php if (!empty($pPassword_password_current_text)): ?>
                        <span class="help-block"><?php echo html_escape($pPassword_password_current_text) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group <?php echo ((!empty($pPassword_password_text)) ? 'has-error' : '') ?>">
                    <label for="fPassword" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pPassword_password']) ?></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="password" name="fPassword" id="fPassword">
                        <?php if (!empty($pPassword_password_text)): ?>
                        <span class="help-block"><?php echo html_escape($pPassword_password_text) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fPassword2" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pPassword_password2']) ?></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="password" name="fPassword2" id="fPassword2">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary"><?php echo html_escape($PALANG['pPassword_button']) ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

   <tr>
      <td colspan="3" class="standout"><?php print $tMessage; ?></td>
   </tr>

</div>