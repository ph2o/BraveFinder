<?php

namespace App\Controller;

use App\Entity\Practice;
use App\Form\PracticeType;
use App\Repository\PracticeRepository;
use App\Repository\EvaluationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/practice")
 * @IsGranted("ROLE_ADMIN")
 */
class PracticeController extends AbstractController
{
    /**
     * @Route("/practice/", name="backoffice-practice.index", methods={"GET"})
     */
    public function index(PracticeRepository $practiceRepository): Response
    {
        return $this->render('practice/index.html.twig', [
            'practices' => $practiceRepository->findAll(),
        ]);
    }



    /**
     * @Route("/new", name="backoffice-practice.new", methods={"GET","POST"})
     */
    public function new(Request $request, EvaluationRepository $EvaluationRepository): Response
    {
        $practice = new Practice();
        $form = $this->createForm(PracticeType::class, $practice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($practice);
            $entityManager->flush();

            $EvaluationRepository->addNewEvaluations();

            $this->addFlash('success', 'Practice successfully added');
            return $this->redirectToRoute('backoffice-practice.index');
        }

        return $this->render('practice/new.html.twig', [
            'practice' => $practice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="backoffice-practice.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Practice $practice): Response
    {
        //override header id for practice id instead of evaluation one (for active menu purpose)
        $request->attributes->set('id',$practice->getId());

        $form = $this->createForm(PracticeType::class, $practice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $practice->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Practice successfully updated');
            return $this->redirectToRoute('backoffice-practice.index');
        }

        return $this->render('practice/edit.html.twig', [
            'practice' => $practice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="backoffice-practice.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Practice $practice): Response
    {
        if ($this->isCsrfTokenValid('backoffice-practice.delete' . $practice->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($practice);
            $entityManager->flush();
            $this->addFlash('success', 'Practice successfully deleted');
        }
        return $this->redirectToRoute('backoffice-practice.index');
    }
}
