<?php

namespace App\Controller;

use App\Entity\Evaluation;
use App\Form\EvaluationType;
use App\Entity\EvaluationSearch;
use App\Form\EvaluationSearchType;
use App\Repository\PracticeRepository;
use App\Repository\EvaluationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/evaluation")
 * @IsGranted("ROLE_CLOSTROPHOBIE, ROLE_ENDURANCE, ROLE_FORCE, ROLE_ENTRETIEN, ROLE_VERTIGE, ROLE_CONFIANCE, ROLE_ADMIN")
 */
class EvaluationController extends AbstractController
{
    /**
     * @Route("/", name="evaluation.index", methods={"GET"})
     */
    public function index(Request $request, EvaluationRepository $evaluationRepository, PracticeRepository $PracticeRepository): Response
    {
        $search = new EvaluationSearch;

        // Filtre par rôle/épreuve
        $roles = $this->getUser()->getEvaluationRoles();
        if ((count($roles) == 1) and ($roles[0] != "ROLE_ADMIN")) {
            $search->setPractice($PracticeRepository->findOneByGroupAllowed($roles[0])->getName());
        }

        $form = $this->createForm(EvaluationSearchType::class, $search);
        $form->handleRequest($request);

        return $this->render('evaluation/index.html.twig', [
            'form' => $form->createView(),
            'evaluations' => $evaluationRepository->findAllQuery($search),
        ]);
    }

    /**
     * @Route("/new", name="evaluation.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $evaluation = new Evaluation();
        $form = $this->createForm(EvaluationType::class, $evaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evaluation);
            $entityManager->flush();

            return $this->redirectToRoute('evaluation.index');
        }

        return $this->render('evaluation/new.html.twig', [
            'evaluation' => $evaluation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="evaluation.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Evaluation $evaluation, EvaluationRepository $EvaluationRepository): Response
    {
        $form = $this->createForm(EvaluationType::class, $evaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evaluation.index');
        }

        $evaluations = $EvaluationRepository->findAllPracticesForCandidate($evaluation->getCandidate());

        if ($evaluation->getPractice()->getGroupAllowed() == 'ROLE_ENTRETIEN') {
            $edit = 'entretien/edit.html.twig';
        } else {
            $edit = 'evaluation/edit.html.twig';
        }

        return $this->render($edit, [
            'evaluation' => $evaluation,
            'form' => $form->createView(),
            'evaluations' => $evaluations,
        ]);
    }

    /**
     * @Route("/{id}", name="evaluation.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Evaluation $evaluation): Response
    {
        if ($this->isCsrfTokenValid('delete' . $evaluation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evaluation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('evaluation.index');
    }
}
