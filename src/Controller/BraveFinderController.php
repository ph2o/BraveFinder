<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\EvaluationRepository;
use App\Form\UserType;
use App\Repository\PracticeRepository;
use App\Repository\UserRepository;
use Spipu\Html2Pdf\Html2Pdf;
use App\Entity\CandidateSearch;
use App\Form\CandidateSearchType;
use App\Repository\CandidateRepository;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class BraveFinderController extends AbstractController
{
    /**
     * @Route("/", name="main.index")
     */
    public function index(CandidateRepository $CandidateRepository, EvaluationRepository $evaluationRepository)
    {
        $onSiteCandidates  = $CandidateRepository->findBy(['onSite' => true]);
        $offSiteCandidates = $CandidateRepository->findBy(['onSite' => false]);
        $engagedCandidates = $CandidateRepository->findBy(['engaged' => true]);
        $evaluations       = $evaluationRepository->findOpenEvaluations($this->getUser()->getRoles()[0]);

        return $this->render('bravefinder/index.html.twig', [
            'onSiteCandidates'  => $onSiteCandidates,
            'offSiteCandidates' => $offSiteCandidates,
            'engagedCandidates' => $engagedCandidates,
            'evaluations'       => $evaluations,
        ]);
    }

    /**
     * @Route("/menu", name="main.menu")
     */
    public function menu(PracticeRepository $practiceRepository)
    {
        $practices = $practiceRepository->findAll();

        return $this->render('_menu.html.twig', [
            'practices' => $practices,
        ]);
    }

    /**
     * @Route("/generatepdf", name="main.generatePdf")
     * @Route("/generatepdf/{id}", name="main.generatePdf.candidate")
     * @IsGranted("ROLE_ADMIN")
     *
     * @return void
     */
    public function generatePdf2(Request $request, CandidateRepository $CandidateRepository)
    {
        $candidates = $CandidateRepository->findAll();

        if ($id = $request->get('id')) {
            $candidates = $CandidateRepository->findBy(['id' => $id]);
        }

        $html2pdf = new Html2Pdf('P', 'A4');
        // $html2pdf->setModeDebug();
        $html2pdf->setTestIsImage(false);

        $html2pdf->writeHTML($this->renderView('pdf/allpdf.html.twig', [
            'candidates' => $candidates,
        ]));

        $fileContent
            = $html2pdf->output('RapportRecrutement'.date('Y').'.pdf'); // the generated file content

        $response = new Response($fileContent);

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            'RapportRecrutement'.date('Y').'.pdf'
        );

        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }

    /**
     * @Route("/exportcandidatexlsx", name="backoffice.xlsx", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function candidateXlsx(CandidateRepository $CandidateRepository): Response
    {
        $spreadsheet = $CandidateRepository->getXlsxData();
        $writer      = new Xlsx($spreadsheet);
        // Create a Temporary file in the system
        $fileName  = 'RDISMN_Candidats.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);

        // Create the excel file in the tmp directory of the system
        $writer->save($temp_file);

        // Return the excel file as an attachment
        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
    }

    /**
     * @Route("/engageCandidate", name="backoffice.engage", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function EngageCandidate(Request $request, CandidateRepository $candidateRepository): Response
    {
        $search = new CandidateSearch;
        $form   = $this->createForm(CandidateSearchType::class, $search);
        $form->handleRequest($request);

        return $this->render('candidate/engaged.html.twig', [
            'form'       => $form->createView(),
            'candidates' => $candidateRepository->findAllOnSiteQuery($search),
        ]);
    }

    /**
     * @Route("/users", name="backoffice.users", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function users(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new", name="backoffice.user.new", methods={"GET","POST"})
     */
    public function new(
        Request $request,
        EvaluationRepository $EvaluationRepository,
        UserPasswordEncoderInterface $passwordEncoder
    ): Response {
        $user = new User();
        $form = $this->createForm(UserType::class, $user, ['allow_extra_fields' => true]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles($form->get('roles')->getData());
            $encodedPassword = $passwordEncoder->encodePassword(
                $user,
                $form->get('plainPassword')->getData()
            );

            $user->setPassword($encodedPassword);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $EvaluationRepository->addNewEvaluations();

            return $this->redirectToRoute('backoffice.users');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/{id}/edit", name="backoffice.user.edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles($form->get('roles')->getData());
            $encodedPassword = $passwordEncoder->encodePassword(
                $user,
                $form->get('plainPassword')->getData()
            );

            $user->setPassword($encodedPassword);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'User updated');

            return $this->redirectToRoute('backoffice.users');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/{id}/delete", name="backoffice.user.delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(User $user, Request $request): Response
    {
        if ($this->isCsrfTokenValid('user.delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
            $this->addFlash('success', 'User deleted');
        }

        return $this->redirectToRoute('backoffice.users');
    }
}
