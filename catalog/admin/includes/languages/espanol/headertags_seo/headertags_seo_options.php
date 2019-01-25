<?php
$contactHelp = file_get_contents(DIR_WS_LANGUAGES . $language . '/headertags_seo/headertags_seo_footer.txt');

define('HTS_HEADING', 'Options');
define('HTS_TEXT_MAIN', '
<div class="heading">Settings: </div>

<div class="section"><span class="subHeading">Automatically Add New Pages</span> - Adds any news pages it finds to the list automatically
  when you go to Page Control. If not set, you have to manually add the pages by
  selecting Add New Pages from the dropdown.</div>

<div class="section"><span class="subHeading">ByPass New Pages Check</span> - Some versions of oscommerce, especially those changed ith
templates, have altered how pages are loaded. This confuses the code in Header Tags
SEO since it is expecting standard code. So if your pages do not show up in Page
Control, enable this option to get them to display.</div>

<div class="section"><span class="subHeading">Canonical Path</span> - Set which type of canonical url is returned
for categories - full or last. A category can be reached via different paths in a shop so you may end up
with urls like ...cPath="1_2_3" and ...cPath="3". They both are legitimate and point to the same location.
The search engines can handle this but some shop owners don\'t like having the different url\'s. If this
setting is set to full, then all of the url\'s will be used. If it is set to last, only the last one
will be used. </div>

<div class="section"><span class="subHeading">Check for Missing Tags</span> - checks to see if you have any products, categories or
  manufacturers that have empty titles or meta tags.</div>

<div class="section"><span class="subHeading">Clear Cache</span> - will remove all cache entries for Header Tags.</div>

<div class="section"><span class="subHeading">Display Category Parents in Title and Tags</span> - This setting has three options meant
  to control how the category names are displayed in the title and meta tags.
  <ul>
  <li>Full Category Path - shows the names of each category in the current path. For
    example, if product A is located in Hardware -> Mice, the displayed title will be
    Hardware - Mice - Product A.</li>

  <li>Duplicate Categories - shows the immediate parent for all categories this product
    is in. For example, if product A is in the Hardware -> Mice category and also in
    Hardware -> Extras category, the displayed title will be
    Mice - Extras - Product A.</li>

  <li>Standard - Only the immediate category for the current path is shown. For
    example, if product A is located in Hardware -> Mice, the displayed title will be
    Mice - Product A.</li>
  </ul>  
 

  Note that for any of the above to work, the category checkbox in Page Control for
  product_info.php must be checked.</div>

<div class="section"><span class="subHeading">Display Category Short Description</span> - If left blank (not 
recommended) or a positive number is entered, all or part of the category description will be displayed under
the categories on the product listing page. Set this option to "Off" to not use it.  </div>
  
<div class="section"><span class="subHeading">Display Column Box</span> - Displays an infobox in the left column while on a product page.
  Provides the search engines with additional text and a link.</div>

<div class="section"><span class="subHeading">Display Currently Viewing</span> - Displays the name of the product currently being viewed
  on the product page.</div>

<div class="section"><span class="subHeading">Display Page Top Title</span> - Displays the pages keyword at the very top of the page.
  This helps highlight the pages keyword, which will help with the search engines.</div>

<div class="section"><span class="subHeading">Disable Permission Warning</span> - Don\'t display the permissions warning. Can be safely enabled
 if on a Windows server.</div>

<div class="section"><span class="subHeading">Display Help Popups</span> - Displays a popup with a quick explanation when in Page Control or
 Fill Tags.</div>

<div class="section"><span class="subHeading">Display See More</span> - Controls the display of the see more
text on the product listing page. The setting can be off, in which no see more text is displayed, short,
in which only the words "see more" are displayed or full, where the words see more and the product named are 
displayed. Full is the better choice if the product name is short. Otherwise, short should be used.</div>
 
<div class="section"><span class="subHeading">Display Silo Links</span> - Displays an infobox containing links related to a specific category.
 See the admin->Header Tags SEO->Silo Control for more information on this option.</div>

<div class="section"><span class="subHeading">Display Social Bookmark</span> - Place social bookmark icons on the category and products pages.</div>

<div class="section"><span class="subHeading">Display Tag Cloud</span> - Displays links to words that are commonly searched for in the footer.
  This is mainly useful for the search engines but can be used by your customers too.</div>

<div class="section"><span class="subHeading"></span>Enable Autofill Listing Text</span> - Displays part of the product description for each
  product on the product listing page. The text for individual products can be
  entered in the product listing box in the products edit page.</div>

<div class="section"><span class="subHeading">Enable Google +1</span> - If enabled, the google +1 social
icon will be displayed along with the other social icons. The google +1 option needs to be
enabled in your google account for this to be useful.</div>
    
<div class="section"><span class="subHeading">Enable Cache</span> - Turns on the caching option for Header Tags. The Normal option is a little
  faster than the gzip option but gzip provides smaller cache sizes.</div>

<div class="section"><span class="subHeading">Enable an HTML Editor</span> - Allows the selection of one of three HTML editors. The editor must
  be installed separately.</div>

<div class="section"><span class="subHeading">Enable HTML Editor for Category Descriptions</span> - If the selected editor is installed and
  this option is set, it will be used for the category descriptions.</div>

<div class="section"><span class="subHeading">Enable HTML Editor for Meta Descriptions</span> - If the selected editor is installed and
  this option is set, it will be used for the meta description tag.</div>

<div class="section"><span class="subHeading">Enable HTML Editor for Products</span> - If the selected editor is installed and
  this option is set, it will be used for the products descriptions.</div>

<div class="section"><span class="subHeading">Enable Version Checker</span> - Provides automatic version checking. This can slow the page
  loading down since it has to connect to the oscommerce contribution site so is usually
  best to leave it off. The version can be checked manually from the Page Control section.</div>

<div class="section"><span class="subHeading">Keyword Density Range</span> - Used with the option to retrieve keywords from the text on the page.</div>

<div class="section"><span class="subHeading">Keyword Highlighter</span> - This option will bold any of the keywords found on the product page.
Depending upon the setting, either full or partial words will be bolded. The search engines
treat bolded words with a little more importance so this is a good option to use. The
exception is if there are too many words bolded because the page starts looking wrong at 
that point.</div>

<div class="section"><span class="subHeading">Position Domain</span> - The domain name that is to be used for checking the position of 
  keywords on google using the keyword tool.</div>

<div class="section"><span class="subHeading">Position Page Count</span> - The number of pages to search on google for the keyword position.</div>

<div class="section"><span class="subHeading">Separator - Description</span> - Defines the separator used for the description meta tag.</div>

<div class="section"><span class="subHeading">Separator - Keywords</span> - Defines the separator used for the keywords meta tag.</div>

<div class="section"><span class="subHeading">Search Keywords</span> - Allows keywords stored in the Header Tags SEO search table to be 
  searched when a search is performed on the site.</div>

<div class="section"><span class="subHeading">Store Keywords</span> - Will keep track of keywords your customers searched for and
  display them in the keywords section of Header Tags SEO in the admin. This
  can be useful in determining what people are looking for. For example, if
  you have a product named "topcoat" but you see people are searching for
  "top coat", then adding "top coat" to that product in the keyword section
  will help the customers find that product on future searches.</div>

<div class="section"><span class="subHeading">Tag Cloud Column Count</span> - How many keywords will be displayed in the footer of the
  shop. Google recommends a maximum of 20.</div>

<div class="section"><span class="subHeading">Use Item Name on Page</span> - There are extra fields in this addon that allow you to control
the text on the page. If this option is enabled, the extra fields are used differently.
Try entering in text for an extra field (alt name) for a product and then display the
page with and without this option set to see the difference.</div>

' .$contactHelp
);