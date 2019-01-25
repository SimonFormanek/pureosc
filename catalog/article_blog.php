<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce
  Portions Copyright 2009 http://www.oscommerce-solution.com

  Released under the GNU General Public License
 */

require('includes/application_top.php');
require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_ARTICLE_BLOG);

if (isset($_POST['action']) && $_POST['action'] == 'process_comment') {

    // if the customer is not logged on, redirect them to the login page
    if (!tep_session_is_registered('customer_id')) {
        $navigation->set_snapshot();
        tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
    } else {

        $comment = tep_db_prepare_input($_POST['blog_comment']);

        if (!tep_not_null($comment)) {
            $messageStack->add('new_comment', ERROR_NO_COMMENT);
        } else {
            $sql_data_array = array('articles_id' => (int) $_GET['articles_id'],
                'comment_date_added' => 'now()',
                'comments_status' => 1,
                'customers_id' => (int) $customers_id,
                'commenters_name' => ucfirst($customer_first_name),
                'comment' => $comment,
                'language_id' => (int) $languages_id,
            );
            tep_db_perform(TABLE_ARTICLES_BLOG, $sql_data_array);

            /*             * *********************** SEND THE EMAIL ************************ */
            $subject = sprintf(BLOG_EMAIL_TEXT_SUBJECT, STORE_NAME);
            $body    = sprintf(BLOG_EMAIL_TEXT_BODY, $_POST['article_name'],
                $customer_first_name);
            tep_mail('', STORE_OWNER_EMAIL_ADDRESS, $subject, $body,
                STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
        }
    }
}


$article_check_query = tep_db_query("SELECT COUNT(*) as total from ".TABLE_ARTICLES." a, ".TABLE_ARTICLES_DESCRIPTION." ad where a.articles_status = '1' and a.articles_id = '".(int) $_GET['articles_id']."' and ad.articles_id = a.articles_id and ad.language_id = '".(int) $languages_id."'");
$article_check       = tep_db_fetch_array($article_check_query);
require(DIR_WS_INCLUDES.'template_top.php');
?>

<?php if ($article_check['total'] < 1) { ?>
    <div class="page-header" ><?php echo HEADING_ARTICLE_NOT_FOUND; ?></div>
    <div class="main" ><?php echo TEXT_ARTICLE_NOT_FOUND; ?></div>

    <?php
} else {
    $article_info_query = tep_db_query("select a.articles_id, a.articles_date_added, a.articles_date_available, a.authors_id, ad.articles_name, ad.articles_description, ad.articles_image, ad.articles_url, au.authors_name, au.authors_image from ".TABLE_ARTICLES." a left join ".TABLE_AUTHORS." au using(authors_id), ".TABLE_ARTICLES_DESCRIPTION." ad where a.articles_status = '1' and a.articles_id = '".(int) $_GET['articles_id']."' and ad.articles_id = a.articles_id and ad.language_id = '".(int) $languages_id."'");
    $article_info       = tep_db_fetch_array($article_info_query);

    tep_db_query("update ".TABLE_ARTICLES_DESCRIPTION." set articles_viewed = articles_viewed+1 where articles_id = '".(int) $_GET['articles_id']."' and language_id = '".(int) $languages_id."'");

    $articles_name      = $article_info['articles_name'];
    $articles_author_id = $article_info['authors_id'];
    $articles_author    = $article_info['authors_name'];
    ?>
    <div class="page-header">
        <div style="float:left"><h1><?php echo $articles_name; ?></h1></div>
        <?php if (tep_not_null($article_info['articles_image']) && file_exists(DIR_WS_IMAGES.'article_manager_uploads/'.$article_info['articles_image'])) { ?>
            <div style="float:right"><?php
                echo tep_image(DIR_WS_IMAGES.'article_manager_uploads/'.$article_info['articles_image'],
                    $article_info['articles_name'], ARTICLES_IMAGE_WIDTH,
                    ARTICLES_IMAGE_HEIGHT);
                ?></div>
    <?php } ?>
    </div>
    <div class="smallText" style="clear:both; margin:5px 0">

        <?php
        if (tep_not_null($articles_author) && DISPLAY_AUTHOR_ARTICLE_LISTING == 'true') {
            $authorsImage = DIR_WS_IMAGES.'article_manager_uploads/'.$article_info['authors_image'];
            if (file_exists($authorsImage) && is_file($authorsImage)) {
                echo '<div style="width:100px"><a href="'.tep_href_link(FILENAME_ARTICLES,
                    'authors_id='.$article_info['authors_id']).'">'.tep_image($authorsImage,
                    $article_info['authors_name'], SMALL_IMAGE_WIDTH,
                    SMALL_IMAGE_HEIGHT).'</a></div>';
            } else {
                echo TEXT_BY.'<a href="'.tep_href_link(FILENAME_ARTICLES,
                    'authors_id='.$article_info['authors_id']).'">'.$article_info['authors_name'].'</a>';
            }
        }
        ?>   
    </div>

    <div class="contentContainer">
        <div class="contentText">
        <?php echo stripslashes($article_info['articles_description']); ?>
        </div>

            <?php if (tep_not_null($article_info['articles_url'])) { ?>
            <div class="articlePadding"><?php echo sprintf(TEXT_MORE_INFORMATION,
            "http://".urlencode($article_info['articles_url']));
                ?></div>
            <?php
        }
        if (DISPLAY_DATE_ADDED_ARTICLE_LISTING == 'true') {
            if ($article_info['articles_date_available'] > date('Y-m-d H:i:s')) {
                ?>
                <div class="articlePadding"><?php echo sprintf(TEXT_DATE_AVAILABLE,
                tep_date_long($article_info['articles_date_available']));
            ?></div>
            <?php } else {
                ?>
                <div class="articlePadding"><?php echo sprintf(_('DATE ADDED'),
                tep_date_long($article_info['articles_date_added']));
                ?></div>
            <?php
        }
    }
    ?> 


        <!-- BEGIN SHOWING THE COMMENTS //-->
        <div class="smallText"><?php echo TEXT_COMMENT; ?></div>
                <?php
                $comments_query = tep_db_query("SELECT * from ".TABLE_ARTICLES_BLOG." where articles_id = ".(int) $_GET['articles_id']." and comments_status = 1 and language_id = ".(int) $languages_id);
                while ($comments       = tep_db_fetch_array($comments_query)) {
                    ?>
            <div class="articlePadding fa fa-asterisk">
                <span class="smallText articleBlogEntry"><?php
            echo sprintf(TEXT_WHO_SAID, $comments['commenters_name'],
                date("F d, Y \a\\t h:i A",
                    strtotime($comments['comment_date_added'])));
            ?></span>
            </div>
            <div class="smallText"><?php echo $comments['comment']; ?></div>
        <?php } ?>
        <!-- END SHOWING THE COMMENTS //-->


        <!-- BEGIN POST A COMMENT SECTION //-->
                <?php
                echo tep_draw_form('new_comment',
                    tep_href_link(FILENAME_ARTICLE_BLOG,
                        tep_get_all_get_params()), 'post').tep_hide_session_id().tep_draw_hidden_field('action',
                    'process_comment');
                ?>
        <div class="articlePadding">
            <div class="smallText"><?php echo TEXT_POST_A_COMMENT; ?></div>
            <div class="smallText"><?php echo tep_draw_textarea_field('blog_comment',
                'soft', 40, 5, '', '', false);
            ?></div>
            <div class="smallText"><?php echo tep_db_num_rows($comments_query).' '.(tep_db_num_rows($comments_query)
            > 1 ? TEXT_TOTAL_COMMENTS : TEXT_TOTAL_COMMENT);
            ?></div>
            <div class="smallText" align="right"><?php
        echo tep_draw_hidden_field('article_name', $articles_name).
        tep_draw_button(IMAGE_BUTTON_SUBMIT, 'arrowreturnthick-1-n', null,
            'primary', null, 'btn-success'); //pure:bugfix:articles tep_draw_button 
        ?></div>
        </div>
    </form>
    <!-- END POST A COMMENT SECTION //-->

    <div class="articlePadding">
    <?php
    //added for cross-sell
    if ((USE_CACHE == 'true') && !SID) {
        include(DIR_WS_MODULES.FILENAME_ARTICLES_XSELL);
    } else {
        include(DIR_WS_MODULES.FILENAME_ARTICLES_XSELL);
    }
    ?>
    </div>

    <!--- BEGIN Header Tags SEO Social Bookmarks -->
    <div class="articlePadding" style="padding-bottom:40px;">
            <?php
            if (HEADER_TAGS_DISPLAY_SOCIAL_BOOKMARKS == 'true') {
                include(DIR_WS_MODULES.'header_tags_social_bookmarks.php');
            }
            ?>
    </div>
    <!--- END Header Tags SEO Social Bookmarks -->   

    <div class="buttonSet">
        <div class="text-right"><?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE,
        'glyphicon glyphicon-chevron-right', tep_href_link(FILENAME_DEFAULT));
    ?></div>
    </div>
    </div>

<?php } ?>
<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');
?>
