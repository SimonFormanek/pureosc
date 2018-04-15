<?php
/**
 * MarkDown2HtmlPDF - get Html
 *
 * @author     Vitex <vitex@hippy.cz>
 * @copyright  2018 Vitex@hippy.cz (G)
 */


    $converter = new League\CommonMark\CommonMarkConverter();
	echo $converter->convertToHtml($markdown);


