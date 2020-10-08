<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Form\CandidateType;
use App\Entity\CandidateSearch;
use App\Form\CandidateSearchType;
use App\Repository\CandidateRepository;
use App\Repository\EvaluationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/candidate")
 */
class CandidateController extends AbstractController
{
    /**
     * @Route("/", name="candidate.index", methods={"GET"})
     */
    public function index(Request $request, CandidateRepository $candidateRepository): Response
    {
        $search = new CandidateSearch;
        $form = $this->createForm(CandidateSearchType::class, $search);
        $form->handleRequest($request);

        return $this->render('candidate/index.html.twig', [
            'form' => $form->createView(),
            'candidates' => $candidateRepository->findAllQuery($search),
        ]);
    }

    /**
     * @Route("/new", name="candidate.new", methods={"GET","POST"})
     */
    public function new(Request $request, EvaluationRepository $EvaluationRepository): Response
    {
        $candidate = new Candidate();
        $form = $this->createForm(CandidateType::class, $candidate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($candidate);
            $entityManager->flush();

            $EvaluationRepository->addNewEvaluations();

            return $this->redirectToRoute('candidate.index');
        }

        return $this->render('candidate/new.html.twig', [
            'candidate' => $candidate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="candidate.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Candidate $candidate): Response
    {
        $form = $this->createForm(CandidateType::class, $candidate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $candidate->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('candidate.index');
        }
        return $this->render('candidate/edit.html.twig', [
            'candidate' => $candidate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="candidate.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Candidate $candidate): Response
    {
        if ($this->isCsrfTokenValid('candidate.delete' . $candidate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($candidate);
            $entityManager->flush();
        }
        return $this->redirectToRoute('candidate.index');
    }
}
