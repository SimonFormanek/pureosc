<?php
$addons = array('All Products SEO', 'Google Sitemap XML SEO', 'Sitemap SEO', 'Ultimate SEO V2.2d');
$links =  array('addons.oscommerce.com/info/6216',
                'addons.oscommerce.com/info/6216',
                'addons.oscommerce.com/info/6216',
                'addons.oscommerce.com/info/6216'                
               ); 
$urls = '<div style="width=800px; text-align:center;">';               
for ($i = 0; $i < count($addons); ++$i) {               
    $urls .= '<div class="section_row_help"><a class="section_email" href="http://' . $links[$i] . '">' . $addons[$i] . '</a></div>';                
}
$urls .= '</div>';
$contactHelp = file_get_contents(DIR_WS_LANGUAGES . $language . '/headertags_seo/headertags_seo_footer.txt');

define('HTS_HEADING', 'Need Help');
define('HTS_TEXT_MAIN', '

<div class="section_block" style="padding-top:10px;">Because this addon is the most powerful of all of the meta tags addons, 
it can take some practice to get it set up the right way. So if you need help in setting it up or upgrading, please feel free to 
<a style="color:blue; font-weight:bold;" href="mailto:support@oscommerce-solution.com">email me</a> for a quote.
</div>

<div class="section_block_line">Besides this addon, for the best SEO results for your shop, I 
recommend the following to be installed:
</div>
 
' . $urls . '
 
<div style="clear:both; padding-top:10px">Please <a style="color:blue; font-weight:bold;" href="mailto:support@oscommerce-solution.com">contact us</a> 
and ask for a quote since discounts are usually available.
</div>
');