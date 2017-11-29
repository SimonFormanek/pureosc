<?php
/*
  $Id: edit_orders.php v5.0 08/05/2007 djmonkey1 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Upravit objednávku #%s of %s',true);
define('ADDING_TITLE', 'Přidat produkt(y) do objednávky #%s',true);

define('ENTRY_UPDATE_TO_CC', '(Updovat na ' . ORDER_EDITOR_CREDIT_CARD . ' to view CC fields.)',true); //todo???
define('TABLE_HEADING_COMMENTS', ' /Komentáře',true);
define('TABLE_HEADING_STATUS', 'Status',true);
define('TABLE_HEADING_NEW_STATUS', 'Nový status',true);
define('TABLE_HEADING_ACTION', 'Akce',true);
define('TABLE_HEADING_DELETE', 'Smazat?',true);
define('TABLE_HEADING_QUANTITY', 'Počet.',true);
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model',true);
define('TABLE_HEADING_PRODUCTS', 'Produkty',true);
define('TABLE_HEADING_TAX', 'Tax',true);
define('TABLE_HEADING_TOTAL', 'Total',true);
define('TABLE_HEADING_BASE_PRICE', 'Cena<br>(základ)',true);
define('TABLE_HEADING_UNIT_PRICE', 'Cena<br>(bez DPH.)',true);
define('TABLE_HEADING_UNIT_PRICE_TAXED', 'Cena<br>(vč. DPH)',true);
define('TABLE_HEADING_TOTAL_PRICE', 'Celkem<br>(bez DPH)',true);
define('TABLE_HEADING_TOTAL_PRICE_TAXED', 'Celem<br>(vč. DPH)',true);
define('TABLE_HEADING_OT_TOTALS', 'Celková objednávka:',true);
define('TABLE_HEADING_OT_VALUES', 'Hodnota:',true);
define('TABLE_HEADING_SHIPPING_QUOTES', 'Možnosti dopravy:',true);
define('TABLE_HEADING_NO_SHIPPING_QUOTES', 'Nelze zobrazit varianty dopravy!',true);

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Notifikace<br>zákazníkovi zaslána',true);
define('TABLE_HEADING_DATE_ADDED', 'Datum přidání',true);

define('ENTRY_CUSTOMER', 'Zákazník',true);
define('ENTRY_NAME', 'Jméno:',true);
define('ENTRY_CITY_STATE', 'Město, kraj:',true);
define('ENTRY_SHIPPING_ADDRESS', 'Dodací adresa',true);
define('ENTRY_BILLING_ADDRESS', 'Fakturační adresa',true);
define('ENTRY_PAYMENT_METHOD', 'Platební metoda',true);
define('ENTRY_CREDIT_CARD_TYPE', 'Typ karty:',true);
define('ENTRY_CREDIT_CARD_OWNER', 'Vlastník karty:',true);
define('ENTRY_CREDIT_CARD_NUMBER', 'Číslo karty:',true);
define('ENTRY_CREDIT_CARD_EXPIRES', 'Expirace:',true);
define('ENTRY_SUB_TOTAL', 'Mezisoučet:',true);
define('ENTRY_TYPE_BELOW', 'Zadejte níže',true);

//the definition of ENTRY_TAX is important when dealing with certain tax components and scenarios
define('ENTRY_TAX', 'Daň',true);
//do not use a colon (:) in the defintion, ie 'VAT' is ok, but 'VAT:' is not

define('ENTRY_SHIPPING', 'Dopravné:',true); //???
define('ENTRY_TOTAL', 'Celkem:',true);
define('ENTRY_STATUS', 'Status:',true);
define('ENTRY_NOTIFY_CUSTOMER', 'Zaslat Notifikaci zákazníkovi:',true);
define('ENTRY_NOTIFY_COMMENTS', 'Zaslat komnetář:',true);
define('ENTRY_CURRENCY_TYPE', 'Měna',true);
define('ENTRY_CURRENCY_VALUE', 'Hodnota měny',true);

define('TEXT_INFO_PAYMENT_METHOD', 'Platební metoda:',true);
define('TEXT_NO_ORDER_PRODUCTS', 'Tato objednávka neobsahuje žádné produkty',true);
define('TEXT_ADD_NEW_PRODUCT', 'Přidat produkty',true);
define('TEXT_PACKAGE_WEIGHT_COUNT', 'Váha balení: %s  |  Počet produktů: %s',true);

define('TEXT_STEP_1', '<b>Krok 1:</b>',true);
define('TEXT_STEP_2', '<b>Krok 2:</b>',true);
define('TEXT_STEP_3', '<b>Krok 3:</b>',true);
define('TEXT_STEP_4', '<b>Krok 4:</b>',true);
define('TEXT_SELECT_Kategorii', '- Vyberte kategorii ze seznamu -',true);
define('TEXT_PRODUCT_SEARCH', '<b>- Nebo vložte klíčové slovo pro vyhledání -</b>',true);
define('TEXT_ALL_CATEGORIES', 'Všechny kategorie/všechny produkty',true);
define('TEXT_SELECT_PRODUCT', '- Vyberte produkt -',true);
define('TEXT_BUTTON_SELECT_OPTIONS', 'Vybrat tuto variantu',true);
define('TEXT_BUTTON_SELECT_Kategorii', 'Vybrat tuto kategorii',true);
define('TEXT_BUTTON_SELECT_PRODUCT', 'Vybrat tento produkt',true);
define('TEXT_SKIP_NO_OPTIONS', '<em>Žádné varinaty - přeskočeno...</em>',true);
define('TEXT_QUANTITY', 'Počet:',true);
define('TEXT_BUTTON_ADD_PRODUCT', 'Přidat do objednávky',true);
define('TEXT_CLOSE_POPUP', '<u>Zavřít</u> [x]',true);
define('TEXT_ADD_PRODUCT_INSTRUCTIONS', 'Pokračujte v přidávání produktů, dokud nebudete hotovi.<br>Pak zavřete tuto kartu / okno, vraťte se na hlavní kartu / okno a stiskněte tlačítko "aktualizovat".',true);
define('TEXT_PRODUCT_NOT_FOUND', '<b>Produkt nenalezen<b>',true);
define('TEXT_SHIPPING_SAME_AS_BILLING', 'Dodací adresa je stejná jako fakturační',true);
define('TEXT_BILLING_SAME_AS_CUSTOMER', 'Fakrurační adresa je stejá jako zákazníkova',true);

define('IMAGE_ADD_NEW_OT', 'Vložte nový celkový součet po tomto',true);
define('IMAGE_REMOVE_NEW_OT', 'Odebrat tuto komponentu z celkového součtu',true);
define('IMAGE_NEW_ORDER_EMAIL', 'Poslat potvrzovací email',true);


define('TEXT_NO_ORDER_HISTORY', 'Není k dispozici historie objednávky',true);

define('PLEASE_SELECT', 'Prosím vyberte',true);

define('EMAIL_SEPARATOR', '------------------------------------------------------',true);
define('EMAIL_TEXT_SUBJECT', 'Vaše objednávka byla aktualizována',true);
define('EMAIL_TEXT_ORDER_NUMBER', 'Objednávka číslo:',true);
define('EMAIL_TEXT_INVOICE_URL', 'Detail objednávky:',true);
define('EMAIL_TEXT_DATE_ORDERED', 'Datum objednání:',true);
define('EMAIL_TEXT_STATUS_UPDATE', 'Děkujeme za objednávku' . "\n\n" . 'Status vaší objednávky byl aktualizován.' . "\n\n" . 'Nový status: %s' . "\n\n");
define('EMAIL_TEXT_STATUS_UPDATE2', 'Pokud mte jakýkoli dotaz, zašlete jej v odopovědi na tento email.' . "\n\n" . 'S pozdravem ' . STORE_NAME . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Komentáře k vaší objednávce' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'CHYBA:: Objednávka %s neexistuje.',true);
define('ERROR_NO_ORDER_SELECTED', 'Nebybána nojednávka k editaci a nebo nebylo zadáno její číslo.',true);
define('SUCCESS_ORDER_UPDATED', 'Úspěch: Objednávka byla úspěšně aktualizována.',true);
define('SUCCESS_EMAIL_SENT', 'Hotovo, objednávka byla aktualizována, úpravy byly odesláne emailem.',true);

//the hints
define('HINT_UPDATE_TO_CC', 'Nastavte platební metodu na ' . ORDER_EDITOR_CREDIT_CARD . ' a ostatní formulářová pole budou automaticky zobrazena.  CC fields are hidden if any other payment method is selected.  The name of the payment method that, when selected, will display the CC fields is configurable in the Objednávka Editor area of the Configuration section of the Administration panel.',true); //todo
define('HINT_UPDATE_CURRENCY', 'Changing the currency will cause the shipping quotes and order totals to recalculate and reload.',true);
define('HINT_SHIPPING_ADDRESS', 'If you change the shipping state, postcode, or country you will be given the option of whether or not to recalculate the totals and reload the shipping quotes.',true);
define('HINT_TOTALS', 'Feel free to give discounts by adding negative values. Subtotal, tax total, and grand total fields are not editable. When adding in custom order total components via AJAX make sure you enter the title first or the code will not recognize the entry (ie, a component with a blank title is deleted from the order).',true);
define('HINT_PRESS_UPDATE', 'Prosím click on "Update" to save all changes.',true);
define('HINT_BASE_PRICE', 'Cena (base) is the products price before products attributes (ie, the catalog price of the item)',true);
define('HINT_PRICE_EXCL', 'Cena (excl) is the base price plus any product attributes prices that may exist',true);
define('HINT_PRICE_INCL', 'Cena (incl) is Cena (excl) times tax',true);
define('HINT_TOTAL_EXCL', 'Total (excl) is Cena (excl) times qty',true);
define('HINT_TOTAL_INCL', 'Total (incl) is Cena (excl) times tax and qty',true);
//end hints

//new order confirmation email- this is a separate email from order status update
define('ENTRY_SEND_NEW_ORDER_CONFIRMATION', 'Nové potvrzení objednávky:',true);
define('EMAIL_TEXT_DATE_MODIFIED', 'Datum změny:',true);
define('EMAIL_TEXT_PRODUCTS', 'Produkty',true);
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Dodací adresa',true);
define('EMAIL_TEXT_BILLING_ADDRESS', 'Fakturační adresa',true);
define('EMAIL_TEXT_PAYMENT_METHOD', 'Platební metoda',true);
// If you want to include extra payment information, enter text below (use <br> for line breaks):
//define('EMAIL_TEXT_PAYMENT_INFO', '',true); //why would this be useful???
// If you want to include footer text, enter text below (use <br> for line breaks):
define('EMAIL_TEXT_FOOTER', '',true);
//end email

//add-on for downloads
define('ENTRY_DOWNLOAD_COUNT', 'Download #',true);
define('ENTRY_DOWNLOAD_FILENAME', 'Soubor',true);
define('ENTRY_DOWNLOAD_MAXDAYS', 'Expirace dnů',true);
define('ENTRY_DOWNLOAD_MAXCOUNT', 'Zbývající počet stažení',true);

//add-on for Ajax
define('AJAX_CONFIRM_PRODUCT_DELETE', 'Opravdu smazat tento produkt z objednávky?',true);
define('AJAX_CONFIRM_COMMENT_DELETE', 'Opravdu chcete smazat tento komentář zz historie stavů objednávky?',true);
define('AJAX_MESSAGE_STACK_SUCCESS', 'Úspěch! \' + %s + \' aktulaizováno',true);
define('AJAX_CONFIRM_RELOAD_TOTALS', 'Změnil jste některé dodací informace. Chcete přepočítat celkový součet a dopravé?',true);
define('AJAX_CANNOT_CREATE_XMLHTTP', 'Nemohu vytvořit XMLHTTP instanci',true);
define('AJAX_SUBMIT_COMMENT', 'Odeslat nové komentáře/status',true);
define('AJAX_NO_QUOTES', 'Žádné možnosti dopravy nejsou k dispozici.',true);
define('AJAX_SELECTED_NO_SHIPPING', 'Zvolili jste pro tuto objednávku způsob odeslání, ale zdá se, že v databázi není již uložena.  Chtěli byste přidat tyto náklady na dopravu do objednávky?',true);
define('AJAX_RELOAD_TOTALS', 'Nová komponenta přepravy byla zapsána do databáze, ale celkový součet ještě nebyl přepočítán. Klepněte na tlačítko OK pro přepočítání. Pokud je vaše připojení pomalé, počkejte, než se všechny součásti načtou před kliknutím na OK.',true);
define('AJAX_NEW_ORDER_EMAIL', 'Opravdu chcete odeslat nový otvrzovací email pro tuto objednávku?',true);
define('AJAX_INPUT_NEW_EMAIL_COMMENTS', 'Prosím dejte všechny připomínky, které zde můžete mít.  Je v pořádku nechat toto pole prázdné, pokud si nepřejete zahrnout komentáře.  Prosím nezapomeňte při psaní, že stisknutí klávesy "enter" bude mít za následek odeslání komentáře. Nový řídek není podporován.',true);
define('AJAX_SUCCESS_EMAIL_SENT', 'Úspěch!  Nový potvrzovací email byl odeslán zákazníkovi %s',true);
define('AJAX_WORKING', 'Pracuji, vyčkejte prosím....',true);

?>
