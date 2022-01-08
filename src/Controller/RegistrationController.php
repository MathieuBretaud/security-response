<?php

namespace App\Controller;

use App\Entity\Member;
use App\Entity\User;
use App\Form\MemberType;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Symfony\Component\Validator\Constraints as Assert;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelper;

class RegistrationController extends AbstractController
{
    private $verifyEmailHelper;
    private $token;
    private $mailer;

    public function __construct(VerifyEmailHelper $helper, MailerInterface $mailer, TokenStorageInterface $token)
    {
        $this->verifyEmailHelper = $helper;
        $this->token = $token;
        $this->mailer = $mailer;
    }

    /**
     * @Route("/inscriptions/{role}", name="app_register")
     */
    public function register(string $role, Request $request, UserPasswordHasherInterface $userPasswordHasherInterface, SluggerInterface $slugger): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasherInterface->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            if ($role == "membre") {

                $user->setRoles(["ROLE_MEMBER"]);
                $user->getuserMember()->setSlug(strtolower($slugger->slug($user->getuserMember()->getFirstname() . '-' . $user->getuserMember()->getLastname())));
            }
            if ($role == "entreprise") {

                $user->setRoles(["ROLE_ENTERPRISE"]);
                $user->getuserEnterprise()->setSlug(strtolower($slugger->slug($user->getuserEnterprise()->getBusinessName())));
            }
            if ($role == "societe") {

                $user->setRoles(["ROLE_COMPANY"]);
                $user->getuserCompany()->setSlug(strtolower($slugger->slug($user->getuserCompany()->getBusinessName())));
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $signatureComponents = $this->verifyEmailHelper->generateSignature(
                'registration_confirmation_route',
                $user->getId(),
                $user->getEmail()
            );

            $email = new TemplatedEmail();
            $email->from('send@example.com');
            $email->to($user->getEmail());
            $email->htmlTemplate('registration/confirmation_email.html.twig');
            $email->context(['signedUrl' => $signatureComponents->getSignedUrl()]);

            $this->mailer->send($email);

            $this->addFlash('success', 'le compte a été créé');

            return $this->redirectToRoute('homepage');
        }


        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'role' => $role,
        ]);
    }

    /**
     * @Route("/verify/email", name="app_verify_email")
     */
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('homepage');
    }
}
