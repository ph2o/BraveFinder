<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use Spipu\Html2Pdf\Html2Pdf;
use App\Repository\CandidateRepository;
use App\Repository\EvaluationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BraveFinderController extends AbstractController
{
    /**
     * @Route("/", name="main.index")
     */
    public function index()
    {
        return $this->render('bravefinder/index.html.twig', [
            'controller_name' => 'BraveFinderController',
        ]);
    }


    /**
     * @Route("/generatepdf", name="main.generatePdf")
     *
     * @return void
     */
    public function generatePdf2(CandidateRepository $CandidateRepository)
    {
        $candidates = $CandidateRepository->findAll();

        $html2pdf = new Html2Pdf('P', 'A4');
        // $html2pdf->setModeDebug();
        $html2pdf->setTestIsImage(false);

        $html2pdf->writeHTML($this->renderView('pdf/allpdf.html.twig', [
            'candidates' => $candidates
        ]));

        $fileContent =
            $html2pdf->output('RapportRecrutement' . date('Y') . '.pdf'); // the generated file content

        $response = new Response($fileContent);

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            'RapportRecrutement' . date('Y') . '.pdf'
        );

        $response->headers->set('Content-Disposition', $disposition);
        $response->send();
    }
}
