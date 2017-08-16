<?php
$contactHelp = file_get_contents(DIR_WS_LANGUAGES . $language . '/headertags_seo/headertags_seo_footer.txt');

define('HTS_HEADING', 'Titles and Tags');

define('HTS_TEXT_MAIN', '
<div class="heading">
This file describes the items found in the category, manufacturer and product edit pages. The use of these
comprise the most important part of SEO - that of setting the title for the categories, manufacturers and products your
site uses.
</div>

<div class="section"><span class="subHeading">Title Tag </span> - The main title in the source of the page. This is the most important part of all SEO and is what the search engines use, more than other tags, for ranking.</div>

<div class="section"><span class="subHeading">Title Tag</span> - Alternate - This is optional. If it is used, it replaces the above. Some shops have very long product names. Since google now limits the length of the title to around 55 characters, this can be used to provide a more precise, and shorter, title.</div>

<div class="section"><span class="subHeading">Title Tag - URL</span> - This is optional. By default, if Ultimate SEO is installed, the title of the product will appear in the url. If this is used, it will be used in the url instead. This will only work if the latest version of Ultimate SEO is installed and if it has the code change needed for this to work.</div>

<div class="section"><span class="subHeading">Breadcrumb Text</span> - This is optional. By default, the product name will appear in the breadcrumb. If this is used, this text will be in the breadcrumb instead.</div>

<div class="section"><span class="subHeading">Meta Description</span> - The meta tag the search engines use. It should be no longer than about 150 characters.</div>

<div class="section"><span class="subHeading">Meta Keywords</span> - This is not used much at all for ranking. However, Header Tags SEO uses it to highlight keywords on the page, which is used for ranking. It is also checked by the search engines to be sure the site is not trying to fool them. Any words entered in this tag must appear in the text on the page or they may think you are trying to do that.</div>

<div class="section"><span class="subHeading">Product Listing Text</span> - This is optional. This is text that will appear in the product listing pages on the site. Typically, the "Enable AutoFill - Listing Text" setting is easier to use since it fills the text automatically. But if this box has text, then it will be used instead.</div>

<div class="section"><span class="subHeading">Product Page Sub Text</span> - This is optional. Any text entered here will appear on the product page. This provides an easy method to display more text on the page and search engines love text, though it needs to mention the keyword(s) of the page for best results.</div>


' .$contactHelp
);