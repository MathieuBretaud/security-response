<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\MemberType;
use App\Repository\MemberRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * Les annotations de routes au niveau de la classe servent de préfixe à toutes les routes définies dans celle ci
 * 
 * @Route("/members", name="member_")
*/
class MemberController extends AbstractController
{
    
    /**
     * @Route("/", name="list")
     */
    public function list(): Response
    {
        return $this->render('member/list.html.twig', [
            'controller_name' => 'MemberController',
        ]);
    }

     /**
     * 
     * @Route("/edit/{id}", name="read")
     */
    public function read($id,MemberRepository $MemberRepository ): Response
    { 
       
        $member = $MemberRepository->find($id);
      
        return $this->render('member/read.html.twig', [
            'member_read' => $member,
        ]);
    }
    
     /**
     * 
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $member = new Member();

       
        $memberForm = $this->createForm(MemberType::class, $member);

        $memberForm->handleRequest($request);

            if ($memberForm->isSubmitted() && $memberForm->isValid()) {

           
                $member = $memberForm->getData();

                // On associe le user connecté à la question
                $member->setUser($this->getUser());
    
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($member);
                $entityManager->flush();
    
                $this->addFlash('success', "Le membre `{$member->getFirstName()}` à été ajouté");
    
                return $this->redirectToRoute('member_list', ['id' => $member->getId()]);

           
        }

        // on fournit ce formulaire à notre vue
        return $this->render('/member/add.html.twig', [
            'form' => $memberForm->createView(),
            'page' => 'create',
        ]);
    }
}