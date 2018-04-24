# GDPR před zákonem 
*(Franz Kafka: Proces)*

## GDPR a bezpečný eshop

Již zhruba 5 let vyvíjíme vlastní fork Open Source eshopu [osCommerce][].  Naše priority jsou především bezpodmínečná
bezpečnost, ochrana citlivých dat a maximální provozní spolehlivost (Wikipedia: unconditional safety, single point of
failure).

Když vyl zveřejněný text GDPR, viděli jsme, že jsme z hledisk nařízení úspěšně implementovali 30% povinných položek. 70%
je byrokracie. Šifrování citlivých údajů je **nepovinné**....

## GDPR vymaz citlivych dat
https://www.podnikatel.cz/clanky/gdpr-a-vymaz-osobnich-udaju-po-skonceni-pracovniho-pomeru

*V okamžiku, kdy uplynou veškeré účely pro zpracování osobních údajů, musí zaměstnavatel osobní údaje vždy aktivně sám
vymazat. "Nelze je například uchovávat jen proto, že by se třeba „mohly v budoucnu hodit“. K mazání nelze rozhodně
přistupovat tak, že by zaměstnavatel smazal pouze osobní údaje těch bývalých zaměstnanců, kteří si o to aktivně řekli
(tzv. uplatnili právo na výmaz), a údaje ostatních bývalých zaměstnanců dále archivoval," vysvětlil pro server
Podnikatel.cz Ladislav Karas, právník ze společnosti KPMG Legal. Doplnil, že pojem výmaz zahrnuje jak fyzickou likvidaci
dokumentů v papírové podobě (skartaci), tak smazání osobních údajů zpracovávaných elektronicky, a to ze všech systémů,
včetně vytvořených záloh.*

je možné chápat tím *vymazáním citlivých dat* jejich bezpečné znepřístupnění smazáním soukromých klíčů daných uživatelů? 
Tím dojde efektivně k nemožnosti dešifrovat citlivá data jak v běžících datbázích i ve všech zálohách: pokud bychom
chápali výše uvedenou formulaci doslovně, museli bychom každou vytvořenou zálohu otevřít a smazat z ní citlivá data a 
tím vystavit zálohovaná data nezepčí nekonzistence dat, musel bych tyto operace provádět púeriodicky nad vzrůsatajícm 
počtem záloh rostoucí pouze aritmewtickou žadou a představovat si že jsem žadatel přšd zákonem z Kafkova Procesu.

poklud GDPR požaduje výmaz od počátku jak by ani nebylo, je to nesmysl, neproveditelné, právní fikce.


[osCommerce]: https://www.oscommerce.com