<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>

    <div id="footer">
        <div class="container">
            <p class="text-muted small">
                <a href="https://github.com/lifeofguenter/postfixadmin0/">PostfixAdminZero <?php print $version; ?></a>
                <?php if (!empty($_SESSION['sessid']['username'])): ?>
                | <?php printf($PALANG['pFooter_logged_as'], authentication_get_username()) ?>
                (<a href="logout.php"><?php echo $PALANG['pMenu_logout'] ?></a>)
                <?php endif; ?>
                <?php if (!empty($CONF['show_footer_text']) && !empty($CONF['footer_link']) && !empty($CONF['footer_text'])): ?>
                | <?php echo '<a href="' . $CONF['footer_link'] . '">' . $CONF['footer_text'] . '</a>' ?>
                <?php endif; ?>
            </p>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
