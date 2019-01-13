<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//namespace PureOSC\Admin;

/**
 * Description of emailMailManager
 *
 * @author vitex
 */
/* * * Altered for Mail Manager ** */

// eliminate line feeds as <br>
class admin_emailMailManager extends admin_email
{

    function add_html($html, $text = NULL, $images_dir = NULL)
    {
        $this->html      = $html; //tep_convert_linefeeds(array("\r\n", "\n", "\r"), '<br>', $html);
        $this->html_text = tep_convert_linefeeds(array("\r\n", "\n", "\r"),
            $this->lf, $text);
        if (isset($images_dir)) $this->find_html_images($images_dir);
    }
}

/* * * EOF alterations for Mail Manager ** */

