<div class="create-account-link fixedHeightBox <?php echo (MODULE_CONTENT_CREATE_ACCOUNT_LINK_CONTENT_WIDTH == 'Half') ? 'col-sm-6' : 'col-sm-12'; ?>">
  <div class="panel panel-info">
    <div class="panel-body">
      <h2><?php echo _('Create Account'); ?></h2>

      <p class="alert alert-info"><?php echo _('I am a new customer.'); ?></p>
      <p><?php echo sprintf(_('By creating an account at %s you will be able to shop faster, be up to date on an orders status, and keep track of the orders you have previously made.'), cfg('STORE_NAME')); ?></p>

      <p class="text-right"><?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'fa fa-angle-right', tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), null, null, 'btn-primary btn-block'); ?></p>
    </div>
  </div>
</div>
