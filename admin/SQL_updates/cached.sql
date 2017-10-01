alter table products_description add cached int(1) default '0' after products_id;
alter table products_description add cached_admin int(1) default '0' after cached;

alter table categories_description add cached int(1) default '0' after categories_id;
alter table categories_description add cached_admin int(1) default '0' after cached;

alter table topics_description add cached int(1) default '0' after topics_id;
alter table topics_description add cached_admin int(1) default '0' after cached;

alter table articles_description add cached int(1) default '0' after articles_id;
alter table articles_description add cached_admin int(1) default '0' after cached;

alter table information add cached int(1) default '0' after information_id;
alter table information add cached_admin int(1) default '0' after cached;

alter table manufacturers_info add cached int(1) after manufacturers_id;
alter table manufacturers_info add cached_admin int(1) after cached;
