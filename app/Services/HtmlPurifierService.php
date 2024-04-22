<?php

namespace App\Services;

use HTMLPurifier;
use HTMLPurifier_Config;

class HtmlPurifierService
{
    public static function clean($html)
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Doctype', 'HTML 4.01 Transitional'); // Set this according to your needs
        $purifier = new HTMLPurifier($config);

        return $purifier->purify($html);
    }
}
