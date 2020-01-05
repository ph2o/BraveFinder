<?php

namespace App\Entity;

class EvaluationSearch
{
    /**
     * Candidate
     *
     * @var string|null
     */
    private $Candidate;

    /**
     * Practice
     *
     * @var string|null
     */
    private $Practice;

    /**
     * Get candidate
     *
     * @return  string|null
     */
    public function getCandidate()
    {
        return $this->Candidate;
    }

    /**
     * Set candidate
     *
     * @param   string|null  $Candidate  Candidate
     *
     * @return  self
     */
    public function setCandidate($Candidate)
    {
        $this->Candidate = $Candidate;

        return $this;
    }

    /**
     * Get practice
     *
     * @return  string|null
     */
    public function getPractice()
    {
        return $this->Practice;
    }

    /**
     * Set practice
     *
     * @param   string|null  $Practice  Practice
     *
     * @return  self
     */
    public function setPractice($Practice)
    {
        $this->Practice = $Practice;

        return $this;
    }
}
