static catalog
=======================

CONFIGURATION
----------------
### languages settings
#### disable language
Set sort_order = 0:
  update languages set sort_order=0 where languages_id=5 


TODO CRITICAL
---------------
admin/static_generator_reset.php:
* zobrazovat stav resetu (cucat z databaze procento hotovych souboru postupne
* umoznit hard reset okamzite a zacit znova
* kontrola duplicty v dtb muze se SHODNE jmenovat clanek/produkt/kategorie 
- pri update static se musi kontrolovat vsechny moznosti a zabranit duplicitam
musi vyskocit error pri vkladani produktu-kategorie

### FRONTEND

dynamic page reload link - start dynamic mode without adding to cart


## TODO ver 1.0
* check all links for missing SID
* tep_recreate session -> app_top
* index.html je kravina, integrovat home page do indexu.php? a nebo je to OK: pokud nen9 session je odkaz slash, na dynamickem webu je to FILENAME_DEFAULT
* simple static cart (email_order)

## ver 2
* cache all page only sessions dynamical
* add ajax if js enabled
* better static cart without db

APACHE CONFIGURATION
-----------------------

### serving precompressed contents theory
* headers
* brothli support

#### Correct Headers, debugging 
https://kevinlocke.name/bits/2016/01/20/serving-pre-compressed-files-with-apache-multiviews/


