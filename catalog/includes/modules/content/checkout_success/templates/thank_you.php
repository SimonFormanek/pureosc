<div class="panel panel-success">
    <div class="panel-heading">
        <strong><?php echo _('Thanks for shopping with us'); ?></strong>
    </div>
    <div class="panel-body">
        <p><?php echo _('Your order has been successfully processed! Your products will arrive at their destination within 2-5 working days.'); ?></p>
        <p><?php echo sprintf(_('You can view the status of your order any time in your account %s page.'),
            sprintf('<a class="btn btn-success" role="button" href="%s">%s</a>', tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'),_('View Orders')));
        ?></p>
        <p><?php echo sprintf(_('Please forward any questions you may have  <a class="btn btn-info" role="button" href="%s">Contact Us</a>'), tep_href_link(FILENAME_CONTACT_US));
        ?></p>
    </div>
</div>
