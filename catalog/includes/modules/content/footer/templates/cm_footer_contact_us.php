<div class="col-sm-<?php echo $content_width; ?>">
    <div class="footerbox contact">
        <h2><?php echo _('How To Contact Us'); ?></h2>
        <address>
            <strong><?php echo STORE_NAME; ?></strong><br>
            <?php echo nl2br(STORE_ADDRESS); ?><br>
            <abbr title="<?php echo _('Phone'); ?>"><?php echo _('P'); ?>:</abbr> <?php echo constant('STORE_PHONE'); ?><br>
            <abbr title="<?php echo _('Email'); ?>">E:</abbr> <?php echo constant('STORE_OWNER_EMAIL_ADDRESS'); ?>
        </address>
        <ul class="list-unstyled">
            <?php
            /*             * ** BEGIN ARTICLE MANAGER *** */
            echo $aLinks;
            /*             * ** END ARTICLE MANAGER *** */
            ?>
            <li><a class="btn btn-success btn-sm btn-block" role="button" href="<?php echo tep_href_link('contact_us.php'); ?>"><i class="fa fa-send"></i> <?php echo _('Contact Us'); ?></a></li>
        </ul>
    </div>
</div>
