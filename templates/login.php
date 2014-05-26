<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<div class="container">
    <form class="form-signin" role="form" name="login" method="post">
        <h2 class="form-signin-heading"><?php echo $PALANG['pLogin_welcome'] ?></h2>
        <?php if (!empty($tMessage)): ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Oh snap!</strong> <?php echo html_escape($tMessage) ?>
        </div>
        <?php endif; ?>
        <input type="email" class="form-control" name="fUsername" placeholder="<?php echo $PALANG['pLogin_username'] ?>" required autofocus>
        <input type="password" class="form-control" name="fPassword" placeholder="<?php echo $PALANG['pLogin_password'] ?>" required>
        <?php echo language_selector('form-control'); ?>
        <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $PALANG['pLogin_button'] ?></button>
    </form>
</div>