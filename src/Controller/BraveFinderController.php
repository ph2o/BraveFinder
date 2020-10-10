<?php

namespace App\Controller;

use Spipu\Html2Pdf\Html2Pdf;
use App\Repository\CandidateRepository;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * @IsGranted("ROLE_ADMIN")
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

    /**
     * @Route("/exportcandidatexlsx", name="backoffice.xlsx", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function candidateXlsx(CandidateRepository $CandidateRepository): Response
    {
        $spreadsheet = $CandidateRepository->getXlsxData();
        $writer = new Xlsx($spreadsheet);
        // Create a Temporary file in the system
        $fileName = 'RDISMN_Candidats.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);

        // Create the excel file in the tmp directory of the system
        $writer->save($temp_file);

        // Return the excel file as an attachment
        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
    }
}
