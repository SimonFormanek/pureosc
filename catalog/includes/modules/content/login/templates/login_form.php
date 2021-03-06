<div class="login-form fixedHeightBox <?php echo (MODULE_CONTENT_LOGIN_FORM_CONTENT_WIDTH == 'Half') ? 'col-sm-6' : 'col-sm-12'; ?>">
  <div class="panel panel-success">
    <div class="panel-body">
      <h2><?php echo _('Login'); ?></h2>

      <p class="alert alert-success"><?php echo _('I am a returning customer.'); ?></p>

      <?php echo tep_draw_form('login', tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL'), 'post', '', true); ?>

        <div class="form-group">
          <?php echo tep_draw_input_field('email_address', NULL, 'autofocus="autofocus" required id="inputEmail" placeholder="' . _('E-Mail Address') . '"', 'email'); ?>
        </div>

        <div class="form-group">
          <?php echo tep_draw_input_field('password', NULL, 'required aria-required="true" id="inputPassword" placeholder="' . ENTRY_PASSWORD . '"', 'password'); ?>
        </div>

        <p class="text-right"><?php echo tep_draw_button(IMAGE_BUTTON_LOGIN, 'fa fa-sign-in', null, 'primary', NULL, 'btn-success btn-block'); ?></p>

      </form>
    </div>
  </div>

  <p><?php echo '<a class="btn btn-default" role="button" href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . _('Password forgotten? Click here.') . '</a>'; ?></p>

</div>
