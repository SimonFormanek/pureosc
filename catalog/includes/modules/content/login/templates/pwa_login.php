<div class="pwa_login <?php echo (MODULE_CONTENT_PWA_LOGIN_CONTENT_WIDTH == 'Half') ? 'col-sm-6' : 'col-sm-12'; ?>">
  <div class="panel panel-info">
    <div class="panel-body">
      <h2><?php echo _('Purchase without account'); ?></h2>

      <p class="alert alert-info"><?php echo _('Purchase without creating user account.'); ?></p>
     
      <p class="text-right"><?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'glyphicon glyphicon-chevron-right', tep_href_link('account_pwa.php', '', 'SSL'), null, null, 'btn-primary btn-block'); ?></p>  
    </div>
  </div>
</div>
