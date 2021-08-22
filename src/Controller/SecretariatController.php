<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Entity\CandidateSearch;
use App\Form\CandidateMesureType;
use App\Form\CandidateOfficeType;
use App\Form\CandidateSearchType;
use App\Form\CandidateReceptionType;
use App\Repository\CandidateRepository;
use App\Repository\EvaluationRepository;
use App\Repository\PracticeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/secretariat")
 */
class SecretariatController extends AbstractController
{
    /**
     * @Route("/reception", name="secretariat.reception")
     * @Route("/")
     * @Security("is_granted('ROLE_ACCUEIL') or is_granted('ROLE_ADMIN')")
     *
     */
    public function reception(CandidateRepository $candidateRepository)
    {
        return $this->render('secretariat/index.html.twig', [
            'candidates' => $candidateRepository->findBy(['onSite' => false]),
        ]);
    }


    /**
     * @Route("/reception/{id}/edit", name="secretariat.reception.edit", methods={"GET","POST"})
     * @Security("is_granted('ROLE_ACCUEIL') or is_granted('ROLE_ADMIN')")
     *
     */
    public function editreception(Request $request, Candidate $candidate)
    {
        $form = $this->createForm(CandidateReceptionType::class, $candidate, ['allow_extra_fields' => true]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $candidate->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();

            if ($candidate->getOnSite()){
                $this->addFlash('success', 'Candidate is on site');
            }

            return $this->redirectToRoute('secretariat.reception');
        }

        return $this->render('secretariat/welcome.html.twig', [
            'candidate' => $candidate,
            'form'      => $form->createView()
        ]);
    }

    /**
     * @Route("/mesure", name="secretariat.mesure")
     * @Security("is_granted('ROLE_MESURE') or is_granted('ROLE_ADMIN')")
     */
    public function mesure(Request $request, CandidateRepository $candidateRepository)
    {
        $search = new CandidateSearch;
        $form   = $this->createForm(CandidateSearchType::class, $search);
        $form->handleRequest($request);

        return $this->render('secretariat/index.html.twig', [
            'candidates' => $candidateRepository->findAllOnSiteQuery($search),
            'job'        => 'mesure',
        ]);
    }


    /**
     * @Route("/administratif", name="secretariat.administratif")
     * @Security("is_granted('ROLE_SECRETARIAT') or is_granted('ROLE_ADMIN')")
     *
     */
    public function administratif(Request $request, CandidateRepository $candidateRepository)
    {
        $search = new CandidateSearch;
        $form   = $this->createForm(CandidateSearchType::class, $search);
        $form->handleRequest($request);

        return $this->render('secretariat/index.html.twig', [
            'form'       => $form->createView(),
            'candidates' => $candidateRepository->findAllOnSiteQuery($search),
            'job'        => 'office',
        ]);
    }

    /**
     * @Route("/administratif/{id}/edit", name="secretariat.administratif.edit", methods={"GET","POST"})
     * @Security("is_granted('ROLE_SECRETARIAT') or is_granted('ROLE_ADMIN') or is_granted('ROLE_MESURE')")
     *
     */
    public function editAdministratif(
        Request $request,
        Candidate $candidate,
        EvaluationRepository $evaluationRepository
    ) {
        $practices     = $evaluationRepository->findBy(['candidate' => $candidate]);
        $candidateForm = $this->createForm(CandidateOfficeType::class, $candidate, ['allow_extra_fields' => true]);
        $candidateForm->handleRequest($request);

        if ($candidateForm->isSubmitted() && $candidateForm->isValid()) {
            $candidate->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Candidate successfully updated');
            return $this->redirectToRoute('secretariat.administratif');
        }

        $measureForm = $this->createForm(CandidateMesureType::class, $candidate, ['allow_extra_fields' => true]);
        $measureForm->handleRequest($request);

        if ($measureForm->isSubmitted() && $measureForm->isValid()) {
            $candidate->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Measurement successfully updated');
            return $this->redirectToRoute('secretariat.mesure');
        }

        $form_total = $form_filed = count($candidateForm->all()) + count($measureForm->all());
        foreach ($candidateForm->all() as $item) {
            if ($item->isEmpty()) {
                $form_filed = $form_filed - 1;
            }
        }
        foreach ($measureForm->all() as $item) {
            if ($item->isEmpty()) {
                $form_filed = $form_filed - 1;
            }
        }

        return $this->render('secretariat/edit.html.twig', [
            'candidate'     => $candidate,
            'practices'     => $practices,
            'candidateForm' => $candidateForm->createView(),
            'measureForm'   => $measureForm->createView(),
            'total_profile' => $form_filed * 100 / $form_total,
        ]);
    }
}
