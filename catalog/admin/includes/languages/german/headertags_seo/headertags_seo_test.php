<?php
$contactHelp = file_get_contents(DIR_WS_LANGUAGES . $language . '/headertags_seo/headertags_seo_footer.txt');

define('HTS_HEADING', 'Test Section');
define('HTS_TEXT_MAIN', '

<div class="section"><span class="subHeading">Test</span> - Clicking on the Test button will cause a number of 
tests to be ran. The results, if any, will be shown on the page. The duplicate title and tags are just
warnings, as opposed to errors. They should be handled for best results but it is not required. But any of the 
failures that are errors, should be handled or the code may not work correctly or security holes may exist
as a result.
</div>

' .$contactHelp
);