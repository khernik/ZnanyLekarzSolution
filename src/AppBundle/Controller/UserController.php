<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Model\UserRepository;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    /**
     * Display email changing form or change the email
     *
     * @param Request $request
     * @return Response
     * @Route("/change_email", name="change_email")
     */
    public function indexAction(Request $request)
    {
        if ($this->getRequest()->getMethod() == 'POST')
        {
            $repository = new UserRepository();

            // get user
            $user = $repository->getUserByEmail($request->request->get('oldEmail'));

            if(! $user)
            {
                return new Response('User with the given email was not found');
            }

            if($_POST['newEmail'] == $_POST['repeatEmail'])
            {
                $this->get('UserService')->changeEmail($user, $request->request->get('newEmail'), $request->request->get('oldEmail'));
            }
            else
            {
                return new Response('Emails dont match');
            }
        }

        return $this->render('AppBundle:User:change_email.html.twig');
    }

} // End UserController
