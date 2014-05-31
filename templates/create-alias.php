<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2><?php echo html_escape($PALANG['pCreate_alias_welcome']) ?></h2>
        </div>
    </div>

    <hr>

    <?php if ((!empty($tMessage) && is_array($tMessage)) || (!empty($_SESSION['flash']) && is_array($_SESSION['flash']))): ?>
    <div class="row">
        <div class="col-md-12">
            <?php if (isset($_SESSION['flash']['info'])): ?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <ul>
                <?php foreach($_SESSION['flash']['info'] as $msg): ?>
                    <li><?php echo html_escape($msg) ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
            <?php $_SESSION['flash'] = array() ?>
            <?php elseif (isset($_SESSION['flash']['error'])): ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <ul>
                <?php foreach($_SESSION['flash']['error'] as $msg): ?>
                    <li><?php echo html_escape($msg) ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
            <?php $_SESSION['flash'] = array() ?>
            <?php else: ?>
            <div class="alert alert-<?php echo $tMessage['level'] ?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo html_escape($tMessage['msg']) ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8">
            <form class="form-horizontal" role="form" method="post">
                <div class="form-group<?php echo ((!empty($pCreate_alias_address_text)) ? ' has-error' : '') ?>">
                    <label for="fAddress" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pCreate_alias_address']) ?></label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="fAddress" id="fAddress" autocomplete="off">
                        <?php if (!empty($pCreate_alias_address_text)): ?>
                        <span class="help-block"><?php echo html_escape($pCreate_alias_address_text) ?></span>
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
                    <label for="fGoto" class="col-sm-4 control-label"><?php echo html_escape($PALANG['pCreate_alias_goto']) ?></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="fGoto" id="fGoto" rows="8"><?php echo html_escape($tGoto) ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8 checkbox">
                        <label>
                            <input type="checkbox" name="fActive" id="fActive" checked>
                            <?php echo html_escape($PALANG['pCreate_alias_active']) ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary"><?php echo html_escape($PALANG['pCreate_alias_button']) ?></button>
                        <span class="help-block"><?php echo html_escape($PALANG['pCreate_alias_catchall_text']) ?></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>