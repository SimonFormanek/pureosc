<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
 */

class objectInfo
{

    public function __construct($object_array)
    {
        $this->objectInfo($object_array);
    }


// class constructor
    function objectInfo($object_array)
    {
        reset($object_array);
        while (list($key, $value) = each($object_array)) {
            $this->$key = tep_db_prepare_input($value);
        }
    }
}
