<?php
/**
 * Created by PhpStorm.
 * User: Radek
 * Date: 06/01/15
 * Time: 22:14
 */

namespace AppBundle\Service;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MarketingSystem
{
    public function postRequest($data)
    {
        $logger = new Logger('logger');
        $logger->info('Email has been changed from ' . $data[0] . ' to ' . $data[1] . ' - marketing system');

        return true;
    }
}
