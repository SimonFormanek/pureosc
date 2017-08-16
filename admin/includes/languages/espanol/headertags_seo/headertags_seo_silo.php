<?php
$contactHelp = file_get_contents(DIR_WS_LANGUAGES . $language . '/headertags_seo/headertags_seo_footer.txt');

define('HTS_HEADING', 'Silo Section');
define('HTS_TEXT_MAIN', '
<div class="section" style="padding-top:10px;">This section provides a way to funnel the search engines
to a particular item. When you setup a silo entry for a category, a box will appear on the page with just the 
links related to that category showing. This is meant to remove the non-related links, thus giving them more 
importance. But when the ever-changing and wide-variety of category boxes, this is difficult to code to have
it work in all shops. So, as of now, please note that this is not a completed option. It works
but needs changes to make it work as it should. You can try it in your shop and it may help but it won\'t hurt.
To delete an existing entry, just select that category from the list and check the disable box before updating.
</div>

 


' .$contactHelp
);