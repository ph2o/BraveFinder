<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Form\CandidateType;
use App\Entity\CandidateSearch;
use App\Form\CandidateSearchType;
use App\Form\CandidateAccueilType;
use App\Repository\CandidateRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/secretariat")
 */

class SecretariatController extends AbstractController
{
    /**
     * @Route("/accueil", name="secretariat.accueil")
     * @Route("/")
     */
    public function accueil(Request $request, CandidateRepository $candidateRepository)
    {
        $search = new CandidateSearch;
        $form = $this->createForm(CandidateSearchType::class, $search);
        $form->handleRequest($request);

        return $this->render('secretariat/index.html.twig', [
            'form' => $form->createView(),
            'candidates' => $candidateRepository->findAllQuery($search),
            'job' => 'accueil',
        ]);
    }

    /**
     * @Route("/accueil/{id}/edit", name="secretariat.accueil.edit", methods={"GET","POST"})
     */
    public function editAccueil(Request $request, Candidate $candidate)
    {
        $form = $this->createForm(CandidateAccueilType::class, $candidate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $candidate->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('secretariat.accueil');
        }
        return $this->render('secretariat/edit.html.twig', [
            'candidate' => $candidate,
            'form' => $form->createView(),
            'job' => 'accueil',
        ]);
    }

    /**
     * @Route("/mesure", name="secretariat.mesure")
     */
    public function mesure(Request $request, CandidateRepository $candidateRepository)
    {
        $search = new CandidateSearch;
        $form = $this->createForm(CandidateSearchType::class, $search);
        $form->handleRequest($request);

        return $this->render('secretariat/index.html.twig', [
            'form' => $form->createView(),
            'candidates' => $candidateRepository->findAllOnSiteQuery($search),
            'job' => 'mesure',
        ]);
    }

    /**
     * @Route("mesure/{id}/edit", name="secretariat.mesure.edit", methods={"GET","POST"})
     */
    public function editMesure(Request $request)
    {
        //       $form = $this->createForm(CandidateType::class, $candidate);
        //       $form->handleRequest($request);

        //       if ($form->isSubmitted() && $form->isValid()) {
        //           $candidate->setUpdatedAt(new \DateTime());
        //           $this->getDoctrine()->getManager()->flush();

        //            return $this->redirectToRoute('candidate.index');
        //        }
        return new Response('retour');
    }

    /**
     * @Route("/administratif", name="secretariat.administratif")
     */
    public function administratif(Request $request, CandidateRepository $candidateRepository)
    {
        // $form = $this->createForm(AccueilType::class, $candidate);
        // $form->handleRequest($request);
        // if ($form->isSubmitted() && $form->isValid()) {
        //     $candidate->setUpdatedAt(new \DateTime());
        //     $this->getDoctrine()->getManager()->flush();
        //     return $this->redirectToRoute('candidate.index');
        // }
        return new Response('retour');
    }

    /**
     * @Route("administratif/{id}/edit", name="secretariat.administratif.edit", methods={"GET","POST"})
     */
    public function editAdministratif(Request $request)
    {
        //       $form = $this->createForm(CandidateType::class, $candidate);
        //       $form->handleRequest($request);

        //       if ($form->isSubmitted() && $form->isValid()) {
        //           $candidate->setUpdatedAt(new \DateTime());
        //           $this->getDoctrine()->getManager()->flush();

        //            return $this->redirectToRoute('candidate.index');
        //        }
        return new Response('retour');
    }
}
