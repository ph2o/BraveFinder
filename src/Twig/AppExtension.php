<?php

namespace App\Twig;

use App\Entity\Candidate;
use App\Manager\CandidateManager;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('profileCount', [$this, 'profileCompletion']),
            new TwigFunction('measureCount', [$this, 'measureCompletion']),
        ];
    }

    public function profileCompletion(Candidate $candidate )
    {
        $candidateManager = new CandidateManager();
        return $candidateManager->profileCompletion($candidate);
    }

    public function measureCompletion(Candidate $candidate )
    {
        $candidateManager = new CandidateManager();
        return $candidateManager->measureCompletion($candidate);
    }
}
