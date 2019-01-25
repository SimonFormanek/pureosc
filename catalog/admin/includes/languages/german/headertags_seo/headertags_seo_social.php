<?php
$contactHelp = file_get_contents(DIR_WS_LANGUAGES . $language . '/headertags_seo/headertags_seo_footer.txt');

define('HTS_HEADING', 'Social Section');
define('HTS_TEXT_MAIN', '

<div class="section"><span class="subHeading">Social Icons</span> - This section provides a way to control
the social icons that are displayed with the Social Bookmarks option is set. There are hundreds of
social media sites so selecting the ones that apply to your product line is helpful. If you don\'t see 
one you want, you just need to upload an image in the size you want to use into the images/socialbookmark/
directory and the code will display it as an option. To enable one of the icons, both the image must be checked
and the box for that icon must be filled in. Be sure to enter the correct url along with the capitalized names
as indicated to end up with a working url.
</div>

<div class="section"><span class="subHeading">Twitter Card</span> - This option allows code to
be created that provides Twitter Card information. This is automatically handled in the code
as long as the settings in this section are filled in. If they are both not filled in, then the Twitter 
Card code is disabled.
</div>

' .$contactHelp
);