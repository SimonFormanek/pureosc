<?php
$contactHelp = file_get_contents(DIR_WS_LANGUAGES . $language . '/headertags_seo/headertags_seo_footer.txt');

define('HTS_HEADING', 'Keywords Section');
define('HTS_TEXT_MAIN', '

<div class="section" style="padding-top:10px;">This section allows you to see what your customers are
looking for on your shop. Whenever a search is done, the word or phase searched for is recorded and this
section provides a way for the shop owner to review those words. The words are shown in different colors,
as described in that section.  
</div>

<div>
One of the most important parts of this section is the words that are not 
found. For example, let\'s say your shop sells unique foods and some of the products are frog legs. You 
would most likely have products with names like "frog legs," "frog legs with ketchup," "spicey frog legs" 
and so on. But if someone visited your site and searched for "froglegs," they would not find any of your
products, unless you used that spelling. In that case, "froglegs" would show in this section with the 
olive color. You can then assign that keyword to a product and when someone searches for it again, 
that product will show up. You have to have "Store Keywords"
option enabled for the search to work on the shop side. If you also have the "Display Tag Cloud" option set,
the most often searched for words, that are found, will be displayed on the shop side in the footer. This is 
mainly intended for the search engines since links to keyword-related pages help those pages.
</div>

' .$contactHelp
);