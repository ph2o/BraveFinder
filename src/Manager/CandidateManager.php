<?php

namespace App\Manager;

use App\Entity\Candidate;

class CandidateManager
{
    const PROFILE_DATA
        = [
            'firstname',
            'name',
            'birthdate',
            'mobile',
            'street',
            'zip',
            'city',
            'mail',
            'picture',
            'originName',
            'bankName',
            'iban',
            'SocialNumber',
            'maritalStatus',
            'title',
        ];
    const MEASURE_DATA
        = [
            'waitingPants',
            'firePants',
            'sweat',
            'teeshirt',
            'firejacket',
            'rubberBoots',
            'rangerBoots',
            'fireGloves',
        ];

    public function profileCompletion(Candidate $candidate)
    {
        return $this->countData(self::PROFILE_DATA, $candidate);
    }

    public function measureCompletion(Candidate $candidate)
    {
        return $this->countData(self::MEASURE_DATA, $candidate);
    }

    private function countData($requiredData, $candidate)
    {
        $total = 0;
        foreach ($requiredData as $data) {
            $functionName = 'get'.ucfirst($data);
            if (method_exists($candidate, $functionName)) {
                $total = $total + ($candidate->{$functionName}() ? 1 : 0);
            }
        }

        return count($requiredData) - $total;
    }
}
