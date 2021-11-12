<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginFormController extends AbstractController 
{
  public function form(Request $request, AuthenticationUtils $authenticationUtils)
  {
    if ($this->getUser()) {
        return $this->redirectToRoute('homepage');
    }

    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();
    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('security/login-form.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
  }
}
