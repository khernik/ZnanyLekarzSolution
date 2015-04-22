<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\Type\ChangeEmailType;
use AppBundle\Model\UserRepository;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    /**
     * @Route("/change_email", name="change_email")
     */
    public function indexAction(Request $request)
    {
        if ($this->getRequest()->getMethod() == 'POST')
        {
            $repository = new UserRepository();
            $user = $repository->getUserByEmail($_POST['oldEmail']);

            if(! $user)
            {
                return new Response('User with the given email was not found');
            }

            if($_POST['newEmail'] == $_POST['repeatEmail'])
            {
                $user->setEmail($_POST['newEmail']);

                $this->get('StatsSystem')->postRequest(json_encode([$user, $_POST['oldEmail']]));
                $this->get('MarketingSystem')->postRequest(json_encode([$user, $_POST['oldEmail']]));
            }
            else
            {
                return new Response('Emails dont match');
            }
        }

        return $this->render('AppBundle:User:change_email.html.twig');
    }

} // End UserController
