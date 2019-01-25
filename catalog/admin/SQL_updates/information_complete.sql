DROP TABLE IF EXISTS `information`;
CREATE TABLE `information` (
  `information_id` tinyint(3) unsigned NOT NULL auto_increment,
  `information_group_id` int(11) unsigned NOT NULL default '0',
  `information_title` varchar(255) NOT NULL default '',
  `information_description` text NOT NULL,
  `parent_id` int(11) default NULL,
  `sort_order` tinyint(3) unsigned NOT NULL default '0',
  `visible` enum('1','0') NOT NULL default '1',
  `language_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`information_id`,`language_id`)
) ;


DROP TABLE IF EXISTS `information_group`;
CREATE TABLE `information_group` (
  `information_group_id` int(11) NOT NULL auto_increment,
  `information_group_title` varchar(64) NOT NULL default '',
  `information_group_description` varchar(255) NOT NULL default '',
  `sort_order` int(5) default NULL,
  `visible` int(1) default '1',
  `locked` varchar(255) NOT NULL default '',
  `format` varchar(10) NOT NULL default 'html',
  PRIMARY KEY  (`information_group_id`)
)  ;
#Information pages group 1 ##########################################################
INSERT INTO `information_group` (`information_group_id`, `information_group_title`, `information_group_description`, `sort_order`, `visible`, `locked`, `format`) VALUES (1, 'Information pages', 'Information pages', 1, 1, '', 'html');

#information group2 Welcome messages & main page (HTML)##############################
INSERT INTO `information_group` (`information_group_id`, `information_group_title`, `information_group_description`, `sort_order`, `visible`, `locked`, `format`) VALUES (2, 'MainPage texts', 'MainPage text, Customer greatings', 2, 1, 'information_title, sort_order, parent_id', 'html');

INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (1, 2, '1', 1, 'TEXT_GREETING_PERSONAL', 'Welcome back <span class="greetUser">%s!</span> Would you like to see which <a href="%s"><u>new products</u></a> are available to purchase?', 1, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (1, 2, '1', 1, 'TEXT_GREETING_PERSONAL', 'Welcome back <span class="greetUser">%s!</span> Would you like to see which <a href="%s"><u>new products</u></a> are available to purchase?', 2, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (1, 2, '1', 1, 'TEXT_GREETING_PERSONAL', 'Welcome back <span class="greetUser">%s!</span> Would you like to see which <a href="%s"><u>new products</u></a> are available to purchase?', 3, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (1, 2, '1', 1, 'TEXT_GREETING_PERSONAL', 'Welcome back <span class="greetUser">%s!</span> Would you like to see which <a href="%s"><u>new products</u></a> are available to purchase?', 4, 0);

INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (2, 2, '1', 2, 'TEXT_GREETING_PERSONAL_RELOGON', '<small>If you are not %s, please <a href="%s"><u>log yourself in</u></a> with your account information.</small>', 1, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (2, 2, '1', 2, 'TEXT_GREETING_PERSONAL_RELOGON', '<small>If you are not %s, please <a href="%s"><u>log yourself in</u></a> with your account information.</small>', 2, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (2, 2, '1', 2, 'TEXT_GREETING_PERSONAL_RELOGON', '<small>If you are not %s, please <a href="%s"><u>log yourself in</u></a> with your account information.</small>', 3, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (2, 2, '1', 2, 'TEXT_GREETING_PERSONAL_RELOGON', '<small>If you are not %s, please <a href="%s"><u>log yourself in</u></a> with your account information.</small>', 4, 0);

INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (3, 2, '1', 3, 'TEXT_GREETING_GUEST', 'Welcome <span class="greetUser">Guest!</span> Would you like to <a href="%s"><u>log yourself in</u></a>? Or would you prefer to <a href="%s"><u>create an account</u></a>?', 1, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (3, 2, '1', 3, 'TEXT_GREETING_GUEST', 'Welcome <span class="greetUser">Guest!</span> Would you like to <a href="%s"><u>log yourself in</u></a>? Or would you prefer to <a href="%s"><u>create an account</u></a>?', 2, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (3, 2, '1', 3, 'TEXT_GREETING_GUEST', 'Welcome <span class="greetUser">Guest!</span> Would you like to <a href="%s"><u>log yourself in</u></a>? Or would you prefer to <a href="%s"><u>create an account</u></a>?', 3, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (3, 2, '1', 3, 'TEXT_GREETING_GUEST', 'Welcome <span class="greetUser">Guest!</span> Would you like to <a href="%s"><u>log yourself in</u></a>? Or would you prefer to <a href="%s"><u>create an account</u></a>?', 4, 0);

INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (4, 2, '1', 4, 'TEXT_MAIN', 'This is a default text. Please go to visit Admin -> InfoManager -> MainPage textsThis is a default text. Please go to visit Admin -> InfoManager -> MainPage textsThis is a default text. Please go to visit Admin -> InfoManager -> MainPage textsThis is a default text. Please go to visit Admin -> InfoManager -> MainPage texts.', 1, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (4, 2, '1', 4, 'TEXT_MAIN', 'This is a default text. Please go to visit Admin -> InfoManager -> MainPage textsThis is a default text. Please go to visit Admin -> InfoManager -> MainPage textsThis is a default text. Please go to visit Admin -> InfoManager -> MainPage textsThis is a default text. Please go to visit Admin -> InfoManager -> MainPage texts.', 2, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (4, 2, '1', 4, 'TEXT_MAIN', 'This is a default text. Please go to visit Admin -> InfoManager -> MainPage textsThis is a default text. Please go to visit Admin -> InfoManager -> MainPage textsThis is a default text. Please go to visit Admin -> InfoManager -> MainPage textsThis is a default text. Please go to visit Admin -> InfoManager -> MainPage texts.', 3, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (4, 2, '1', 4, 'TEXT_MAIN', 'Text pro HomePage. UPRAVIT: Admin -> InfoManager -> Texty HomePage', 4, 0);

#information group3 MainPage H1,title, description, keywords#########################
INSERT INTO `information_group` (`information_group_id`, `information_group_title`, `information_group_description`, `sort_order`, `visible`, `locked`, `format`) VALUES (3, 'MainPage titles', 'MainPage H1,title, description, keywords', 3, 1, 'information_title, sort_order, parent_id', 'plaintext');

INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (5, 3, '1', 1, 'HEADING_TITLE', 'Store title', 1, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (5, 3, '1', 1, 'HEADING_TITLE', 'Store title', 2, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (5, 3, '1', 1, 'HEADING_TITLE', 'Store title', 3, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (5, 3, '1', 1, 'HEADING_TITLE', 'Titulek H1 obchodu', 4, 0);

INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (6, 3, '1', 2, 'META_SEO_TITLE', '', 1, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (6, 3, '1', 2, 'META_SEO_TITLE', '', 2, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (6, 3, '1', 2, 'META_SEO_TITLE', '', 3, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (6, 3, '1', 2, 'META_SEO_TITLE', '', 4, 0);

INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (7, 3, '1', 3, 'META_SEO_DESCRIPTION', '', 1, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (7, 3, '1', 3, 'META_SEO_DESCRIPTION', '', 2, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (7, 3, '1', 3, 'META_SEO_DESCRIPTION', '', 3, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (7, 3, '1', 3, 'META_SEO_DESCRIPTION', '', 4, 0);

INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (8, 3, '1', 4, 'META_SEO_KEYWORDS', '', 1, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (8, 3, '1', 4, 'META_SEO_KEYWORDS', '', 2, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (8, 3, '1', 4, 'META_SEO_KEYWORDS', '', 3, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (8, 3, '1', 4, 'META_SEO_KEYWORDS', '', 4, 0);

#information group4 Plaintext constants #####################################################
INSERT INTO `information_group` (`information_group_id`, `information_group_title`, `information_group_description`, `sort_order`, `visible`, `locked`, `format`) VALUES (4, 'Plaintext constants', 'Plaintext constants', 4, 1, 'information_title, sort_order, parent_id', 'plaintext');
#HEADER_GENERIC 1-5
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (9, 4, '1', 1, 'HEADER_GENERIC1', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic1</span>', 1, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (9, 4, '1', 1, 'HEADER_GENERIC1', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic1</span>', 2, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (9, 4, '1', 1, 'HEADER_GENERIC1', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic1</span>', 3, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (9, 4, '1', 1, 'HEADER_GENERIC1', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic1</span>', 4, 0);

INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (10, 4, '1', 2, 'HEADER_GENERIC2', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic2</span>', 1, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (10, 4, '1', 2, 'HEADER_GENERIC2', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic2</span>', 2, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (10, 4, '1', 2, 'HEADER_GENERIC2', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic2</span>', 3, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (10, 4, '1', 2, 'HEADER_GENERIC2', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic2</span>', 4, 0);

INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (11, 4, '1', 3, 'HEADER_GENERIC3', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic3</span>', 1, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (11, 4, '1', 3, 'HEADER_GENERIC3', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic3</span>', 2, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (11, 4, '1', 3, 'HEADER_GENERIC3', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic3</span>', 3, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (11, 4, '1', 3, 'HEADER_GENERIC3', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic3</span>', 4, 0);

INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (12, 4, '1', 4, 'HEADER_GENERIC4', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic4</span>', 1, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (12, 4, '1', 4, 'HEADER_GENERIC4', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic4</span>', 2, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (12, 4, '1', 4, 'HEADER_GENERIC4', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic4</span>', 3, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (12, 4, '1', 4, 'HEADER_GENERIC4', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic4</span>', 4, 0);

INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (13, 4, '1', 5, 'HEADER_GENERIC5', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic5</span>', 1, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (13, 4, '1', 5, 'HEADER_GENERIC5', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic5</span>', 2, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (13, 4, '1', 5, 'HEADER_GENERIC5', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic5</span>', 3, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (13, 4, '1', 5, 'HEADER_GENERIC5', '<i class="fa fa-question"></i><span class="hidden-sm"> Generic5</span>', 4, 0);

#HTML constants########################################################################
INSERT INTO `information_group` (`information_group_id`, `information_group_title`, `information_group_description`, `sort_order`, `visible`, `locked`) VALUES (5, 'HTML constants', 'HTML constants', 5, 1, 'information_title, sort_order, parent_id');
#MODULE_CONTENT_FOOTER_TEXT_TEXT
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (14, 5, '1', 1, 'MODULE_CONTENT_FOOTER_TEXT_TEXT', 'This is a default footer text. Please go to visit the admin and change it (Info manager -> Welcome message).', 1, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (14, 5, '1', 1, 'MODULE_CONTENT_FOOTER_TEXT_TEXT', 'This is a default footer text. Please go to visit the admin and change it (Info manager -> Welcome message).', 2, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (14, 5, '1', 1, 'MODULE_CONTENT_FOOTER_TEXT_TEXT', 'This is a default footer text. Please go to visit the admin and change it (Info manager -> Welcome message).', 3, 0);
INSERT INTO `information` (`information_id`, `information_group_id`, `visible`, `sort_order`, `information_title`, `information_description`, `language_id`, `parent_id`) VALUES (14, 5, '1', 1, 'MODULE_CONTENT_FOOTER_TEXT_TEXT', 'This is a default footer text. Please go to visit the admin and change it (Info manager -> Welcome message).', 4, 0);
