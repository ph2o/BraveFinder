<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use Spipu\Html2Pdf\Html2Pdf;
use App\Repository\CandidateRepository;
use App\Repository\EvaluationRepository;
use Symfony\Component\Routing\Annotation\Route;
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
    public function generatePdf2(CandidateRepository $CandidateRepository, EvaluationRepository $EvaluationRepository)
    {
        $candidates = $CandidateRepository->findAll();
        $evaluations = $EvaluationRepository->findAll();

        /*
        return $this->render('pdf/allpdf.html.twig', [
            'candidates' => $candidates,
            'evaluations' => '$evaluations',
        ]);
*/
        // instantiate and use the dompdf class

        $html2pdf = new Html2Pdf('P', 'A4');
        // $html2pdf->setModeDebug();
        $html2pdf->setTestIsImage(false);
        // font de page d'en-tête
        $html2pdf->addFont('Raleway', '', 'Raleway-Thin.ttf');
        $html2pdf->addFont('Raleway-Regular', '', 'Raleway-Regular.ttf');

        $html2pdf->writeHTML($this->renderView('pdf/allpdf.html.twig', [
            'candidates' => $candidates
        ]));
        $html2pdf->output('RapportRecrutement' . date('Y') . '.pdf');
    }
}
