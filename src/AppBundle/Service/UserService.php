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

class UserService
{

    private $stats, $marketing;

    public function __construct($stats, $marketing)
    {
        $this->stats = $stats;
        $this->marketing = $marketing;
    }

    public function changeEmail($user, $newEmail, $oldEmail)
    {
        // set new email
        $user->setEmail($newEmail);

        // notify services
        $this->stats->postRequest([$oldEmail, $newEmail]);
        $this->marketing->postRequest([$oldEmail, $newEmail]);
    }
}
