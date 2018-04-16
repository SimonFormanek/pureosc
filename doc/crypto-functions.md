# crypto functions

## namespace: SslCrypto

### admin only clases:
* SslDecryptAdmin.php
* SslChangePassphraseAdmin.php

### catalog side only clases:
* SslGenerateCustomerKeys.php
* SslDecryptCustomer.php
* SslChangePassphraseCustomer.php

### commoon classes:
* SslEncrypt.php

### deploy workflow: Makefile
Open common files admin-side and do "make cryptocp".
