<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
 */

define('NAVBAR_TITLE', 'Enviar a un Amigo', true);

define('HEADING_TITLE', 'Enviar información sobre \'%s\' a un amigo', true);

define('FORM_TITLE_CUSTOMER_DETAILS', 'Tus datos', true);
define('FORM_TITLE_FRIEND_DETAILS', 'Los datos de tu amigo', true);
define('FORM_TITLE_FRIEND_MESSAGE', 'Tu Mensaje', true);

define('FORM_FIELD_CUSTOMER_NAME', 'Tu Nombre:', true);
define('FORM_FIELD_CUSTOMER_EMAIL', 'Tu Correo Electrónico:', true);
define('FORM_FIELD_FRIEND_NAME', 'El Nombre de tu amigo:', true);
define('FORM_FIELD_FRIEND_EMAIL', 'El Correo Electrónico de tu amigo:', true);

define('TEXT_EMAIL_SUCCESSFUL_SENT',
    'Tu Correo Electrónico sobre <strong>%s</strong> ha sido enviado con éxito a <strong>%s</strong>.',
    true);

define('TEXT_EMAIL_SUBJECT',
    'Tu amigo %s ha recomendado este gran producto de %s', true);
define('TEXT_EMAIL_INTRO',
    '¡Hola %s!'."\n\n".'Tu amigo %s, pensó que estarías interesado en %s de %s.',
    true);
define('TEXT_EMAIL_LINK',
    'Para ver el producto haga click en el siguiente enlace o copie y pegue el enlace en su navegador:'."\n\n".'%s',
    true);
define('TEXT_EMAIL_SIGNATURE', 'Atentamente,'."\n\n".'%s', true);

define('ERROR_TO_NAME', 'Error: El Nombre de su amigo no puede estar vacío.',
    true);
define('ERROR_TO_ADDRESS',
    'Error: El Correo Electrónico de tu amigo debe ser una dirección válida de correo electrónico.',
    true);
define('ERROR_FROM_NAME', 'Error: Su nombre no puede estar vacío.', true);
define('ERROR_FROM_ADDRESS',
    'Error: Su dirección de correo electrónico debe ser una dirección v&aacute;lida de correo electrónico.',
    true);
define('ERROR_ACTION_RECORDER',
    'Error: Un correo electrónico ya ha sido enviado. Por favor intente de nuevo en %s minutos.',
    true);