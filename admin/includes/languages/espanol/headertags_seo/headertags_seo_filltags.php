<?php
$contactHelp = file_get_contents(DIR_WS_LANGUAGES . $language . '/headertags_seo/headertags_seo_footer.txt');

define('HTS_HEADING', 'Fill Tags');
define('HTS_TEXT_MAIN', '
<div class="section" style="padding-top:10px;"><span class="subHeading">Overview</span> - The Fill Tags section is 
used to pre-fill all title and meta tags for the categories, manufacturers and products. In most cases, the section at the
bottom of the pages is all that is needed, though the other sections may be useful for some shops.
</div>

<div class="section" style="padding-top:10px;"><span class="subHeading">Description Override Section</span> - This section
allows the meta description tags to be filled in with the products description. This can result in unexpected text,
depending upon how your descriptions are setup, so do a backup first. 
</div>

<div class="section" style="padding-top:10px;"><span class="subHeading">Keywords Override Section</span> - This section
allows the keywords to be filled in from text on the page. I do not recommend using this option since keywords 
should be chosen manually for best results.
</div>

<div class="section" style="padding-top:10px;"><span class="subHeading">Generic Override Section</span> - This section
allows the titles and tags of all items in the selected sub-section to be altered at one time. The "Check to fill title and tags with generic strings."
check box must be selected to enable this section. Then check each check box of the item to be changed. I suggest creating
a test category with test products and then just using this section on those in order to see how it works. Using the
definitions mentioned on the page will substitute the name of the given item in wherever they are used.
</div>

<div class="section" style="padding-top:10px;"><span class="subHeading">Fill Tags Section</span> - This is the section 
located at the bottom of the page. When using this section, it is generally better to use the "Fill Only Empty Tags" option
since that is the safest. But if you all tags to be overwritten, then the "Fill All Tags" option should be used. When the
Update button is clicked, the title and tags for whichever items are selected will be filled. If one of the override
options is used, then that applies to whichever item is selected, like products. After the script runs, the page will
display at the top. If there are errors, it will automatically scroll down to show them.
</div>

' .$contactHelp
);